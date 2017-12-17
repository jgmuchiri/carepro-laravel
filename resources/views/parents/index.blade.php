@extends('layouts.dashboard')

@section('title') @lang('Parents')
@endsection

@section('content')
<div class="content-wrapper">
    <div class="content-heading">
        @can('create', \App\Models\ChildParent::class)
        <div class="pull-right">
          <div class="btn-group">
             <a class="btn btn-primary waves-effect m-b-5" href="{{ route('parents.create')}}" > <i class="fa fa-plus m-r-5 btn-fa"></i> <span> @lang('New Parent')</span></a>
          </div>
       </div>
       @endcan
       <!-- END Language list-->@lang('Parents')
       <small data-localize="dashboard.WELCOME"></small>
    </div>
    <!-- END widgets box-->
    <div class="panel panel-default">
       <div class="panel-heading">
           <div class="row">
             <div class="col-lg-2">
                <div class="input-group">
                   <input class="input-sm form-control" type="text" placeholder="Search">
                   <span class="input-group-btn">
                      <button class="btn btn-sm btn-default" type="button">Search</button>
                   </span>
                </div>
             </div>
             <div class="col-lg-8"></div>
             <div class="col-lg-2">
                <div class="input-group pull-right">
                   <select class="input-sm form-control">
                      <option value="0">Bulk action</option>
                      <option value="1">Delete</option>
                      <option value="2">Clone</option>
                      <option value="3">Export</option>
                   </select>
                   <span class="input-group-btn">
                      <button class="btn btn-sm btn-default">Apply</button>
                   </span>
                </div>
             </div>
          </div>
       </div>
       <!-- START table-responsive-->
       <div class="table-responsive">
          <table class="table table-bordered table-hover" id="table-ext-1">
             <thead>
                <tr>
                   <th data-check-all>
                      <div class="checkbox c-checkbox" data-toggle="tooltip" data-title="Check All">
                         <label>
                            <input type="checkbox">
                            <span class="fa fa-check"></span>
                         </label>
                      </div>
                   </th>
                   <th>Picture</th>
                   <th>@lang('Name')</th>
                   <th></th>
                   <th></th>
                </tr>
             </thead>
             <tbody>
                @foreach ($parents as $parent)
                <tr>
                   <td>
                      <div class="checkbox c-checkbox">
                         <label>
                            <input type="checkbox">
                            <span class="fa fa-check"></span>
                         </label>
                      </div>
                   </td>
                   <td>
                      <div class="media">
                         <img class="img-responsive img-circle" src="{{ asset('storage/' . $parent->photo_uri) }}" alt="Image">
                      </div>
                   </td>
                   <td>{{ $parent->user->name }}</td>
                   <td></td>
                   <td></td>
                </tr>
                @endforeach

             </tbody>
          </table>
       </div>
    </div>
 </div>

@stop

@push('modals')
    <div class="modal fade" id="newParent" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">@lang('New Parent Registration')</h4>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('parents.store') }}" enctype="multipart/form-data" id="form-add">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="name">Name*</label>
                            <input id="name" class="form-control" required="" autofocus="" name="name" type="text" autofocus required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">E-Mail Address*</label>
                            <input id="email" class="form-control" required="" name="email" type="email">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="password">Password*</label>
                            <input class="form-control" id="password" required="" name="password" type="password" value="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="password-confim">Confirm Password*</label>
                            <input id="password-confirm" class="form-control" required="" name="password_confirmation" type="password" value="">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="photo_uri">Photo*</label>
                            <input name="photo_uri" type="file" id="photo_uri">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="dob">DOB*</label>
                            <input id="dob" class="form-control" required="" name="dob" type="date">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="pin">PIN*</label>
                            <input id="pin" class="form-control" required="" name="pin" type="text" value="{{ old('pin', $parent->pin) }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="is_primary"></label>
                            <div class="checkbox c-checkbox needsclick">
                                <label class="needsclick">
                                    <input class="needsclick" type="checkbox" id="is_primary" value="{{ old('pin', $parent->is_primary) }}">
                                    <span class="fa fa-check"></span>Is Primary Parent?</label>
                            </div> 
                        </div>

                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="address_line_1">Address Line 1*</label>
                            <input id="address_line_1" class="form-control" required="" placeholder="Street and number, P.O. box, c/o." name="address_line_1" type="text">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="address_line_2">Address Line 2</label>
                            <input id="address_line_2" class="form-control" placeholder="Apartment, suite, unit, building, floor, etc." name="address_line_2" type="text">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-5">
                            <label for="city">City / Town / Village*</label>
                            <input id="city" class="form-control" required="" name="city" type="text">
                        </div>

                        <div class="form-group col-md-5">
                            <label for="state">State / Province / Region*</label>
                            <input id="state" class="form-control" required="" name="state" type="text">
                        </div>

                        <div class="form-group col-md-2">
                            <label for="zip_code">ZIP*</label>
                            <input id="zip_code" class="form-control" required="" name="zip_code" type="text">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="country">Country*</label>
                            <select id="country" class="form-control" required="" name="country"><option value="1">United States</option></select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="phone">Phone Number*</label>
                            <input id="phone" class="form-control" required="" name="phone" type="text">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <input class="btn btn-primary" type="submit" value="Save">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endpush
