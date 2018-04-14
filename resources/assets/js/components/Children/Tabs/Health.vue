<template>
    <div>
        <div class="content-heading">
            <h3 style="margin-top: 0px;">{{ $t('Health') }}</h3>
        </div>
        <ul class="nav nav-tabs tabs-bordered">
            <li class="active">
                <a href="#medications" data-toggle="tab" aria-expanded="false">
                    <span class="visible-xs"><img src="/assets/img/icons/med.jpg"></span>
                    <span class="hidden-xs"><img src="/assets/img/icons/med.jpg">{{ $t('Medications') }}</span>
                </a>
            </li>
            <li class="">
                <a href="#allergies" data-toggle="tab" aria-expanded="true">
                    <span class="visible-xs"><img src="/assets/img/icons/al.png"></span>
                    <span class="hidden-xs"><img src="/assets/img/icons/al.png">{{ $t('Allergies') }}</span>
                </a>
            </li>
            <li>
                <a href="#food" data-toggle="tab" aria-expanded="false">
                    <span class="visible-xs"><img src="/assets/img/icons/food.png"></span>
                    <span class="hidden-xs"><img src="/assets/img/icons/food.png">{{ $t('Food Preferences') }}</span>
                </a>
            </li>
            <li>
                <a href="#contacts" data-toggle="tab" aria-expanded="false">
                    <span class="visible-xs"><img src="/assets/img/icons/contact.png"></span>
                    <span class="hidden-xs"><img src="/assets/img/icons/contact.png">{{ $t('Contacts') }}</span>
                </a>
            </li>
        </ul>
        <div class="tab-content" style="margin-top:20px;">
            <div class="tab-pane active" id="medications">
                <div class="content-heading">
                    <!-- START Language list-->
                    <div class="pull-right">
                        <div class="btn-group">
                            <button class="btn btn-success waves-effect m-b-5" data-toggle="modal" data-target="#medications-tab" data-backdrop="false" id="new-health-provider-button">
                                <i class="fa fa-plus m-r-5 btn-fa"></i>
                                <span>{{ $t('New Medication') }}</span>
                            </button>
                        </div>
                    </div>
                    <h3 style="margin-top:0px;margin-bottom:20px;">{{ $t('Medications') }}</h3>
                </div>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <!-- START table-responsive-->
                        <div v-if="child.medication.length" class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ $t('Name') }}</th>
                                        <th>{{ $t('Frequency') }}</th>
                                        <th>{{ $t('Start') }}</th>
                                        <th>{{ $t('Stop') }}</th>
                                        <th class="text-center">{{ $t('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="medication in child.medication">
                                        <td>1</td>
                                        <td>{{ medication.name }}</td>
                                        <td>{{ medication.frequency }}</td>
                                        <td>10 October 2017</td>
                                        <td>15 October 2017</td>
                                        <td class="text-center">
                                            <a class="btn btn-primary btn-xs" href="" title="Edit"><i class="fa fa-pencil"></i></a>
                                            <a class="btn btn-danger btn-xs" href="" title="Delete"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- END table-responsive-->
                        <div v-else class="text-center">
                            <p>There are no Medication records</p>
                             <div class="btn-group">
                                <button class="btn btn-success waves-effect m-b-5" data-toggle="modal" data-target="#medications-tab" data-backdrop="false" id="new-health-provider-button">
                                    <span>{{ $t('Add First Medication Record') }}</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="allergies">
                <div class="content-heading">
                    <!-- START Language list-->
                    <div class="pull-right">
                        <div class="btn-group">
                            <button class="btn btn-success waves-effect m-b-5">
                                <i class="fa fa-plus m-r-5 btn-fa"></i>
                                <span>{{ $t('Add Allergy') }}</span>
                            </button>
                        </div>
                    </div>
                    <h3 style="margin-top:0px;margin-bottom:20px;">{{ $t('Allergies') }}</h3>
                </div>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <!-- START table-responsive-->
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ $t('Name') }}</th>
                                        <th>{{ $t('Remarks') }}</th>
                                        <th>{{ $t('Treatment') }}</th>
                                        <th>{{ $t('Date first noted') }}</th>
                                        <th>{{ $t('Last Event Date') }}</th>
                                        <th class="text-center">{{ $t('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Pea Nuts</td>
                                        <td>Anaphlytic shock</td>
                                        <td>Epipen Injection</td>
                                        <td>10 October 2017</td>
                                        <td>15 October 2017</td>
                                        <td class="text-center">
                                            <a class="btn btn-primary btn-xs" href="" title="Edit"><i class="fa fa-pencil"></i></a>
                                            <a class="btn btn-danger btn-xs" href="" title="Delete"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- END table-responsive-->
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="food">
                <div class="content-heading">
                    <!-- START Language list-->
                    <div class="pull-right">
                        <div class="btn-group">
                            <button class="btn btn-success waves-effect m-b-5">
                                <i class="fa fa-plus m-r-5 btn-fa"></i>
                                <span>{{ $t('Add a Preference') }}</span>
                            </button>
                        </div>
                    </div>
                    <h3 style="margin-top:0px;margin-bottom:20px;">{{ $t('Food Preferences') }}</h3>
                </div>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <!-- START table-responsive-->
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ $t('Food Name') }}</th>
                                        <th>{{ $t('Remarks') }}</th>
                                        <th>{{ $t('Preffered Time') }}</th>
                                        <th class="text-center">{{ $t('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Cheese Sandwich</td>
                                        <td>Use wheat bread</td>
                                        <td>Lunch</td>
                                        <td class="text-center">
                                            <a class="btn btn-primary btn-xs" href="" title="Edit"><i class="fa fa-pencil"></i></a>
                                            <a class="btn btn-danger btn-xs" href="" title="Delete"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- END table-responsive-->
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="contacts">
                <div class="content-heading">
                    <!-- START Language list-->
                    <div class="pull-right">
                        <div class="btn-group">
                            <button class="btn btn-success waves-effect m-b-5"
                                data-toggle="modal"
                                data-target="#create-edit-emergency-contact-modal"
                                data-backdrop="false"
                                id="new-emergency-contact-button"
                            >
                                <i class="fa fa-plus m-r-5 btn-fa"></i>
                                <span> {{ $t('New Contact') }}</span>
                            </button>
                        </div>
                    </div>
                    <h3 style="margin-top:0px;margin-bottom:20px;">{{ $t('Emergency Contacts') }}</h3>
                </div>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <!-- START table-responsive-->
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ $t('Name') }}</th>
                                        <th>{{ $t('Relation') }}</th>
                                        <th>{{ $t('Phone') }}</th>
                                        <th>{{ $t('Address') }}</th>
                                        <th class="text-center">{{ $t('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="emergency_contact in child.emergency_contacts">
                                        <td>{{ emergency_contact.id }}</td>
                                        <td>{{ emergency_contact.name }}</td>
                                        <td>{{ emergency_contact.relation.name }}</td>
                                        <td>{{ emergency_contact.address.phone }}</td>
                                        <td>
                                            {{ emergency_contact.address.address_line_1 }} <br />
                                            {{ emergency_contact.address.address_line_2 }} <br v-if="emergency_contact.address.address_line_2"/>
                                            {{ emergency_contact.address.city.name }}, {{ emergency_contact.address.state.name }} {{ emergency_contact.address.zip_code.zip_code }}
                                        </td>
                                        <td class="text-center">
                                            <a class="btn btn-primary btn-xs" v-on:click="editEmergencyContact(emergency_contact)" title="Edit"><i class="fa fa-pencil"></i></a>
                                            <a class="btn btn-danger btn-xs" title="Delete" v-on:click.prevent="deleteEmergencyContact(emergency_contact.id)"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- END table-responsive-->
                    </div>
                </div>

                <div class="content-heading">
                    <!-- START Language list-->
                    <div class="pull-right">
                        <div class="btn-group">
                            <button class="btn btn-success waves-effect m-b-5"
                                    data-toggle="modal"
                                    data-target="#create-edit-health-provider-modal"
                                    data-backdrop="false"
                                    id="new-health-provider-button"
                            >
                                <i class="fa fa-plus m-r-5 btn-fa"></i>
                                <span> {{ $t('New Provider') }}</span>
                            </button>
                        </div>
                    </div>
                    <h3 style="margin-top:0px;margin-bottom:0px;">{{ $t('Health Providers') }}</h3>
                    <h6 style="margin-top:0px;margin-bottom:10px;">{{ $t('doctors,insurance,clinics') }}</h6>
                </div>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <!-- START table-responsive-->
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ $t('Name') }}</th>
                                        <th>{{ $t('Type/Role') }}</th>
                                        <th>{{ $t('Phone') }}</th>
                                        <th>{{ $t('Address') }}</th>
                                        <th>{{ $t('Remarks') }}</th>
                                        <th class="text-center">{{ $t('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="health_provider in child.health_providers">
                                        <td>{{ health_provider.id }}</td>
                                        <td>{{ health_provider.name }}</td>
                                        <td>{{ health_provider.role.name }}</td>
                                        <td>{{ health_provider.address.phone }}</td>
                                        <td>
                                            {{ health_provider.address.address_line_1 }} <br />
                                            {{ health_provider.address.address_line_2 }} <br v-if="health_provider.address.address_line_2"/>
                                            {{ health_provider.address.city.name }}, {{ health_provider.address.state.name }} {{ health_provider.address.zip_code.zip_code }}
                                        </td>
                                        <td>{{ health_provider.remarks }}</td>
                                        <td class="text-center">
                                            <a class="btn btn-primary btn-xs" v-on:click="editHealthProvider(health_provider)" title="Edit"><i class="fa fa-pencil"></i></a>
                                            <a class="btn btn-danger btn-xs" title="Delete" v-on:click.prevent="deleteHealthProvider(health_provider.id)"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- END table-responsive-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        methods: {
            deleteEmergencyContact: function (id) {
                this.$http.delete('/api/children/' + this.child.id + '/emergency-contacts/' + id)
                    .then(response => {
                        this.$noty.success(response.data.message);
                        this.child.emergency_contacts = this.child.emergency_contacts.filter(x => x.id != id);
                    })
                    .catch(error => {
                        if (error.response.status == 403) {
                            this.$noty.error(this.$t('This child is inactive and read-only.'));
                        } else if (error.response.status == 422) {
                            for (var key in error.response.data) {
                                this.$noty.error(error.response.data[key]);
                            }
                        } else {
                            alert("Something went wrong. Please reload the page and try again.");
                        }
                    });
            },
            deleteHealthProvider: function (id) {
                this.$http.delete('/api/children/' + this.child.id + '/health-providers/' + id)
                    .then(response => {
                        this.$noty.success(response.data.message);
                        this.child.health_providers = this.child.health_providers.filter(x => x.id != id);
                    })
                    .catch(error => {
                        if (error.response.status == 403) {
                            this.$noty.error(this.$t('This child is inactive and read-only.'));
                        } else if (error.response.status == 422) {
                            for (var key in error.response.data) {
                                this.$noty.error(error.response.data[key]);
                            }
                        } else {
                            alert("Something went wrong. Please reload the page and try again.");
                        }
                    });
            },
            editEmergencyContact: function(emergency_contact) {
                window.bus.$emit('editEmergencyContact', emergency_contact);
                $('#new-emergency-contact-button').click();
            },
            editHealthProvider: function(health_provider) {
                window.bus.$emit('editHealthProvider', health_provider);
                $('#new-health-provider-button').click();
            },
        },
        props: ['child']
    }
</script>
