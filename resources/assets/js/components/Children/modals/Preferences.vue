<template>
    <div class="modal fade modal-mo" id="preferences-tab" tabindex="-1" role="dialog" aria-labelledby="preferences-tab">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">{{ $t('Food Preferences') }}</h4>
                </div>
                <form v-on:submit.prevent="savePreference">
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label>{{ $t('Name') }}*</label>
                                <input type="text" class="form-control" name="name" required v-model="preference.name" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label>{{ $t('Remarks') }}*</label>
                                <textarea class="form-control" name="remarks" rows="2" required v-model="preference.remarks"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label>{{ $t('Prefered Time') }}*</label>
                                <textarea class="form-control" name="time" rows="2" required v-model="preference.preffered_time"></textarea>
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
                preference: this.foodpreferenceData()
            }
        },

        created() {
            var self = this;
            window.bus.$on('editFoodPreference', function(preference) {
                self.preference.id = preference.id;
                self.preference.name = preference.name;
                self.preference.remarks = preference.remarks;
                self.preference.preffered_time = preference.preffered_time;
            });
        },

        methods: {
            foodpreferenceData: function() {
                return {
                    name: '',
                    remarks: '',
                    preffered_time: '',
                    id: ''
                }
            },

            savePreference: function() {
                if (this.preference.id) {
                    return this.update();
                } else {
                    return this.store();
                }
            },

            store: function() {
                axios.post('/api/children/' + this.child_id + '/foodpreference', this.preference)
                .then(response => {
                    this.preference = this.foodpreferenceData()
                    $('#preferences-tab').modal('hide');
                    window.bus.$emit('preferenceRecordCreated', response.data.preference);
                    this.$noty.success(response.data.message);
                })
                .catch(function (error) {
                    this.$noty.error(error.response.data.message);
                });
            },

            update: function() {
                axios.patch('/api/children/' + this.child_id + '/foodpreference/'+ this.preference.id, this.preference)
                .then(response => {
                    this.preference = this.foodpreferenceData()
                    $('#preferences-tab').modal('hide');
                    window.bus.$emit('preferenceRecordEdited', response.data.preference);
                    this.$noty.success(response.data.message);
                })
                .catch(function (error) {
                    this.$noty.error(error.response.data.message);
                });
            },

            cancel: function() {
                this.preference = this.foodpreferenceData()
            }
        },
        props: ['child_id']
    }
</script>