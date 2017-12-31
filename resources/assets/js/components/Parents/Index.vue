<template>
    <div class="content-wrapper">
        <div class="content-heading">
            <div class="pull-right" v-if="can_create_parents">
                <div class="btn-group">
                    <a class="btn btn-primary waves-effect m-b-5"><i class="fa fa-plus m-r-5 btn-fa"></i> <span> {{ $t('New Parent') }}</span></a>
                </div>
            </div>
            <!-- END Language list-->{{ $t('Parents') }}
        </div>
        <!-- END widgets box-->
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-lg-2">
                        <div class="input-group">
                            <input class="input-sm form-control" type="text" placeholder="Search">
                            <span class="input-group-btn">
                          <button class="btn btn-sm btn-default" type="button">Search</button>
                       </span>
                        </div>
                    </div>
                    <div class="col-lg-8"></div>
                    <div class="col-lg-2">
                        <div class="input-group pull-right">
                            <select class="input-sm form-control">
                                <option value="0">Bulk action</option>
                                <option value="1">Delete</option>
                                <option value="2">Clone</option>
                                <option value="3">Export</option>
                            </select>
                            <span class="input-group-btn">
                          <button class="btn btn-sm btn-default">Apply</button>
                       </span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- START table-responsive-->
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="table-ext-1">
                    <thead>
                        <tr>
                            <th data-check-all>
                                <div class="checkbox c-checkbox" data-toggle="tooltip" data-title="Check All">
                                    <label>
                                        <input type="checkbox">
                                        <span class="fa fa-check"></span>
                                    </label>
                                </div>
                            </th>
                            <th>Picture</th>
                            <th>{{ $t('Name') }}</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="parent in parents">
                            <td>
                                <div class="checkbox c-checkbox">
                                    <label>
                                        <input type="checkbox">
                                        <span class="fa fa-check"></span>
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="media">
                                    <img class="img-responsive img-circle" :src="parent.full_photo_uri" alt="Image">
                                </div>
                            </td>
                            <td>{{ parent.user.name }}</td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        created()
        {
            this.$http.get('/api/parents')
                .then(response => {
                    this.parents = response.data.parents;
                    this.can_create_parents = response.data.can_create_parents
                })
                .catch(error => {
                    alert("Something went wrong. Please try reloading the page");
                });
        },
        data() {
            return {
                parents: [],
                can_create_parents: false
            }
        },
        methods: {
            addParent: function(parent) {
                this.parents.push(parent);
            }
        }
    }
</script>
