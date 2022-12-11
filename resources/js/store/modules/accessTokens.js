const state = {
    access_tokens: {}
};
const getters = {
    access_tokens: (state) => {
        return state.access_tokens
    }
};
const actions = {
    get_access_tokens: ({context}, vueInstance) => {
        vueInstance.axios.get('/api/access_tokens').then((response) => {
            context.commit('set_access_tokens', response.data)
        })
    }
};
const mutations = {
    set_access_tokens: (state, data) => {
        state.access_tokens = data
    }
};

export default {
    namespaced: true,
    state, getters, actions, mutations
}
