import Vue from 'vue'
import Vuex from 'vuex'
import createPersistedState from "vuex-persistedstate";

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        user: {}
    },
    mutations: {
        setUserState: (state, value) => {
            state.user = value
        }
    },
    actions: {
        userStateAction: (store) => {
            axios.get('api/user/me').then(async (result) => {
                const { user } = await result.data;
                store.commit('setUserState', user);
            })
        }
    },
    plugins: [createPersistedState()],
})
