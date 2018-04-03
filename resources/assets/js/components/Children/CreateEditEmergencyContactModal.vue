<template>
    <div class="modal fade modal-mo" id="create-edit-emergency-contact-modal" tabindex="-1" role="dialog" aria-labelledby="create-edit-emergency-contact-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">{{ $t('Emergency Contact') }}</h4>
                </div>
                <form v-on:submit.prevent="saveEmergencyContact">
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label>{{ $t('Name') }}*</label>
                                <input type="text" class="form-control" name="name" required v-model="emergency_contact.name" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label>{{ $t('Relation') }}*</label>
                                <input type="text" class="form-control" name="relation" required v-model="emergency_contact.relation" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label class="control-label">{{ $t('Address Line 1') }}*</label>
                                <input type="text" class="form-control" v-model="emergency_contact.address_line_1" required placeholder="Street and number, P.O. box, c/o."/>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-12">
                                <label class="control-label">{{ $t('Address Line 2') }}</label>
                                <input type="text" class="form-control" v-model="emergency_contact.address_line_2" placeholder="Apartment, suite, unit, building, floor, etc." />
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-5">
                                <label class="control-label">{{ $t('City / Town / Village') }}*</label>
                                <input type="text" class="form-control" v-model="emergency_contact.city" required />
                            </div>

                            <div class="form-group col-md-5">
                                <label class="control-label">{{ $t('State / Province / Region') }}*</label>
                                <input type="text" class="form-control" v-model="emergency_contact.state" required />
                            </div>

                            <div class="form-group col-md-2">
                                <label class="control-label">{{ $t('ZIP') }}*</label>
                                <input type="text" class="form-control" v-model="emergency_contact.zip_code" required />
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="control-label">{{ $t('Country') }}*</label>
                                <select class="form-control" v-model="emergency_contact.country" required>
                                    <option v-for="country in countries" v-bind:value="country.id">
                                        {{ country.name_label }}
                                    </option>
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label class="control-label">{{ $t('Phone Number') }}*</label>
                                <input type="text" class="form-control" v-model="emergency_contact.phone" required />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">
                            <i class="fa fa-times btn-fa"></i>
                            {{ $t('Cancel') }}
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
            this.$http.get('/api/addresses/countries')
                .then(response => {
                    this.countries = response.data.countries;
                })
                .catch(error => {
                    alert("Something went wrong. Please try reloading the page");
                });

            var self = this;
            window.bus.$on('editEmergencyContact', function(emergency_contact) {
                self.emergency_contact.id = emergency_contact.id;
                self.emergency_contact.name = emergency_contact.name;
                self.emergency_contact.phone = emergency_contact.address.phone;
                self.emergency_contact.relation = emergency_contact.relation.name;
                self.emergency_contact.address_line_1 = emergency_contact.address.address_line_1;
                self.emergency_contact.address_line_2 = emergency_contact.address.address_line_2;
                self.emergency_contact.city = emergency_contact.address.city.name;
                self.emergency_contact.zip_code = emergency_contact.address.zip_code.zip_code;
                self.emergency_contact.state = emergency_contact.address.state.name;
                self.emergency_contact.country = emergency_contact.address.country.id;
            });
        },
        data() {
             return {
                 countries: [],
                 emergency_contact: this.generateNewEmergencyContactModel()
             };
        },
        methods: {
            generateNewEmergencyContactModel: function() {
                return {
                    name: '',
                    phone: '',
                    relation: '',
                    address_line_1: '',
                    address_line_2: '',
                    city: '',
                    state: '',
                    zip_code: '',
                    country: ''
                }
            },
            saveEmergencyContact: function() {
                if (this.emergency_contact.id) {
                    return this.update();
                } else {
                    return this.store();
                }
            },
            store: function() {
                this.$http.post('/api/children/' + this.child_id + '/emergency-contacts', this.emergency_contact)
                        .then(response => {
                            $('#create-edit-emergency-contact-modal').modal('hide');
                            window.bus.$emit('emergencyContactCreated', response.data.emergency_contact);
                            this.emergency_contact = this.generateNewEmergencyContactModel();
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
            },
            update: function() {
                this.$http.put(
                    '/api/children/' + this.child_id + '/emergency-contacts/' + this.emergency_contact.id,
                    this.emergency_contact
                )
                    .then(response => {
                        $('#create-edit-emergency-contact-modal').modal('hide');
                        window.bus.$emit('emergencyContactEdited', response.data.emergency_contact);
                        this.emergency_contact = this.generateNewEmergencyContactModel();
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
        },
        props: ['child_id']
    }
</script>
