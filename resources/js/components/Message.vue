<template>
    <div class="d-flex align-items-center mb-3">
        <Avatar></Avatar>
        <div class="text-blue ml-2">{{ message.message_text }}</div>
    </div>
</template>

<script>
import Avatar from "./Avatar";

export default {
    name: "Message",
    props: ['message'],
    components: {
        Avatar: Avatar
    }
}
</script>

<style scoped>

</style>
