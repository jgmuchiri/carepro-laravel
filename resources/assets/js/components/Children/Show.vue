<template>
    <div class="content-wrapper">
        <div class="content-heading" style="padding-bottom: 6px;">
            <!-- START Language list-->
            <div class="pull-right">
                <div class="btn-group">
                    <a :class="getCheckInCheckOutButtonClass()"
                       data-toggle="modal"
                       data-target="#toggleCheckInModal"
                       data-backdrop="false"
                       >{{ child.is_checked_in ? 'Check-out' : 'Check-in' }}</a>
                    <!-- TODO: Implement this when check and check out is implemented
                        <a class="mb-sm btn btn-success btn-quick" href="{{ route('children.deactivate', $child->id) }}">Check-in</a>
                    -->
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    {{ child.name }} <small class="td-text-success" style="font-size: 12px;">{{ child.status.name_label }}</small>
                </div>
                <div class="col-md-3">
                    {{ child.dob }}
                </div>
                <div class="col-md-3">
                    {{ child.ssn }}
                </div>
            </div>
        </div>
        <!-- END widgets box-->

        <div class="panel panel-default" id="panelDemo1">
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <div class="card card-transparent flex-row">
                        <ul class="nav nav-tabs nav-tabs-simple nav-tabs-left" id="tab-3">
                            <li style="padding-bottom: 15px;">
                                <img :src="child.full_photo_uri" :alt="$t('User Image')" class="center-block img-responsive img-thumbnail"/>
                            </li>
                            <li :class="'nav-item ' + (this.currentView == 'ChildrenHomeTab' ? 'active' : '')">
                                <a href="#home" v-on:click="switchTab('home')">
                                    <i class="fa fa-home"></i> {{ $t('Home') }}
                                </a>
                            </li>
                            <li :class="'nav-item ' + (this.currentView == 'ChildrenPhotoTab' ? 'active' : '')">
                                <a href="#photos" v-on:click="switchTab('photos')">
                                    <i class="fa fa-photo"></i> {{ $t('Photos') }}
                                </a>
                            </li>
                            <li :class="'nav-item ' + (this.currentView == 'ChildrenNoteTab' ? 'active' : '')">
                                <a href="#notes" v-on:click="switchTab('notes')">
                                    <i class="fa fa-file-text"></i> {{ $t('Notes') }}
                                </a>
                            </li>
                            <li :class="'nav-item ' + (this.currentView == 'ChildrenBillingTab' ? 'active' : '')">
                                <a href="#billing" v-on:click="switchTab('billing')">
                                    <i class="fa fa-money"></i> {{ $t('Billing') }}
                                </a>
                            </li>
                            <li :class="'nav-item ' + (this.currentView == 'ChildrenHealthTab' ? 'active' : '')">
                                <a href="#health" v-on:click="switchTab('health')">
                                    <i class="fa fa-medkit"></i> {{ $t('Health') }}
                                </a>
                            </li>
                            <li :class="'nav-item ' + (this.currentView == 'ChildrenAttendanceTab' ? 'active' : '')">
                                <a href="#attendance" v-on:click="switchTab('attendance')">
                                    <i class="fa fa-calendar"></i> {{ $t('Attendance') }}
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active">
                                <keep-alive>
                                    <component v-if="child.id"
                                               v-bind:is="currentView"
                                               :child="child"
                                               v-on:attachGroupsToChild="loadGroups"
                                    ></component>
                                </keep-alive>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <ChildrenAttachParentModal
            :child="child"
            v-if="child.id && currentView == 'ChildrenHomeTab'"
            v-on:attachParentsToChild="loadParents"
        ></ChildrenAttachParentModal>
        <ChildrenAttachGroupModal
            :child="child"
            v-if="child.id && currentView == 'ChildrenHomeTab'"
            v-on:attachGroupsToChild="loadGroups"
        ></ChildrenAttachGroupModal>
        <CreateEditPickupUserModal
            :child_id="child.id"
            v-if="child.id && currentView == 'ChildrenHomeTab'"
        ></CreateEditPickupUserModal>
        <CreateEditParentModal v-if="child.id && currentView == 'ChildrenHomeTab'"></CreateEditParentModal>
        <ToggleCheckInModal v-if="child.id" :child="child"></ToggleCheckInModal>
    </div>
</template>

<script>
    export default {
        created()
        {
            this.loadChild();

            this.switchTab(window.location.hash.substr(1));

            $(document).on('click', '#upload_link', function(e) {
                e.preventDefault();
                $("#upload:hidden").trigger('click');
            });

            $("#upload").change(function () {
                var file = $('#upload').val();
                var filename = file.slice(-12);
                if (filename !== null) {
                    if ($('.filename').val() !== null) {
                        $($('.filename')).empty();
                    }
                    $('<span>' + filename + '</span>').appendTo('.filename');
                }
            });

            var self = this;
            window.bus.$on('pickupUserCreated', function(pickup_user) {
                self.child.pickup_users.push(pickup_user);
            });

            window.bus.$on('childEdited', function (child) {
                self.child = child;
            });

            window.bus.$on('parentEdited', function(parent) {
                self.child.parents = self.child.parents.map(x => {
                    if (x.id == parent.id) {
                        parent.photo_uri += '?date=' + window.moment().toISOString();
                        return parent;
                    } else {
                        return x;
                    }
                })
            });

            window.bus.$on('pickupUserEdited', function(pickup_user) {
                self.child.pickup_users = self.child.pickup_users.map(x => {
                    if (x.id == pickup_user.id)
                    {
                        pickup_user.photo_uri += '?date=' + window.moment().toISOString()
                        return pickup_user;
                    }
                    else
                    {
                        return x;
                    }
                });
            });
        },
        data() {
            return {
                child: {
                    groups: [],
                    parents: [],
                    status: {}
                },
                currentView: 'ChildrenHomeTab'
            }
        },
        methods: {
            loadParents: function (parents) {
                this.child.parents = parents;
            },
            loadGroups: function (groups) {
                this.child.groups = groups;
            },
            switchTab: function (tab) {
                switch (tab) {
                    case 'photos':
                        this.currentView = 'ChildrenPhotoTab';
                        break;
                    case 'notes':
                        this.currentView = 'ChildrenNoteTab';
                        break;
                    case 'billing':
                        this.currentView = 'ChildrenBillingTab';
                        break;
                    case 'health':
                        this.currentView = 'ChildrenHealthTab';
                        break;
                    case 'attendance':
                        this.currentView = 'ChildrenAttendanceTab';
                        break;
                    default:
                        this.currentView = 'ChildrenHomeTab';
                }
            },
            loadChild: function() {
                this.$http.get('/api/children/' + this.child_id)
                    .then(response => {
                        this.child = response.data.child;
                    })
                    .catch(error => {
                        alert("Something went wrong. Please try reloading the page");
                    });
            },
            getCheckInCheckOutButtonClass: function() {
                var return_string = 'mb-sm btn btn-quick ';
                if (this.child.is_checked_in) {
                    return_string += 'btn-primary'
                } else {
                    return_string += 'btn-success';
                }

                return return_string;
            }
        },
        props: ['child_id']
    }
</script>
