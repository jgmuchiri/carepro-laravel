<template>
   <div>
        <div class="row">
            <div class="col-md-4">
                <p class="child-alert child-danger">3 {{ $t('Known Allergies') }}</p>
                <p class="child-alert child-info">$244 {{ $t('due') }}</p>
            </div>
            <div class="col-md-4">
                <p class="child-alert child-success">2 {{ $t('Incidents reported') }}</p>
                <p class="child-alert child-warning">5 {{ $t('medications') }}</p>
            </div>
            <div class="col-md-4">
                <p class="child-alert child-success">20 {{ $t('Notes') }}</p>
                <p class="child-alert child-success">88 {{ $t('Photos') }}</p>
            </div>
        </div>
        <hr>

        <div class="panel panel-default">
            <div class="panel-heading panel-heading-collapsed"><strong style="color: #656565">{{ $t('Child Information') }}</strong>
                <a class="pull-right" href="#" data-tool="panel-collapse" data-toggle="tooltip" title="Collapse Panel">
                    <em class="fa fa-plus"></em>
                </a>
            </div>

            <div class="panel-wrapper collapse">
                <div class="panel-body">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <input id="name"
                                class="form-control input-lg"
                                :placeholder="$t('Apartment, suite, unit, building, floor, etc.')"
                                name="name"
                                type="text"
                                v-model="child.name"
                            >
                        </div>
                        <div class="form-group col-md-4">
                            <input class="form-control input-lg" name="ssn" type="text" v-model="child.ssn">
                        </div>
                        <div class="form-group col-md-4">
                            <select required="" class="form-control input-lg" name="status">
                                <option value="1">Active</option>
                                <option value="2">Inactive</option>
                                <option value="3">Pending Approval</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <input id="name" class="form-control input-lg" name="name" type="text" v-model="child.name">
                                </div>
                                <div class="form-group col-md-6">
                                    <select required="" class="form-control input-lg" name="gender">
                                        <option value="1">Male</option>
                                        <option value="2">Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <input id="name"
                                        class="form-control input-lg"
                                        :placeholder="$t('Apartment, suite, unit, building, floor, etc.')"
                                        name="name"
                                        type="text"
                                        v-model="child.name">
                                </div>
                                <div class="form-group col-md-6">
                                    <select required="" class="form-control input-lg" name="blood_type">
                                        <option value="1">A-</option>
                                        <option value="2">A+</option>
                                        <option value="3">B-</option>
                                        <option value="4">B+</option>
                                        <option value="5">AB</option>
                                        <option value="6">O-</option>
                                        <option value="7">O+</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <input style="display:none;" id="upload" name="photo" type="file"/>
                            <div class="panel widget child-upload">
                                <div class="panel-body text-center">
                                    <div class="child-btn-fa">
                                        <a href="" id="upload_link" title=""><i class="fa fa-upload"></i></a>
                                    </div>
                                    <p><span>{{ $t('Upload Profile Photo') }}</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                             <input required="" class="form-control input-lg" name="dob" type="date" v-model="child.dob">
                        </div>
                        <div class="form-group col-sm-4">
                             <input required="" class="form-control input-lg" name="ssn" type="text" v-model="child.pin">
                        </div>
                        <div class="form-group col-sm-4 text-center">
                             <button class="btn btn-primary btn-lg"><i class="fa fa-save btn-fa"></i> {{ $t('Save changes') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="child-border">
            <!-- groups section -->
            <div class="content-heading">
                <div class="pull-right">
                    <div class="btn-group">
                        <button class="btn btn-primary waves-effect m-b-5" data-toggle="modal" data-target="#attachGroup" data-backdrop="false"> <i class="fa fa-plus m-r-5 btn-fa"></i> <span> {{ $t('Assign to group') }}</span></button>
                    </div>
                </div>
                <h3>{{ $t('Assigned Groups') }}</h3>
            </div>

            <div class="table-responsive" v-if="child.groups.length">
                <table class="table table-bordered table-hover" >
                    <thead>
                        <tr>
                            <th data-check-all width="3">
                                <div class="checkbox c-checkbox" data-toggle="tooltip" data-title="Check All">
                                    <label>
                                        <input type="checkbox">
                                        <span class="fa fa-check"></span>
                                    </label>
                                </div>
                            </th>
                            <th>{{ $t('Name') }}</th>
                            <th>{{ $t('Description') }}</th>
                            <th class="text-center">{{ $t('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="group in child.groups">
                            <td>
                                <div class="checkbox c-checkbox">
                                    <label>
                                        <input type="checkbox">
                                        <span class="fa fa-check"></span>
                                    </label>
                                </div>
                            </td>
                            <td>{{ group.name }}</td>
                            <td>{{ group.short_description }}</td>
                            <td class="text-center">
                                <a class="btn btn-danger btn-xs" href="" title="Delete"><i class="fa fa-trash-o"></i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="text-center" v-if="!child.groups.length">
                <h4>{{ $t('No assigned groups yet') }}</h4>
                <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#attachGroup" data-backdrop="false" title="">{{ $t('Assign to first group') }}</button>
            </div>
            <hr>

            <!-- parents section -->
            <div class="content-heading">
                <div class="pull-right">
                    <div class="btn-group">
                        <!-- @if ($user->role->permissions->contains('name', App\Models\Permissions\Permission::MANAGE_CHILDREN)) -->
                        <button v-if="can_manage_children"
                                class="btn btn-primary waves-effect m-b-5"
                                data-toggle="modal"
                                data-target="#attachParent"
                                data-backdrop="false">
                            <i class="fa fa-plus m-r-5 btn-fa"></i>
                            <span> {{ $t('Assign Parent/Guardian') }}</span>
                        </button>
                    </div>
                </div>
                <h3>{{ $t('Parents/Guardians') }}</h3>
            </div>
            <div class="child-parent">
                <div class="row">
                    <div class="col-md-offset-1 col-md-4" v-for="parent in child.parents">
                        <div class="panel b text-center">
                            <div class="panel-body">
                                <img class="img-circle thumb64" :src="parent.full_photo_uri">
                                <p class="h4 text-bold mb0">{{ parent.user.name }}</p>
                                <p class="h4 text-bold mb0">{{ parent.user.email }}</p>
                                <p>{{ parent.user.address.phone }}</p>
                                <button class="btn btn-success btn-oval" type="button">{{ $t('Edit') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>

            <!-- authorized section -->
            <div class="content-heading">
                <!-- START Language list-->
                <div class="pull-right">
                    <div class="btn-group">
                        <button class="btn btn-primary waves-effect m-b-5"
                                data-toggle="modal"
                                data-target="#newChild"
                                data-backdrop="false">
                            <i class="fa fa-plus m-r-5 btn-fa"></i>
                            <span> {{ $t('New Authorization') }}</span>
                        </button>
                    </div>
                </div>
                <h3>{{ $t('Authorised Pick Up Users') }}</h3>
            </div>
            <div class="child-parent">
                <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-body">
                                <div class="row row-table">
                                    <div class="col-xs-5 text-center">
                                        <img :src="child.full_photo_uri" :alt="$t('User Image')"/>
                                    </div>
                                    <div class="col-xs-7">
                                        <h3 class="mt0">Patricia Ellys</h3>
                                        <ul class="list-unstyled">
                                            <li class="mb-sm"><em class="fa fa-envelope fa-fw"></em>patricia@gmail.com</li>
                                            <li class="mb-sm"><em class="fa fa-phone fa-fw"></em>0708153683</li>
                                            <li class="mb-sm"><em class="fa fa-key fa-fw"></em>123456</li><li class="mb-sm">
                                            <em class="fa fa-check-circle-o fa-fw"></em>Aunt</li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="text-center">
                                    <a href="" class="btn btn-success btn-oval"><i class="fa fa-pencil"></i></a>
                                    <a href="" class="btn btn-danger btn-oval"><i class="fa fa-trash-o"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-body">
                                <div class="row row-table">
                                    <div class="col-xs-5 text-center">
                                        <img :src="child.full_photo_uri" :alt="$t('User Image')"/>
                                    </div>
                                    <div class="col-xs-7">
                                        <h3 class="mt0">Patricia Ellys</h3>
                                        <ul class="list-unstyled">
                                            <li class="mb-sm"><em class="fa fa-envelope fa-fw"></em>patricia@gmail.com</li>
                                            <li class="mb-sm"><em class="fa fa-phone fa-fw"></em>0708153683</li>
                                            <li class="mb-sm"><em class="fa fa-key fa-fw"></em>123456</li>
                                            <li class="mb-sm"><em class="fa fa-check-circle-o fa-fw"></em>Brother</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <a href="" class="btn btn-success btn-oval"><i class="fa fa-pencil"></i></a>
                                    <a href="" class="btn btn-danger btn-oval"><i class="fa fa-trash-o"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   </div>
</template>

<script>
    export default {
        created()
        {
            /*this.$http.get('/api/children/' + this.child_id)
                .then(response => {
                    this.child = response.data.child;
                })
                .catch(error => {
                    alert("Something went wrong. Please try reloading the page");
                });*/
        },
        data() {
            return {
                can_manage_children: false
            }
        },
        methods: {

        },
        props: ['child']
    }
</script>
