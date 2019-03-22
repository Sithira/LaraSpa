<template>

    <div>

        <Header></Header>

        <div class="container">
            <router-view></router-view>
        </div>
    </div>

</template>

<script>
    import Header from "./components/layouts/Header";
    export default {
        name: "App",
        components: { Header }
    }
</script>

<style scoped>

</style>
