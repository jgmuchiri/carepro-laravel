<template>
    <div>
        <div class="content-heading">
            <!-- START Language list-->
            <div class="pull-right">
                <div class="btn-group">
                    <button class="btn btn-success waves-effect m-b-5">
                        <i class="fa fa-print m-r-5 btn-fa"></i>
                        <span> {{ $t('Print') }}</span>
                    </button>
                </div>
            </div>
            <h3 style="margin-top: 0px;">{{ $t('Attendance') }}</h3>
        </div>
        <hr>
        <div class="panel panel-default">
            <div class="panel-body">
                <!-- START table-responsive-->
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ $t('Date') }}</th>
                                <th>{{ $t('Time in') }}</th>
                                <th>{{ $t('Time Out') }}</th>
                                <th>{{ $t('Pick up by') }}</th>
                                <th>{{ $t('Late Fee?') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="attendance in attendances">
                                <td>1</td>
                                <td>{{ attendance.check_in_date | moment("Do MMMM YYYY") }}</td>
                                <td>{{ attendance.check_in_date | moment("h:mm A") }}</td>
                                <td v-if="attendance.check_out_date">{{ attendance.check_out_date | moment("h:mm A") }}</td>
                                <td v-else><span style="background-color: #0d97c5;" class="badge badge-primary">Still checked in</span></td>
                                <td v-if="attendance.check_out_parent_id">{{ attendance.check_out_parent.name}}</td>
                                <td v-else-if="attendance.check_out_pickup_user_id">{{ attendance.check_out_pickup_user.name}}</td>
                                <td v-else><span style="background-color: #0d97c5;" class="badge badge-primary">not picked up yet</span></td>
                                <td>No</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- END table-responsive-->
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                attendances: []
            }
        },

        created() {
            this.getAttendance()
        },

        methods: {
            getAttendance: function() {
                this.$http.get('/api/children/attendance/' + this.child.id)
                .then(response => {
                    this.attendances = response.data;
                })
                .catch(error => {
                    alert("Something went wrong. Please try reloading the page");
                });
            },
        },
        props: ['child']
    }
</script>
