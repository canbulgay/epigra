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
            </div>

            <v-spacer></v-spacer>
        </v-app-bar>

        <v-main>
            <router-view />
        </v-main>
    </v-app>
</template>

<script>
export default {
    name: "App",
};
</script>
