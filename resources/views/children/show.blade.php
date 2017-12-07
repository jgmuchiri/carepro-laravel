@extends('layouts.dashboard')

@section('title') @lang('Children')
@endsection

@section('content')
<div class="content-wrapper">
    <div class="content-heading">
       <!-- START Language list-->
       <div class="pull-right">
          <div class="btn-group">
             @if ($child->is_active)
                @can('updateStatus', $child)
                    @if($child->status->name =='Active')
                          <a class="mb-sm btn btn-primary btn-quick" href="{{ route('children.deactivate', $child->id) }}">Check-out</a>
                    @else
                          <a class="mb-sm btn btn-success btn-quick" href="{{ route('children.deactivate', $child->id) }}">Check-in</a>
                    @endif
                @endcan
            @endif
          </div>
       </div>
       <!-- END Language list-->{{ $child->name }}
       <small class="td-text-success">{{ $child->status->name_label }}</small>
    </div>
    <!-- END widgets box-->
    <div class="panel panel-default" id="panelDemo1">
        <div class="panel-wrapper collapse in">
           <div class="panel-body">
                <div class="card card-transparent flex-row">
                    <ul class="nav nav-tabs nav-tabs-simple nav-tabs-left" id="tab-3">
                        <li style="padding-bottom: 15px;">
                            @if($child->photo =="")
                            <img src="{{asset('/img/portrait.png')}}" alt="@lang('User Image')"
                                 class="center-block img-responsive img-thumbnail"/>
                            @else
                                <img class="center-block img-responsive img-thumbnail" src="{{ asset('storage/' . $child->photo) }}" alt="@lang('User Image')">
                            @endif
                        </li>
                        <li class="nav-item active">
                            <a href="#" data-toggle="tab" data-target="#tab3hellowWorld">One</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" data-toggle="tab" data-target="#tab3FollowUs">Two</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" data-toggle="tab" data-target="#tab3Inspire">Three</a>
                        </li>
                    </ul>
                    <div class="tab-content ">
                        <div class="tab-pane active" id="tab3hellowWorld">
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
                                            <input id="name" class="form-control input-lg" placeholder="Apartment, suite, unit, building, floor, etc." name="name" type="text" value="{{ $child->name }}">
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
                            <hr>
                            <div class="content-heading">
                               <!-- START Language list-->
                               <div class="pull-right">
                                  <div class="btn-group">
                                     <button class="btn btn-primary waves-effect m-b-5" data-toggle="modal" data-target="#newChild" data-backdrop="false"> <i class="fa fa-plus m-r-5 btn-fa"></i> <span> @lang('Assign Parent/Guardian')</span></button>
                                  </div>
                               </div>
                               <h3>Parents/Guardians</h3>
                            </div>
                            <div class="child-parent">
                                <div class="row">
                                    @foreach($parents as $parent)
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
                        </div>
                        <div class="tab-pane " id="tab3FollowUs">
                        <h3>
                        “ Nothing is <span class="semi-bold">impossible</span>, the word
                        itself says 'I'm <span class="semi-bold">possible</span>'! ”
                        </h3>
                        <p>
                        A style represents visual customizations on top of a layout. By editing a style, you can use Squarespace's visual interface to customize your...
                        </p>
                        <br>
                        <p class="pull-right">
                        <button class="btn btn-default btn-cons" type="button">White</button>
                        <button class="btn btn-success btn-cons" type="button">Success</button>
                        </p>
                        </div>
                        <div class="tab-pane" id="tab3Inspire">
                        <h3>
                        Follow us &amp; get updated!
                        </h3>
                        <p>
                        Instantly connect to what's most important to you. Follow your friends, experts, favorite celebrities, and breaking news.
                        </p>
                        <br>
                        </div>
                    </div>
                </div>
           </div>
           <div class="panel-footer">Panel Footer</div>
        </div>
    </div>


    <!-- end row -->
 </div>
@stop


