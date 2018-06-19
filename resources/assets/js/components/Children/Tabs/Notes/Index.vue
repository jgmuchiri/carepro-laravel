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
                            <select class="input-sm form-control" v-on:change="getNotes()" v-model="note_type">
                                <option value="">{{ $t('All') }}</option>
                                <option value="1">{{ $t('Incident') }}</option>
                                <option value="2">{{ $t('General') }}</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="media-box-body" v-for="note in notes">
                    <div class="row">
                        <div class="col-md-11">
                            <h4 :class="'media-box-heading ' + note.type.name.toLowerCase()">
                                {{ formatDate(note.created_at) }} | {{ note.type.name_label }}
                            </h4>
                            <h3 v-on:click="expandNote(note)" style="cursor: pointer;"><strong>{{ note.title }}</strong> <i class="fa" v-bind:class="[note.is_expanded ? 'fa-chevron-down' : 'fa-chevron-up']" style="font-size:20px;padding-left: 5px;"></i></h3>
                        </div>
                        <div class="col-md-1">
                            <a href="javascript:void(0);" v-on:click.prevent="deleteNote(note.id)"><i class="fa fa-trash-o" style="color: red; font-size: 16pt;"></i></a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <p v-if="note.is_expanded" v-html="note.body"></p>
                            <p v-else v-html="note.short_body"></p>
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
    </div>
</template>

<script>
    export default {
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
                notes: [],
                pagination: {},
                search: '',
                note_type: ''
            }
        },
        methods: {
            getNotes: function () {
                this.$http.get('/api/children/' + this.child.id + '/notes?page=' + this.pagination.current_page + '&search=' + this.search + '&note_type=' + this.note_type)
                    .then(response => {
                        this.notes = response.data.notes.data.map(x => {x.is_expanded = false; return x;});
                        this.pagination = response.data.notes
                    })
                    .catch(error => {
                        alert("Something went wrong. Please try reloading the page");
                    });
            },

            expandNote: function (note)
            {
                note.is_expanded = !note.is_expanded ;
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
            }
        },
        props: ['child']
    }
</script>
