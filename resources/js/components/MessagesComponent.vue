<template> 
    <div class="card user-box">
        <div class="card-header" @click="collapsed = !collapsed"> 
            {{ chat.username }}
            <span class="btn-close-chat" @click="closeChat">X</span>
        </div>
        <div class="card-body" v-show="!collapsed">
            <div class="user-messages">
                <div
                    class="chat-message" 
                    v-for="message in messages" 
                    :key="message.id"
                    :class="[(message.user.id == username) ? 'from-client' : 'from-admin']"
                >
                    {{ message.text }}
                </div>
               
            </div>
            <div class="input-container">
                <input
                    class="chat-input" 
                    type="text" 
                    placeholder="enter message..." 
                    v-model="message"
                    v-on:keyup.enter="addMessage"
                    @keydown="startedTyping"
                    @keyup="stoppedTyping"
                    @enter="addMessage"
                >
            </div>
             <span class="help-block mt-2" v-if="isTyping && typing.user.id !== username" style="font-style: italic;">{{ `${chat.username} is typing...` }}</span>
        </div>
    </div>
</template>

<script>
export default {
    props: ['client', 'chat', 'autheduser'],
    data() {
        return {
            message: "",
            messages: [],
            collapsed: false,
            channel: null,
            isTyping: false,
            typing: null
        }
    },
    computed: {
        username() {
            return this.autheduser.email.replace(/[@\.]/g, '_')
        }
    },
    async created() {
        console.log('Message component created hook');
        const to_username = this.chat.email.replace(/[@\.]/g, '_')
         
        // Initialize the channel
        const channel = this.client.channel('messaging', {
            name: 'Awesome channel',
            members: [this.username, to_username]
        });

        this.channel = channel

        // fetch the channel state, subscribe to future updates
        channel.watch().then(state => {
            this.messages = state.messages
            
            // Listen for new messages on the channel
            channel.on('message.new', event => {
                this.messages.push(event.message)
            });
        })

        this.channel.on("typing.start", event => {
            this.isTyping = true;
            this.typing = event;
        });

        this.channel.on("typing.stop", event => {
            this.isTyping = false;
        });
    },
    methods: {

        addMessage() {
            console.log('asd qwezxc cvbdfg fsd');
            // Send message to the channel
            this.channel && this.channel.sendMessage({
                text: this.message,
            });
            
            this.message = "";

            this.$parent.createChat();

        },
        closeChat(){
            this.$parent.closeChat()
        },
        
        async startedTyping() {
           await this.channel.keystroke();
        },
        stoppedTyping() {
            setTimeout(async () => {
                await this.channel.stopTyping();
            }, 5000);
        }
    }
}

$("#btnCloseChat").click(function(){
    console.log('clicked on close btn of chat system ');
});
</script>