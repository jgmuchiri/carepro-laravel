<template>
    <div class="card">
        <div class="header">
            <button class="btn btn-primary" data-toggle="modal" data-target="#createEditGroup"><i
                    class="fa fa-pencil"></i>
                {{$t('Edit')}}
            </button>
        </div>
        <div class="content">
            <router-link :to="{name: 'groups.index'}">Back to all groups</router-link>
            <p><strong>{{$t('Name')}}: </strong>{{ group.name }}</p>
            <p><strong>{{$t('Description')}}: </strong>{{ group.short_description }}</p>
            <h3>{{$t('Staff')}}</h3>
            <table class="table table-responsive table-full-width table-striped" id="table">
                <thead>
                <tr>
                    <th>{{$t('Name')}}</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="staff_member in group.staff">
                    <td>{{ staff_member.user.name }}</td>
                </tr>
                </tbody>
            </table>

            <div class="clearfix"></div>
            <h3>{{$t('Children')}}</h3>
            <table class="table table-responsive table-full-width table-striped" id="table2">
                <thead>
                <tr>
                    <th>{{$t('Name')}}</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="child in group.children">
                    <td>{{ child.name }}</td>
                </tr>
                </tbody>
            </table>
            <div class="clearfix"></div>
        </div>
        <CreateEditGroupModal v-on:editGroup="groupEdited" :edit_group="group"></CreateEditGroupModal>
    </div>
</template>

<script>
    export default {
        created()
        {
            this.$http.get('/api/groups/' + this.group_id)
                .then(response => {
                    this.group = response.data.group;
                })
                .catch(error => {
                    alert("Something went wrong. Please try reloading the page");
                });
        },
        data() {
            return {
                group: {}
            }
        },
        methods: {
            groupEdited: function(group) {
                this.group = group;
            }
        },
        props: ['group_id']
    }
</script>
