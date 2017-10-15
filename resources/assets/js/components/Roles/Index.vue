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
            <div class="row" v-show="can_create_role">
                <div class="col-md-12">
                    <router-link :to="{name: 'roles.create'}" class="btn btn-primary">{{$t('New Role')}}</router-link>
                </div>
            </div>
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
                                <router-link :to="{name: 'roles.edit', params: { role_id: role.id}}" :v-if="role.can_update">{{$t('Edit')}}</router-link>
                                <button class="btn btn-danger" @click.prevent="deleteRole(role.id)">{{$t('Delete')}}</button>
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
                    this.can_create_role = response.data.can_create_role;
                })
                .catch(error => {
                    alert("Something went wrong. Please try reloading the page");
                });
        },
        data() {
            return {
                can_create_role: false,
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
