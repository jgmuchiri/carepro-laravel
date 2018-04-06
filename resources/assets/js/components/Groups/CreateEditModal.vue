<template>
    <div class="modal fade" id="createEditGroup" tabindex="-1" role="dialog" aria-labelledby="create-edit-group">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="create-group">{{ this.edit_group ? $t('Edit') + this.edit_group.name : $t('New Group')}}</h4>
                </div>
                <form v-on:submit.prevent="saveGroup">
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label>{{$t('Name')}}</label>
                                <input type="text" name="name" class="form-control" required v-model="group.name"/>
                            </div>
                            <div class="form-group col-sm-6">
                                <label>{{$t('Description')}}</label>
                                <textarea name="short_description" class="form-control" rows="4" cols="30" v-model="group.short_description"></textarea>
                            </div>
                        </div>
                        <GroupMassAssign :existing_assigned_staff_members="group.assigned_staff_members"
                                         :existing_assigned_children="group.assigned_children"
                                         v-on:assigneesUpdated="updateAssignees"></GroupMassAssign>
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
        computed: {
            group: {
                get: function () {
                    if (this.edit_group) {
                        return {
                            assigned_children: this.edit_group.children,
                            assigned_staff_members: this.edit_group.staff,
                            short_description: this.edit_group.short_description,
                            name: this.edit_group.name
                        }
                    } else {
                        return this.generateNewGroupModel();
                    }
                },
                set: function(value) {
                    this.assigned_children = [];
                    this.assigned_staff_members = [];
                    this.short_description = '';
                    this.name = '';
                }
            }
        },
        methods: {
            updateAssignees: function(children, staff_members) {
                this.group.assigned_children = children;
                this.group.assigned_staff_members = staff_members;
            },
            generateNewGroupModel: function() {
                return {
                    assigned_children: [],
                    assigned_staff_members: [],
                    short_description: '',
                    name: ''
                }
            },
            saveGroup: function() {
                if (this.edit_group) {
                    return this.updateGroup();
                } else {
                    return this.storeGroup();
                }
            },
            storeGroup: function() {
                this.$http.post('/api/groups', {
                    name: this.group.name,
                    short_description: this.group.short_description,
                    children: this.group.assigned_children.map(x => x.id),
                    staff: this.group.assigned_staff_members.map(x => x.id)
                })
                    .then(response => {
                        this.$emit('createGroup', response.data.group);
                        $('#createEditGroup').modal('hide');
                        this.group = this.generateNewGroupModel();
                        this.$noty.success(response.data.message);
                    })
                    .catch(error => {
                        console.log(error);
                        if (error.response.status == 422) {
                            for (var key in error.response.data) {
                                this.$noty.error(error.response.data[key]);
                            }
                        } else {
                            alert("Something went wrong. Please reload the page and try again.");
                        }
                    });
            },
            updateGroup: function() {
                this.$http.put('/api/groups/' + this.edit_group.id, {
                    name: this.group.name,
                    short_description: this.group.short_description,
                    children: this.group.assigned_children.map(x => x.id),
                    staff: this.group.assigned_staff_members.map(x => x.id)
                })
                    .then(response => {
                        this.$emit('editGroup', response.data.group)
                        $('#createEditGroup').modal('hide');
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
        props: ['edit_group']
    }
</script>
