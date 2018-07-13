<template>
    <div id="incident-create">
        <div class="content-heading">
            <!-- START Language list-->
            <div class="pull-right">
                <div class="btn-group">
                    <button class="btn btn-success waves-effect m-b-5" v-bind:class="{ disabled: loading }"
                            id="incident-back-btn"
                            v-on:click="switchView('NoteIndex')">
                        <i class="fa fa-chevron-left m-r-5 btn-fa"></i>
                        <span>{{ $t('Back') }}</span>
                    </button>
                </div>
            </div>
            <h3 style="margin-top: 0px;">{{ $t('New Incident Report') }}</h3>
        </div>
        <hr>
        <div class="panel panel-default">
            <div class="panel-body">
                <form v-on:submit.prevent="storeNote">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <input id="title" class="form-control input-lg" :placeholder="$t('Title')"
                                   v-model="note.title" type="text" v-bind:class="{ 'parsley-error': errors.title }">
                            <ul v-if="errors.title" class="parsley-errors-list filled">
                                <li class="parsley-required">{{errors.title[0]}}</li>
                            </ul>
                        </div>
                        <div class="form-group col-md-6">
                            <datetime type="datetime" v-model="note.incident_time" placeholder="incident time"
                                      input-class="form-control input-lg"></datetime>
                            <ul v-if="errors.incident_time" class="parsley-errors-list filled">
                                <li class="parsley-required">{{errors.incident_time[0]}}</li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <input class="form-control input-lg" :placeholder="$t('Location')" v-model="note.location"
                                   type="text" v-bind:class="{ 'parsley-error': errors.location }">
                            <ul v-if="errors.location" class="parsley-errors-list filled">
                                <li class="parsley-required">{{errors.location[0]}}</li>
                            </ul>
                        </div>
                        <div class="form-group col-md-6">
                            <input class="form-control input-lg"
                                   :placeholder="$t('Incident type(fall/bruise/sickness/etc)')"
                                   v-model="note.incident_type" type="text"
                                   v-bind:class="{ 'parsley-error': errors.incident_type }">
                            <ul v-if="errors.incident_type" class="parsley-errors-list filled">
                                <li class="parsley-required">{{errors.incident_type[0]}}</li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <textarea v-model="note.body" style="overflow-x: hidden;" rows="3"
                                          class="form-control input-lg" :placeholder="$t('Description')"
                                          v-bind:class="{ 'parsley-error': errors.body }"></textarea>
                                <ul v-if="errors.body" class="parsley-errors-list filled">
                                    <li class="parsley-required">{{errors.body[0]}}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <textarea v-model="note.action_taken" style="overflow-x: hidden;" rows="3"
                                          class="form-control input-lg" :placeholder="$t('Actions Taken')"
                                          v-bind:class="{ 'parsley-error': errors.action_taken }"></textarea>
                                <ul v-if="errors.action_taken" class="parsley-errors-list filled">
                                    <li class="parsley-required">{{errors.action_taken[0]}}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <textarea v-model="note.witnesses" rows="3" class="form-control input-lg"
                                          :placeholder="$t('Witnesses(include their contact number)')"
                                          v-bind:class="{ 'parsley-error': errors.witnesses }"></textarea>
                                <ul v-if="errors.witnesses" class="parsley-errors-list filled">
                                    <li class="parsley-required">{{errors.witnesses[0]}}</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <textarea v-model="note.remarks" rows="3" class="form-control input-lg"
                                          :placeholder="$t('Remarks')"
                                          v-bind:class="{ 'parsley-error': errors.remarks }"></textarea>
                                <ul v-if="errors.remarks" class="parsley-errors-list filled">
                                    <li class="parsley-required">{{errors.remarks[0]}}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <vue-dropzone ref="imagedropzone" id="dropzone" :options="dropzoneOptions"
                                          @vdropzone-success="uploadSuccess"></vue-dropzone>
                        </div>
                    </div>
                    <div class="row text-center" style="padding-top:15px;">
                        <div class="col-md-6">
                            <button class="btn btn-danger waves-effect m-b-5" v-bind:class="{ disabled: loading }"
                                    v-on:click.prevent="switchView('NoteIndex')">
                                <span>{{ $t('Cancel') }}</span>
                            </button>
                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-success waves-effect m-b-5" v-bind:class="{ disabled: loading }"><span>{{ $t('Save') }}</span></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    import vue2Dropzone from 'vue2-dropzone'

    export default {
        components: {
            vueDropzone: vue2Dropzone
        },

        data() {
            return {
                note: this.generateNewIncidentNote(),
                errors: [],
                loading: false,
                dropzoneOptions: {
                    url: this.url,
                    thumbnailWidth: 150,
                    autoProcessQueue: false,
                    uploadMultiple: true,
                    paramName: 'photo_uris',
                    parallelUploads: 15,
                    maxFilesize: 2.0,
                    headers: {"X-CSRF-TOKEN": window.Laravel.csrfToken}
                }
            }
        },

        created() {
            this.note.incident_time = moment().format();
        },

        methods: {
            generateNewIncidentNote: function () {
                return {
                    id: '',
                    title: '',
                    body: '',
                    witnesses: '',
                    action_taken: '',
                    remarks: '',
                    location: '',
                    note_type: 'Incident',
                    incident_type: '',
                    incident_time: ''
                }
            },

            storeNote: function () {
                this.loading = true
                axios.post('/api/children/' + this.child.id + '/notes', this.note)
                    .then(response => {
                        this.note.id = response.data.note.id
                        this.$emit('noteCreated', response.data.note);
                        window.bus.$emit('noteCreated', response.data.note);
                        this.$noty.success(response.data.message);
                        this.$noty.warning("Hey!Incident Images are still Uploading, please do not move away from this page!!", {
                            timeout: false,
                            layout: 'topRight'
                        })
                        this.$refs.imagedropzone.processQueue()
                    })
                    .catch(error => {
                        this.loading = false
                        if (error.response.status == 403) {
                            this.$noty.error(this.$t('This child is inactive and read-only.'));
                        } else {
                            this.errors = error.response.data.errors
                            this.$noty.error('You have some errors in your inputs!')
                        }
                    });
            },

            uploadSuccess(file, response) {
                this.loading = false
                this.$noty.success('Incident Images have been uploaded succesfully!')
                this.note = this.generateNewIncidentNote()
                this.switchView('NoteIndex')
            },

            url: function () {
                return '/api/children/' + this.child.id + '/notes/' + this.note.id + '/photos'
            },

            switchView: function (view) {
                this.generateNewIncidentNote();
                this.$emit('viewSwitched', view);
            }
        },
        props: ['child']
    }
</script>
