@extends('layouts.dashboard')

@section('title') @lang('Parents')
@endsection

@section('content')
<div class="content-wrapper">
    <div class="content-heading">
        <div class="pull-right">
          <div class="btn-group">
             <a href="{{ route('parents.index') }}" class="btn btn-primary waves-effect m-b-5"> <i class="fa fa-plus m-r-5 btn-fa"></i> <span> @lang('Back to all parents')</span></a>
          </div>
       </div>
       <!-- END Language list-->@lang('Parents')
       <small data-localize="dashboard.WELCOME"></small>
    </div>
    <!-- END widgets box-->
    <div class="row">
        <div class="col-md-offset-1 col-md-10">
           <div class="panel panel-default">
           <div class="panel-heading">
              Edit @lang('Parent') 
           </div>
           <div class="panel-body">
              <div class="content">
                <div class="row">
                    <div class="col-md-12">
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

                        <div class="row text-center">
                            <div>
                                <input class="btn btn-primary" type="submit" value="Save">
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
@stop
