<template>

    <component :is="layout">
        <router-view></router-view>
    </component>

</template>

<script>
    export default {
        name: "App",
        computed: {
            layout() {
                if (window.location.href.indexOf("/portal") > -1
                    || window.location.href.indexOf("/login") > -1
                    || window.location.href.indexOf("/register") > -1) {
                    return "System";
                } else {
                    return "Web"
                }
            }
        },
        components: {}
    }
</script>

<style scoped>
    div.loading {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(16, 16, 16, 0.72);
        z-index: 1500;
    }

    #loader {
        margin: auto;
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        width: 200px;
        height: 200px;
    }
</style>
