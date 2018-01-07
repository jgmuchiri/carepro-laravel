@extends('layouts.logged-out')

@section('content')
<div class="wrapper">
    <div class="pricing-4 section ">
        <div class="container">
            <div class="row bs-wizard hidden-xs" style="border-bottom:0;">

                <div class="col-4 bs-wizard-step complete">
                    <div class="text-center bs-wizard-stepnum">
                        <img src="{{ url('assets/vendor/icon-pack-1/svg/admin.png') }}" width="36" height="36">
                    </div>
                    <div class="progress"><div class="progress-bar"></div></div>
                    <a href="#" class="bs-wizard-dot"></a>
                    <div class="bs-wizard-info text-center">Plan</div>
                </div>

                <div class="col-4 bs-wizard-step active"><!-- complete -->
                    <div class="text-center bs-wizard-stepnum">
                        <img src="{{ url('assets/vendor/icon-pack-1/svg/child.svg') }}" width="36" height="36">
                    </div>
                    <div class="progress"><div class="progress-bar"></div></div>
                    <a href="#" class="bs-wizard-dot"></a>
                    <div class="bs-wizard-info text-center">User Registration</div>
                </div>

                <div class="col-4 bs-wizard-step disabled">
                    <div class="text-center bs-wizard-stepnum">
                        <img src="{{ url('assets/vendor/icon-pack-1/svg/group.png') }}" width="36" height="36" />
                    </div>
                    <div class="progress"><div class="progress-bar"></div></div>
                    <a href="#" class="bs-wizard-dot"></a>
                    <div class="bs-wizard-info text-center">Daycare Registration</div>
                </div>
            </div>
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
            <p class="text-center">@lang('By registering your account, you agree to the') <a href="https://stripe.com/us/connect-account/legal" target="_blank">@lang('Stripe Connected Account Agreement')</a>.</p>
        </div>
    </div>
</div>
@endsection
