import Vue from "vue";
import Vuex from "vuex";
import VuexPersistence from "vuex-persist";
import axios from "axios";

Vue.use(Vuex);

const vuexLocal = new VuexPersistence({
    storage: window.localStorage,
    reducer: (state) => ({
        user: state.user,
    }),
});

export default new Vuex.Store({
    state: {
        user: null,
    },
    getters: {
        _isAuthenticated: (state) => state.user !== null,
        _getCurrentUser(state) {
            const user = state.user;
            return user;
        },
    },
    mutations: {
        setUserToLoggedin(state, user) {
            state.user = user;
        },
        removeUserLoggedin(state) {
            state.user = null;
        },
    },
    actions: {
        logout({ commit }) {
            axios
                .get("http://localhost/api/logout")
                .then(() => {
                    commit("removeUserLoggedin");
                })
                .catch(() => {
                    commit("removeUserLoggedin");
                })
                .finally(() => {
                    router.push("/");
                });
        },
    },
    plugins: [vuexLocal.plugin],
});
