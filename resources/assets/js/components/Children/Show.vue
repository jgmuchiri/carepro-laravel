<template>
    <div class="content-wrapper">
        <div class="content-heading" style="padding-bottom: 6px;">
            <!-- START Language list-->
            <div class="pull-right">
                <div class="btn-group">
                    <a class="mb-sm btn btn-primary btn-quick" href="#">Check-out</a>
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
                            <li class="nav-item active">
                                <a href="#" data-toggle="tab" data-target="#home">
                                    <i class="fa fa-home"></i> {{ $t('Home') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" data-toggle="tab" id="photo-a" data-target="#photo">
                                    <i class="fa fa-photo"></i> {{ $t('Photos') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" data-toggle="tab" data-target="#notes">
                                    <i class="fa fa-file-text"></i> {{ $t('Notes') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" data-toggle="tab" data-target="#billing">
                                    <i class="fa fa-money"></i> {{ $t('Billing') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" data-toggle="tab" data-target="#health">
                                    <i class="fa fa-medkit"></i> {{ $t('Health') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" data-toggle="tab" data-target="#attendance">
                                    <i class="fa fa-calendar"></i> {{ $t('Attendance') }}
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="home">
                                <keep-alive>
                                    <component v-if="child.id" v-bind:is="currentView" :child="child"></component>
                                </keep-alive>
                                <!-- @include('children.includes.home')
                             </div>
                             <div class="tab-pane" id="photo">
                                @include('children.includes.photo')
                             </div>
                             <div class="tab-pane" id="notes">
                                @include('children.includes.notes')
                             </div>
                             <div class="tab-pane" id="billing">
                                @include('children.includes.billing')
                             </div>
                             <div class="tab-pane" id="attendance">
                                @include('children.includes.attendance')
                             </div>
                             <div class="tab-pane" id="health">
                                @include('children.includes.health')
                             -->
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
    </div>
</template>

<script>
    export default {
        created()
        {
            this.$http.get('/api/children/' + this.child_id)
                .then(response => {
                    this.child = response.data.child;
                })
                .catch(error => {
                    alert("Something went wrong. Please try reloading the page");
                });

            $('#btn-invoice').on('click', function() {
                $('#billing-index').hide();
                $('#invoice-create').show();
            });
            $('#back-btn').on('click', function() {
                $('#invoice-create').hide();
                $('#billing-index').show();
            });

            $('#btn-incident').on('click', function() {
                $('#notes-index').hide();
                $('#incident-create').show();
            });
            $('#incident-back-btn').on('click', function() {
                $('#incident-create').hide();
                $('#notes-index').show();
            });

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
            }
        },
        props: ['child_id']
    }
</script>
