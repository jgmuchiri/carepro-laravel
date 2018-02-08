<template>
    <div class="modal fade modal-mo" id="create-edit-pickup-user-modal" tabindex="-1" role="dialog" aria-labelledby="create-edit-pickup-user-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">{{ $t('Pickup User') }}</h4>
                </div>
                <form v-on:submit.prevent="savePickupUser">
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label>{{ $t('Name') }}*</label>
                                <input type="text" class="form-control" name="name" required v-model="user.name" />
                            </div>
                            <div class="form-group col-sm-6">
                                <label>{{ $t('Email') }}*</label>
                                <input type="text" class="form-control" name="email" required v-model="user.email" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label>{{ $t('Phone') }}*</label>
                                <input type="text" class="form-control" name="phone" required v-model="user.phone" />
                            </div>
                            <div class="form-group col-sm-6">
                                <label>{{ $t('Pin') }}*</label>
                                <input type="number" name="pin" min="4" class="form-control" required v-model="user.pin" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label>{{ $t('Relation') }}*</label>
                                <input type="text" class="form-control" name="relation" required v-model="user.relation" />
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="pickup_user_photo_uri" class="control-label">{{ $t('Photo') }}*</label>
                                <input type="file" class="form-control" name="photo_uri" id="pickup_user_photo_uri" @change="onFileChange" />
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
            var self = this;
            window.bus.$on('editPickupUser', function(pickup_user) {
                self.user.id = pickup_user.id;
                self.user.name = pickup_user.name;
                self.user.email = pickup_user.email;
                self.user.phone = pickup_user.phone;
                self.user.pin = pickup_user.pin;
                self.user.relation = pickup_user.relation.name;
            });
        },
        data() {
             return {
                 user: this.generateNewPickupUserModel()
             };
        },
        methods: {
            generateNewPickupUserModel: function() {
                return {
                    name: '',
                    email: '',
                    phone: '',
                    pin: Math.floor(Math.random()*(9999-1111+1)+1111),
                    relation: '',
                    photo_uri: null
                }
            },
            onFileChange: function(event) {
                var files = event.target.files || event.dataTransfer.files;
                if (!files.length)
                    return;
                this.user.photo_uri = files[0];
            },
            savePickupUser: function() {
                if (this.user.id) {
                    return this.update();
                } else {
                    return this.store();
                }
            },
            store: function() {
                var formData = new FormData();
                formData.append('name', this.user.name);
                formData.append('email', this.user.email);
                formData.append('phone', this.user.phone);
                formData.append('pin', this.user.pin);
                formData.append('relation', this.user.relation);
                formData.append('photo_uri', this.user.photo_uri);

                this.$http.post('/api/children/' + this.child_id + '/pickup-users', formData)
                        .then(response => {
                            $('#create-edit-pickup-user-modal').modal('hide');
                            window.bus.$emit('pickupUserCreated', response.data.pickup_user);
                            this.user = this.generateNewPickupUserModel();
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
                var formData = new FormData();
                formData.append('name', this.user.name);
                formData.append('email', this.user.email);
                formData.append('phone', this.user.phone);
                formData.append('pin', this.user.pin);
                formData.append('relation', this.user.relation);
                formData.append('photo_uri', this.user.photo_uri);
                formData.append('_method', 'PUT');

                this.$http.post('/api/children/' + this.child_id + '/pickup-users/' + this.user.id, formData)
                    .then(response => {
                        $('#create-edit-pickup-user-modal').modal('hide');
                        window.bus.$emit('pickupUserEdited', response.data.pickup_user);
                        this.user = this.generateNewPickupUserModel();
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
