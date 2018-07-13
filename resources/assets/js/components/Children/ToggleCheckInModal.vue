<template>
    <div class="modal fade" id="toggleCheckInModal" tabindex="-1" role="dialog" aria-labelledby="check-in-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">{{ child.is_checked_in ? 'check out' : 'check in' }}</h4>
                </div>

                <form v-on:submit.prevent="save">
                    <div class="modal-body">
                        <div class="row">
                            <div v-for="user in parents" class="col-sm-6 col-xs-6 col-md-4 text-center">
                                <input type="radio" v-bind:id="user.id" class="input-hidden" v-bind:value="user.id" v-model="parent.parent_id" @change="clearPickupuser"/>
                                <label v-bind:for="user.id">
                                  <img class="center-block img-responsive img-thumbnail" :src="user.full_photo_uri" :alt="user.name"/>
                                  <p style="padding-top:10px;">{{ user.user.name }}</p>
                                </label>
                            </div>
                            <div v-for="user in pickupusers" class="col-sm-6 col-xs-6 col-md-4 text-center">
                                <input type="radio" v-bind:id="user.email" class="input-hidden" v-bind:value="user.id" v-model="parent.pickupuser_id" @change="clearParent"/>
                                <label v-bind:for="user.email">
                                  <img class="center-block img-responsive img-thumbnail" :src="user.full_photo_uri" :alt="user.name" />
                                  <p style="padding-top:10px;">{{ user.name }}</p>
                                </label>
                            </div>
                        </div>
                        <template v-if="state == 'Pin'">
                            <div v-if="parent.parent_id || parent.pickupuser_id">
                                <p class="text-center">{{ $t('Enter the pickup person\'s pin number') }}</p>
                                <input type="text" class="form-control" v-model="parent.pin" required/>
                            </div>
                        </template>
                    </div>
                    <div class="modal-footer">
                        <button type="button" :class="'btn ' + (state == 'Success' ? 'btn-primary' : 'btn-default')" data-dismiss="modal">{{ state == 'Success' ? $t('OK') : $t('Close') }}</button>
                        <input v-if="state != 'Success'" type="submit" class="btn btn-primary" :value="$t('Validate and ' + (child.is_checked_in ? 'Checkout' : 'Check in'))"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        created() {
            var self = this;
            window.bus.$on('openToggleCheckinModal', function(child, parents, pickupusers) {
                self.child = child;
                self.parents = parents;
                self.pickupusers = pickupusers;
                self.state = 'Pin';
                self.parent.parent_id = '';
                self.parent.pin = null;
            });
        },
        data() {
             return {
                state: 'Pin',
                child: {},
                parents: [],
                pickupusers: [],
                parent: {
                    parent_id: '',
                    pickupuser_id: '',
                    pin: null,
                }
             };
        },
        methods: {
            save: function() {
                let self = this
                this.$swal({

                    title: 'Are you sure?',
                    text: 'You are about to ' + (this.child.is_checked_in ? 'checkout' : 'check in') + ' a child.',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, ' + (this.child.is_checked_in ? 'Checkout' : 'Check in'),
                    cancelButtonText: 'No, cancel please'
                })

                .then(function(result) {
                    axios.post('/api/children/' + self.child.id + '/toggle-check-in', self.parent)
                    .then(response => {
                        window.bus.$emit('toggleChildCheckIn',self.child.id);
                        self.$swal(
                            'Success!',
                            self.$t('Child has been ' + (self.child.is_checked_in ? 'checked in.' : 'checked out.') + '<br>' + (self.child.is_checked_in ? 'Check In ' : 'Checkout ') + '' +self.getDate()),
                            'success'
                        );
                        $('#toggleCheckInModal').hide()
                    })
                    .catch(error => {
                        if (error.response.status == 403) {
                            self.$swal(
                                'Something went Wrong',
                                self.$t('This child is inactive and read-only.'),
                                'error'
                            );
                        } else {
                            self.$swal(
                                'error',
                                error.response.data.message[0],
                                'error'
                            );
                        }
                    });

                    }, function(dismiss) {
                        if (dismiss === 'cancel') {
                          self.$swal(
                            'Cancelled',
                            self.$t('Child has not been ' + (self.child.is_checked_in ? 'checked in.' : 'checked out.')),
                            'error'
                          );
                        }
                        $('#toggleCheckInModal').hide()
                    }
                );
            },
            getDate: function() {
                return window.moment().format('dddd, D MMM YYYY @ hh:mm a');
            },

            clearParent: function() {
                this.parent.parent_id = ''
            },

            clearPickupuser: function() {
                this.parent.pickupuser_id = ''
            },

            cancel: function() {
                this.parents = []
                this.parent.pin = ''
                this.parent.parent_id = ''
            }
        }
    }
</script>
