<template>
    <div class="modal fade" id="toggleCheckInModal" tabindex="-1" role="dialog" aria-labelledby="check-in-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form v-on:submit.prevent="save">
                    <div class="modal-body">
                        <template v-if="state == 'Pin'">
                            <p class="text-center">{{ $t('Enter the pickup person\'s pin number') }}</p>
                            <input type="text" class="form-control" v-model="pin" />
                        </template>
                        <template v-if="state == 'Confirm'">
                            <p class="text-center">{{ $t('Are you sure?') }}</p>
                            <p class="text-center">{{ $t('You are about to check in a child.')}}</p>
                        </template>
                        <template v-if="state == 'Success'">
                            <p class="text-center">{{ $t('Child has been checked in.') }}}</p>
                            <p class="text-center">{{ $t('Check In ') }} {{ this.getDate() }}</p>
                        </template>
                    </div>
                    <div class="modal-footer">
                        <button type="button" :class="'btn ' + (state == 'Success' ? 'btn-primary' : 'btn-default')" data-dismiss="modal">{{ state == 'Success' ? $t('OK') : $t('Close') }}</button>
                        <input v-if="state != 'Success'" type="submit" class="btn btn-primary" :value="$t('Validate and Checkout')"/>
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
                 pin: null,
                 state: 'Pin'
             };
        },
        methods: {
            save: function() {
                if (this.state != 'Confirm') {
                    this.state = 'Confirm';
                    return;
                }

                this.$http.post('/api/children/' + this.child.id + '/toggle-check-in', {
                    pin: this.pin
                })
                    .then(response => {
                        this.$emit('toggleCheckIn', 'Check-out');
                        this.state = 'Success'
                    })
                    .catch(error => {
                        if (error.response.status == 403) {
                            this.$noty.error(this.$t('This child is inactive and read-only.'));
                        } else if (error.response.status == 422) {
                            for (var key in error.response.data) {
                                this.$noty.error(error.response.data[key]);
                            }
                            this.state = 'Pin';
                        } else {
                            alert("Something went wrong. Please reload the page and try again.");
                        }
                    });
            },
            getDate: function() {
                return window.moment().now().format('dddd, D MMM YYYY @ hh:mm a');
            }
        },
        props: ['child']
    }
</script>
