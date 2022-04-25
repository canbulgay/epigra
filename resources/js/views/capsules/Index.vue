<template>
    <v-container>
        <v-data-table :headers="headers" :items="capsules" class="elevation-1">
            <template v-slot:top>
                <v-toolbar flat>
                    <v-toolbar-title>Capsules</v-toolbar-title>
                    <v-spacer></v-spacer>
                    <v-toolbar-items>
                        <h3>Status : {{ status }}</h3>
                    </v-toolbar-items>
                    <v-divider class="mx-4" inset vertical></v-divider>
                </v-toolbar>
                <v-spacer></v-spacer>
                <div></div>
            </template>
            <template v-slot:item="{ item }">
                <tr>
                    <td>{{ item.capsule_serial }}</td>
                    <td>{{ item.capsule_id }}</td>
                    <td>{{ item.original_launch }}</td>
                    <td>
                        <router-link
                            style="text-decoration: none; color: inherit"
                            :to="{
                                name: 'Capsule',
                                params: { capsule_serial: item.capsule_serial },
                            }"
                        >
                            <v-btn
                                to=""
                                color="secondary"
                                elevation="2"
                                rounded
                                small
                                >Details</v-btn
                            >
                        </router-link>
                    </td>
                </tr>
            </template>
        </v-data-table>
    </v-container>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            headers: [
                {
                    text: "Capsule Serial",
                    align: "start",
                    sortable: false,
                    value: "capsule_serial",
                },
                { text: "Capsule Id", value: "capsule_id" },
                { text: "Original Launch", value: "original_launch" },
                { text: "Details", value: "details", sortable: false },
            ],
            capsules: [
                {
                    capsule_serial: null,
                    capsule_id: null,
                    original_launch: null,
                },
            ],
        };
    },
    computed: {
        status() {
            if (this.$route.query.status) {
                return this.$route.query.status;
            } else {
                return "All";
            }
        },
    },
    methods: {
        getCapsules() {
            axios
                .get("http://localhost/api/capsules")
                .then((response) => {
                    console.log(response.data);
                    this.capsules = response.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        getCapsulesByStatus() {
            axios
                .get(`http://localhost/api/${this.status}/capsules`)
                .then((response) => {
                    console.log(response.data);
                    this.capsules = response.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
    beforeMount() {
        if (this.$route.query.status) {
            this.getCapsulesByStatus();
        } else {
            this.getCapsules();
        }
    },
};
</script>
