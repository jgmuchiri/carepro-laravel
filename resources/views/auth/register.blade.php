@extends('frontend.layouts.app')

@section('content')

<div class="section-empty section-item">
    <div class="container content">
        <div class="row">
            <div class="col-md-10 col-md-offset-1 login-box shadow-1 ">
                <div class="text-center">
                    <h2 style="padding-bottom:15px;">@lang('Register')</h2>
                </div>
                <form method="POST" class="form-box" action="{{ url('register') }}" accept-charset="UTF-8">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-6">
                            <p>Name *</p>
                            <input class="form-control form-value" required="" name="name" type="text" value="{{ old('name') }}">
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <small>{{ $errors->first('name') }}</small>
                                </span>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <p>E-Mail Address *</p>
                            <input name="email" type="email" class="form-control form-value" required="" value="{{ old('email') }}">
                            @if ($errors->has('email'))
                                <span class="help-block has-error">
                                    <small>{{ $errors->first('email') }}</small>
                                </span>
                            @endif
                        </div>
                    </div>
                    <hr class="space xs" />
                    <div class="row">
                        <div class="col-md-6">
                            <p>Password *</p>
                            <input required="" name="password"  type="password" class="form-control form-value" value="{{ old('password') }}">
                            @if ($errors->has('password'))
                                <span class="help-block has-error">
                                    <small>{{ $errors->first('password') }}</small>
                                </span>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <p>Confirm Password *</p>
                            <input type="password" required="" name="password_confirmation" class="form-control form-value" value="{{ old('password_confirmation') }}">
                            @if ($errors->has('password_confirmation'))
                                <span class="help-block has-error">
                                    <small>{{ $errors->first('password_confirmation') }}</small>
                                </span>
                            @endif
                        </div>
                    </div>
                    <hr class="space xs" />
                    @include('partials.address-form')
                    <button class="btn-sm btn" type="submit">Register</button>
                    <div>
                        <a href="{{ route('login') }}" style="float:right;">@lang('Already have an account')?</a>
                    </div>
                </form>
                <p style="padding-top: 40px;" class="text-center">@lang('By registering your account, you agree to the') <a href="https://stripe.com/us/connect-account/legal" class="btn-text" target="_blank">@lang('Stripe Connected Account Agreement')</a>.</p>
            </div>
        </div>
    </div>
</div>
@endsection