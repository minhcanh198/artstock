<template>
    <div class="container">
        <h3><strong>Messages</strong></h3>
        <div class="divider"></div>
        <div v-for="(message, index) in messages">
            <div class="d-flex message py-2">
                <div class="col-3 pl-1">
                    <strong class="mr-2">{{ message.user }}</strong>
                </div>
                <div class="col-9">
                    <div>{{ message.message }}</div>
                </div>
            </div>
            <div v-if="index!=messages.length-1" class="divider m-0"></div>
        </div>
    </div>
</template>

<script>
export default {
    name: "ChatPanel",
    data() {
        return {
            messages: [
                {
                    user: "Mith",
                    message: "Hot control name think may has think no keeng",
                },
                {
                    user: "Bdyjs",
                    message: "knafh faghagh asfgya aafav",
                },
                {
                    user: "Rndhfm",
                    message: "fgf adhaf wvha avgfaf ",
                },
                {
                    user: "Rdxsth",
                    message: "sdfhsdf agdfasdf  sufjs usfha  agsdf",
                },
                {
                    user: "Egxbxvzv",
                    message: "fhgs hsfgs hs df",
                },
            ]
        }
    },
    props: ['user'],
    created() {
        console.log(this.user)
    }
}
</script>

<style scoped>
.message:hover {
    cursor: pointer;
    background: #ef595f;
}
</style>
