import Vue from "vue";
import Vuex from "vuex";
import VuexPersistence from "vuex-persist";

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
    getters: {},
    mutations: {},
    actions: {},
    plugins: [vuexLocal.plugin],
});
