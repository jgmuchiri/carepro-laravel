<template>
    <div class="content-wrapper">
        <div class="content-heading">
            <div class="pull-right">
                <div class="btn-group">
                    <button class="btn btn-primary waves-effect m-b-5" data-toggle="modal" data-target="#create-child-modal" data-backdrop="false">
                        <i class="fa fa-plus m-r-5 btn-fa"></i>
                        <span>{{ $t('Register Child') }}</span>
                    </button>
                </div>
            </div>
            {{ $t('Children') }}
        </div>
        <!-- END widgets box-->
        <div class="row">
            <!-- START dashboard main content-->
            <div class="col-lg-3 col-md-6" v-for="child in children">
                <!-- START widget-->
                <div class="panel panel-primary" id="panelDemo8">
                    <div class="panel-heading pnl-child-hd">
                        <router-link :to="{ name: 'children.show', params: { child_id: child.id }}">
                            {{ child.name}}
                        </router-link>
                    </div>
                    <div class="panel-body">
                        <div class="row row-table">
                            <div class="col-sm-6 col-xs-6 col-md-6 text-center">
                                <img :src="child.full_photo_uri" class="img-responsive">
                            </div>
                            <div class="col-sm-6 col-xs-6 col-md-6">
                                <h3 class="mt0">{{ child.dob }}</h3>
                                <h3 class="mt0">{{ child.ssn }}</h3>
                                <h3 v-if="child.status == 'Pending Approval'" class="mt0 text-warning">{{ child.status.name_label }}</h3>
                                <h3 v-if="child.status == 'Inactive'" class="mt0 text-danger">{{ child.status.name_label}}</h3>
                                <h3 v-if="child.status != 'Pending Approval' && child.status != 'Inactive'" class="mt0 text-success">{{ child.status.name_label }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <div class="row row-table text-center">
                            <div class="col-xs-6">
                                <router-link class="mb-sm btn btn-success" :to="{ name: 'children.show', params: { child_id: child.id }}">
                                    View
                                </router-link>
                            </div>
                            <div class="col-xs-6">
                                <a :class="getCheckInCheckOutButtonClass(child)"
                                   v-on:click="openToggleCheckInModal(child)"
                                >{{ child.is_checked_in ? 'Check-out' : 'Check-in' }}</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END widget-->
            </div>
            <a id="open-toggle-checkin-modal"
               class="hidden"
               data-toggle="modal"
               data-target="#toggleCheckInModal"
               data-backdrop="false"></a>
        </div>
        <CreateEditParentModal></CreateEditParentModal>
        <CreateChildModal v-on:createChild="addChild"></CreateChildModal>
        <ToggleCheckInModal v-if="children.length"></ToggleCheckInModal>
    </div>
</template>

<script>
    export default {
        created()
        {
            this.$http.get('/api/children')
                .then(response => {
                    this.children = response.data.children;
                })
                .catch(error => {
                    alert("Something went wrong. Please try reloading the page");
                });

            var self = this;
            window.bus.$on('toggleChildCheckIn', function(child_id) {
                self.children.map(function(child) {
                    if (child.id == child_id) {
                        child.is_checked_in = !child.is_checked_in;
                    }

                    return child;
                });
            });
        },
        data() {
            return {
                children: []
            }
        },
        methods: {
            addChild: function(child) {
                this.children.push(child);
            },
            getCheckInCheckOutButtonClass: function(child) {
                var return_string = 'mb-sm btn ';
                if (child.is_checked_in) {
                    return_string += 'btn-primary'
                } else {
                    return_string += 'btn-success';
                }

                return return_string;
            },
            openToggleCheckInModal: function(child) {
                window.bus.$emit('openToggleCheckinModal', child);
                $('#open-toggle-checkin-modal').click();
            },
        }
    }
</script>
