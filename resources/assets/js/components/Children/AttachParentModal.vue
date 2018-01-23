<template>
    <div class="modal fade" id="attachParent" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">{{ $t('Select Parent') }}</h4>
                </div>

                <form v-on:submit.prevent="save">
                    <div class="modal-body">
                        <table class="table table-striped" id="table">
                            <thead>
                                <tr>
                                    <td data-orderable="false"></td>
                                    <td>{{ $t('Name') }}</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="parent in parents">
                                    <td style="width:20px;">
                                        <div class="checkbox c-checkbox">
                                            <label>
                                                <input type="checkbox" v-model="selected_parents" :value="parent.id"/>
                                                <span class="fa fa-check"></span>
                                            </label>
                                        </div>
                                    </td>
                                    <td>{{ parent.user.name}}</td>
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
            this.selected_parents = this.child.parents.map(x => x.id);
            this.$http.get('/api/parents')
                .then(response => {
                    this.parents = response.data.parents;
                })
                .catch(error => {
                    alert("Something went wrong. Please try reloading the page");
                });
        },
        data() {
             return {
                 parents: [],
                 selected_parents: []
             };
        },
        methods: {
            save: function() {
                this.$http.post('/api/children/' + this.child.id + '/assign-parents', {
                    parents: this.selected_parents
                })
                    .then(response => {
                        this.$emit('attachParentsToChild', response.data.parents);
                        $('#attachParent').modal('hide');
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
        props: ['child']
    }
</script>
