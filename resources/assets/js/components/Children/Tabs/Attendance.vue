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
                            <tr>
                                <td>1</td>
                                <td>10 October 2017</td>
                                <td>10:00 AM</td>
                                <td>05:00 PM</td>
                                <td>Jamie Jones</td>
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
    export default {}
</script>
