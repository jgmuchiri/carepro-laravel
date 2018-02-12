<template>
<div class="content-wrapper">
<div class="content-heading">
    <div class="pull-right">
      <div class="btn-group">
         <button class="btn btn-primary waves-effect m-b-5" data-toggle="modal" data-target="#create-child-modal" data-backdrop="false">
            <i class="fa fa-plus m-r-5 btn-fa"></i>
            <span>{{ $t('Register Child') }}</span>
        </button>
      </div>
   </div>
   {{parent.user.name}}
</div>
<!-- END widgets box-->

<div class="panel panel-default" id="panelDemo1">
        <div class="panel-wrapper collapse in">
            <div class="panel-body">
                <div class="card card-transparent flex-row">
                    <div class="row">
                        <div class="col-md-2 col-xs-6 text-center">
                            <img :src="parent.full_photo_uri" :alt="$t('Parent Image')" class=" img-responsive img-thumbnail"/>
                        </div>
                        <div class="col-md-10 col-xs-6 text-center">
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="child-alert child-danger">$200 Unpaid Invoices</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="child-alert child-warning">4 Medications</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="child-alert child-success">1 Child Registered</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="child-alert child-warning">2 incidents Reported</p>
                                </div>
                            </div>                     
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <hr>
                            <div class="child-border">
                                <div class="content-heading">
                                    <div class="pull-right">
                                        <div class="btn-group">
                                            <button class="btn btn-primary waves-effect m-b-5" data-toggle="modal" data-target="#attachChildren" data-backdrop="false"><i class="fa fa-plus m-r-5 btn-fa"></i><span>{{ $t('Assign new child') }}</span>
                                            </button>
                                        </div>
                                    </div>
                                    <h3>{{ $t('Children') }}</h3>
                                </div>
                                <div class="row" style="padding-top:10px;">
                                    <div v-for="child in parent.children" class="col-md-6">
                                        <div class="panel b">
                                             <div class="panel-body" style="padding:0px;">
                                                <div class="media">
                                                   <div class="media-left media-middle">
                                                      <a href="#">
                                                         <img class="media-object img-thumbnail thumb96" :src="child.full_photo_uri" :alt="$t('Child Image')" alt="Contact">
                                                      </a>
                                                   </div>
                                                   <div class="media-body pt-sm">
                                                      <div class="pull-right pt-lg pr-lg ">
                                                         <router-link class="mb-sm btn btn-info" :to="{ name: 'children.show', params: { child_id: child.id }}">
                                                            View
                                                        </router-link>
                                                      </div>
                                                      <div class="text-bold"><h3>{{child.name}}</h3>
                                                        <div class="text-sm text-muted td-text-success">{{ child.status.name_label }}</div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
                    <div class="row" style="padding-top: 20px;">
                      <div class="col-lg-12">
                          <div class="panel panel-default">
                            <div class="panel-heading">
                                <strong style="color: rgb(101, 101, 101);">Update Profile</strong>
                            </div> 
                            <div class="panel-wrapper">
                                <div class="panel-body">
                                    <form v-on:submit.prevent="save">
                                        <div class="row">
                                            <div class="form-group col-md-4">
                                                <input id="name" placeholder="Name" v-model="parent.user.name" type="text" class="form-control input-lg">
                                            </div> 
                                            <div class="form-group col-md-4">
                                                <input v-model="parent.user.email" type="text" placeholder="Email-Address" class="form-control input-lg">
                                            </div> 
                                            <div class="form-group col-md-4">
                                                <input v-model="parent.user.address.phone" type="text" placeholder="Phone" class="form-control input-lg">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-4">
                                                <input  type="date" v-model="parent.date_of_birth" class="form-control input-lg">
                                            </div> 
                                            <div class="form-group col-md-4">
                                                <input v-model="parent.pin"  type="text" placeholder="Pin" class="form-control input-lg">
                                            </div> 
                                            <div class="form-group col-md-4">
                                                <div class="checkbox c-checkbox needsclick">
                                                    <label class="needsclick">
                                                        <input class="needsclick" v-model="parent.is_primary" type="checkbox" id="is_primary">
                                                        <span class="fa fa-check"></span>Is Primary Parent?
                                                    </label>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <input v-model="parent.user.address.address_line_1" type="text" placeholder="Address Line 1" class="form-control input-lg">
                                                    </div> 
                                                    <div class="form-group col-md-6">
                                                        <input v-model="parent.user.address.address_line_2" type="text" placeholder="Address Line 2" class="form-control input-lg">
                                                    </div>
                                                </div> 
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <input v-model="parent.user.address.city.name" placeholder="City" name="name" type="text" class="form-control input-lg">
                                                    </div> 
                                                    <div class="form-group col-md-6">
                                                        <input v-model="parent.user.address.state.name" placeholder="State" name="name" type="text" class="form-control input-lg">
                                                    </div>
                                                </div>
                                            </div> 
                                            <div class="col-md-4">
                                                <input id="upload" name="photo" type="file" style="display: none;" @change="onFileChange"> 
                                                <div class="panel widget child-upload">
                                                    <div class="panel-body text-center">
                                                        <div class="child-btn-fa">
                                                            <a href="" id="upload_link" title="">
                                                                <i class="fa fa-upload"></i>
                                                            </a>
                                                        </div> 
                                                        <p id="filename"><span>Upload Profile Photo</span></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="row">
                                            <div class="form-group col-sm-4">
                                                <input required="required" v-model="parent.user.address.zip_code.zip_code" placeholder="Zip" type="text" class="form-control input-lg">
                                            </div> 
                                            <div class="form-group col-sm-4">
                                                <select id="country" v-model="parent.user.address.country_id" class="form-control input-lg"  required>
                                                    <option v-for="country in countries" v-bind:value="country.id">
                                                        {{ country.name_label }}
                                                    </option>
                                                </select>
                                            </div> 
                                            <div class="form-group col-sm-4 text-center">
                                                <button class="btn btn-primary btn-lg">
                                                <i class="fa fa-save btn-fa"></i>
                                                 Save changes
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                          </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <CreateChildModal v-on:createChild="addChild"></CreateChildModal>
    <AssignChildrenModal v-on:attachChildtoParent="assignChild" :parent_id="parent.id" :initial_selected_children="parent.children"></AssignChildrenModal>
