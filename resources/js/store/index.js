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
    getters: {
        currentChat: state => {
            let filteredChat = state.chats.filter(chat => {
                return chat.chat_id == state.currentChatId;
            })
            return filteredChat.length != 0 ? filteredChat[0] : null;
        }
    },
    actions: {
        showChatBoxAction({commit}, isShow) {
            commit("SHOW_CHAT_BOX", isShow)
        },
        async getChats({commit}) {
            let chats = await axios.get(`/chats`)
            commit('SET_CHATS', chats.data)
        },
        async getChat({commit}, chatId) {
            let chats = await axios.get(`/chat/${chatId}/detail`)
            commit('ADD_CHAT', chats.data)
        },
        selectChat({commit}, chatId) {
            commit('SET_CURRENT_CHAT', chatId)
        },
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
        },
        ADD_CHAT(state, chat) {
            state.chats.push(chat)
        }
    },
})

export default store;
