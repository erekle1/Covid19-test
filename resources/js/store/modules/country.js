const state = {
    countries: {}
};
const getters = {
    countries: (state) => {
        return state.countries
    }
};
const actions = {
    get_countries: ({context}, vueInstance) => {
        vueInstance.axios.get('/api/countries').then((response) => {
            context.commit('set_countries', response.data)
        })
    }
};
const mutations = {
    set_countries: (state, data) => {
        state.countries = data
    }
};

export default {
    namespaced: true,
    state, getters, actions, mutations
}
