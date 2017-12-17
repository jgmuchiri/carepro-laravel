<div class="row">
    <div class="col-md-4">
        <p class="child-alert child-danger">3 Known Allergies</p>
        <p class="child-alert child-info">$244 due</p>
    </div>
    <div class="col-md-4">
        <p class="child-alert child-success">2 Incidents reported</p>
        <p class="child-alert child-warning">5 medications</p>
    </div>
    <div class="col-md-4">
        <p class="child-alert child-success">20 Notes</p>
        <p class="child-alert child-success">88 Photos</p>
    </div>
</div>
<hr>

<div class="panel panel-default">
    <div class="panel-heading panel-heading-collapsed"><strong style="color: #656565">Child Information</strong>
       <a class="pull-right" href="#" data-tool="panel-collapse" data-toggle="tooltip" title="Collapse Panel">
          <em class="fa fa-plus"></em>
       </a>
    </div>
    <div class="panel-wrapper collapse">
       <div class="panel-body">
          <div class="row">
            <div class="form-group col-md-4">
                <input id="name" class="form-control input-lg" placeholder="Apartment, suite, unit, building, floor, etc." name="name" type="text" value="{{ $child->name }}">
            </div>
            <div class="form-group col-md-4">
                <input required="" class="form-control input-lg" name="ssn" type="text" value="{{ $child->ssn }}">
            </div>
            <div class="form-group col-md-4">
                <select required="" class="form-control input-lg" name="status">
                    <option value="1" {{ $child->status_id == '1' ? ' selected' : '' }}>Active</option>
                    <option value="2" {{ $child->status_id == '2' ? ' selected' : '' }}>Inactive</option>
                    <option value="3" {{ $child->status_id == '3' ? ' selected' : '' }}>Pending Approval</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <div class="form-group col-md-6">
                        <input id="name" class="form-control input-lg" name="name" type="text" value="{{ $child->name }}">
                    </div>
                    <div class="form-group col-md-6">
                        <select required="" class="form-control input-lg" name="gender">
                            <option value="1" {{ $child->gender_id == '1' ? ' selected' : '' }}>Male</option>
                            <option value="2"{{ $child->gender_id == '2' ? ' selected' : '' }}>Female</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <input id="name" class="form-control input-lg" placeholder="Apartment, suite, unit, building, floor, etc." name="name" type="text" value="{{ $child->name }}">
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
                      <p>
                         <span>Upload Profile Photo</span>
                      </p>
                   </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-4">
                <input required="" class="form-control input-lg" name="dob" type="date" value="{{$child->dob}}">
            </div>
            <div class="form-group col-sm-4">
                <input required="" class="form-control input-lg" name="ssn" type="text" value="{{ $child->pin }}">
            </div>
            <div class="form-group col-sm-4 text-center">
                <button class="btn btn-primary btn-lg"><i class="fa fa-save btn-fa"></i> Save changes</button>
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
             <button class="btn btn-primary waves-effect m-b-5" data-toggle="modal" data-target="#attachGroup" data-backdrop="false"> <i class="fa fa-plus m-r-5 btn-fa"></i> <span> @lang('Assign to group')</span></button>
          </div>
       </div>
       <h3>Assigned Groups</h3>
    </div>
    @if(!$child->groups->isEmpty())
    <div class="table-responsive">
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
                <th>Name</th>
                <th>Description</th>
                <th class="text-center">Actions</th>
            </tr>
         </thead>
         <tbody>
          @foreach($child->groups as $group)
            <tr>
                <td>
                  <div class="checkbox c-checkbox">
                     <label>
                        <input type="checkbox">
                        <span class="fa fa-check"></span>
                     </label>
                  </div>
                </td>
                <td>{{ $group->name }}</td>
                <td>{{ $group->short_description }}</td>
                <td class="text-center">
                    <a class="btn btn-danger btn-xs" href="" title="Delete"><i class="fa fa-trash-o"></i></a>
                </td>
            </tr>
          @endforeach
         </tbody>
      </table>
   </div>
   @else
   <div class="text-center">
      <h4>No assigned groups yet</h4>
      <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#attachGroup" data-backdrop="false" title="">Assign to first group</button>
   </div>
   @endif
    <hr>
    <!-- parents section -->
    <div class="content-heading">
       <div class="pull-right">
          <div class="btn-group">
            @if ($user->role->permissions->contains('name', App\Models\Permissions\Permission::MANAGE_CHILDREN))
                <button class="btn btn-primary waves-effect m-b-5" data-toggle="modal" data-target="#attachParent" data-backdrop="false"> <i class="fa fa-plus m-r-5 btn-fa"></i> <span> @lang('Assign Parent/Guardian')</span></button>
            @endif
          </div>
       </div>
       <h3>Parents/Guardians</h3>
    </div>
    <div class="child-parent">
        <div class="row">
            @foreach($child->parents as $parent)
            <div class="col-md-offset-1 col-md-4">
                <div class="panel b text-center">
                   <div class="panel-body">
                      <img class="img-circle thumb64" src="{{ asset('storage/' . $parent->photo_uri) }}">
                      <p class="h4 text-bold mb0">{{ $parent->user->name }}</p>
                      <p class="h4 text-bold mb0">{{ $parent->user->email }}</p>
                      <p>{{ $parent->user->address->phone }}</p>
                      <button class="btn btn-success btn-oval" type="button">Edit</button>
                   </div>
                </div>
             </div>
            @endforeach 
        </div>
    </div>
    <hr>
    <!-- authorized section -->
    <div class="content-heading">
       <!-- START Language list-->
       <div class="pull-right">
          <div class="btn-group">
             <button class="btn btn-primary waves-effect m-b-5" data-toggle="modal" data-target="#newChild" data-backdrop="false"> <i class="fa fa-plus m-r-5 btn-fa"></i> <span> @lang('New Authorization')</span></button>
          </div>
       </div>
       <h3>Authorised Pick Up Users</h3>
    </div>
    <div class="child-parent">
        <div class="row">
            <div class="col-md-6">
               <div class="panel panel-primary">
                     <div class="panel-body">
                        <div class="row row-table">
                           <div class="col-xs-5 text-center">
                                @if($child->photo =="")
                                    <img src="{{asset('/img/portrait.png')}}" alt="@lang('User Image')"
                                         class=""/>
                                @else
                                    <img class="" src="{{ asset('storage/' . $child->photo) }}" alt="@lang('User Image')">
                                @endif
                           </div>
                           <div class="col-xs-7">
                              <h3 class="mt0">Patricia Ellys</h3>
                              <ul class="list-unstyled">
                                 <li class="mb-sm">
                                    <em class="fa fa-envelope fa-fw"></em>patricia@gmail.com</li>
                                 <li class="mb-sm">
                                    <em class="fa fa-phone fa-fw"></em>0708153683</li>
                                 <li class="mb-sm">
                                    <em class="fa fa-key fa-fw"></em>123456</li>
                                 <li class="mb-sm">
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
                                @if($child->photo =="")
                                    <img src="{{asset('/img/portrait.png')}}" alt="@lang('User Image')"
                                         class=""/>
                                @else
                                    <img class="" src="{{ asset('storage/' . $child->photo) }}" alt="@lang('User Image')">
                                @endif
                           </div>
                           <div class="col-xs-7">
                              <h3 class="mt0">Patricia Ellys</h3>
                              <ul class="list-unstyled">
                                 <li class="mb-sm">
                                    <em class="fa fa-envelope fa-fw"></em>patricia@gmail.com</li>
                                 <li class="mb-sm">
                                    <em class="fa fa-phone fa-fw"></em>0708153683</li>
                                 <li class="mb-sm">
                                    <em class="fa fa-key fa-fw"></em>123456</li>
                                 <li class="mb-sm">
                                    <em class="fa fa-check-circle-o fa-fw"></em>Brother</li>
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