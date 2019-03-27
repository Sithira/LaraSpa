<template>
    <div>

        <div v-if="user">

            <div class="card">
                <div class="card-header">
                    User details

                    <div class="float-right">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit">
                            Edit
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <p>Name: {{ user.name }}</p>
                    <p>Email: {{ user.email }}</p>
                    <p>Provider: {{ user.provider }}</p>
                </div>
            </div>

        </div>

        <!-- Modal -->
        <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Form - {{ user.name }} </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" v-model="user.name">
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email" v-model="user.email">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" @click="updateDetails">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapActions, mapGetters} from "vuex";
    import swal from 'sweetalert';

    export default {
        name: "user",
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
