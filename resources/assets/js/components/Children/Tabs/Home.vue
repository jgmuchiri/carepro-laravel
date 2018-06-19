<template>
    <div>
        <div class="row">
            <div class="col-md-4">
                <p class="child-alert child-danger">3 {{ $t('Known Allergies') }}</p>
                <p class="child-alert child-info">$244 {{ $t('due') }}</p>
            </div>
            <div class="col-md-4">
                <p class="child-alert child-success">2 {{ $t('Incidents reported') }}</p>
                <p class="child-alert child-warning">5 {{ $t('medications') }}</p>
            </div>
            <div class="col-md-4">
                <p class="child-alert child-success">20 {{ $t('Notes') }}</p>
                <p class="child-alert child-success">88 {{ $t('Photos') }}</p>
            </div>
        </div>
        <hr>

        <div class="panel panel-default">
            <div class="panel-heading panel-heading-collapsed"><strong style="color: #656565">{{ $t('Child Information') }}</strong>
                <a class="pull-right" href="#" data-tool="panel-collapse" data-toggle="tooltip" title="Collapse Panel">
                    <em class="fa fa-plus"></em>
                </a>
            </div>

            <div class="panel-wrapper collapse">
                <div class="panel-body">
                    <form v-on:submit.prevent="save">
                        <div class="row">
                            <div class="form-group col-md-8">
                                <input id="name"
                                    class="form-control input-lg"
                                    :placeholder="$t('Child Name')"
                                    name="name"
                                    type="text"
                                    v-model="child.name">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <input class="form-control input-lg" name="ssn" type="text" v-model="child.ssn">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <select required class="form-control input-lg" v-model="child.gender_id">
                                            <option v-for="gender in genders" v-bind:value="gender.id">
                                                {{ gender.name_label }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <select id="status" class="form-control input-lg" v-model="child.status_id" required>
                                            <option v-for="status in statuses" v-bind:value="status.id">
                                                {{ status.name_label }}
                                            </option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <select required class="form-control input-lg" v-model="child.blood_type_id">
                                            <option v-for="blood_type in blood_types" v-bind:value="blood_type.id">
                                                {{ blood_type.blood_type_label }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <input style="display:none;" id="upload" name="photo" type="file" @change="onFileChange"/>
                                <div class="panel widget child-upload">
                                    <div class="panel-body text-center">
                                        <div class="child-btn-fa">
                                            <a href="" id="upload_link" title=""><i class="fa fa-upload"></i></a>
                                        </div>
                                        <p><span>{{ $t('Upload Profile Photo') }}</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-4">
                                 <input required="" class="form-control input-lg" name="dob" type="date" v-model="child.dob">
                            </div>
                            <div class="form-group col-sm-4">
                                 <input required="" class="form-control input-lg" name="ssn" type="text" v-model="child.pin">
                            </div>
                            <div class="form-group col-sm-4 text-center">
                                 <button class="btn btn-primary btn-lg">
                                     <i class="fa fa-save btn-fa"></i>
                                     {{ $t('Save changes') }}
                                 </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="child-border">
            <!-- groups section -->
            <div class="content-heading">
                <div class="pull-right">
                    <div class="btn-group">
                        <button class="btn btn-primary waves-effect m-b-5" data-toggle="modal" data-target="#attachGroup" data-backdrop="false"> <i class="fa fa-plus m-r-5 btn-fa"></i> <span> {{ $t('Assign to group') }}</span></button>
                    </div>
                </div>
                <h3>{{ $t('Assigned Groups') }}</h3>
            </div>

            <div class="table-responsive" v-if="child.groups.length">
                <table class="table table-bordered table-hover" >
                    <thead>
                        <tr>
                            <th>{{ $t('Name') }}</th>
                            <th>{{ $t('Description') }}</th>
                            <th class="text-center">{{ $t('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="group in child.groups">
                            <td>{{ group.name }}</td>
                            <td>{{ group.short_description }}</td>
                            <td class="text-center">
                                <a class="btn btn-danger btn-xs" v-on:click.prevent="unassignGroup(group.id)" title="Delete">
                                    <i class="fa fa-trash-o"></i>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="text-center" v-if="!child.groups.length">
                <h4>{{ $t('No assigned groups yet') }}</h4>
                <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#attachGroup" data-backdrop="false" title="">{{ $t('Assign to first group') }}</button>
            </div>
            <hr>

            <!-- parents section -->
            <div class="content-heading">
                <div class="pull-right">
                    <div class="btn-group">
                        <button v-if="can_manage_children"
                                class="btn btn-primary waves-effect m-b-5"
                                data-toggle="modal"
                                data-target="#attachParent"
                                data-backdrop="false">
                            <i class="fa fa-plus m-r-5 btn-fa"></i>
                            <span> {{ $t('Assign Parent/Guardian') }}</span>
                        </button>
                        <button class="hide"
                                data-toggle="modal"
                                data-target="#create-edit-parent-modal"
                                data-backdrop="false"
                                id="edit-parent-button"
                        >
                            <i class="fa fa-plus m-r-5 btn-fa"></i>
                            <span> {{ $t('New Authorization') }}</span>
                        </button>
                    </div>
                </div>
                <h3>{{ $t('Parents/Guardians') }}</h3>
            </div>
            <div class="child-parent">
                <div class="row">
                    <div class="col-md-offset-1 col-md-4" v-for="parent in child.parents">
                        <div class="panel b text-center">
                            <div class="panel-body">
                                <img class="img-circle thumb64" :src="parent.full_photo_uri">
                                <p class="h4 text-bold mb0">{{ parent.user.name }}</p>
                                <p class="h4 text-bold mb0">{{ parent.user.email }}</p>
                                <p>{{ parent.user.address.phone }}</p>
                                <button v-on:click="editParent(parent.id)"class="btn btn-success btn-oval" type="button">{{ $t('Edit') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>

            <!-- authorized section -->
            <div class="content-heading">
                <!-- START Language list-->
                <div class="pull-right">
                    <div class="btn-group">
                        <button class="btn btn-primary waves-effect m-b-5"
                            data-toggle="modal"
                            data-target="#create-edit-pickup-user-modal"
                            data-backdrop="false"
                            id="new-pickup-user-button"
                            v-on:click="clearPickupUserModal()"
                        >
                            <i class="fa fa-plus m-r-5 btn-fa"></i>
                            <span> {{ $t('New Authorization') }}</span>
                        </button>
                    </div>
                </div>
                <h3>{{ $t('Authorized Pick Up Users') }}</h3>
            </div>
            <div class="child-parent">
                <div class="row">
                    <div class="col-md-6" v-for="pickup_user in child.pickup_users">
                        <div class="panel panel-primary">
                            <div class="panel-body">
                                <div class="row row-table">
                                    <div class="col-xs-5 text-center">
                                        <img :src="pickup_user.full_photo_uri" :alt="$t('User Image')"/>
                                    </div>
                                    <div class="col-xs-7">
                                        <h3 class="mt0">{{ pickup_user.name }}</h3>
                                        <ul class="list-unstyled">
                                            <li class="mb-sm"><em class="fa fa-envelope fa-fw"></em>{{ pickup_user.email }}</li>
                                            <li class="mb-sm"><em class="fa fa-phone fa-fw"></em>{{ pickup_user.phone }}</li>
                                            <li class="mb-sm"><em class="fa fa-key fa-fw"></em>{{ pickup_user.pin }}</li><li class="mb-sm">
                                            <em class="fa fa-check-circle-o fa-fw"></em>{{ pickup_user.relation.name }}</li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="text-center">
                                    <a class="btn btn-success btn-oval"
                                       v-on:click="editPickupUser(pickup_user)">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <a class="btn btn-danger btn-oval" v-on:click.prevent="deletePickupUser(pickup_user.id)">
                                        <i class="fa fa-trash-o"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center" v-if="!child.pickup_users.length">
                        <h4>{{ $t('No authorised Pick Up Users yet') }}</h4>
                        <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#create-edit-pickup-user-modal" data-backdrop="false" title="">{{ $t('New Authorization') }}</button>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row" style="padding-bottom:10px;">
                <div class="form-row text-center">
                    <div class="col-md-12">
                        <button v-if="child.status.name == 'Active'" type="submit" v-on:click.prevent="toggleChildActivation" class="btn btn-danger wave-effect m-b-5">
                            <i class="fa fa-trash m-r-5 btn-fa"></i>
                            <span> {{ $t('Deactivate Child')}}</span>
                        </button>
                        <button v-else type="submit" v-on:click.prevent="toggleChildActivation" class="btn btn-primary wave-effect m-b-5">
                            <i class="fa fa-plus m-r-5 btn-fa"></i>
                            <span> {{ $t('Activate Child')}}</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        created()
        {
            this.$http.get('/api/children/' + this.child.id + '/edit')
                .then(response => {
                    this.statuses = response.data.statuses;
                    this.genders = response.data.genders;
                    this.blood_types = response.data.blood_types;
                    this.can_manage_children = response.data.can_manage_children;
                })
                .catch(error => {
                    alert("Something went wrong. Please try reloading the page");
                });
        },
        data() {
            return {
                blood_types: [],
                can_manage_children: false,
                genders: [],
                statuses: [],
                upload_image: false
            }
        },
        methods: {
            deletePickupUser: function (id) {
                this.$http.delete('/api/children/' + this.child.id + '/pickup-users/' + id)
                    .then(response => {
                        this.$noty.success(response.data.message);
                        this.child.pickup_users = this.child.pickup_users.filter(x => x.id != id);
                    })
                    .catch(error => {
                        if (error.response.status == 403) {
                           this.$noty.error(this.$t('This child is inactive and read-only.'));
                        } else if (error.response.status == 422) {
                            for (var key in error.response.data) {
                                this.$noty.error(error.response.data[key]);
                            }
                        } else {
                            alert("Something went wrong. Please reload the page and try again.");
                        }
                    });
            },
            onFileChange: function(event) {
                var files = event.target.files || event.dataTransfer.files;
                if (!files.length)
                    return;
                this.child.photo_uri = files[0];
                this.upload_image = true;
            },
            save: function() {
                var formData = new FormData();
                formData.append('name', this.child.name);
                formData.append('ssn', this.child.ssn);
                formData.append('dob', this.child.dob);
                formData.append('pin', this.child.pin);
                formData.append('status_id', this.child.status_id);
                formData.append('gender_id', this.child.gender_id);
                formData.append('blood_type_id', this.child.blood_type_id);
                formData.append('_method', 'PUT');

                if (this.upload_image) {
                    formData.append('photo_uri', this.child.photo_uri);
                }

                this.$http.post('/api/children/' + this.child.id, formData)
                    .then(response => {
                        var child = response.data.child;
                        child.photo += '?date=' + window.moment().toISOString();
                        child.full_photo_uri += '?date=' + window.moment().toISOString();
                        child.full_photo_uri_original += '?date=' + window.moment().toISOString();
                        window.bus.$emit('childEdited', child);
                        this.$noty.success(response.data.message);
                    })
                    .catch(error => {
                        if (error.response.status == 403) {
                            this.$noty.error(this.$t('This child is inactive and read-only.'));
                        } else if (error.response.status == 422) {
                            for (var key in error.response.data) {
                                this.$noty.error(error.response.data[key]);
                            }
                        } else {
                            alert("Something went wrong. Please reload the page and try again.");
                        }
                    });
            },
            editParent: function(id) {
                window.bus.$emit('editParent', id);
                $('#edit-parent-button').click();
            },
            editPickupUser: function(pickup_user) {
                $('#new-pickup-user-button').click();
                window.bus.$emit('editPickupUser', pickup_user);
            },
            clearPickupUserModal: function() {
                window.bus.$emit('clearPickupUserModal');
            },
            toggleChildActivation: function() {
                if (this.child.status.name == 'Active') {
                    this.$http.get('/api/children/' + this.child.id + '/deactivate')
                        .then(response => {
                            this.$noty.success(response.data.message);
                            this.child.status.name = 'Inactive';
                        })
                        .catch(error => {
                            if (error.response.status == 403) {
                                this.$noty.error(this.$t('This child is inactive and read-only.'));
                            } else if (error.response.status == 422) {
                                for (var key in error.response.data) {
                                    this.$noty.error(error.response.data[key]);
                                }
                            } else {
                                alert("Something went wrong. Please reload the page and try again.");
                            }
                        });
                } else {
                    this.$http.get('/api/children/' + this.child.id + '/activate')
                        .then(response => {
                            this.$noty.success(response.data.message);
                            this.child.status.name = 'Active';
                        })
                        .catch(error => {
                            if (error.response.status == 403) {
                                this.$noty.error(this.$t('This child is inactive and read-only.'));
                            } else if (error.response.status == 422) {
                                for (var key in error.response.data) {
                                    this.$noty.error(error.response.data[key]);
                                }
                            } else {
                                alert("Something went wrong. Please reload the page and try again.");
                            }
                        });
                }
            },
            unassignGroup: function (group_id) {
                this.$http.delete('/api/children/' + this.child.id + '/groups/' + group_id)
                    .then(response => {
                        this.$emit('attachGroupsToChild', response.data.groups);
                        this.$noty.success(response.data.message);
                    })
                    .catch(error => {
                        if (error.response.status == 403) {
                            this.$noty.error(this.$t('This child is inactive and read-only.'));
                        } else if (error.response.status == 422) {
                            for (var key in error.response.data) {
                                this.$noty.error(error.response.data[key]);
                            }
                        } else {
                            alert("Something went wrong. Please reload the page and try again.");
                        }
                    });
            }
        },
        props: ['child']
    }
</script>
