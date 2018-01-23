<template>
    <div>
        <div id="notes-index">
        <div class="content-heading">
            <!-- START Language list-->
            <div class="pull-right">
                <div class="row">
                    <div class="col-md-6">
                        <div class="btn-group">
                            <button class="btn btn-success waves-effect m-b-5">
                                <i class="fa fa-plus m-r-5 btn-fa"></i>
                                <span>{{ $t('New Note') }}</span>
                            </button>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="btn-group">
                            <button class="btn btn-danger waves-effect m-b-5"
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
                        <div class="input-group">
                            <input class="input-sm form-control" type="text" :placeholder="$t('Search')">
                            <span class="input-group-btn">
                                    <button class="btn btn-sm btn-default" type="button">{{ $t('Search') }}</button>
                                </span>
                        </div>
                    </div>
                    <div class="col-lg-8"></div>
                </div>
            </div>
            <div class="panel-body">
                <div class="media-box-body">
                    <h4 class="media-box-heading general">10 October 2017 | General</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus suscipit eros elit, eget molestie turpis ultricies et. Nullam non ornare ligula, a venenatis urna. Vestibulum sodales egestas massa, quis laoreet arcu. Integer euismod enim sit amet metus iaculis tincidunt. Suspendisse sit amet mi velit. Integer eu commodo nunc. Integer vitae tortor nisl. Ut porttitor arcu a mauris auctor, in consectetur dolor hendrerit.Cras massa diam, vehicula at ipsum eget, lobortis malesuada mauris. In hac habitasse platea dictumst. Aenean consectetur posuere consequat. Curabitur in purus sed ex blandit tincidunt at nec eros. Curabitur ligula sapien, convallis eu elementum quis, auctor ac urna. Aliquam commodo fermentum tristique. Quisque placerat ornare sodales. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer sodales viverra tellus, sollicitudin pharetra purus efficitur eu. Etiam ullamcorper quam nec ante tempus sagittis. Nullam hendrerit fermentum massa. Aenean sed ultrices purus. In porttitor vulputate eros sit amet ornare.</p>
                </div>
                <div class="media-box-body">
                    <h4 class="media-box-heading incident">9 October 2017 | Incedent</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus suscipit eros elit, eget molestie turpis ultricies et. Nullam non ornare ligula, a venenatis urna. Vestibulum sodales egestas massa, quis laoreet arcu. Integer euismod enim sit amet metus iaculis tincidunt. Suspendisse sit amet mi velit. Integer eu commodo nunc. Integer vitae tortor nisl. Ut porttitor arcu a mauris auctor, in consectetur dolor hendrerit.Cras massa diam, vehicula at ipsum eget, lobortis malesuada mauris. In hac habitasse platea dictumst. Aenean consectetur posuere consequat. Curabitur in purus sed ex blandit tincidunt at nec eros. Curabitur ligula sapien, convallis eu elementum quis, auctor ac urna. Aliquam commodo fermentum tristique. Quisque placerat ornare sodales. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer sodales viverra tellus, sollicitudin pharetra purus efficitur eu. Etiam ullamcorper quam nec ante tempus sagittis. Nullam hendrerit fermentum massa. Aenean sed ultrices purus. In porttitor vulputate eros sit amet ornare.</p>
                </div>
            </div>
        </div>
    </div>
        <div style="display: none;" id="incident-create">
            <div class="content-heading">
                <!-- START Language list-->
                <div class="pull-right">
                    <div class="btn-group">
                        <button class="btn btn-success waves-effect m-b-5"
                                id="incident-back-btn">
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
                            <h4>Date: 10 October 2017</h4>
                            <h4>Time: 02:00 PM</h4>
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
                                        <input style="display:none;" id="upload" name="photo" type="file" @change="onFileChange"/>
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
                                        <button class="btn btn-danger waves-effect m-b-5"><span>{{ $t('Cancel') }}</span></button>
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
    </div>
</template>

<script>
    export default {
        mounted()
        {
            $('#btn-incident').on('click', function() {
                $('#notes-index').hide();
                $('#incident-create').show();
            });
            $('#incident-back-btn').on('click', function() {
                $('#incident-create').hide();
                $('#notes-index').show();
            });
        },
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
                     note_type_id: '',
                     incident_type: '',
                     photo_uri: ''
                 }
             },
            onFileChange: function(event) {
                var files = event.target.files || event.dataTransfer.files;
                if (!files.length)
                    return;
                this.note.photo_uri = files[0];
            },
            storeNote: function() {
                var formData = new FormData();
                formData.append('title', this.note.title);
                formData.append('body', this.note.body);
                formData.append('witnesses', this.note.witnesses);
                formData.append('action_taken', this.note.action_taken);
                formData.append('remarks', this.note.remarks);
                formData.append('location', this.note.location);
                formData.append('note_type_id', this.note_type_id);
                formData.append('incident_type', this.note.incident_type);

                this.$http.post('/api/notes', formData).then(response => {
                    this.$emit('noteCreated', response.data.note);
                    $('#incident-create').hide();
                    $('#notes-index').show();
                    this.note = this.generateNewIncidentNote();
                    this.$noty.success(response.data.message);
                })
                .catch(error => {
                    if (error.response.status == 422) {
                        for (var key in error.response.data) {
                            this.$noty.error(error.response.data[key]);
                        }
                    } else {
                        alert("Something went wrong. Please reload the page and try again.");
                    }
                });
            }
        }
    }
</script>
