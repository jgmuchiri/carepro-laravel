<template>
    <div class="card">
        <div class="header">
            <div class="row">
                <div class="col-sm-6">
                    <p>{{$t('Roles')}}</p>
                </div>
            </div>
        </div>
        <hr/>
        <div class="content">
            @can('create', \App\Models\Permissions\Role::class)
            <div class="row">
                <div class="col-md-12">
                    <router-link :to="{name: 'roles.create'}" class="btn btn-primary">{{$t('New Role')}}</router-link>
                </div>
            </div>
            @endcan
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>{{$t('Name')}}</th>
                            <th colspan="2">{{$t('Actions')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-if="!roles.length"><td colspan="2">{{$t('No roles created yet')}}.</td></tr>
                        <tr v-for="role in roles">
                            <td>{{ role.name }}</td>
                            <td>
                                @can('update', $role)<router-link :to="{name: 'roles.edit', params: { role_id: role.id}}">{{$t('Edit')}}</router-link>@endcan
                                @can('delete', $role)
                                <button class="btn btn-danger" @click.prevent="deleteRole(role.id)">{{$t('Delete')}}</button>
                                @endcan
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        created()
        {
            this.$http.get('/api/roles')
                .then(response => {
                    this.roles = response.data.roles;
                })
                .catch(error => {
                    alert("Something went wrong. Please try reloading the page");
                });
        },
        data() {
            return {
                roles: []
            }
        },
        methods: {
            deleteRole: function(id) {
                this.$http.delete('/api/roles/' + id)
                    .then(response => {
                        this.roles = this.roles.filter(role => role.id != id);
                    })
                    .catch(error => {
                        alert("Something went wrong. Please reload the page and try again.");
                    });
            }
        }
    }
</script>
