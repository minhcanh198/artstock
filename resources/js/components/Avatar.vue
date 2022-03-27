<template>
    <img width="40" height="40"
         :src="`/avatar/${imageUrl}`"
         class="profile-pict-img rounded-circle" alt="avatar">
</template>

<script>
export default {
    name: "Avatar",
    props: [
        "imageUrl",
    ]
}
</script>

<style scoped>

</style>
