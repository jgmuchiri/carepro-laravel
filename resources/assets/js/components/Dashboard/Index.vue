<template>

 <div class="content-wrapper">
    <div class="content-heading">

       <!-- END Language list-->Dashboard
       <small data-localize="dashboard.WELCOME"></small>
    </div>
    <!-- END widgets box-->
    <div class="row">
       <!-- START dashboard main content-->
       <div class="col-lg-9">
          <!-- START chart-->
          <div class="row">
             <div class="col-lg-12">
                <!-- START widget-->
                <div class="panel panel-default panel-demo" id="panelChart9">
                   <div class="panel-heading">
                      <a class="pull-right" href="#" data-tool="panel-refresh" data-toggle="tooltip" title="Refresh Panel">
                         <em class="fa fa-refresh"></em>
                      </a>
                      <a class="pull-right" href="#" data-tool="panel-collapse" data-toggle="tooltip" title="Collapse Panel">
                         <em class="fa fa-minus"></em>
                      </a>
                      <div class="panel-title">Monthly Reports</div>
                   </div>
                   <div class="panel-body">
                      <div class="chart-spline flot-chart"></div>
                   </div>
                </div>
                <!-- END widget-->
             </div>
          </div>
       </div>
       <!-- END dashboard main content-->
       <!-- START dashboard sidebar-->
       <aside class="col-lg-3">
          <!-- START messages and activity-->
          <div class="panel panel-default">
             <div class="panel-heading">
                <div class="panel-title">Quick Actions</div>
             </div>
             <!-- START list group-->
             <div class="list-group">
                <!-- START list group item-->
                <div v-show="this.can_register_child" class="list-group-item">
                   <div class="media-box">
                      <div  class="media-box-body clearfix text-center">
                         <button class="btn btn-primary waves-effect btn-quick btn-lg m-b-5" data-toggle="modal" data-target="#create-child-modal" data-backdrop="false"> <i class="fa fa-plus m-r-5 btn-fa"></i> <span>{{ $t('Register Child') }}</span> </button>
                      </div>
                   </div>
                </div>
                <div v-show="this.can_register_parent" class="list-group-item">
                   <div class="media-box">
                      <div class="media-box-body clearfix text-center">
                         <button class="btn btn-primary waves-effect btn-quick btn-lg m-b-5" data-toggle="modal" data-target="#create-parent-modal" data-backdrop="false"> <i class="fa fa-plus m-r-5 btn-fa"></i> <span> {{ $t('Register Parent') }}</span> </button>
                      </div>
                   </div>
                </div>
                <div v-show="this.can_register_staff" class="list-group-item">
                   <div class="media-box">
                      <div class="media-box-body clearfix text-center">
                         <button class="btn btn-primary waves-effect btn-quick btn-lg m-b-5" data-toggle="modal" data-target="#create-staff-modal" data-backdrop="false"> <i class="fa fa-plus m-r-5 btn-fa"></i> <span> {{ $t('Register Staff')}}</span> </button>
                      </div>
                   </div>
                </div>
                <!-- END list group item-->
             </div>
             <!-- END list group-->
          </div>
          <!-- END messages and activity-->
       </aside>
       <!-- END dashboard sidebar-->
    </div>
    <CreateStaffModal></CreateStaffModal>
    <CreateParentModal></CreateParentModal>
    <CreateChildModal></CreateChildModal>
 </div>

<!--     <div>
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <button v-show="this.can_register_parent" class="btn btn-primary" data-toggle="modal" data-target="#create-parent-modal">
                        <i class="fa fa-plus-circle"></i>
                        {{ $t('Register Parent') }}
                    </button>
                    <button v-show="this.can_register_child" class="btn btn-primary" data-toggle="modal" data-target="#create-child-modal">
                        <i class="fa fa-plus-circle"></i>
                        {{ $t('Register Child') }}</button>
                    <button v-show="this.can_register_staff" class="btn btn-primary" data-toggle="modal" data-target="#create-staff-modal">
                        <i class="fa fa-plus-circle"></i>
                        {{ $t('Register Staff')}}
                    </button>
                </div>
            </div>

            <div class="row" v-show="this.has_children_to_activate && this.can_update_child_status">
                <div class="col-md-8">
                    <div class="alert alert-warning" role="alert">
                        {{ $t('Parent registered a child') }}. <a href="/children">{{ $t('Activate Child') }}</a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">{{ $t('Dashboard') }}</div>

                        <div class="panel-body">
                            {{ $t('You are logged in!') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div> -->
</template>

<script>
    export default {
        created()
        {
            this.$http.get('/api/home')
                .then(response => {
                    this.can_register_staff = response.data.can_register_staff;
                    this.can_register_parent = response.data.can_register_parent;
                    this.can_register_child = response.data.can_register_child;
                    this.has_children_to_activate = response.data.has_children_to_activate;
                    this.can_update_child_status = response.data.can_update_child_status
                })
                .catch(error => {
                    alert("Something went wrong. Please try reloading the page");
                });
        },
        data() {
            return {
                can_register_staff: false,
                can_register_parent: false,
                can_register_child: false,
                has_children_to_activate: false,
                can_update_child_status: false
            }
        },
    }
</script>
