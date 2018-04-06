<template>
    <div class="content-wrapper">
        <div class="content-heading">
           <!-- END Language list-->{{ $t('Staff Members') }}
        </div>
        <!-- END widgets box-->
        <div class="row">
            <div class="col-md-offset-1 col-md-10">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $t('Edit Staff Member') }}</div>
                    <hr>
                    <div class="panel-body">
                        <form v-on:submit.prevent="updateStaff">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="name" class="control-label">{{ $t('Name') }}*</label>
                                    <input type="text" id="name" class="form-control" v-model="staff.user.name" required autofocus/>
                                </div>

                                <div class="col-md-6">
                                    <label for="email" class="control-label">{{ $t('E-Mail Address') }}*</label>
                                    <input type="email" id="email" class="form-control" v-model="staff.user.email" required />
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <label for="photo_uri" class="control-label">{{ $t('Photo') }}*</label>
                                    <input type="file" name="photo_uri" id="photo_uri" class="form-control" @change="onFileChange" />
                                </div>

                                <div class="col-md-6">
                                    <label class="control-label">{{ $t('DOB') }}*</label>
                                    <input type="date" class="form-control" required v-model="staff.date_of_birth"/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <label class="control-label">{{ $t('Address Line 1') }}*</label>
                                    <input type="text" class="form-control" v-model="staff.user.address.address_line_1" required placeholder="Street and number, P.O. box, c/o."/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <label class="control-label">{{ $t('Address Line 2') }}</label>
                                    <input type="text" class="form-control" v-model="staff.user.address.address_line_2" placeholder="Apartment, suite, unit, building, floor, etc." />
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-5">
                                    <label class="control-label">{{ $t('City / Town / Village') }}*</label>
                                    <input type="text" class="form-control" v-model="staff.user.address.city.name" required />
                                </div>

                                <div class="col-md-5">
                                    <label class="control-label">{{ $t('State / Province / Region') }}*</label>
                                    <input type="text" class="form-control" v-model="staff.user.address.state.name" required />
                                </div>

                                <div class="col-md-2">
                                    <label class="control-label">{{ $t('ZIP') }}*</label>
                                    <input type="text" class="form-control" v-model="staff.user.address.zip_code.zip_code" required />
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <label class="control-label">{{ $t('Country') }}*</label>
                                    <select class="form-control" v-model="staff.user.address.country.id" required>
                                        <option v-for="country in countries" v-bind:value="country.id">
                                            {{ country.name_label }}
                                        </option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="control-label">{{ $t('Phone Number') }}*</label>
                                    <input type="text" class="form-control" v-model="staff.user.address.phone" required />
                                </div>
                            </div>
                            <div class="row" style="padding-top:30px;">
                                <div class="form-group text-center">
                                    <button class="btn btn-primary"><i class="fa fa-save"></i> {{$t('Save')}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">{{ $t('Update Password') }}</div>
                    <hr/>
                    <div class="panel-body">
                        <form v-on:submit.prevent="updateStaffPassword">
                            <div class="content">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="password" class="control-label">{{ $t('Password') }}*</label>
                                        <input type="password" class="form-control" id="password" v-model="staff.user.password" required autocomplete="new-password"/>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="password-confirm" class="control-label">{{ $t('Confirm Password') }}*</label>
                                        <input type="password" id="password-confirm" class="form-control" v-model="staff.user.confirm_password" required autocomplete="new-password"/>
                                    </div>
                                </div>
                                <div class="row" style="padding-top:30px;">
                                    <div class="form-group text-center">
                                        <button class="btn btn-primary"><i class="fa fa-save"></i> {{$t('Save')}}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ $t('Groups') }}
                        <div class="pull-right">
                            <div class="btn-group">
                                <button data-toggle="modal" data-target="#addToGroup" data-backdrop="false" class="btn btn-primary waves-effect m-b-5">
                                    <i class="fa fa-plus m-r-5 btn-fa"></i>
                                    <span> {{ $t('Add to group') }}</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <hr/>
                    <div class="panel-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>{{ $t('Name') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="group in staff.groups">
                                    <td>
                                        <router-link :to="{ name: 'groups.show', params: { group_id: group.id }}">
                                            {{group.name}}
                                        </router-link>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <AddToGroupModal v-if="staff.id" v-on:staffAddedToGroup="addGroups" :staff_id="staff.id" :initial_groups="staff.groups"></AddToGroupModal>
    </div>
