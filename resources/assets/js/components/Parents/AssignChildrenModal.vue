<template>
    <div class="modal fade" id="attachChildren" tabindex="-1" role="dialog" aria-labelledby="attach-children">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">{{ $t('Select Child') }}</h4>
                </div>

                <form v-on:submit.prevent="storeChildren">
                    <div class="modal-body">
                        <table class="table table-striped" id="table">
                            <thead>
                                <tr>
                                    <td data-orderable="false"></td>
                                    <td>{{ $t('Name') }}</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="child in children">
                                    <td style="width:20px;">
                                        <input type="checkbox" v-model="selected_children" :value="child.id">
                                    </td>
                                    <td><a href="#">{{ child.name }}</a></td>
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
            this.$http.get('/api/children')
                .then(response => {
                    this.children = response.data.children;
                })
                .catch(error => {
                    alert("Something went wrong. Please try reloading the page");
                });
            this.selected_children = this.initial_selected_children.map(x => x.id);
        },
        data() {
            return {
                children: [],
                selected_children: []
            };
        },
        methods: {
            storeChildren: function() {
                this.$http.post('/api/parents/' + this.parent_id + '/assign-children', {
                    children: this.selected_children
                })
                    .then(response => {
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
        props: ['parent_id', 'initial_selected_children']
    }
</script>
