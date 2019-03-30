<template>

    <div>

        <h3>
            Checkups in system

            <div class="float-right">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit">
                    Create
                </button>
            </div>
        </h3>
        <div class="table-responsive">

            <table class="table table-bordered">

                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
                </thead>

                <tbody>
                <tr v-for="checkup in checkups">
                    <td>{{ checkup.id }}</td>
                    <td>{{ checkup.name }}</td>
                    <td>{{ checkup.description || "N/A" }}</td>
                    <td>
                        <router-link tag="a" class="btn btn-sm btn-primary" :to="{ name: 'portal-admin-checkup', params: { id: checkup.id } }">
                            view
                        </router-link>
                    </td>
                </tr>
                </tbody>

            </table>

        </div>

        <!-- Modal -->
        <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Form - {{ checkup.name }} </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" v-model="checkup.name">
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea id="description" name="description" class="form-control"  v-model="checkup.description">

                            </textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" @click="create">Create</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    import {mapActions, mapGetters} from "vuex";

    export default {
        name: "Checkups",
         computed: {
            ...mapGetters("checkups", [
                "checkups",
                "checkup"
            ])
        },
        methods: {
            ...mapActions("checkups", [
                "all",
                "store"
            ]),
            create() {
                this.store(this.checkup);
            }
        },

        mounted() {
            this.all();
        }
    }
</script>

<style scoped>

</style>
