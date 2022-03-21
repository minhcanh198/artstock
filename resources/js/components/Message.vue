<template>
    <div class="d-flex align-items-center mb-3">
        <img width="40" height="40"
             src="https://fiverr-res.cloudinary.com/t_profile_original,q_auto,f_auto/attachments/profile/photo/cbe166efbaa64c12ed8e9f88d459d875-1629640689379/0644d5ae-4555-4f22-bfa3-39bca8e96e3a.jpg"
             class="profile-pict-img rounded-circle" alt="minhcanhnguyen">
        <div class="text-blue ml-2">{{ message }}</div>
    </div>
</template>

<script>
export default {
    name: "Message",
    props: ['message']
}
</script>

<style scoped>

</style>