</div>

    <!-- <div class="content-wrapper">
        <div v-if="this.can_manage_children">
            <a href="#" class="label label-default" data-toggle="modal" data-target="#attachChildren" data-backdrop="false">{{ $t('Assign new child') }}</a>
            <AssignChildrenModal :parent_id="parent.id" :initial_selected_children="parent.children"></AssignChildrenModal>
        </div>
    </div> -->
</template>

<script>
    export default {
        created()
        {
            this.getParent();

            this.$http.get('/api/addresses/countries')
            .then(response => {
                this.countries = response.data.countries;
            })
            .catch(error => {
                alert("Something went wrong. Please try reloading the page");
            });

            $(document).on('click', '#upload_link', function(e) {
                e.preventDefault();
                $("#upload:hidden").trigger('click');
            });

            $("input[type=hidden]").bind("change", function() {
                console.log('change');
                var file = $('#upload').val();
                var filename = file.slice(-12);
                console.log(filename);
                if (filename !== null) {
                    console.log(filename);
                    $("#filename span").text(filename);
                }
            });
        },

        data() {
            return {
                parent: {},
                countries: [],
                photo_uri: '',
                upload_image: false,
                can_manage_children: false
            }
        },

        methods: {
            getParent: function() {
                this.$http.get('/api/parents/' + this.parent_id)
                .then(response => {
                    this.parent = response.data.parent;
                    this.can_manage_children = response.data.can_manage_children;
                })
                .catch(error => {
                    alert("Something went wrong. Please try reloading the page");
                });
            },

            onFileChange: function(event) {
                console.log('file');
                var files = event.target.files || event.dataTransfer.files;
                if (!files.length)
                    return;
                this.photo_uri = files[0];
                this.upload_image = true;
            },
            
            save: function() {
                var formData = new FormData();
                formData.append('name', this.parent.user.name);
                formData.append('email', this.parent.user.email);
                formData.append('dob', this.parent.date_of_birth);
                formData.append('pin', this.parent.pin);
                formData.append('is_primary', this.parent.is_primary)
                formData.append('address_line_1', this.parent.user.address.address_line_1);
                formData.append('address_line_2', this.parent.user.address.address_line_2);
                formData.append('city', this.parent.user.address.city.name);
                formData.append('state', this.parent.user.address.state.name);
                formData.append('zip_code', this.parent.user.address.zip_code.zip_code)
                formData.append('country', this.parent.user.address.country_id);
                formData.append('phone', this.parent.user.address.phone);
                formData.append('_method', 'PUT');

                if (this.upload_image) {
                    formData.append('photo_uri', this.photo_uri);
                }

                this.$http.post('/api/parents/' + this.parent.id, formData)
                    .then(response => {
                        this.getParent();
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
            },

            assignChild: function() {
                this.getParent();
            },

            addChild: function(child) {
                this.children.push(child);
            }
        },
        props: ['parent_id']
    }
</script>
