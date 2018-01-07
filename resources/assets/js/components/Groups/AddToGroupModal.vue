<template>
    <div class="modal fade" id="addToGroup" tabindex="-1" role="dialog" aria-labelledby="add-to-group">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="create-group">{{ $t('Add to group')}}</h4>
                </div>
                <form v-on:submit.prevent="save">
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>{{ $t('Name') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="group in groups">
                                        <td><input type="checkbox" :value="group.id" v-model="group_ids"></td>
                                        <td>{{ group.name }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> {{$t('Cancel')}}
                        </button>
                        <button class="btn btn-primary"><i class="fa fa-save"></i> {{$t('Save Changes')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        created()
        {
            this.$http.get('/api/groups')
                .then(response => {
                    this.groups = response.data.groups;
                })
                .catch(error => {
                    alert("Something went wrong. Please try reloading the page");
                });
            this.group_ids = this.initial_groups.map(x => x.id)
        },
        data() {
            return {
                groups: [],
                group_ids: []
            }
        },
        methods: {
            save: function() {
                this.$http.put('/api/staff/' + this.staff_id + '/add-to-group', {
                    group_ids: this.group_ids,
                    staff_id: this.staff_id
                })
                    .then(response => {
                        this.$emit('staffAddedToGroup', response.data.groups);
                        $('#addToGroup').modal('hide');
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
        },
        props: ['staff_id', 'initial_groups']
    }
</script>
