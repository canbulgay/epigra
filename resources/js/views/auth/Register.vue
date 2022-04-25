<template>
    <v-container>
        <v-row>
            <v-col cols="6" class="rounded elevation-10 mt-10">
                <validation-observer ref="observer" v-slot="{ invalid }">
                    <v-form ref="form" @submit.prevent="register" class="mt-5">
                        <validation-provider
                            v-slot="{ errors }"
                            name="Name"
                            :counter="10"
                            rules="required|max:15|min:3|alpha"
                        >
                            <v-text-field
                                v-model="name"
                                label="Name"
                                :error-messages="errors"
                            ></v-text-field>
                        </validation-provider>

                        <validation-provider
                            v-slot="{ errors }"
                            rules="required|email"
                            name="Email"
                        >
                            <v-text-field
                                v-model="email"
                                label="E-mail"
                                :error-messages="errors"
                            >
                            </v-text-field>
                        </validation-provider>

                        <validation-provider
                            v-slot="{ errors }"
                            rules="required|min:7"
                            name="Password"
                        >
                            <v-text-field
                                v-model="password"
                                label="Password"
                                :error-messages="errors"
                                type="password"
                            >
                            </v-text-field>
                        </validation-provider>

                        <validation-provider
                            v-slot="{ errors }"
                            name="Password Confirmation"
                            rules="required|confirmed:Password"
                        >
                            <v-text-field
                                v-model="password_confirmation"
                                label="Password (Confirmation)"
                                :error-messages="errors"
                                type="password"
                            >
                            </v-text-field>
                        </validation-provider>

                        <center>
                            <v-btn
                                color="primary"
                                class="mr-4 mt-5"
                                type="submit"
                                :disabled="invalid"
                            >
                                Submit
                            </v-btn>
                            <v-btn
                                color="secondary"
                                class="mr-4 mt-5"
                                @click="clear"
                            >
                                Clear
                            </v-btn>
                        </center>
                    </v-form>
                </validation-observer>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
import axios from "axios";
import {
    required,
    max,
    min,
    confirmed,
    email,
    alpha,
} from "vee-validate/dist/rules";
import {
    extend,
    ValidationObserver,
    ValidationProvider,
    setInteractionMode,
} from "vee-validate";

setInteractionMode("eager");

extend("required", {
    ...required,
    message: "{_field_} can not be empty",
});
extend("max", {
    ...max,
    message: "{_field_} may not be greater than {length} characters",
});
extend("min", {
    ...min,
    message: "{_field_} may not be lower than {length} characters",
});
extend("confirmed", {
    ...confirmed,
    message: "Your password does not match the password confirmation",
});
extend("email", {
    ...email,
    message: "Please enter a email address",
});
extend("alpha", {
    ...alpha,
    message: "The {_field_} field may only contain alphabetic characters",
});

export default {
    components: {
        ValidationProvider,
        ValidationObserver,
    },
    data: () => ({
        name: null,
        email: null,
        password: null,
        password_confirmation: null,
    }),
    methods: {
        register() {
            this.$refs.observer.validate();
            axios
                .post("http://localhost/api/register", {
                    name: this.name,
                    email: this.email,
                    password: this.password,
                    password_confirmation: this.password_confirmation,
                })
                .then((register_response) => {
                    console.log(register_response.data);
                    this.$router.push("/login");
                });
        },
        clear() {
            (this.name = null),
                (this.email = null),
                (this.password = null),
                (this.password_confirmation = null),
                this.$refs.observer.reset();
        },
    },
};
</script>
