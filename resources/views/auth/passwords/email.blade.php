@extends('layouts.logged-out')

@section('content')
<div class="wrapper">
    <div class="full-screen register main">
        <div class="section">
            <div class="row" id="pwd-container">
                
                <div class="col-md-4 offset-md-4">
                      <section class="login-form text-center">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form method="post" action="{{ route('password.email') }}" role="login">
                          <img src="{{ url('assets/img/logo.png') }}" class="img-responsive" alt="" />
                            <p style="font-size: 20px;"><strong>@lang('Reset Password')</strong></p>
                          {{ csrf_field() }}
                          <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                             <input type="email" name="email" placeholder="Email" required class="form-control input-lg" required/>
                            @if ($errors->has('email'))
                                <span class="help-block has-danger">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif 
                          </div>
                                            
                            <button type="submit" name="go" class="btn btn-primary btn-block">@lang('Send Password Reset Link')</button>

                            <div>
                              <a href="{{ route('login') }}">@lang('Back to Login')</a>
                            </div>
                          
                        </form>
                      </section>  
                 </div>
              </div>            
        </div>
    </div>
</div>
@endsection
