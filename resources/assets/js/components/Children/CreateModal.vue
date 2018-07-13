<template>
    <div class="modal fade modal-mo" id="create-child-modal" tabindex="-1" role="dialog" aria-labelledby="create-child-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">{{ $t('New Child Registration') }}</h4>
                </div>
                <form v-on:submit.prevent="storeChild">
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label>{{ $t('Name') }}*</label>
                                <input type="text" class="form-control" name="name" required v-model="child.name" />
                            </div>
                            <div class="form-group col-sm-6">
                                <label>{{ $t('Nickname') }}</label>
                                <input type="text" class="form-control" name="nickname" v-model="child.nickname" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label>{{ $t('Birthday') }}*</label>
                                <input type="date" class="form-control" name="dob" required v-model="child.dob" />
                            </div>
                            <div class="form-group col-sm-6">
                                <label>{{ $t('SSN/ID') }}#*</label>
                                <input type="text" class="form-control" name="ssn" required v-model="child.ssn" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label>{{ $t('Gender') }}*</label>
                                <select id="gender" class="form-control" v-model="child.gender" required>
                                    <option v-for="gender in genders" v-bind:value="gender.id">
                                        {{ gender.name_label }}
                                    </option>
                                </select>
                            </div>
                            <div class="form-group col-sm-6">
                                <label>{{ $t('Blood Group') }}*</label>
                                <select id="blood_type" class="form-control" v-model="child.blood_type">
                                    <option v-for="blood_type in blood_types" v-bind:value="blood_type.id">
                                        {{ blood_type.blood_type_label }}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label>{{ $t('Access Pin') }}*</label>
                                <input type="number" name="pin" min="4" class="form-control" equired v-model="child.pin" />
                            </div>
                            <template v-if="is_not_parent">
                                <div class="form-group col-sm-6">
                                    <label>{{ $t('Status') }}*</label>
                                    <select id="status" class="form-control" v-model="child.status" required>
                                        <option v-for="status in statuses" v-bind:value="status.id">
                                            {{ status.name_label }}
                                        </option>
                                    </select>
                                </div>
                            </template>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label>{{ $t('Religion') }}*</label>
                                <select id="religion" class="form-control" v-model="child.religion">
                                    <option v-for="religion in religions" v-bind:value="religion.id">
                                        {{ religion.name_label }}
                                    </option>
                                </select>
                            </div>
                            <div class="form-group col-sm-6">
                                <label>{{ $t('Ethnicity') }}*</label>
                                <select id="ethnicity" class="form-control" v-model="child.ethnicity">
                                    <option v-for="ethnicity in ethnicities" v-bind:value="ethnicity.id">
                                        {{ ethnicity.name_label }}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <template v-if="is_not_parent && parents.length">
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label>{{ $t('Parents') }}*</label>
                                    <select id="parents" v-model="child.parents" class="form-control" required multiple>
                                        <option v-for="parent in parents" v-bind:value="parent.id">
                                            {{ parent.user.name }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </template>
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="child_photo_uri" class="control-label">{{ $t('Photo') }}*</label>
                                <input type="file" class="form-control" name="photo_uri" id="child_photo_uri" @change="onFileChange" />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times btn-fa"></i> {{ $t('Cancel') }}
                        </button>
                        <button class="btn btn-primary"><i class="fa fa-save btn-fa"></i> {{ $t('Save Changes') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        created() {
            // Needed to fix bootstrap multiple modal bug
            $.fn.modal.Constructor.prototype.enforceFocus = function () {};

            this.$http.get('/api/children/create')
                .then(response => {
                    this.genders = response.data.genders;
                    this.blood_types = response.data.blood_types;
                    this.statuses = response.data.statuses;
                    this.religions = response.data.religions;
                    this.ethnicities = response.data.ethnicities;
                    this.parents = response.data.parents
                    this.is_not_parent = response.data.is_not_parent;
                })
                .catch(error => {
                    alert("Something went wrong. Please try reloading the page");
                });

            var self = this;
            window.bus.$on('parentRegistered', function(parent) {
                self.parents.push(parent);
                self.child.parents.push(parent.id);
                $('#create-edit-parent-modal').modal('hide');
                $('#create-child-modal').modal('show');
            });
        },
        data() {
             return {
                 genders: [],
                 blood_types: [],
                 statuses: [],
                 religions: [],
                 ethnicities: [],
                 parents: [],
                 child: this.generateNewChildModel(),
                 is_not_parent: false
             };
        },
        methods: {
            generateNewChildModel: function() {
                return {
                    name: '',
                    nickname: '',
                    ssn: '',
                    gender: '',
                    blood_type: '',
                    photo_uri: null,
                    dob: '',
                    pin: Math.floor(Math.random()*(9999-1111+1)+1111),
                    status: '',
                    religion: '',
                    ethnicity: '',
                    parents: []
                }
            },
            onFileChange: function(event) {
                var files = event.target.files || event.dataTransfer.files;
                if (!files.length)
                    return;
                this.child.photo_uri = files[0];
            },
            storeChild: function() {
                if (!this.parents.length && this.is_not_parent) {
                    $('#create-child-modal').modal('hide');
                    $('#create-edit-parent-modal').modal('show');
                    return;
                }

                var formData = new FormData();
                formData.append('name', this.child.name);
                formData.append('nickname', this.child.nickname);
                formData.append('ssn', this.child.ssn);
                formData.append('gender', this.child.gender);
                formData.append('photo_uri', this.child.photo_uri);
                formData.append('dob', this.child.dob);
                formData.append('pin', this.child.pin);
                formData.append('blood_type', this.child.blood_type)
                formData.append('status', this.child.status);
                formData.append('religion', this.child.religion);
                formData.append('ethnicity', this.child.ethnicity);
                this.child.parents.forEach(function(parent) {
                    formData.append('parents[]', parent);
                });

                this.$http.post('/api/children', formData)
                    .then(response => {
                        $('#create-child-modal').modal('hide');
                        this.child = this.generateNewChildModel();
                        this.$noty.success(response.data.message);
                    })
                    .catch(error => {
                        if (error.response.status == 403) {
                            this.$noty.error(this.$t('This child is inactive and read-only.'));
                        } else if (error.response.status == 422) {
                            for (var key in error.response.data.errors) {
                                this.$noty.error(error.response.data.errors[key]);
                            }
                        } else {
                            this.$noty.error(error.response.data.message);
                        }
                    });
            }
        }
    }
</script>
