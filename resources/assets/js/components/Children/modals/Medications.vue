<template>
    <div class="modal fade modal-mo" id="medications-tab" tabindex="-1" role="dialog" aria-labelledby="medications-tab">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">{{ $t('Emergency Contact') }}</h4>
                </div>
                <form v-on:submit.prevent="saveMedication">
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label>{{ $t('Name') }}*</label>
                                <input type="text" class="form-control" name="name" required v-model="medication.name" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label>{{ $t('Frequency') }}*</label>
                                <textarea class="form-control" name="relation" rows="5" required v-model="medication.frequency"></textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="control-label">{{ $t('Start') }}*</label>
                                <input type="date" class="form-control" v-model="medication.start" required>
                            </div>

                            <div class="form-group col-md-6">
                                <label class="control-label">{{ $t('Stop') }}*</label>
                                <input type="date" class="form-control" v-model="medication.stop" required />
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
                medication: this.medicationData()
            }
        },

        created() {
            var self = this;
            window.bus.$on('editMedication', function(medication) {
                console.log(medication)
                self.medication.id = medication.id;
                self.medication.name = medication.name;
                self.medication.frequency = medication.frequency;
                self.medication.start = medication.start;
                self.medication.stop = medication.stop;
            });
        },

        methods: {
            medicationData: function() {
                return {
                    name: '',
                    frequency: '',
                    start: '',
                    stop: '',
                    id: ''
                }
            },

            saveMedication: function() {
                if (this.medication.id) {
                    return this.update();
                } else {
                    return this.store();
                }
            },

            store: function() {
                axios.post('/api/children/' + this.child_id + '/medication', this.medication)
                .then(response => {
                    this.medication = this.medicationData()
                    $('#medications-tab').modal('hide');
                    window.bus.$emit('medicationRecordCreated', response.data.medication);
                    this.$noty.success(response.data.message);
                })
                .catch(function (error) {
                    this.$noty.error(error.response.data.message);
                });
            },

            update: function() {
                axios.patch('/api/children/' + this.child_id + '/medication/'+ this.medication.id, this.medication)
                .then(response => {
                    this.medication = this.medicationData()
                    $('#medications-tab').modal('hide');
                    window.bus.$emit('medicationRecordEdited', response.data.medication);
                    this.$noty.success(response.data.message);
                })
                .catch(function (error) {
                    this.$noty.error(error.response.data.message);
                });
            },

            cancel: function() {
                this.medication = this.medicationData()
            }
        },
        props: ['child_id']
    }
</script>