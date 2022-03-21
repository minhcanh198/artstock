import Vue from 'vue';
import Vuex from 'vuex'

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        showChatBox: true
    },
    mutations: {
        SHOW_CHAT_BOX(state, isShow) {
            state.showChatBox = isShow
        }
    },
    actions: {
        showChatBoxAction({commit}, isShow) {
            commit("SHOW_CHAT_BOX", isShow)
        },
    }
})

export default store;
