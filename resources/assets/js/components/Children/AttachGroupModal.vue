<template>
    <div class="modal fade" id="attachGroup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">{{ $t('Assign Groups') }}</h4>
                </div>

                <form v-on:submit.prevent="save">
                    <div class="modal-body">
                        <table class="table table-striped" id="table">
                            <thead>
                                <tr>
                                    <td data-orderable="false"></td>
                                    <td>{{ $t('Name') }}</td>
                                    <td>{{ $t('Description') }}</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="group in groups">
                                    <td style="width:20px;">
                                        <div class="checkbox c-checkbox">
                                            <label>
                                                <input type="checkbox" v-model="selected_groups" :value="group.id"/>
                                                <span class="fa fa-check"></span>
                                            </label>
                                        </div>
                                    </td>
                                    <td>{{ group.name }}</td>
                                    <td>{{ group.short_description }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">{{ $t('Close') }}</button>
                        <input type="submit" class="btn btn-primary" :value="$t('Assign')"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        created() {
            this.selected_groups = this.child.groups.map(x => x.id);
            this.$http.get('/api/groups')
                .then(response => {
                    this.groups = response.data.groups;
                })
                .catch(error => {
                    alert("Something went wrong. Please try reloading the page");
                });
        },
        data() {
             return {
                 groups: [],
                 selected_groups: []
             };
        },
        methods: {
            save: function() {
                this.$http.post('/api/children/' + this.child.id + '/assign-groups', {
                    groups: this.selected_groups
                })
                    .then(response => {
                        this.$emit('attachGroupsToChild', response.data.groups);
                        $('#attachGroup').modal('hide');
                        this.$noty.success(response.data.message);
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
            }
        },
        props: ['child']
    }
</script>
