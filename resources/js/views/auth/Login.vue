<template>
    <v-container>
        <v-row>
            <v-col cols="5" class="rounded elevation-7 mt-10">
                <validation-observer ref="observer" v-slot="{ invalid }">
                    <v-form ref="form" @submit.prevent="login" class="mt-5">
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
import { mapMutations } from "vuex";
import { required, email } from "vee-validate/dist/rules";
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
extend("email", {
    ...email,
    message: "Please enter a email address",
});

export default {
    components: {
        ValidationProvider,
        ValidationObserver,
    },
    data: () => ({
        email: null,
        password: null,
    }),
    methods: {
        ...mapMutations(["setUserToLoggedin"]),
        login() {
            this.$refs.observer.validate();
            axios
                .post("http://localhost/api/login", {
                    email: this.email,
                    password: this.password,
                })
                .then((login_response) => {
                    console.log(login_response);
                    this.setUserToLoggedin(login_response.data);
                    this.$router.push("/");
                })
                .catch((e) => {
                    console.log(e);
                });
        },
        clear() {
            (this.email = null),
                (this.password = null),
                this.$refs.observer.reset();
        },
    },
};
</script>
