@extends('layouts.logged-out')

@section('content')
<div class="wrapper">
    <div class="pricing-4 section ">
        <div class="container">
            <div class="row">
                <div class="col-md-6 ml-auto mr-auto text-center">
                    <h2 class="title">@lang('Register')</h2>
                </div>
            </div>
            <div class="space-top"></div>
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <form method="POST" action="{{ url('register') }}" accept-charset="UTF-8" role="form">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-sm-6">
                               <div class="form-group">
                                    <label for="name" class="control-label">Name *</label>
                                    <input id="name" class="form-control" required="" autofocus="" name="name" type="text" value="{{ old('name') }}">
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div> 
                            </div>
                            <div class="col-sm-6">
                               <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                    <label for="email" class="control-label">E-Mail Address *</label>
                                    <input id="email" class="form-control" required="" name="email" type="email" value="{{ old('email') }}">
                                    @if ($errors->has('email'))
                                        <span class="help-block has-danger">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif 
                                </div> 
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                               <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                    <label for="password" class="control-label">Password *</label>
                                    <input class="form-control" id="password" required="" name="password" type="password" value="{{ old('password') }}">
                                    @if ($errors->has('password'))
                                        <span class="help-block has-danger">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div> 
                            </div>
                            <div class="col-sm-6">
                               <div class="form-group{{ $errors->has('password_confirmation') ? ' has-danger' : '' }}">
                                    <label for="password-confim" class="control-label">Confirm Password *</label>
                                    <input id="password-confirm" class="form-control" required="" name="password_confirmation" type="password" value="{{ old('password_confirmation') }}">
                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block has-danger">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
                                </div> 
                            </div>
                        </div>

                        @include('partials.address-form')

                        <div class="form-group text-center">
                            <div class="12">
                                <input class="btn btn-primary" type="submit" value="Register">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
