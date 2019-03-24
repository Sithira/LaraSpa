<template>

    <div>

        <div class="loading" v-if="isRequestPending">
            <half-circle-spinner
                    id="loader"
                    :animation-duration="1000"
                    :size="60"
                    :color="'#FFFFFF'"
            ></half-circle-spinner>
        </div>

        <Header></Header>

        <div class="container">
            <router-view></router-view>
        </div>
    </div>

</template>

<script>
    import Header from "./components/layouts/Header";

    import {HalfCircleSpinner} from 'epic-spinners'
    import {mapGetters} from "vuex";

    export default {
        name: "App",
        computed: {
            ...mapGetters('base', ['isRequestPending'])
        },
        components: {Header, HalfCircleSpinner}
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
