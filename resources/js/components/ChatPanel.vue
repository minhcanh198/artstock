<template>
    <div class="container px-1">
        <h3><strong>Messages</strong></h3>
        <div class="divider"></div>
        <div class="d-flex font-italic my-5 justify-content-center px-2" v-if="chats.length==0">
            Your chat history is empty
        </div>
        <div v-for="(chat, index) in chats">
            <div class="d-flex message py-2 align-items-center"
                 @click="showChatBoxAction(true);selectChat(chat.chat_id);">
                <div class="col-3 pl-1">
                    <Avatar></Avatar>
                </div>
                <div class="col-9">
                    <strong class="mr-2" v-if="chat.sender.id!==user.id">{{ chat.sender.name }}</strong>
                    <strong class="mr-2" v-else>{{ chat.receiver.name }}</strong>
                    <div>{{ chat.last_message.message_text }}</div>
                </div>
            </div>
            <div v-if="index!=chats.length-1" class="divider m-0"></div>
        </div>
    </div>
</template>

<script>
import ChatBox from "./ChatBox";
import {mapState, mapActions} from "vuex";
import Avatar from "./Avatar";

export default {
    name: "ChatPanel",
    components: {
        ChatBox: ChatBox,
        Avatar: Avatar
    },
    props: ['user'],
    computed: {
        ...mapState(['showChatBox', 'chats']),
    },
    created() {
        this.$store.commit("SET_USER", this.user)
    },
    mounted() {
        this.getChats()
    },
    methods: {
        ...mapActions(['showChatBoxAction', 'getChats', 'selectChat']),
    }
}
</script>

<style scoped>
.message:hover {
    cursor: pointer;
    background: #ef595f;
}
</style>
