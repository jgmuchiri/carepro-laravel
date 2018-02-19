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
            <div class="col-lg-4" v-for="child in children">
                <!-- START widget-->
                <div class="panel panel-primary" id="panelDemo8">
                    <div class="panel-heading pnl-child-hd">
                        <router-link :to="{ name: 'children.show', params: { child_id: child.id }}">
                            {{ child.name}}
                        </router-link>
                    </div>
                    <div class="panel-body">
                        <div class="row row-table">
                            <div class="col-xs-6 text-center">
                                <lightbox
                                        :thumbnail="child.full_photo_uri"
                                        :images="[child.full_photo_uri_original]"
                                ></lightbox>
                            </div>
                            <div class="col-xs-6">
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
                                <router-link class="mb-sm btn btn-success btn-quick" :to="{ name: 'children.show', params: { child_id: child.id }}">
                                    View
                                </router-link>
                            </div>
                            <div class="col-xs-6">
                                <a class="mb-sm btn btn-primary btn-quick" href="#">Check-out</a>
                            </div>
                            <!-- TODO: Uncomment when this is implemented dynamically
                            <div class="col-xs-6">
                                <a class="mb-sm btn btn-success btn-quick" href="#">Check-in</a>
                            </div> -->
                        </div>
                    </div>
                </div>
                <!-- END widget-->
            </div>
        </div>
        <CreateEditParentModal></CreateEditParentModal>
        <CreateChildModal v-on:createChild="addChild"></CreateChildModal>
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
        },
        data() {
            return {
                children: []
            }
        },
        methods: {
            addChild: function(child) {
                this.children.push(child);
            }
        }
    }
</script>
