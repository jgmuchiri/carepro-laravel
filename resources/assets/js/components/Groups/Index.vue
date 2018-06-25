<template>
<div class="content-wrapper">
    <div class="content-heading">
        <div class="pull-right">
          <div class="btn-group">
             <button class="btn btn-primary waves-effect m-b-5" data-toggle="modal" data-target="#createEditGroup" data-backdrop="false"> <i class="fa fa-plus m-r-5 btn-fa"></i> <span> {{ $t('Create Group') }}</span></button>
          </div>
       </div>
       <!-- END Language list-->{{ $t('Groups') }}
       <small data-localize="dashboard.WELCOME"></small>
    </div>
    <!-- END widgets box-->
    <div class="panel panel-default">
       <div class="panel-heading">
           <div class="row">
             <div class="col-lg-2">
                <div class="input-group">
                   <input class="input-sm form-control" type="text" placeholder="Search">
                   <span class="input-group-btn">
                      <button class="btn btn-sm btn-default" type="button">Search</button>
                   </span>
                </div>
             </div>
             <div class="col-lg-8"></div>
             <div class="col-lg-2">
                <div class="input-group pull-right">
                   <select class="input-sm form-control">
                      <option value="0">Bulk action</option>
                      <option value="1">Delete</option>
                      <option value="2">Clone</option>
                      <option value="3">Export</option>
                   </select>
                   <span class="input-group-btn">
                      <button class="btn btn-sm btn-default">Apply</button>
                   </span>
                </div>
             </div>
          </div>
       </div>
       <div class="panel-body">
         <!-- START table-responsive-->
         <div v-if="groups.length" class="table-responsive">
            <table class="table table-bordered table-hover" >
               <thead>
                  <tr>
                      <th data-check-all width="3">
                        <div class="checkbox c-checkbox" data-toggle="tooltip" data-title="Check All">
                           <label>
                              <input type="checkbox">
                              <span class="fa fa-check"></span>
                           </label>
                        </div>
                      </th>
                      <th>{{$t('Name')}}</th>
                      <th>{{$t('Description')}}</th>
                      <th>{{$t('# of Children')}}</th>
                      <th>{{$t('# of Staff')}}</th>
                  </tr>
               </thead>
               <tbody>
                  <tr v-for="group in groups">
                      <td>
                        <div class="checkbox c-checkbox">
                           <label>
                              <input type="checkbox">
                              <span class="fa fa-check"></span>
                           </label>
                        </div>
                      </td>
                      <td>
                          <router-link :to="{ name: 'groups.show', params: { group_id: group.id }}">
                              {{group.name}}
                          </router-link>
                      </td>
                      <td>{{group.short_description}}</td>
                      <td>{{group.staff_count}}</td>
                      <td>{{group.children_count}}</td>
                  </tr>

               </tbody>
            </table>
         </div>
         <div v-else class="text-center">
            <p>We couldn't find any Group records</p>
            <div class="btn-group">
                <button class="btn btn-success waves-effect m-b-5" data-toggle="modal" data-target="#createEditGroup" data-backdrop="false">
                    <span>{{ $t('Create first Group') }}</span>
                </button>
            </div>
         </div>
       </div>
    </div>
    <CreateEditGroupModal v-on:createGroup="addGroup"></CreateEditGroupModal>
 </div>
</template>

<script>
    export default {
        created()
        {
            this.$http.get('/api/groups')
                .then(response => {
                    this.groups = response.data.groups;
                })
                .catch(error => {
                    alert("Something went wrong. Please try reloading the page");
                });
        },
        data() {
            return {
                groups: []
            }
        },
        methods: {
            addGroup: function(group) {
                this.groups.push(group);
            }
        }
    }
</script>
