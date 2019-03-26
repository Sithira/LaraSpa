<template>
    <div>

        <v-card class="elevation-3">

            <v-toolbar flat="">
                <v-toolbar-title>Users in System</v-toolbar-title>
            </v-toolbar>

            <v-card-text>

                <v-data-table :headers="headers" :items="users">

                    <template v-slot:items="props">
                        <td>{{ props.item.id }}</td>
                        <td>{{ props.item.name }}</td>
                        <td>{{ props.item.email }}</td>
                        <td>{{ props.item.provider }}</td>
                        <td>
                            <v-btn class="primary" small :to="{ name: 'user', params: { id: props.item.id } }">View</v-btn>
                        </td>
                    </template>

                </v-data-table>
            </v-card-text>

        </v-card>
    </div>
</template>

<script>
    import {mapActions, mapGetters} from "vuex";

    export default {
        name: "users",

        data() {

            return {
                headers: [
                    { text: '# ID', value: 'id' },
                    { text: 'Name', value: 'name' },
                    { text: 'Email', value: 'email' },
                    { text: 'Provider', value: 'provider' },
                    { text: 'Actions', value: 'actions' }
                ],
            }

        },

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
