@extends('layouts.logged-out')

@section('content')
<div class="wrapper">
    <div class="full-screen register main">
        <div class="section">
            <div class="row" id="pwd-container">
                
                <div class="col-md-4 offset-md-4">
                  <section class="login-form">
                    <form method="post" action="{{ route('login') }}" role="login">
                      <img src="assets/img/logo.png" class="img-responsive" alt="" />
                      {{ csrf_field() }}
                      <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                         <input type="email" name="email" placeholder="Email" required class="form-control input-lg" />
                        @if ($errors->has('email'))
                            <span class="help-block has-danger">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif 
                      </div>

                      <div class="form-group {{ $errors->has('password') ? ' has-danger' : '' }}">
                          <input type="password" class="form-control input-lg" name="password" id="password" placeholder="Password" required="" />
                         @if ($errors->has('password'))
                            <span class="help-block has-danger">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                      </div>
                                          
                      <button type="submit" name="go" class="btn btn-lg btn-primary btn-block">@lang('Login')</button>
                      <div>
                        <a href="#">@lang('Forgot Your Password')?</a>
                      </div>
                      
                    </form>
                  </section>  
                  </div>
                                    

              </div>            
        </div>
    </div>
</div>
@endsection
