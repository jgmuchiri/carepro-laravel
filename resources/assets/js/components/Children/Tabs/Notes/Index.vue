<template>
    <div id="notes-index">
        <div class="content-heading">
            <!-- START Language list-->
            <div class="pull-right">
                <div class="row">
                    <div class="col-md-6">
                        <div class="btn-group">
                            <button v-on:click="switchView('CreateNote')" class="btn btn-success waves-effect m-b-5">
                                <i class="fa fa-plus m-r-5 btn-fa"></i>
                                <span>{{ $t('New Note') }}</span>
                            </button>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="btn-group">
                            <button v-on:click="switchView('CreateIncident')" class="btn btn-danger waves-effect m-b-5"
                                    id="btn-incident">
                                <i class="fa fa-plus m-r-5 btn-fa"></i>
                                <span>{{ $t('Incident report') }}</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <h3 style="margin-top: 0px;">{{ $t('Notes') }}</h3>
        </div>
        <hr>
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="">
                            <input class="input-sm form-control" type="text" :placeholder="$t('Search')" v-on:keyup="getNotes()" v-model="search">
                        </div>
                    </div>
                    <div class="col-lg-5"></div>
                    <div class="col-lg-3">
                        <div class=" pull-right">
                            <select class="input-sm form-control" v-on:change="filterNotes()" v-model="note_type">
                                <option value="">{{ $t('All') }}</option>
                                <option value="1">{{ $t('Incident') }}</option>
                                <option value="2">{{ $t('General') }}</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="media-box-body" style="padding-bottom:5px;" v-for="note in notes">
                    <div class="row">
                        <div class="col-md-11">
                            <h5 :class="'media-box-heading ' + note.type.name.toLowerCase()">
                                {{ formatDate(note.created_at) }} | {{ note.type.name_label }}
                            </h5>
                            <h3 v-on:click="viewNote(note.id)" style="cursor: pointer;margin-top:0px;margin-bottom:0px;"><strong>{{ note.title }}</strong></h3>
                        </div>
                        <div class="col-md-1">
                            <a href="javascript:void(0);" v-on:click.prevent="deleteNote(note.id)"><i class="fa fa-trash-o" style="color: red; font-size: 16pt;"></i></a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <p v-html="note.short_body"></p>
                        </div>
                    </div>
                </div>
                <div v-if="!notes.length" class="text-center">
                    <p>We couldn't find any Notes</p>
                </div>
            </div>
            <div v-if="notes.length && pagination.last_page != 1" class="panel-footer">
                <div class="text-center">
                    <pagination-component  :pagination="pagination"
                          @paginate="getNotes()"
                          :offset="4">
                    </pagination-component>
                </div>
            </div>
        </div>
        <div class="modal fade modal-mo" id="view-general-note" tabindex="-1" role="dialog" aria-labelledby="view-general-note">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" v-on:click="cancel" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">{{ $t('View Note') }}</h4>
                </div>
                <div class="modal-body">
                    <div class="content-heading">
                        <!-- START Language list-->
                        <div class="pull-right">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="btn-group">
                                        <button  class="btn btn-default waves-effect m-b-5" data-toggle="modal" data-target="#emailNote" data-backdrop="false" >
                                            <i class="fa fa-envelope m-r-5"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="btn-group">
                                        <button  class="btn btn-default waves-effect m-b-5">
                                            <i class="fa fa-print m-r-5"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h3 style="margin-top: 0px;" :class="note.note_type.name.toLowerCase()">{{ note.title }} | {{ note.note_type.name }}</h3>
                    </div>
                    <hr>
                    <h4>{{ note.created_at | moment("dddd, MMMM Do YYYY") }} | {{ note.created_at | moment("h:mm:ss A")}} | By {{ note.created_by_user.name }}</h4>
                    <div v-if="note.note_type.id == 1" class="row">
                        <div class="col-md-6">
                            <h4>Location: {{ note.location.name }}</h4>
                        </div>
                        <div class="col-md-6">
                            <h4>Incident Type: {{ note.incident_type.name }}</h4>
                        </div>
                    </div>
                    <h4>Description:</h4>
                    <p v-html="note.body"></p>
                    <div v-if="note.note_type.id == 1">
                        <h4>Actions Taken:</h4>
                        <p v-html="note.action_taken"></p>
                        <h4>Witnesses(include their contact number):</h4>
                        <p v-html="note.witnesses"></p>
                        <h4>Remarks:</h4>
                        <p v-html="note.remarks"></p>
                        <div v-if="note.photos.length" id="app">
                          <h4>Photos:</h4>
                          <img class="image" v-for="(image, i) in note.photos" :src="image.full_photo_uri" @click="index = i">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" v-on:click="cancel" data-dismiss="modal">
                        {{ $t('Close') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- gallery goes here so as not to appear inside modal -->
    <vue-gallery-slideshow :images="photoUrlArray(note.photos, note.photos.length)" :index="index" @close="index = null"></vue-gallery-slideshow>
    <div class="modal fade" id="emailNote" tabindex="-1" role="dialog" aria-labelledby="emailNote">
        <div class="modal-dialog" role="document" style="padding-top:150px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">{{ $t('Email Note') }}</h4>
                </div>

                <form v-on:submit.prevent="emailNote()">
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label>{{ $t('Email Address') }}*</label>
                                <input type="email" class="form-control" name="email" required v-model="email_note.email" />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" v-on:click="clearemailData" class="btn btn-default" data-dismiss="modal">
                            {{ $t('Cancel') }}
                        </button>
                        <button class="btn btn-primary"><i class="fa fa-save btn-fa"></i> {{ $t('Send Email') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
</template>

<script>
    import VueGallerySlideshow from 'vue-gallery-slideshow'
    export default {
        components: {
            VueGallerySlideshow
        },
        created()
        {
            this.getNotes();
            this.notes = [];
            var self = this;
            window.bus.$on('noteCreated', function(note) {
                self.notes.unshift(note);
            });
        },
        data() {
            return {
                index: null,
                notes: [],
                pagination: {},
                note: this.noteData(),
                search: '',
                note_type: '',
                email_note: {
                    note_id: '',
                    email: ''
                }
            }
        },
        methods: {
            getNotes: function () {
                axios.get('/api/children/' + this.child.id + '/notes?page=' + this.pagination.current_page + '&search=' + this.search + '&note_type=' + this.note_type)
                    .then(response => {
                        this.notes = response.data.notes.data;
                        this.pagination = response.data.notes
                    })
                    .catch(error => {
                        alert("Something went wrong. Please try reloading the page");
                    });
            },

            viewNote: function(id) {
                axios.get('/api/children/' + this.child.id + '/notes/' + id)
                .then(response => {
                    this.note.id = response.data[0].id
                    this.note.title = response.data[0].title
                    this.note.body = response.data[0].body
                    this.note.created_at = response.data[0].created_at
                    this.note.created_by_user = response.data[0].created_by_user
                    this.note.note_type.id = response.data[0].type.id
                    this.note.note_type.name = response.data[0].type.name
                    if (this.note.note_type.id == 1) {
                        this.note.witnesses = response.data[0].witnesses
                        this.note.action_taken = response.data[0].action_taken
                        this.note.remarks = response.data[0].remarks
                        this.note.location.name = response.data[0].location.name
                        this.note.photos = response.data[0].photos
                        this.note.incident_type = response.data[0].incident_type
                        this.note.note_type = response.data[0].type
                    }
                })
                .catch(function (error) {
                    this.$noty.error(error.response.data.message)
                });
                $('#view-general-note').modal({
                  backdrop: false
                })
            },

            noteData: function() {
                return {
                    id: '',
                    title: '',
                    body: '',
                    witnesses: '',
                    action_taken: '',
                    remarks: '',
                    created_by_user: {},
                    location: {
                        name: ''
                    },
                    note_type: {
                        id: '2',
                        name: ''
                    },
                    incident_type: {},
                    photos: [],
                    created_at: ''
                }
            },

            emailNote: function() {
                this.email_note.note_id = this.note.id
                axios.post('/api/children/' + this.child.id + '/notes/' + this.email_note.note_id + '/email', this.email_note)
                .then(response => {
                    this.$noty.success(response.data.message)
                    $('#emailNote').modal('hide')
                    this.clearemailData()
                })
                .catch(function (error) {
                    this.$noty.error(error.response.data.message)
                });
            },

            photoUrlArray: function(photos, length) {
                var images = []
                for (var i = 0; i < length; i++) {
                    images.push(photos[i].full_photo_uri_original);
                }
                return images
            },

            switchView: function (view)
            {
                this.$emit('viewSwitched', view);
            },

            deleteNote: function (note_id) {
                let self = this
                this.$swal({

                    title: 'Are you sure?',
                    text: 'You will not be able to recover this Note!',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, keep it'
                })

                .then(function(result) {
                    axios.delete('/api/children/' + self.child.id + '/notes/' + note_id)
                    .then(response => {
                        self.$noty.success(response.data.message);
                        self.getNotes();
                        self.$swal(
                            'Deleted!',
                            response.data.message,
                            'success'
                        );
                    })
                    .catch(function (error) {
                        if (error.response.status == 403) {
                            self.$swal(
                                'Something went Wrong',
                                'This child is inactive and read-only!',
                                'error'
                            );
                        } else {
                            self.$swal(
                                'Something went Wrong',
                                'Note record could not be deleted! :)',
                                'error'
                            );
                        }
                    });

                    }, function(dismiss) {
                        if (dismiss === 'cancel') {
                          self.$swal(
                            'Cancelled',
                            'Your Note is safe :)',
                            'error'
                          );
                        }
                    }
                );
            },

            filterNotes: function() {
                this.pagination.current_page = '1'
                this.getNotes()
            },

            cancel: function() {
                this.note = this.noteData()
            },

            clearemailData: function() {
                this.email_note.id = ''
                this.email_note.email = ''
            }
        },
        props: ['child']
    }
</script>
