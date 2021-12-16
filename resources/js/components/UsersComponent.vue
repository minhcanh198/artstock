<template> 
    <div class="card users-box">
        <div class="card-header" @click="collapsed = !collapsed"> 
            Users
        </div>
        <div class="card-body users" v-show="!collapsed">
            <div class="user" v-for="user in users" :key="user.id"  v-if="user.username != 'Admin'" @click="addToActiveChat(user)"> 
                
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQSXmfj4kUOZR1oT7ood5_AqnC_TgkuyVojx73oE2eYdp4Mvl29" width="30" height="30">
                {{ user.username }} 
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['messages', 'userId'],
    data() {
        return {
            collapsed: false,
            users: []
        }
    },
    async created() {
        const {data} = await axios.get('/darquise_nantel/get-users')
        this.users = data.users
    },
    methods: {
        addToActiveChat(user) {

            console.log('asdas')
            this.EventBus.$emit('newActiveChat', user)
        }
    },
}
</script>