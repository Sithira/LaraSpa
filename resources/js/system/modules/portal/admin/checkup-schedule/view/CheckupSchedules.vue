<template>
    <div>

        <h3>
            Schedules in system

            <div class="float-right">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#store">
                    Create
                </button>
            </div>
        </h3>

        <div class="table-responsive">

            <table class="table table-bordered">

                <thead>
                <tr>
                    <th>#</th>
                    <th>User id</th>
                    <th>Request by</th>
                    <th>Diagnosed Date</th>
                    <th>Note</th>
                    <th>Active</th>
                </tr>
                </thead>

                <tbody>
                <tr v-for="schedule in schedules">
                    <td>{{ schedule.id }}</td>
                    <td>{{ schedule.user_id }}</td>
                    <td>{{ schedule.request_by }}</td>
                    <td>{{ schedule.diagnosed_date || "N/A" }}</td>
                    <td>{{ schedule.note || "N/A" }}</td>
                    <td>
                        <router-link tag="a" class="btn btn-sm btn-primary" :to="{ name: 'portal-admin-schedule', params: { id: schedule.id } }">
                            view
                        </router-link>
                    </td>
                </tr>
                </tbody>

            </table>

        </div>

        <!-- Modal -->
        <div class="modal fade" id="store" tabindex="-1" role="dialog" aria-labelledby="store" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Form - {{ schedule.id }} </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" v-model="schedule.name">
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea id="description" name="description" class="form-control"  v-model="schedule.description">

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
        name: "CheckupSchedules",
        computed: {
            ...mapGetters("checkupschedules", [
                "schedules",
                "schedule"
            ])
        },
        methods: {
            ...mapActions("checkupschedules", [
                "all",
                "store"
            ]),
            create() {

            }
        },
        mounted() {
            this.all();
        }
    }
</script>

<style scoped>

</style>
