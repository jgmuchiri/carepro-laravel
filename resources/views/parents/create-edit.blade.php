@extends('layouts.dashboard')

@section('title') @lang('Parents')
@endsection

@section('content')
<div class="content-wrapper">
    <div class="content-heading">
        <div class="pull-right">
          <div class="btn-group">
             <a href="{{ route('parents.index') }}" class="btn btn-primary waves-effect m-b-5"> <i class="fa fa-arrow-left m-r-5 btn-fa"></i> <span> @lang('Back to all parents')</span></a>
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
              {{ !empty($role->id) ? __('Edit') : __('Create')  }} @lang('Parent') 
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
                                <input id="name" class="form-control" required="" autofocus="" name="name" type="text" value="{{ old('name', $parent->name) }}" autofocus required>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} col-md-6">
                                <label for="email">E-Mail Address*</label>
                                <input id="email" class="form-control" required="" name="email" type="email" value="{{ old('email', $parent->email) }}">
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} col-md-6">
                                <label for="password">Password*</label>
                                <input class="form-control" id="password" required="" name="password" type="password" value="{{ old('password') }}">
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label for="password-confim">Confirm Password*</label>
                                <input id="password-confirm" class="form-control" required="" name="password_confirmation" type="password" value="{{ old('password_confirmation') }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group{{ $errors->has('photo_uri') ? ' has-error' : '' }} col-md-6">
                                <label for="photo_uri">Photo*</label>
                                <input name="photo_uri" type="file" class="form-control" id="photo_uri">
                                @if ($errors->has('photo_uri'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('photo_uri') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('dob') ? ' has-error' : '' }} col-md-6">
                                <label for="dob">DOB*</label>
                                <input id="dob" class="form-control" required="" name="dob" type="date" value="{{ old('dob', $parent->dob) }}">
                                @if ($errors->has('dob'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('dob') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group{{ $errors->has('pin') ? ' has-error' : '' }} col-md-6">
                                <label for="pin">PIN*</label>
                                <input id="pin" class="form-control" required="" name="pin" type="text" value="{{ old('pin', $parent->pin) }}">
                                @if ($errors->has('pin'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('pin') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('is_primary') ? ' has-error' : '' }} col-md-6">
                                <label for="is_primary"></label>
                                <div class="checkbox c-checkbox needsclick">
                                    <label class="needsclick">
                                        <input class="needsclick" type="checkbox" id="is_primary" value="{{ old('pin', $parent->is_primary) }}">
                                        <span class="fa fa-check"></span>Is Primary Parent?</label>
                                </div> 
                                @if ($errors->has('is_primary'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('is_primary') }}</strong>
                                    </span>
                                @endif
                            </div>

                        </div>

                        @include('partials.address-form')

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
