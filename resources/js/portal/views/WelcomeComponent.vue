<template>
    <h3>{{ welcome }}</h3>
</template>

<script>
    export default {
        name: "WelcomeComponent",
        computed: {
            welcome: () => {
                return 'Welcome to LaraSpa';
            }
        }
    }
</script>

<style scoped>

</style>
