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
                <div class="media-box-body" v-for="note in notes">
                    <div class="row">
                        <div class="col-md-11">
                            <h4 :class="'media-box-heading ' + note.type.name.toLowerCase()">
                                {{ formatDate(note.created_at) }} | {{ note.type.name_label }}
                            </h4>
                            <h3 v-on:click="expandNote(note)" style="cursor: pointer;"><strong>{{ note.title }}</strong></h3>
                        </div>
                        <div class="col-md-1">
                            <a v-on:click.prevent="deleteNote(note.id)"><i class="fa fa-trash-o" style="color: red; font-size: 16pt;"></i></a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <p v-if="note.is_expanded" v-html="note.body"></p>
                            <p v-else v-html="note.short_body"></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <div class="pagination">
                    <button class="btn btn-default" @click="loadNotes(pagination.prev_page_url)"
                        :disabled="!pagination.prev_page_url">
                        Previous
                    </button>
                    <span>Page {{pagination.current_page}} of {{pagination.last_page}}</span>
                    <button class="btn btn-default" @click="loadNotes(pagination.next_page_url)"
                        :disabled="!pagination.next_page_url">Next
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        created()
        {
            this.loadNotes('/api/children/' + this.child.id + '/notes');
            this.notes = [];
            var self = this;
            window.bus.$on('noteCreated', function(note) {
                self.notes.unshift(note);
            });
        },
        data() {
            return {
                notes: [],
                pagination: {}
            }
        },
        methods: {
            expandNote: function (note)
            {
                note.is_expanded = true;
            },
            switchView: function (view)
            {
                this.$emit('viewSwitched', view);
            },
            deleteNote: function (note_id)
            {
                this.$http.delete('/api/children/' + this.child.id + '/notes/' + note_id)
                    .then(response => {
                        this.$noty.success(response.data.message);
                        this.notes = this.notes.filter(x => x.id != note_id);
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
            makePagination: function(data) {
                let pagination = {
                    current_page: data.current_page,
                    last_page: data.last_page,
                    next_page_url: data.next_page_url,
                    prev_page_url: data.prev_page_url
                }
                this.pagination = pagination;
            },
            loadNotes: function (url) {
                this.$http.get(url)
                    .then(response => {
                        this.notes = response.data.notes.data.map(x => {x.is_expanded = false; return x;});
                        this.makePagination(response.data.notes);
                    })
                    .catch(error => {
                        alert("Something went wrong. Please try reloading the page");
                    });
            }
        },
        props: ['child']
    }
</script>
