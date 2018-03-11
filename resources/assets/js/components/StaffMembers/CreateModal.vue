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
                            <div class="form-group col-md-6">
                                <label class="control-label">{{ $t('Name') }}*</label>
                                <input type="text" class="form-control" v-model="staff.name" required autofocus/>
                            </div>

                            <div class="form-group col-md-6">
                                <label class="control-label">{{ $t('E-Mail Address') }}*</label>
                                <input type="email" class="form-control" v-model="staff.email" required autocomplete="username email"/>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="control-label">{{ $t('Password') }}*</label>
                                <input type="password" class="form-control" v-model="staff.password" required autocomplete="new-password"/>
                            </div>

                            <div class="form-group col-md-6">
                                <label class="control-label">{{ $t('Confirm Password') }}*</label>
                                <input type="password" class="form-control" v-model="staff.confirm_password" required autocomplete="new-password"/>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="photo_uri" class="control-label">{{ $t('Photo') }}*</label>
                                <input type="file" class="form-control" name="photo_uri" id="photo_uri" @change="onFileChange" />
                            </div>

                            <div class="form-group col-md-6">
                                <label class="control-label">{{ $t('DOB') }}*</label>
                                <input type="date" class="form-control" required v-model="staff.dob"/>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-12">
                                <label class="control-label">{{ $t('Address Line 1') }}*</label>
                                <input type="text" class="form-control" v-model="staff.address_line_1" required placeholder="Street and number, P.O. box, c/o."/>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-12">
                                <label class="control-label">{{ $t('Address Line 2') }}</label>
                                <input type="text" class="form-control" v-model="staff.address_line_2" placeholder="Apartment, suite, unit, building, floor, etc." />
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-5">
                                <label class="control-label">{{ $t('City / Town / Village') }}*</label>
                                <input type="text" class="form-control" v-model="staff.city" required />
                            </div>

                            <div class="form-group col-md-5">
                                <label class="control-label">{{ $t('State / Province / Region') }}*</label>
                                <input type="text" class="form-control" v-model="staff.state" required />
                            </div>

                            <div class="form-group col-md-2">
                                <label class="control-label">{{ $t('ZIP') }}*</label>
                                <input type="text" class="form-control" v-model="staff.zip_code" required />
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="control-label">{{ $t('Country') }}*</label>
                                <select class="form-control" v-model="staff.country" required>
                                    <option v-for="country in countries" v-bind:value="country.id">
                                        {{ country.name_label }}
                                    </option>
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label class="control-label">{{ $t('Phone Number') }}*</label>
                                <input type="text" class="form-control" v-model="staff.phone" required />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times btn-fa"></i> {{$t('Cancel')}}
                        </button>
                        <button class="btn btn-primary"><i class="fa fa-save btn-fa"></i> {{$t('Save')}}</button>
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
                        this.$emit('staffRegistered', response.data.staff_member);
                        $('#create-staff-modal').modal('hide');
                        this.staff = this.generateNewStaffModel();
                        this.$noty.success(response.data.message);
                    })
                    .catch(error => {
                        if (error.response.status == 422) {
                            for (var key in error.response.data) {
                                this.$noty.error(error.response.data[key]);
                            }
                        } else {
                            alert("Something went wrong. Please reload the page and try again.");
                        }
                    });
            }
        }
    }
</script>
