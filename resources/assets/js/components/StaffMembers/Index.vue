<template>
<div class="content-wrapper">
    <div class="content-heading">
        <div class="pull-right">
          <div class="btn-group">
             <button class="btn btn-primary waves-effect m-b-5" data-toggle="modal" data-target="#create-staff-modal" data-backdrop="false"> <i class="fa fa-plus m-r-5 btn-fa"></i> <span> {{ $t('Register Staff') }}</span></button>
          </div>
       </div>
       <!-- END Language list-->{{ $t('Staff Members') }}
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
         <div v-if="staff.length" class="table-responsive">
            <table class="table table-bordered table-hover" id="table-ext-1">
               <thead>
                  <tr>
                     <th data-check-all>
                        <div class="checkbox c-checkbox" data-toggle="tooltip" data-title="Check All">
                           <label>
                              <input type="checkbox">
                              <span class="fa fa-check"></span>
                           </label>
                        </div>
                     </th>
                     <th>Picture</th>
                     <th>{{ $t('Name') }}</th>
                     <th>{{ $t('Email') }}</th>
                     <th>{{ $t('Phone') }}</th>
                     <th>{{$t('Actions')}}</th>
                  </tr>
               </thead>
               <tbody>
                  <tr v-for="staff_member in staff">
                     <td>
                        <div class="checkbox c-checkbox">
                           <label>
                              <input type="checkbox">
                              <span class="fa fa-check"></span>
                           </label>
                        </div>
                     </td>
                     <td>
                        <div class="media">
                           <img class="img-responsive img-circle" :src="staff_member.full_photo_uri" alt="Image">
                        </div>
                     </td>
                     <td>{{ staff_member.user.name }}</td>
                     <td>{{ staff_member.user.email }}</td>
                     <td>{{ staff_member.user.address.phone }}</td>
                     <td class="text-center">
                          <router-link class="mb-sm btn btn-success btn-xs" :to="{ name: 'staff.edit', params: { staff_id: staff_member.id }}">
                              View
                          </router-link>
                      </td>
                  </tr>
               </tbody>
            </table>
         </div>
         <div v-else class="text-center">
            <p>We couldn't find any Staff Member records</p>
            <div class="btn-group">
                <button class="btn btn-success waves-effect m-b-5" data-toggle="modal" data-target="#create-staff-modal" data-backdrop="false">
                    <span>{{ $t('Register first Staff Member') }}</span>
                </button>
            </div>
         </div>
       </div>
    </div>
    <CreateStaffModal v-on:staffRegistered="addStaff"></CreateStaffModal>
 </div>
</template>

<script>
    export default {
        created()
        {
            axios.get('/api/staff')
                .then(response => {
                    this.staff = response.data.staff;
                    this.can_create_staff = response.data.can_create_staff
                })
                .catch(error => {
                    alert("Something went wrong. Please try reloading the page");
                });
        },
        data() {
            return {
                staff: [],
                can_create_staff: false
            }
        },
        methods: {
            addStaff: function(staff_member) {
                this.staff.push(staff_member);
            }
        }
    }
</script>
