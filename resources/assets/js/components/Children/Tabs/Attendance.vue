<template>
    <div>
        <div class="content-heading">
            <!-- START Language list-->
            <div class="pull-right">
                <div class="btn-group">
                    <a :href="'/children/' + child.id + '/attendance/print'" target="_blank"  class="btn btn-success waves-effect m-b-5">
                        <i class="fa fa-print m-r-5 btn-fa"></i>
                        <span> {{ $t('Print') }}</span>
                    </a>
                </div>
            </div>
            <h3 style="margin-top: 0px;">{{ $t('Attendance') }}</h3>
        </div>
        <hr>
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="">
                    <form class="form-horizontal row">
                            <div class="form-group col-sm-4">
                                <label class="col-lg-2 control-label">From</label>
                                <div class="col-lg-10">
                                   <input type="date" id="fromdate" class="form-control" v-model="from">
                                </div>
                            </div>
                            <div class="form-group col-sm-4">
                                <label class="col-lg-2 control-label">To</label>
                                <div class="col-lg-10">
                                   <input class="form-control" v-model="to" type="date">
                                </div>
                            </div>
                            <div class="form-group col-sm-4">
                                <button class="btn btn-default" v-on:click.prevent="getAttendance()" type="submit">Filter</button>
                                <button class="btn btn-default" v-on:click.prevent="reset()" type="submit">Reset</button>
                            </div>
                    </form>
                </div>
                <!-- START table-responsive-->
                <div v-if="attendances.length" class="table-responsive">
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
                <div v-else class="text-center">
                    <p>There are no Attendance records!</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                attendances: [],
                to: '',
                from: ''
            }
        },

        created() {
            this.getAttendance()
        },

        mounted() {
            var dtToday = new Date();
            var month = dtToday.getMonth() + 1;
            var day = dtToday.getDate();
            var year = dtToday.getFullYear();
            if(month < 10)
                month = '0' + month.toString();
            if(day < 10)
                day = '0' + day.toString();

            var maxDate = year + '-' + month + '-' + day;
            $('#fromdate').attr('max', maxDate);
        },

        methods: {
            getAttendance: function() {
                this.$http.get('/api/children/' + this.child.id + '/attendance?to=' + this.to + '&from=' + this.from)
                .then(response => {
                    this.attendances = response.data;
                })
                .catch(error => {
                    alert("Something went wrong. Please try reloading the page");
                });
            },

            reset: function() {
                this.from = ""
                this.to = ''
                this.getAttendance()
            }
        },
        props: ['child']
    }
</script>
