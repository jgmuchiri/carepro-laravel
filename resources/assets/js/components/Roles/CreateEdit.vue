<template>
    <div class="card">
        <div class="header">
            <div class="row">
                <div class="col-sm-6">
                    <p>{{ this.role.id ? $t('Edit') : $t('Create')}} {{$t('Role')}}</p>
                </div>
            </div>
        </div>
        <hr/>
        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <router-link :to="{name: 'roles.index'}">{{$t('Back to all roles')}}</router-link>
                    <form v-on:submit.prevent="saveRole">
                        <label>{{$t('Name')}}</label>
                        <input type="text" v-model="role.name" />
                        <br />
                        <div v-for="permission in permissions" class="form-group">
                            <label :for="'permissions-' + permission.id">{{ permission.name_label }}</label>
                            <input type="checkbox" v-model="role.permissions" :value="permission.id" :id="'permissions-' + permission.id" />
                        </div>
                        <input type="submit" :value="$t('Save')" class="btn btn-primary">
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        created()
        {
            if (this.role_id) {
                this.loadRole();
            } else {
                this.$http.get('/api/roles/create')
                    .then(response => {
                        this.permissions = response.data.permissions;
                    })
                    .catch(error => {
                        alert("Something went wrong. Please try reloading the page");
                    });
            }
        },
        data() {
            return {
                permissions: [],
                role: this.generateNewRoleModel()
            }
        },
        methods: {
            generateNewRoleModel: function() {
                return {
                    name: '',
                    permissions: []
                }
            },
            saveRole: function() {
                if (this.role.id) {
                     return this.updateRole();
                } else {
                    return this.storeRole();
                }
            },
            storeRole: function() {
                this.$http.post('/api/roles', this.role)
                    .then(response => {
                        this.notifySuccess(response.data.message);
                        this.$router.push({name: 'roles.edit', params: {role_id: response.data.role.id}});
                    })
                    .catch(error => {
                        if (error.response.status == 422) {
                            for (var key in error.response.data) {
                                this.notifyError(error.response.data[key]);
                            }
                        } else {
                            alert("Something went wrong. Please reload the page and try again.");
                        }
                    });
            },
            updateRole: function() {
                this.$http.put('/api/roles/' + this.role.id, this.role)
                    .then(response => {
                        this.notifySuccess(response.data.message);
                        this.role = response.data.role;
                        this.role.permissions = response.data.role.permissions.map(x => x.id);
                    })
                    .catch(error => {
                        if (error.response.status == 422) {
                            for (var key in error.respCSSSize.data) {
                                this.notifyError(error.response.data[key]);
                            }
                        } else {
                            alert("Something went wrong. Please reload the page and try again.");
                        }
                    })
            },
            loadRole: function() {
                this.$http.get('/api/roles/' + this.role_id + '/edit')
                    .then(response => {
                        this.role = response.data.role;
                        this.role.permissions = response.data.role.permissions.map(x => x.id);
                        this.permissions = response.data.permissions;
                    })
                    .catch(error => {
                        alert("Something went wrong. Please try reloading the page");
                    });
            }
        },
        props: ['role_id'],
        watch: {
            '$route' (to, from) {
                if (to.name == 'roles.edit') {
                    this.loadRole();
                }
            }
        }
    }
</script>
