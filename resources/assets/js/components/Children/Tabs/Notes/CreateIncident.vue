<template>
    <div id="incident-create">
        <div class="content-heading">
            <!-- START Language list-->
            <div class="pull-right">
                <div class="btn-group">
                    <button class="btn btn-success waves-effect m-b-5"
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
            <div class="panel-heading" style="color: #515253;">
                <div class="row">
                    <div class="col-lg-4">
                        <h4>Date: {{ formatDate(this.note.moment_date) }}</h4>
                        <h4>Time: {{ formatTime(this.note.moment_date) }}</h4>
                    </div>
                    <div class="col-lg-8"></div>
                </div>
            </div>
            <div class="panel-body">
                <form v-on:submit.prevent="storeNote">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <input id="title" class="form-control input-lg" :placeholder="$t('Title')" v-model="note.title" type="text">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <input id="location" class="form-control input-lg" :placeholder="$t('Location')" v-model="note.location" type="text">
                        </div>
                        <div class="form-group col-md-6">
                            <input id="description"
                                   class="form-control input-lg"
                                   :placeholder="$t('Incident type(fall/bruise/sickness/etc)')"
                                   v-model="note.incident_type"
                                   type="text">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <textarea v-model="note.body" rows="3" class="form-control input-lg" :placeholder="$t('Description')"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <textarea v-model="note.action_taken" rows="3" class="form-control input-lg" :placeholder="$t('Actions Taken')"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <textarea v-model="note.witnesses" rows="3" class="form-control input-lg" :placeholder="$t('Witnesses(include their contact number)')"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <textarea v-model="note.remarks" rows="3" class="form-control input-lg" :placeholder="$t('Remarks')"></textarea>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input style="display:none;" id="upload" name="photo" type="file" multiple @change="onFileChange"/>
                                    <div class="panel widget child-upload">
                                        <div class="panel-body text-center">
                                            <div class="child-btn-fa">
                                                <a id="upload_link"><i class="fa fa-upload"></i></a>
                                            </div>
                                            <p><span>{{ $t('Upload Incident Images') }}</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row text-center">
                                <div class="col-md-6">
                                    <button class="btn btn-danger waves-effect m-b-5" v-on:click.prevent="switchView('NoteIndex')">
                                        <span>{{ $t('Cancel') }}</span>
                                    </button>
                                </div>
                                <div class="col-md-6">
                                    <button class="btn btn-success waves-effect m-b-5"><span>{{ $t('Save') }}</span></button>
                                </div>
                            </div>
                        </div>
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
                note: this.generateNewIncidentNote()
            }
        },
        methods: {
            generateNewIncidentNote: function () {
                return {
                    title: '',
                    body: '',
                    witnesses: '',
                    action_taken: '',
                    remarks: '',
                    location: '',
                    note_type: 'Incident',
                    incident_type: '',
                    photo_uris: [],
                    moment_date: window.moment()
                }
            },
            onFileChange: function(event) {
                for(var key in event.target.files){
                    this.photo_uris = event.target.files[key];
                }
            },
            storeNote: function() {
                var formData = new FormData();
                formData.append('title', this.note.title);
                formData.append('body', this.note.body);
                formData.append('witnesses', this.note.witnesses);
                formData.append('action_taken', this.note.action_taken);
                formData.append('remarks', this.note.remarks);
                formData.append('location', this.note.location);
                formData.append('note_type', this.note.note_type);
                formData.append('incident_type', this.note.incident_type);
                formData.append('child_id', this.child_id);
                formData.append('photo_uris', this.note.photo_uris);
                formData.append('created_at', window.moment(this.note.moment_date))

                this.$http.post('/api/children/' + this.child.id + '/notes', formData).then(response => {
                    this.$emit('noteCreated', response.data.note);
                    window.bus.$emit('noteCreated', response.data.note);
                    this.note = this.generateNewIncidentNote();
                    this.$noty.success(response.data.message);
                    this.switchView('NoteIndex');
                })
                .catch(error => {
                    if (error.response.status == 403) {
                        this.$noty.error(this.$t('This child is inactive and read-only.'));
                    } else if (error.response.status == 422) {
                        for (var key in error.response.data) {
                            this.$noty.error(error.response.data[key]);
                        }
                    } else {
                        alert("Something went wrong. Please reload the page and try again.");
                    }
                });
            },
            switchView: function (view)
            {
                this.generateNewIncidentNote();
                this.$emit('viewSwitched', view);
            }
        },
        props: ['child']
    }
</script>
