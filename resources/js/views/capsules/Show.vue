<template>
    <v-card class="mx-auto mt-10" max-width="400" tile>
        <v-list-item two-line>
            <v-list-item-content>
                <v-list-item-title>Capsule Detail</v-list-item-title>
                <v-list-item-subtitle
                    >Capsule Id : {{ capsule.capsule_id }}</v-list-item-subtitle
                >
                <v-list-item-subtitle
                    >Capsule Serial :
                    {{ capsule.capsule_serial }}</v-list-item-subtitle
                >
                <v-list-item-subtitle
                    >Capsule Status : {{ capsule.status }}</v-list-item-subtitle
                >
                <v-list-item-subtitle
                    >Capsule Type : {{ capsule.type }}</v-list-item-subtitle
                >
                <v-list-item-subtitle>
                    Original Launch : {{ capsule.original_launch }}
                </v-list-item-subtitle>
                <v-list-item-subtitle>
                    Original Launch Unix : {{ capsule.original_launch_unix }}
                </v-list-item-subtitle>
                <v-list-item-subtitle>
                    Landings : {{ capsule.landings }}
                </v-list-item-subtitle>
                <v-list-item-subtitle>
                    Reuse Count : {{ capsule.reuse_count }}
                </v-list-item-subtitle>
                <v-list-item-subtitle>
                    Details : {{ capsule.details }}
                </v-list-item-subtitle>
            </v-list-item-content>
        </v-list-item>

        <v-list-item three-line v-if="missions.length > 0">
            <v-list-item-content>
                <v-list-item-title>Missions</v-list-item-title>
                <v-list-item-subtitle
                    v-for="mission in missions"
                    :key="mission.capsule_serial"
                >
                    Mission Name : {{ mission.name }} <br />
                    Flights :
                    {{ mission.flight }}
                </v-list-item-subtitle>
            </v-list-item-content>
        </v-list-item>
        <v-list-item>
            <router-link
                style="text-decoration: none; color: inherit"
                :to="{ name: 'Capsules' }"
            >
                <v-btn>
                    <v-icon left>mdi-arrow-left</v-icon>
                    Back
                </v-btn>
            </router-link>
        </v-list-item>
    </v-card>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            capsule: null,
            missions: [],
        };
    },
    computed: {
        capsule_serial() {
            return this.$route.params.capsule_serial;
        },
    },
    methods: {
        getCapsuleDetail() {
            axios
                .get(`http://localhost/api/capsules/${this.capsule_serial}`)
                .then((response) => {
                    this.capsule = response.data;
                    this.missions = response.data.missions;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
    beforeMount() {
        this.getCapsuleDetail();
    },
    watch: {
        capsule_serial() {
            this.capsule = null;
            this.getCapsuleDetail();
        },
    },
};
</script>