</template>

<script>
import 'vuejs-noty/dist/vuejs-noty.css'
    export default {
        created() {
            this.$http.get('/api/addresses/countries')
                .then(response => {
                    this.countries = response.data.countries;
                })
                .catch(error => {
                    alert("Something went wrong. Please try reloading the page");
                });
            this.$http.get('/api/staff/' + this.staff_id + '/edit')
                .then(response => {
                    this.staff = response.data.staff;
                    this.staff.user.password = '';
                    this.staff.user.confirm_password = '';
                    this.staff.date_of_birth = moment(String(this.staff.date_of_birth)).format('YYYY-MM-DD');
                })
                .catch(error => {
                    alert("Something went wrong. Please try reloading the page");
                })
        },
        data() {
             return {
                 countries: [],
                 staff: this.generateNewStaffModel()
             };
        },
        methods: {
            generateNewStaffModel: function() {
                return {
                    user: {
                        name: '',
                        email: '',
                        password: '',
                        confirm_password: '',
                        address: {
                            address_line_1: '',
                            address_line_2: '',
                            city: {
                                name: ''
                            },
                            state: {
                                name: ''
                            },
                            zip_code: {
                                zip_code: ''
                            },
                            country: {
                                id: 0,
                                name: ''
                            },
                            phone: ''
                        }
                    },
                    photo_uri: null,
                    date_of_birth: '',
                    groups: []
                }
            },
            onFileChange: function(event) {
                var files = event.target.files || event.dataTransfer.files;
                if (!files.length)
                    return;
                this.staff.photo_uri = files[0];
            },
            updateStaff: function() {
                var formData = new FormData();
                formData.append('name', this.staff.user.name);
                formData.append('email', this.staff.user.email);
                formData.append('photo_uri', this.staff.photo_uri);
                formData.append('dob', this.staff.date_of_birth);
                formData.append('address_line_1', this.staff.user.address.address_line_1);
                formData.append('address_line_2', this.staff.user.address.address_line_2);
                formData.append('city', this.staff.user.address.city.name);
                formData.append('state', this.staff.user.address.state.name);
                formData.append('zip_code', this.staff.user.address.zip_code.zip_code);
                formData.append('country', this.staff.user.address.country.id);
                formData.append('phone', this.staff.user.address.phone);
                formData.append('_method', 'PUT');

                this.$http.post('/api/staff/' + this.staff_id, formData)
                    .then(response => {
                        this.$noty.success(response.data.message);
                    })
                    .catch(error => {
                        if (error.response.status == 422) {
                            for (var key in error.response.data) {
                                this.notifyError(error.response.data[key]);
                            }
                        } else {
                            alert("Something went wrong. Please reload the page and try again.");
                        }
                    });
            },
            updateStaffPassword: function() {
                this.$http.put(
                    '/api/staff/' + this.staff_id + '/update-password',
                    {
                        password: this.staff.user.password,
                        password_confirmation: this.staff.user.confirm_password
                    }
                )
                    .then(response => {
                        this.notifySuccess(response.data.message);
                        this.staff.user.password = '';
                        this.staff.user.confirm_password = '';
                        $('#password').val('');
                        $('#password-confirm').val('');
                    })
                    .catch(error => {
                        if (error.response.status == 422) {
                            for (var key in error.response.data) {
                                this.notifyError(error.response.data[key]);
                            }
                        } else {
                            alert("Something went wrong. Please reload the page and try again.");
                        }
                    });
            },
            addGroups: function(groups) {
                this.staff.groups = groups;
            }

        },
        props: ['staff_id']
    }
</script>
