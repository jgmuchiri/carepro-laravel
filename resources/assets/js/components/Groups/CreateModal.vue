<template>
    <div class="modal fade" id="createGroup" tabindex="-1" role="dialog" aria-labelledby="create-group">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="create-group">{{$t('New Group')}}</h4>
                </div>
                <form v-on:submit.prevent="storeGroup">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <label>{{$t('Name')}}</label>
                                <input type="text" name="name" required v-model="group.name"/>
                            </div>
                            <div class="col-sm-6">
                                <label>{{$t('Description')}}</label>
                                <textarea name="description" rows="4" cols="30" v-model="group.description"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-5">
                                <label>{{$t('All Staff')}}</label>
                                <label>{{$t('Search')}}</label>
                                <input type="text" v-model="staff_search"/>
                                <draggable v-model="staff_members" :options="{group:'staff'}" style="background:#DDDDDD; min-height: 50px;">
                                    <div v-for="staff_member in filtered_staff_members">{{staff_member.user.name}}</div>
                                </draggable>
                            </div>

                            <div class="col-sm-5 col-sm-offset-1">
                                <label>{{$t('Assigned Staff')}}</label>
                                <draggable v-model="group.assigned_staff_members" :options="{group:'staff'}" style="background:#DDDDDD; min-height: 50px;">
                                    <div v-for="staff_member in group.assigned_staff_members">{{staff_member.user.name}}</div>
                                </draggable>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-5">
                                <label>{{$t('All Children')}}</label>
                                <label>{{$t('Search')}}</label>
                                <input type="text" v-model="child_search"/>
                                <draggable v-model="children" :options="{group:'children'}" style="background:#DDDDDD; min-height: 50px;">
                                    <div v-for="child in filtered_children">{{child.name}}</div>
                                </draggable>
                            </div>

                            <div class="col-sm-5 col-sm-offset-1">
                                <label>{{$t('Assigned Children')}}</label>
                                <draggable v-model="group.assigned_children" :options="{group:'children'}" style="background:#DDDDDD; min-height: 50px;">
                                    <div v-for="child in group.assigned_children">{{child.name}}</div>
                                </draggable>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> {{$t('Cancel')}}
                        </button>
                        <button class="btn btn-primary"><i class="fa fa-save"></i> {{$t('Save Changes')}}</button>
                    </div>
                </form>
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
                staff_search: '',
                child_search: '',
                group: this.generateNewGroupModel()
            }
        },
        methods: {
            generateNewGroupModel: function() {
                return {
                    assigned_children: [],
                    assigned_staff_members: [],
                    description: '',
                    name: ''
                }
            },
            storeGroup: function() {
                this.$http.post('/api/groups', {
                    name: this.group.name,
                    description: this.group.description,
                    children: this.group.assigned_children.map(x => x.id),
                    staff: this.group.assigned_staff_members.map(x => x.id)
                })
                    .then(response => {
                        this.$emit('createGroup', response.data.group);
                        $('#createGroup').modal('hide');
                        this.staff_members = this.staff_members.concat(this.group.assigned_staff_members);
                        this.children = this.children.concat(this.group.assigned_children);
                        this.group = this.generateNewGroupModel();
                        this.notifySuccess(response.data.message);
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
            }
        }
    }
</script>
