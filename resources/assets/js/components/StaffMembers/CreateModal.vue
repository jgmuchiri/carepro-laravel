<template>
    <div class="modal fade" id="create-staff-modal" tabindex="-1" role="dialog" aria-labelledby="create-staff">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="create-staff">{{ $t('Register Staff Member') }}</h4>
                </div>
                <form v-on:submit.prevent="storeStaff">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="name" class="control-label">{{ $t('Name') }}*</label>
                                <input type="text" id="name" class="form-control" v-model="staff.name" required autofocus/>
                            </div>

                            <div class="col-md-6">
                                <label for="email" class="control-label">{{ $t('E-Mail Address') }}*</label>
                                <input type="email" id="email" class="form-control" v-model="staff.email" required />
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label for="password" class="control-label">{{ $t('Password') }}*</label>
                                <input type="password" class="form-control" id="password" v-model="staff.password" required />
                            </div>

                            <div class="col-md-6">
                                <label for="password-confirm" class="control-label">{{ $t('Confirm Password') }}*</label>
                                <input type="password" id="password-confirm" class="form-control" v-model="staff.confirm_password" required />
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label for="photo_uri" class="control-label">{{ $t('Photo') }}*</label>
                                <input type="file" name="photo_uri" id="photo_uri" @change="onFileChange" />
                            </div>

                            <div class="col-md-6">
                                <label for="dob" class="control-label">{{ $t('DOB') }}*</label>
                                <input type="date" id="dob" class="form-control" required v-model="staff.dob"/>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <label for="address_line_1" class="control-label">{{ $t('Address Line 1') }}*</label>
                                <input type="text" id="address_line_1" class="form-control" v-model="staff.address_line_1" required placeholder="Street and number, P.O. box, c/o."/>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <label for="address_line_2" class="control-label">{{ $t('Address Line 2') }}</label>
                                <input type="text" id="address_line_2" class="form-control" v-model="staff.address_line_2" placeholder="Apartment, suite, unit, building, floor, etc." />
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-5">
                                <label for="city" class="control-label">{{ $t('City / Town / Village') }}*</label>
                                <input type="text" id="city" class="form-control" v-model="staff.city" required />
                            </div>

                            <div class="col-md-5">
                                <label for="state" class="control-label">{{ $t('State / Province / Region') }}*</label>
                                <input type="text" id="state" class="form-control" v-model="staff.state" required />
                            </div>

                            <div class="col-md-2">
                                <label for="zip_code" class="control-label">{{ $t('ZIP') }}*</label>
                                <input type="text" id="zip_code" class="form-control" v-model="staff.zip_code" required />
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label for="country" class="control-label">{{ $t('Country') }}*</label>
                                <select id="country" class="form-control" v-model="staff.country" required>
                                    <option v-for="country in countries" v-bind:value="country.id">
                                        {{ country.name_label }}
                                    </option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="phone" class="control-label">{{ $t('Phone Number') }}*</label>
                                <input type="text" id="phone" class="form-control" v-model="staff.phone" required />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> {{$t('Cancel')}}
                        </button>
                        <button class="btn btn-primary"><i class="fa fa-save"></i> {{$t('Save')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        created() {
            this.$http.get('/api/addresses/countries')
                .then(response => {
                    this.countries = response.data.countries;
                })
                .catch(error => {
                    alert("Something went wrong. Please try reloading the page");
                });
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
                    name: '',
                    email: '',
                    password: '',
                    confirm_password: '',
                    photo_uri: null,
                    dob: '',
                    address_line_1: '',
                    address_line_2: '',
                    city: '',
                    state: '',
                    zip_code: '',
                    country: '',
                    phone: ''
                }
            },
            onFileChange: function(event) {
                var files = event.target.files || event.dataTransfer.files;
                if (!files.length)
                    return;
                this.staff.photo_uri = files[0];
            },
            storeStaff: function() {
                var formData = new FormData();
                formData.append('name', this.staff.name);
                formData.append('email', this.staff.email);
                formData.append('password', this.staff.password);
                formData.append('password_confirmation', this.staff.confirm_password);
                formData.append('photo_uri', this.staff.photo_uri);
                formData.append('dob', this.staff.dob);
                formData.append('address_line_1', this.staff.address_line_1);
                formData.append('address_line_2', this.staff.address_line_2);
                formData.append('city', this.staff.city);
                formData.append('state', this.staff.state);
                formData.append('zip_code', this.staff.zip_code)
                formData.append('country', this.staff.country);
                formData.append('phone', this.staff.phone);

                this.$http.post('/api/staff', formData)
                    .then(response => {
                        $('#create-staff-modal').modal('hide');
                        this.staff = this.generateNewStaffModel();
                        this.notifySuccess(response.data.message);
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
            }
        }
    }
</script>
