<template>
    <div>

        <h3>Users in system</h3>
        <div class="table-responsive">

            <table class="table table-bordered">

                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Provider</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    <tr v-for="user in users">
                        <td>{{ user.id }}</td>
                        <td>{{ user.name }}</td>
                        <td>{{ user.provider || 'N/A' }}</td>
                        <td>{{ user.email }}</td>
                        <td>
                            <router-link tag="a" class="btn btn-sm btn-primary" :to="{ name: 'portal-admin-user', params: { id: user.id } }">
                                view
                            </router-link>
                        </td>
                    </tr>
                </tbody>

            </table>

        </div>
    </div>
</template>

<script>
    import {mapActions, mapGetters} from "vuex";

    export default {
        name: "users",
        computed: {
            ...mapGetters('users', [
                'users',
            ])
        },

        methods: {
            ...mapActions('users', [
                'all'
            ])
        },
        mounted() {
            this.all();
        }
    }
</script>

<style scoped>

</style>
