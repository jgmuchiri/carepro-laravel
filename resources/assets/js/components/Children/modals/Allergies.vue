<template>
    <div class="modal fade modal-mo" id="allergies-tab" tabindex="-1" role="dialog" aria-labelledby="allergies-tab">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">{{ $t('Allergies') }}</h4>
                </div>
                <form v-on:submit.prevent="saveAllergy">
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label>{{ $t('Name') }}*</label>
                                <input type="text" class="form-control" name="name" required v-model="allergy.name" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label>{{ $t('Remarks') }}*</label>
                                <textarea class="form-control" name="relation" rows="4" required v-model="allergy.remarks"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label>{{ $t('Treatment') }}*</label>
                                <textarea class="form-control" name="relation" rows="4" required v-model="allergy.treatment"></textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="control-label">{{ $t('Date first noted') }}*</label>
                                <input type="date" class="form-control" v-model="allergy.date_first_noted" required>
                            </div>

                            <div class="form-group col-md-6">
                                <label class="control-label">{{ $t('Last Event Date ') }}*</label>
                                <input type="date" class="form-control" v-model="allergy.last_event_date" required />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" v-on:click="cancel" data-dismiss="modal">
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
        data() {
            return {
                allergy: this.allergyData()
            }
        },

        created() {
            var self = this;
            window.bus.$on('editAllergy', function(allergy) {
                console.log(allergy)
                self.allergy.id = allergy.id;
                self.allergy.name = allergy.name;
                self.allergy.remarks = allergy.remarks;
                self.allergy.treatment = allergy.treatment;
                self.allergy.date_first_noted = allergy.date_first_noted;
                self.allergy.last_event_date = allergy.last_event_date;
            });
        },

        methods: {
            allergyData: function() {
                return {
                    name: '',
                    remarks: '',
                    date_first_noted: '',
                    last_event_date: '',
                    treatment: '',
                    id: ''
                }
            },

            saveAllergy: function() {
                if (this.allergy.id) {
                    return this.update();
                } else {
                    return this.store();
                }
            },

            store: function() {
                axios.post('/api/children/' + this.child_id + '/allergy', this.allergy)
                .then(response => {
                    this.allergy = this.allergyData()
                    $('#allergies-tab').modal('hide');
                    window.bus.$emit('allergyRecordCreated', response.data.allergy);
                    this.$noty.success(response.data.message);
                })
                .catch(function (error) {
                    this.$noty.error(error.response.data.message);
                });
            },

            update: function() {
                axios.patch('/api/children/' + this.child_id + '/allergy/'+ this.allergy.id, this.allergy)
                .then(response => {
                    this.allergy = this.allergyData()
                    $('#allergies-tab').modal('hide');
                    window.bus.$emit('allergyRecordEdited', response.data.allergy);
                    this.$noty.success(response.data.message);
                })
                .catch(function (error) {
                    this.$noty.error(error.response.data.message);
                });
            },

            cancel: function() {
                this.allergy = this.allergyData()
            }
        },
        props: ['child_id']
    }
</script>