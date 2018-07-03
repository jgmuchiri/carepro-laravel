@extends('frontend.layouts.app')

@section('content')

<div class="section-empty section-item">
    <div class="container content">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 login-box shadow-1 ">
              <div class="text-center">
                <h2 style="padding-bottom:15px;">login</h2>
              </div>
              <form action="" class="form-box" action="{{ route('login') }}" method="post">
                {{ csrf_field() }}
                  <div class="row">
                      <div class="col-md-12">
                          <p>Email</p>
                          <input name="email" placeholder="Email" type="text" class="form-control form-value">
                          @if ($errors->has('email'))
                              <span class="help-block has-error">
                                  <small>{{ $errors->first('email') }}</small>
                              </span>
                          @endif
                          <hr class="space xs" />
                          <p>Password</p>
                          <input name="password" id="password" placeholder="Password" type="password" class="form-control form-value">
                          @if ($errors->has('password'))
                              <span class="help-block has-error">
                                  <small>{{ $errors->first('password') }}</small>
                              </span>
                          @endif
                          <hr class="space s" />
                          <button type="submit" class="anima-button btn-sm btn"><i class="fa fa-sign-in"></i>Login</button>
                          <div>
                            <a href="{{ route('password.request') }}" style="float:right;">@lang('Forgot Your Password')?</a>
                          </div>
                      </div>
                  </div>
              </form>
            </div>
        </div>
    </div>
</div>
@endsection
