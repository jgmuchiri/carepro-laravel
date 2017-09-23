<template>
    <div class="card">
        <div class="content">
            <router-link :to="{name: 'groups.index'}">Back to all groups</router-link>
            <p><strong>{{$t('Name')}}: </strong>{{ group.name }}</p>
            <p><strong>{{$t('Description')}}: </strong>{{ group.name }}</p>
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
        props: ['group_id']
    }
</script>
