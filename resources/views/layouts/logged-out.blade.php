<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
	<title>{{ config('app.name') }}</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'/>
	<meta name="viewport" content="width=device-width"/>
	<link href="{{ url('website/css/bootstrap.min.css') }}" rel="stylesheet"/>
	<link href="{{ url('website/css/styles.css') }}" rel="stylesheet"/>
	<link href="{{ url('website/css/demo.css') }}" rel="stylesheet"/>
	<link href='http://fonts.googleapis.com/css?family=Montserrat:400,300,700' rel='stylesheet' type='text/css'>
	<link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet">
	<link href="{{ url('website/css/nucleo-icons.css') }}" rel="stylesheet">
	@stack('styles')
	<script>
        window.Laravel = '<?php echo json_encode(['csrfToken' => csrf_token()]); ?>';
        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', '{{config('app.google-analytics')}}']);
        _gaq.push(['_trackPageview']);
        (function () {
            var ga = document.createElement('script');
            ga.type = 'text/javascript';
            ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(ga, s);
        })();
	</script>
</head>

<body>
<nav class="navbar navbar-expand-lg fixed-top {{ Request::is('/') ? "navbar-transparent" : "" }}" {!! Request::is('/') ? 'color-on-scroll="500"' : '' !!}>
	<div class="container">
		<div class="navbar-translate">
			<div class="navbar-header">
				<img src="{{ url('assets/img/logo.png') }}" alt="logo">
			</div>
			<button class="navbar-toggler navbar-burger" type="button" data-toggle="collapse"
					data-target="#navbarToggler" aria-controls="navbarTogglerDemo02" aria-expanded="false"
					aria-label="Toggle navigation">
				<span class="navbar-toggler-bar"></span>
				<span class="navbar-toggler-bar"></span>
				<span class="navbar-toggler-bar"></span>
			</button>
		</div>
		<div class="collapse navbar-collapse">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item">
					<a class="nav-link" href="{{ url('/') }}" data-scroll="true">Home</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/#features" data-scroll="true">Features</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="{{ route('plans') }}" data-scroll="true">@lang('Plans')</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="{{route('contact')}}" data-scroll="true">Contact Us</a>
				</li>
				@if (Auth::guest())
					<li class="nav-item">
						<a class="nav-link" href="{{ url('/login') }}" data-scroll="true"
						>@lang('Login')</a>
					</li>
				@else
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->name }}</a>
						<ul class="dropdown-menu dropdown-menu-right dropdown-danger">
							<a class="dropdown-item" href="{{ url('home') }}">
								<i class="nc-icon nc-bank"></i>&nbsp;
								Dashboard
							</a>
							<a class="dropdown-item" href="{{ url('/logout') }}"
							   onclick="event.preventDefault();document.getElementById('logout-form').submit();">
								<i class="nc-icon nc-basket"></i>&nbsp; @lang('Logout')
							</a>
							<form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
								{{ csrf_field() }}
							</form>
						</ul>
					</li>
				@endif
			</ul>
		</div>
	</div>
</nav>

@if (session()->has('alert'))
	<div class="msg-alert alert alert-{{session()->has('alert-level')?session('alert-level'):'info'}}" style="position: fixed;top:0;z-index:3000;width:100%">
		{{session('alert')}}
	</div>
@endif

@if(isset($errors) && $errors->any())
	@foreach($errors->all() as $error)
		<div class="msg-alert alert alert-error"  style="position: fixed;top:0;z-index:3000;width:100%">{{$error}}</div>
	@endforeach
@endif
@stack('scripts')
@yield('content')
<footer class="footer footer-black footer-big">
	<div class="container">
		<div class="row">
			<div class="col-md-2 text-center col-sm-3 col-12 ml-auto mr-auto">
				<h4>{{config('app.name')}}</h4>
				<div class="social-area">
					<a class="btn btn-just-icon btn-round btn-facebook">
						<i class="fa fa-facebook" aria-hidden="true"></i>
					</a>
					<a class="btn btn-just-icon btn-round btn-twitter">
						<i class="fa fa-twitter" aria-hidden="true"></i>
					</a>
					<a class="btn btn-just-icon btn-round btn-google">
						<i class="fa fa-google-plus" aria-hidden="true"></i>
					</a>
				</div>
			</div>
			<div class="col-md-9 col-sm-9 col-12 ml-auto mr-auto">
				<div class="row">
					<div class="col-md-3 col-sm-3 col-6">
						<div class="links">
							<ul class="uppercase-links stacked-links">
								<li><a href="{{url('/')}}">Home</a></li>
							</ul>

						</div>
					</div>
					<div class="col-md-3 col-sm-3 col-6">
						<div class="links">
							<ul class="uppercase-links stacked-links">
								<li><a href="{{route('contact')}}">Contact Us</a></li>
							</ul>
						</div>
					</div>
					<div class="col-md-3 col-sm-3 col-6">
						<div class="links">
							<ul class="uppercase-links stacked-links">
								<li><a href="https://blog.tykcare.com">Blog</a></li>
							</ul>
						</div>
					</div>
					<div class="col-md-3 col-sm-3 col-6">
						<div class="links">
							<ul class="stacked-links">
								<li>
									<h4>
										{{--{{DB::table('users')->select('id')->count()}}<br/>--}}
										220
										<small>registered daycare centers</small>
									</h4>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<hr/>
				<div class="copyright">
					<div class="pull-left">
						&copy; {{date('Y').' '.config('app.name')}}
					</div>
					<div class="links pull-right">
						<ul>
							<li><a href="{{url('pages/privacy-policy')}}">Privacy Policy</a></li>
							|
							<li><a href="{{url('pages/terms-and-conditions')}}">Terms & Conditions</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</footer>
</body>

<script src="{{ url('website/js/jquery-3.2.1.min.js') }}" type="text/javascript"></script>
<script src="{{ url('website/js/jquery-ui-1.12.1.custom.min.js') }}" type="text/javascript"></script>
<script src="{{ url('website/js/popper.js') }}" type="text/javascript"></script>
<script src="{{ url('website/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ url('website/js/demo.js') }}"></script>
<!--  Plugins for presentation page -->
<script src="{{ url('website/js/presentation-page/main.js') }}"></script>

<!-- Sharrre plugin -->
<script src="{{ url('website/js/presentation-page/jquery.sharrre.js') }}"></script>
<script src="{{ url('website/js/fe-app.js') }}"></script>


</html>
