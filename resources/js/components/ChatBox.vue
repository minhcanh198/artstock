<template>
    <div class="position-fixed z-1000 w-25 h-50 right-10 bottom-0 bg-white rounded-top border"
         v-if="currentChatId&&showChatBox">
        <div class="d-flex flex-column h-100">
            <div class="px-2 py-1 bg-red rounded-top d-flex justify-content-between align-items-center">
                <div><strong class="text-white">{{ chatHeader }}</strong></div>
                <button type="button" class="btn text-white" @click="showChatBoxAction(false)">X</button>
            </div>
            <div class="p-3 h-75 overflow-scroll" ref="messageList">
                <message v-for="message in messages" :key="message.message_id" :message="message"
                         :avatar="messageAvatar(message)">
                </message>
            </div>
            <div class="d-flex flex-grow-1 px-1 py-1 align-items-center border-top justify-content-between">
                <input type="text" class="px-2 m-0 rounded w-80" placeholder="enter your message" v-model="message"
                       @keypress="triggerSendMessage">
                <button type="button" class="btn" title="Send" @click="sendMessage">
                    <svg width="20px" height="20px" viewBox="0 0 24 24" class="crt8y2ji">
                        <path
                            d="M16.6915026,12.4744748 L3.50612381,13.2599618 C3.19218622,13.2599618 3.03521743,13.4170592 3.03521743,13.5741566 L1.15159189,20.0151496 C0.8376543,20.8006365 0.99,21.89 1.77946707,22.52 C2.41,22.99 3.50612381,23.1 4.13399899,22.8429026 L21.714504,14.0454487 C22.6563168,13.5741566 23.1272231,12.6315722 22.9702544,11.6889879 C22.8132856,11.0605983 22.3423792,10.4322088 21.714504,10.118014 L4.13399899,1.16346272 C3.34915502,0.9 2.40734225,1.00636533 1.77946707,1.4776575 C0.994623095,2.10604706 0.8376543,3.0486314 1.15159189,3.99121575 L3.03521743,10.4322088 C3.03521743,10.5893061 3.34915502,10.7464035 3.50612381,10.7464035 L16.6915026,11.5318905 C16.6915026,11.5318905 17.1624089,11.5318905 17.1624089,12.0031827 C17.1624089,12.4744748 16.6915026,12.4744748 16.6915026,12.4744748 Z"
                            fill="#0084ff"></path>
                    </svg>
                </button>

            </div>
        </div>
    </div>
</template>

<script>
import {mapActions, mapGetters, mapState} from "vuex";
import Message from "./Message";

export default {
    name: "ChatBox",
    components: {
        Message: Message
    },
    data() {
        return {
            message: "",
            messages: []
        }
    },
    mounted() {
        this.getMessages();
        setInterval(() => {
            if (this.showChatBox)
                this.getMessages();
        }, 10000)
    },

    computed: {
        ...mapState(['currentChatId', 'user', 'showChatBox']),
        ...mapGetters(['currentChat']),
        chatHeader() {
            if (this.messages.length > 0) {
                if (this.user.id != this.currentChat.sender_id) {
                    return this.currentChat.sender.name
                }
                return this.currentChat.receiver.name
            }
            return "Receiver name"
        },
        chatMateId() {
            if (this.user.id == this.currentChat.sender_id) {
                return this.currentChat.receiver_id
            }
            return this.currentChat.sender_id
        },
    },

    methods: {
        ...mapActions(['showChatBoxAction']),
        sendMessage() {
            if (this.message != "") {
                axios.post(`/chat/${this.currentChatId}/message`, {
                    'message': this.message,
                    'to': this.chatMateId
                })
                    .then(res => {
                        this.messages.push(res.data)
                        this.scrollBottom()
                    })
                    .catch(err => {
                        console.log(err)
                    })
                this.message = ''
            }
        },
        triggerSendMessage(event) {
            if (event.key == 'Enter') {
                this.sendMessage();
            }
        },
        async getMessages() {
            if (this.currentChatId) {
                let res = await axios.get(`/chat/${this.currentChatId}`)
                this.messages = res.data
                this.scrollBottom()
            }
        },
        messageAvatar(message) {
            return message.sender.avatar
        },
        scrollBottom() {
            setTimeout(() => {
                this.$refs.messageList.scrollTop = this.$refs.messageList.scrollHeight
            }, 1)
        }
    },
}
</script>

<style scoped>
.right-10 {
    right: 1rem;
}

.bottom-0 {
    bottom: 0;
}

.z-1000 {
    z-index: 1000;
}

.bg-red {
    background: #ef595f
}

.overflow-scroll {
    overflow-y: scroll;
}

.w-80 {
    width: 80%;
}

</style>
