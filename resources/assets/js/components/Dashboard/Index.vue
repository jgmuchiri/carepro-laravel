<template>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <a v-show="this.can_register_parent" href="/parents/create" class="btn btn-primary">{{ $t('New Parent') }}</a>
                    <a v-show="this.can_register_child" href="/children" class="btn btn-primary">{{ $t('Add Child') }}</a>
                    <button v-show="this.can_register_staff" class="btn btn-primary" data-toggle="modal" data-target="#create-staff-modal"><i
                            class="fa fa-plus-circle"></i>
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
        <CreateStaffModal></CreateStaffModal>
    </div>
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
