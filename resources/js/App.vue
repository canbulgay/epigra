<template>
    <v-app>
        <v-app-bar app dark>
            <div class="d-flex align-center">
                <v-btn to="/">
                    <v-icon>mdi-home</v-icon>
                    <span class="mx-2">Home</span>
                </v-btn>
                <v-btn to="/about">
                    <v-icon>mdi-information-outline</v-icon>
                    <span class="mx-2">About</span>
                </v-btn>
                <v-btn v-if="_isAuthenticated" to="/capsules">
                    <v-icon>mdi-rocket</v-icon>
                    <span class="mx-2">Capsules</span>
                </v-btn>
            </div>

            <v-spacer></v-spacer>

            <v-btn v-show="!_isAuthenticated" to="/register">
                <v-icon>mdi-account-plus-outline</v-icon>
                <span class="mx-2">Register</span>
            </v-btn>
            <v-btn v-show="!_isAuthenticated" to="/login">
                <v-icon>mdi-account-arrow-right-outline</v-icon>
                <span class="mx-2">Login</span>
            </v-btn>
            <v-btn v-if="_isAuthenticated" to="/profile">
                <v-icon>mdi-account-box</v-icon>
                <span class="mx-2">{{ _getCurrentUser.name }}</span>
            </v-btn>
            <v-btn v-show="_isAuthenticated" @click.prevent="logout">
                <v-icon>mdi-logout</v-icon>
                <span class="mx-2">Logout</span>
            </v-btn>
        </v-app-bar>

        <v-main>
            <router-view />
        </v-main>
    </v-app>
</template>

<script>
import { mapGetters, mapActions } from "vuex";

export default {
    name: "App",

    data: () => ({
        //
    }),
    computed: {
        ...mapGetters(["_isAuthenticated", "_getCurrentUser"]),
    },
    methods: {
        ...mapActions(["logout"]),
    },
};
</script>
