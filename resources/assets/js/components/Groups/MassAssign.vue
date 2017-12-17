<template>
    <div>
        <div class="row">
            <div class="form-group col-sm-6">
                <label>{{$t('All Staff')}}</label>
                <label>{{$t('Search')}}</label>
                <input type="text" class="form-control" placeholder="Search" v-model="staff_search"/>
                <draggable class="drag2" @end="assigneesUpdated" v-model="staff_members" :options="{group:'staff'}" >
                    <div v-for="staff_member in filtered_staff_members">{{staff_member.user.name}}</div>
                </draggable>
            </div>

            <div class="col-sm-6">
                <label>{{$t('Assigned Staff')}}</label>
                <draggable class="drag" @end="assigneesUpdated" v-model="assigned_staff_members" :options="{group:'staff'}">
                    <div v-for="staff_member in assigned_staff_members">{{staff_member.user.name}}</div>
                </draggable>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-6">
                <label>{{$t('All Children')}}</label>
                <label>{{$t('Search')}}</label>
                <input type="text" class="form-control" placeholder="Search" v-model="child_search"/>
                <draggable class="drag2" @end="assigneesUpdated" v-model="children" :options="{group:'children'}">
                    <div v-for="child in filtered_children">{{child.name}}</div>
                </draggable>
            </div>

            <div class="form-group col-sm-6">
                <label>{{$t('Assigned Children')}}</label>
                <draggable class="drag" @end="assigneesUpdated" v-model="assigned_children" :options="{group:'children'}" >
                    <div v-for="child in assigned_children">{{child.name}}</div>
                </draggable>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        created()
        {
            this.$http.get('/api/groups/create')
                .then(response => {
                    this.staff_members = response.data.staff;
                    this.children = response.data.children;
                    this.staff_members = this.staff_members.filter(staff_member => {
                        return !this.existing_assigned_staff_members.some(x => x.id == staff_member.id);
                    });
                    this.children = this.children.filter(child => {
                        return !this.existing_assigned_children.some(x => x.id == child.id);
                    });
                })
                .catch(error => {
                    alert("Something went wrong. Please try reloading the page");
                });
        },
        computed: {
            filtered_staff_members: function() {
                return this.staff_members.filter(staff_member => {
                    return staff_member.user.name.toLowerCase().indexOf(this.staff_search.toLowerCase()) >= 0;
                });
            },
            filtered_children: function() {
                return this.children.filter(child => {
                    return child.name.toLowerCase().indexOf(this.child_search.toLowerCase()) >= 0;
                });
            }
        },
        data() {
            return {
                staff_members: [],
                children: [],
                assigned_staff_members: [],
                assigned_children: [],
                staff_search: '',
                child_search: ''
            }
        },
        methods: {
            assigneesUpdated: function() {
                this.$emit('assigneesUpdated', this.assigned_children, this.assigned_staff_members);
            }
        },
        props: ['existing_assigned_staff_members', 'existing_assigned_children'],
        watch: {
            existing_assigned_staff_members: function (staff_members) {
                this.assigned_staff_members = staff_members;
                this.staff_members = this.staff_members.filter(staff_member => {
                    return !this.assigned_staff_members.some(x => x.id == staff_member.id);
                });
            },
            existing_assigned_children: function (children) {
                this.assigned_children = children;
                this.children = this.children.filter(child => {
                    return !this.assigned_children.some(x => x.id == child.id);
                });
            }
        },
    }
</script>
