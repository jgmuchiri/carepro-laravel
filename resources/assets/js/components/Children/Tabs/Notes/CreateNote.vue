<template>
    <div id="note-create">
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
            <h3 style="margin-top: 0px;">{{ $t('New General Note') }}</h3>
        </div>
        <hr>
        <div class="panel panel-default">
            <div class="panel-heading" style="color: #515253;">
                <div class="row">
                    <div class="col-lg-4">
                        <h4>Date: {{ formatDate(this.note.moment_date) }}</h4>
                    </div>
                    <div class="col-lg-4">
                        <h4>Time: {{ formatTime(this.note.moment_date) }}</h4>
                    </div>
                    <div class="col-lg-4"></div>
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
                        <div class="col-md-12">
                            <div class="form-group">
                                <wysiwyg v-model="note.body"></wysiwyg>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <button class="btn btn-danger waves-effect m-b-5" v-on:click.prevent="switchView('NoteIndex')">
                                <span>{{ $t('Cancel') }}</span>
                            </button>
                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-success waves-effect m-b-5 pull-right"><span>{{ $t('Save') }}</span></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    import "vue-wysiwyg/dist/vueWysiwyg.css";
    export default {
        data() {
            return {
                note: this.generateNewNote()
            }
        },
        methods: {
            generateNewNote: function () {
                return {
                    title: '',
                    body: '',
                    note_type: 'General',
                    moment_date: moment()
                }
            },
            storeNote: function() {
                var formData = new FormData();
                formData.append('title', this.note.title);
                formData.append('body', this.note.body);
                formData.append('note_type', this.note.note_type);
                formData.append('child_id', this.child_id);
                formData.append('created_at', window.moment(this.note.moment_date))

                this.$http.post('/api/children/' + this.child.id + '/notes', formData).then(response => {
                    this.$emit('noteCreated', response.data.note);
                    window.bus.$emit('noteCreated', response.data.note);
                    this.note = this.generateNewNote();
                    this.$noty.success(response.data.message);
                    this.switchView('NoteIndex');
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
            },
            switchView: function (view)
            {
                this.generateNewNote();
                this.$emit('viewSwitched', view);
            }
        },
        props: ['child']
    }
</script>
