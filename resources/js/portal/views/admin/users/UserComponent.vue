<template>
    <div>

        <v-card>
            <v-toolbar>
                User Details
                <v-spacer></v-spacer>

                <v-dialog v-model="dialog" persistent max-width="600px">
                    <template v-slot:activator="{ on }">
                        <v-btn color="primary" dark v-on="on">Edit</v-btn>
                    </template>

                    <v-card>
                        <v-form @submit.prevent="updateDetails">
                            <v-card-title class="headline">Update details</v-card-title>

                            <v-card-text>


                                <v-text-field
                                        label="Name"
                                        data-vv-name="name"
                                        v-model="user.name"
                                >
                                </v-text-field>

                                <v-text-field
                                        label="Email"
                                        data-vv-name="email"
                                        v-model="user.email"
                                >
                                </v-text-field>


                            </v-card-text>

                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn color="red darken-1" flat @click="dialog = false">Close</v-btn>
                                <v-btn color="green darken-1" type="submit" flat @click="dialog = false">Save</v-btn>
                            </v-card-actions>
                        </v-form>
                    </v-card>
                </v-dialog>

            </v-toolbar>

            <v-card-text>
                <p>Name: {{ user.name }}</p>
                <p>Email: {{ user.email }}</p>
                <p>Provider: {{ user.provider }}</p>
            </v-card-text>

        </v-card>
    </div>
</template>

<script>
    import {mapActions, mapGetters} from "vuex";
    import swal from 'sweetalert';

    export default {
        name: "user",

        data() {
            return {
                dialog: false
            }
        },

        computed: {
            ...mapGetters('users', [
                'user'
            ])
        },
        methods: {
            ...mapActions('users', [
                'get',
                'update'
            ]),
            updateDetails() {

                swal({
                    title: 'Are you sure to update ?',
                    buttons: true,
                    dangerMode: true
                }).then((response) => {

                    if (response) {
                        this.update(this.user).then(() => {
                            $("#edit").modal('hide');
                        }).catch(function (e) {
                            console.log(e)
                        });
                    }

                }).catch(() => {
                    swal.stopLoading();
                })

            }
        },
        created() {
            this.get(this.$route.params.id);
        }
    }
</script>

<style scoped>

</style>
