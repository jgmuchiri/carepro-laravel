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
                    <h4 :class="'media-box-heading ' + note.type.name.toLowerCase()">
                        {{ formatDate(note.created_at) }} | {{ note.type.name_label }}
                    </h4>
                    <h3><strong>{{ note.title }}</strong></h3>
                    <p>{{ note.short_body }}</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        created()
        {
            this.$http.get('/api/children/' + this.child.id + '/notes')
                .then(response => { this.notes = response.data.notes; })
                .catch(error => {
                    alert("Something went wrong. Please try reloading the page");
                });
            this.notes = [];
            var self = this;
            window.bus.$on('noteCreated', function(note) {
                self.notes.unshift(note);
            });
        },
        data() {
            return {
                notes: []
            }
        },
        methods: {
            switchView: function (view)
            {
                this.$emit('viewSwitched', view);
            }
        },
        props: ['child']
    }
</script>
