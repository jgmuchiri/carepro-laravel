<template>
    <div class="card">
        <div class="header">
            <div class="row">
                <div class="col-sm-6">
                    <p>{{ $t('Staff Members') }}</p>
                </div>
            </div>
        </div>
        <hr/>
        <div class="content">
            <div class="row" v-if="can_create_staff">
                <div class="col-md-12">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#create-staff-modal">
                        <i class="fa fa-plus-circle"></i>
                        {{ $t('Register Staff')}}
                    </button>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>{{ $t('Name') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-if="staff.length < 1"><td colspan="3">{{ $t('No staff created yet') }}</td></tr>
                        <tr v-for="staff_member in staff">
                            <td>{{ staff_member.user.name }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <CreateStaffModal></CreateStaffModal>
    </div>
</template>

<script>
    export default {
        created()
        {
            this.$http.get('/api/staff')
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
