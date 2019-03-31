<template>
    <div>
        <div class="card">

            <div class="card-header">
                Schedule ID: {{ schedule.name }}

                <div class="float-right">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#store">
                        Edit
                    </button>
                </div>
            </div>
            <div class="card-body">
                <p>Schedule id: {{ schedule.id }}</p>
                <p>Schedule request by: {{ schedule.request_by || "N/A" }}</p>
                <p>Schedule diagnosed date: {{ schedule.diagnosed_date || "N/A" }}</p>
                <p>Schedule note: {{ schedule.note || "N/A" }}</p>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
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
                            <label for="name">Diagnosed Date</label>
                            <input type="text" class="form-control" id="name" v-model="schedule.diagnosed_date">
                        </div>

                        <div class="form-group">
                            <label for="description">Note</label>
                            <textarea id="description" name="description" class="form-control"  v-model="schedule.note">

                            </textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" @click="patch" >Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapActions, mapGetters} from "vuex";
    import swal from "sweetalert";

    export default {
        name: "CheckupSchedule",
        computed: {
            ...mapGetters("checkupschedules", [
                "schedule"
            ])
        },
        methods: {
            ...mapActions("checkupschedules", [
                "get",
                "update"
            ]),
            patch() {

                swal({
                    title: 'Are you sure to update ?',
                    buttons: true,
                    dangerMode: true
                }).then((response) => {

                    if (response) {
                        this.update({
                            id: this.schedule.id,
                            data: this.schedule
                        }).then(() => {
                            $("#edit").modal('hide');
                        }).catch(function (e) {
                            console.log(e)
                        });
                    }

                }).catch(() => {
                    swal.stopLoading();
                });

            }
        },
        created() {
            this.get(this.$route.params.id);
        }
    }
</script>

<style scoped>

</style>
