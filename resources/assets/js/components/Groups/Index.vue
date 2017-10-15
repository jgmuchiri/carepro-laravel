<template>
    <div class="card">
        <div class="header">
            <button class="btn btn-primary" data-toggle="modal" data-target="#createEditGroup"><i
                    class="fa fa-plus-circle"></i>
                {{$t('Create Group')}}
            </button>
        </div>
        <hr/>
        <div class="content">
            <table class="table table-responsive table-full-width table-striped" id="table">
                <thead>
                    <tr>
                        <th>{{$t('Name')}}</th>
                        <th>{{$t('Description')}}</th>
                        <th>{{$t('# of Children')}}</th>
                        <th>{{$t('# of Staff')}}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="group in groups">
                        <td><router-link :to="{ name: 'groups.show', params: { group_id: group.id }}">{{group.name}}</router-link></td>
                        <td>{{group.short_description}}</td>
                        <td>{{group.staff_count}}</td>
                        <td>{{group.children_count}}</td>
                    </tr>
                </tbody>
            </table>
            <div class="clearfix"></div>
        </div>
        <CreateEditGroupModal v-on:createGroup="addGroup"></CreateEditGroupModal>
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
        },
        data() {
            return {
                groups: []
            }
        },
        methods: {
            addGroup: function(group) {
                this.groups.push(group);
            }
        }
    }
</script>
