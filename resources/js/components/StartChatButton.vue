<template>
    <button type="button" class="bg-info btn rounded p-2" @click="startChat">Start chat</button>
</template>

<script>
import {mapState} from "vuex";

export default {
    name: "StartChatButton",

    props: ['receiverId'],

    methods: {
        async startChat() {
            try {
                let res = await axios.post("/chat", {
                    'to': this.receiverId
                });
                let newChatId = res.data
                await this.$store.dispatch('getChat', newChatId)
                this.$store.commit("SET_CURRENT_CHAT", newChatId)
            } catch (e) {
                console.log(e)
            }

            this.$store.commit('SHOW_CHAT_BOX', true)
        },
    },
    computed: {
        ...mapState(['showChatBox', 'user'])
    },
}
</script>

<style scoped>

</style>
