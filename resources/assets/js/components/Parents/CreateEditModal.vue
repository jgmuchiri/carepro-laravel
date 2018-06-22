<template>
    <div class="modal fade" id="create-edit-parent-modal" tabindex="-1" role="dialog" aria-labelledby="create-edit-parent">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="create-edit-parent">{{ (this.parent.id ? $t('Edit Parent') : $t('Register Parent')) }}</h4>
                </div>
                <form v-on:submit.prevent="save">
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="control-label">{{ $t('Name') }}*</label>
                                <input type="text" class="form-control" v-model="parent.name" required autofocus/>
                            </div>

                            <div class="form-group col-md-6">
                                <label class="control-label">{{ $t('E-Mail Address') }}*</label>
                                <input type="email" class="form-control" v-model="parent.email" required autocomplete="username email" />
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="control-label">{{ $t('Password') }}{{ (this.parent.id ? '' : '*') }}</label>
                                <input type="password" class="form-control" v-model="parent.password" autocomplete="new-password"/>
                            </div>

                            <div class="form-group col-md-6">
                                <label class="control-label">{{ $t('Confirm Password') }}{{ (this.parent.id ? '' : '*') }}</label>
                                <input type="password" class="form-control" v-model="parent.confirm_password" autocomplete="new-password" />
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="parent_photo_uri" class="control-label">{{ $t('Photo') }}*</label>
                                <input class="form-control filestyle" type="file" data-classbutton="btn btn-default" data-classinput="form-control inline" name="photo_uri" id="parent_photo_uri" @change="onFileChange" />
                            </div>

                            <div class="form-group col-md-6">
                                <label class="control-label">{{ $t('DOB') }}*</label>
                                <input type="date" class="form-control" required v-model="parent.dob"/>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="pin">{{ $t('Access Pin') }}*</label>
                                <input type="text" id="pin" class="form-control" required v-model="parent.pin" />
                            </div>
                            <div class="form-group col-md-6">
                                <label for="is_primary"></label>
                                <div class="checkbox c-checkbox needsclick">
                                    <label class="needsclick">
                                        <input class="needsclick" type="checkbox" id="is_primary" v-model="parent.is_primary">
                                        <span class="fa fa-check"></span>{{ $t('Is Primary Parent?') }}</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-12">
                                <label class="control-label">{{ $t('Address Line 1') }}*</label>
                                <input type="text" class="form-control" v-model="parent.address_line_1" required placeholder="Street and number, P.O. box, c/o."/>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-12">
                                <label class="control-label">{{ $t('Address Line 2') }}</label>
                                <input type="text" class="form-control" v-model="parent.address_line_2" placeholder="Apartment, suite, unit, building, floor, etc." />
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-5">
                                <label class="control-label">{{ $t('City / Town / Village') }}*</label>
                                <input type="text" class="form-control" v-model="parent.city" required />
                            </div>

                            <div class="form-group col-md-5">
                                <label class="control-label">{{ $t('State / Province / Region') }}*</label>
                                <input type="text" class="form-control" v-model="parent.state" required />
                            </div>

                            <div class="form-group col-md-2">
                                <label class="control-label">{{ $t('ZIP') }}*</label>
                                <input type="text" class="form-control" v-model="parent.zip_code" required />
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="control-label">{{ $t('Country') }}*</label>
                                <select class="form-control" v-model="parent.country" required>
                                    <option v-for="country in countries" v-bind:value="country.id">
                                        {{ country.name_label }}
                                    </option>
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label class="control-label">{{ $t('Phone Number') }}*</label>
                                <input type="text" class="form-control" v-model="parent.phone" required />
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
            axios.get('/api/addresses/countries')
                .then(response => {
                    this.countries = response.data.countries;
                })
                .catch(error => {
                    alert("Something went wrong. Please try reloading the page");
                });

            var self = this;
            window.bus.$on('editParent', function(id) {
                axios.get('/api/parents/' + id)
                .then(response => {
                    self.parent = {
                        id: response.data.parent.id,
                        name: response.data.parent.user.name,
                        email: response.data.parent.user.email,
                        password: '',
                        confirm_password: '',
                        photo_uri: null,
                        dob: response.data.parent.date_of_birth,
                        pin: response.data.parent.pin,
                        is_primary: response.data.parent.is_primary,
                        address_line_1: response.data.parent.user.address.address_line_1,
                        address_line_2: response.data.parent.user.address.address_line_2,
                        city: response.data.parent.user.address.city.name,
                        state: response.data.parent.user.address.state.name,
                        zip_code: response.data.parent.user.address.zip_code.zip_code,
                        country: response.data.parent.user.address.country.id,
                        phone: response.data.parent.user.address.phone
                    }
                    $('#create-edit-parent-modal').modal({
                      backdrop: false
                    })
                })
                .catch(error => {
                    this.$noty.error(error.response.data.message);
                });
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
                this.upload_image = true;
            },
            save: function() {
               if (this.parent.id) {
                   return this.updateParent();
               } else {
                   return this.storeParent();
               }
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

                axios.post('/api/parents', formData)
                    .then(response => {
                        this.$emit('parentRegistered', response.data.parent);
                        window.bus.$emit('parentRegistered', response.data.parent);
                        $('#create-edit-parent-modal').modal('hide');
                        this.parent = this.generateNewParentModel();
                        this.$noty.success(response.data.message);
                    })
                    .catch(error => {
                        if (error.response.status == 422) {
                            for (var key in error.response.data) {
                                this.$noty.error(error.response.data[key]);
                            }
                        } else {
                            this.$noty.error(error.response.data.message);
                        }
                    });
            },
            updateParent: function() {
                var formData = new FormData();
                formData.append('name', this.parent.name);
                formData.append('email', this.parent.email);
                formData.append('password', this.parent.password);
                formData.append('password_confirmation', this.parent.confirm_password);
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
                formData.append('_method', 'PUT');

                if (this.upload_image) {
                    formData.append('photo_uri', this.parent.photo_uri);
                }

                axios.post('/api/parents/' + this.parent.id, formData)
                    .then(response => {
                        this.$emit('parentEdited', response.data.parent);
                        window.bus.$emit('parentEdited', response.data.parent);
                        $('#create-edit-parent-modal').modal('hide');
                        this.parent = this.generateNewParentModel();
                        this.$noty.success(response.data.message);
                    })
                    .catch(error => {
                        if (error.response.status == 422) {
                            for (var key in error.response.data) {
                                this.$noty.error(error.response.data[key]);
                            }
                        } else {
                            this.$noty.error(error.response.data.message);
                        }
                    });
            }
        }
    }
</script>
