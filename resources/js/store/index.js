import Vue from 'vue';
import Vuex from 'vuex'

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        user: null,
        showChatBox: false,
        chats: [],
        currentChatId: null,
    },
    actions: {
        showChatBoxAction({commit}, isShow) {
            commit("SHOW_CHAT_BOX", isShow)
        },
        async getChats({commit}) {
            let chats = await axios.get(`/chats`)
            commit('SET_CHATS', chats.data)
        },
        selectChat({commit}, chatId) {
            commit('SET_CURRENT_CHAT', chatId)
        }
    },
    mutations: {
        SET_USER(state, user) {
            state.user = user
        },
        SHOW_CHAT_BOX(state, isShow) {
            state.showChatBox = isShow
        },
        SET_CHATS(state, chats) {
            state.chats = chats
        },
        SET_CURRENT_CHAT(state, chatId) {
            state.currentChatId = chatId
        }
    },
})

export default store;
