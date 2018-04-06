<template>
    <div class="modal fade modal-mo" id="create-edit-health-provider-modal" tabindex="-1" role="dialog" aria-labelledby="create-edit-health-provider-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">{{ $t('Health provider') }}</h4>
                </div>
                <form v-on:submit.prevent="saveHealthProvider">
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label>{{ $t('Name') }}*</label>
                                <input type="text" class="form-control" name="name" required v-model="health_provider.name" />
                            </div>
                            <div class="form-group col-sm-6">
                                <label>{{ $t('Type/Role') }}*</label>
                                <input type="text" class="form-control" name="role" required v-model="health_provider.role" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label>{{ $t('Remarks') }}*</label>
                                <textarea class="form-control" name="remarks" required v-model="health_provider.remarks"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label class="control-label">{{ $t('Address Line 1') }}*</label>
                                <input type="text" class="form-control" v-model="health_provider.address_line_1" required placeholder="Street and number, P.O. box, c/o."/>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-12">
                                <label class="control-label">{{ $t('Address Line 2') }}</label>
                                <input type="text" class="form-control" v-model="health_provider.address_line_2" placeholder="Apartment, suite, unit, building, floor, etc." />
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-5">
                                <label class="control-label">{{ $t('City / Town / Village') }}*</label>
                                <input type="text" class="form-control" v-model="health_provider.city" required />
                            </div>

                            <div class="form-group col-md-5">
                                <label class="control-label">{{ $t('State / Province / Region') }}*</label>
                                <input type="text" class="form-control" v-model="health_provider.state" required />
                            </div>

                            <div class="form-group col-md-2">
                                <label class="control-label">{{ $t('ZIP') }}*</label>
                                <input type="text" class="form-control" v-model="health_provider.zip_code" required />
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="control-label">{{ $t('Country') }}*</label>
                                <select class="form-control" v-model="health_provider.country" required>
                                    <option v-for="country in countries" v-bind:value="country.id">
                                        {{ country.name_label }}
                                    </option>
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label class="control-label">{{ $t('Phone Number') }}*</label>
                                <input type="text" class="form-control" v-model="health_provider.phone" required />
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
            window.bus.$on('editHealthProvider', function(health_provider) {
                self.health_provider.id = health_provider.id;
                self.health_provider.name = health_provider.name;
                self.health_provider.phone = health_provider.address.phone;
                self.health_provider.role = health_provider.role.name;
                self.health_provider.address_line_1 = health_provider.address.address_line_1;
                self.health_provider.address_line_2 = health_provider.address.address_line_2;
                self.health_provider.city = health_provider.address.city.name;
                self.health_provider.zip_code = health_provider.address.zip_code.zip_code;
                self.health_provider.state = health_provider.address.state.name;
                self.health_provider.country = health_provider.address.country.id;
                self.health_provider.remarks = health_provider.remarks;
            });
        },
        data() {
             return {
                 countries: [],
                 health_provider: this.generateNewHealthProviderModel()
             };
        },
        methods: {
            generateNewHealthProviderModel: function() {
                return {
                    name: '',
                    phone: '',
                    role: '',
                    address_line_1: '',
                    address_line_2: '',
                    city: '',
                    state: '',
                    zip_code: '',
                    country: '',
                    remarks: ''
                }
            },
            saveHealthProvider: function() {
                if (this.health_provider.id) {
                    return this.update();
                } else {
                    return this.store();
                }
            },
            store: function() {
                this.$http.post('/api/children/' + this.child_id + '/health-providers', this.health_provider)
                        .then(response => {
                            $('#create-edit-health-provider-modal').modal('hide');
                            window.bus.$emit('healthProviderCreated', response.data.health_provider);
                            this.health_provider = this.generateNewHealthProviderModel();
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
                    '/api/children/' + this.child_id + '/health-providers/' + this.health_provider.id,
                    this.health_provider
                )
                    .then(response => {
                        $('#create-edit-health-provider-modal').modal('hide');
                        window.bus.$emit('healthProviderEdited', response.data.health_provider);
                        this.health_provider = this.generateNewHealthProviderModel();
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
