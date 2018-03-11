<template>
<div class="content-wrapper">
    <div class="content-heading">
        <div class="pull-right">
          <div class="btn-group">
             <button class="btn btn-primary waves-effect m-b-5" data-toggle="modal" data-target="#createEditGroup" data-backdrop="false"> <i class="fa fa-pencil m-r-5 btn-fa"></i> <span> {{ $t('Edit Group') }}</span></button>
          </div>
       </div>
       <!-- END Language list-->{{ $t('View Group') }}
       <small >{{ group.name}}</small>
    </div>
    <!-- END widgets box-->
    <div class="list-group">
       <a class="list-group-item" href="#">
          <table class="wd-wide">
             <tbody>
                <tr>
                   <td>
                      <div class="ph">
                         <h4 class="media-box-heading">{{ $t('Name') }}</h4>
                         <small class="text-muted">{{ group.name }}</small>
                      </div>
                   </td>
                   <td>
                      <div class="ph">
                         <h4 class="media-box-heading">{{ $t('Description') }}</h4>
                         <small class="text-muted">{{ group.short_description }}</small>
                      </div>
                   </td>
                </tr>
             </tbody>
          </table>
       </a>
    </div>
    <div class="row">
       <div class="col-lg-6">
          <!-- START panel-->
          <div class="panel panel-default">
             <div class="panel-heading">{{$t('Staff')}}</div>
             <div class="panel-body">
                <!-- START table-responsive-->
                <div class="table-responsive">
                   <table class="table table-striped table-hover">
                      <thead>
                         <tr>
                            <th>{{$t('Name')}}</th>
                         </tr>
                      </thead>
                      <tbody>
                         <tr v-for="staff_member in group.staff">
                            <td>{{ staff_member.user.name }}</td>
                        </tr>
                      </tbody>
                   </table>
                </div>
                <!-- END table-responsive-->
             </div>
          </div>
          <!-- END panel-->
       </div>
       <div class="col-lg-6">
          <!-- START panel-->
          <div class="panel panel-default">
             <div class="panel-heading">{{ $t('Children') }}</div>
             <div class="panel-body">
                <!-- START table-responsive-->
                <div class="table-responsive">
                   <table class="table">
                      <thead>
                         <tr>
                            <th>{{$t('Name')}}</th>
                         </tr>
                      </thead>
                      <tbody>
                         <tr v-for="child in group.children">
                            <td>{{ child.name }}</td>
                        </tr>
                      </tbody>
                   </table>
                </div>
                <!-- END table-responsive-->
             </div>
          </div>
          <!-- END panel-->
       </div>
    </div>
    <CreateEditGroupModal v-on:editGroup="groupEdited" :edit_group="group"></CreateEditGroupModal>
 </div>
</template>

<script>
    export default {
        created()
        {
            this.$http.get('/api/groups/' + this.group_id)
                .then(response => {
                    this.group = response.data.group;
                })
                .catch(error => {
                    console.log(error);
                    alert("Something went wrong. Please try reloading the page");
                });
        },
        data() {
            return {
                group: {}
            }
        },
        methods: {
            groupEdited: function(group) {
                this.group = group;
            }
        },
        props: ['group_id']
    }
</script>
