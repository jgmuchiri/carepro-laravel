<template>
    <div class="modal fade" id="create-parent-modal" tabindex="-1" role="dialog" aria-labelledby="create-parent">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="create-parent">{{ $t('Register Parent') }}</h4>
                </div>
                <form v-on:submit.prevent="storeParent">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="name" class="control-label">{{ $t('Name') }}*</label>
                                <input type="text" id="name" class="form-control" v-model="parent.name" required autofocus/>
                            </div>

                            <div class="col-md-6">
                                <label for="email" class="control-label">{{ $t('E-Mail Address') }}*</label>
                                <input type="email" id="email" class="form-control" v-model="parent.email" required />
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label for="password" class="control-label">{{ $t('Password') }}*</label>
                                <input type="password" class="form-control" id="password" v-model="parent.password" required />
                            </div>

                            <div class="col-md-6">
                                <label for="password-confirm" class="control-label">{{ $t('Confirm Password') }}*</label>
                                <input type="password" id="password-confirm" class="form-control" v-model="parent.confirm_password" required />
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label for="photo_uri" class="control-label">{{ $t('Photo') }}*</label>
                                <input type="file" name="photo_uri" id="photo_uri" @change="onFileChange" />
                            </div>

                            <div class="col-md-6">
                                <label for="dob" class="control-label">{{ $t('DOB') }}*</label>
                                <input type="date" id="dob" class="form-control" required v-model="parent.dob"/>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label for="pin">{{ $t('Access Pin') }}*</label>
                                <input type="text" id="pin" class="form-control" required v-model="parent.pin" />
                            </div>
                            <div class="col-md-6">
                                <label for="is_primary">{{ $t('Is Primary Parent?') }}</label>
                                <input type="checkbox" id="is_primary" class="form-control" v-model="parent.is_primary" />
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <label for="address_line_1" class="control-label">{{ $t('Address Line 1') }}*</label>
                                <input type="text" id="address_line_1" class="form-control" v-model="parent.address_line_1" required placeholder="Street and number, P.O. box, c/o."/>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <label for="address_line_2" class="control-label">{{ $t('Address Line 2') }}</label>
                                <input type="text" id="address_line_2" class="form-control" v-model="parent.address_line_2" placeholder="Apartment, suite, unit, building, floor, etc." />
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-5">
                                <label for="city" class="control-label">{{ $t('City / Town / Village') }}*</label>
                                <input type="text" id="city" class="form-control" v-model="parent.city" required />
                            </div>

                            <div class="col-md-5">
                                <label for="state" class="control-label">{{ $t('State / Province / Region') }}*</label>
                                <input type="text" id="state" class="form-control" v-model="parent.state" required />
                            </div>

                            <div class="col-md-2">
                                <label for="zip_code" class="control-label">{{ $t('ZIP') }}*</label>
                                <input type="text" id="zip_code" class="form-control" v-model="parent.zip_code" required />
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label for="country" class="control-label">{{ $t('Country') }}*</label>
                                <select id="country" class="form-control" v-model="parent.country" required>
                                    <option v-for="country in countries" v-bind:value="country.id">
                                        {{ country.name_label }}
                                    </option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="phone" class="control-label">{{ $t('Phone Number') }}*</label>
                                <input type="text" id="phone" class="form-control" v-model="parent.phone" required />
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
                 parent: this.generateNewParentModel()
             };
        },
        methods: {
            generateNewParentModel: function() {
                return {
                    name: '',
                    email: '',
                    password: '',
                    confirm_password: '',
                    photo_uri: null,
                    dob: '',
                    pin: '',
                    is_primary: false,
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
                this.parent.photo_uri = files[0];
            },
            storeParent: function() {
                var formData = new FormData();
                formData.append('name', this.parent.name);
                formData.append('email', this.parent.email);
                formData.append('password', this.parent.password);
                formData.append('password_confirmation', this.parent.confirm_password);
                formData.append('photo_uri', this.parent.photo_uri);
                formData.append('dob', this.parent.dob);
                formData.append('pin', this.parent.pin);
                formData.append('is_primary', this.parent.is_primary)
                formData.append('address_line_1', this.parent.address_line_1);
                formData.append('address_line_2', this.parent.address_line_2);
                formData.append('city', this.parent.city);
                formData.append('state', this.parent.state);
                formData.append('zip_code', this.parent.zip_code)
                formData.append('country', this.parent.country);
                formData.append('phone', this.parent.phone);

                this.$http.post('/api/parents', formData)
                    .then(response => {
                        $('#create-parent-modal').modal('hide');
                        this.parent = this.generateNewParentModel();
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
