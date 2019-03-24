<template>
    <div>

        <h3>Users in system</h3>

        <v-data-table
                :headers="headers"
                :items="users"
                class="elevation-1"
        >

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
        <!--<div class="table-responsive">-->

            <!--<table class="table table-bordered">-->

                <!--<thead>-->
                    <!--<tr>-->
                        <!--<th>#</th>-->
                        <!--<th>Name</th>-->
                        <!--<th>Provider</th>-->
                        <!--<th>Email</th>-->
                        <!--<th>Action</th>-->
                    <!--</tr>-->
                <!--</thead>-->

                <!--<tbody>-->
                    <!--<tr v-for="user in users">-->
                        <!--<td>{{ user.id }}</td>-->
                        <!--<td>{{ user.name }}</td>-->
                        <!--<td>{{ user.provider || 'N/A' }}</td>-->
                        <!--<td>{{ user.email }}</td>-->
                        <!--<td>-->
                            <!--<router-link tag="a" class="btn btn-sm btn-primary" :to="{ name: 'user', params: { id: user.id } }">-->
                                <!--view-->
                            <!--</router-link>-->
                        <!--</td>-->
                    <!--</tr>-->
                <!--</tbody>-->

            <!--</table>-->

        <!--</div>-->
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
