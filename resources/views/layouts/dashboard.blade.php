<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<script>
        window.Laravel = {!! json_encode(['csrfToken' => csrf_token()]) !!};
	</script>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="description" content="tykcare admin panel">
	<meta name="keywords" content="admin">
	<title>{{config('app.name')}}</title>
	<link rel="stylesheet" href="{{ url('assets/vendor/fontawesome/css/font-awesome.min.css') }}">
	<link rel="stylesheet" href="{{ url('assets/vendor/simple-line-icons/css/simple-line-icons.css') }}">
	<link rel="stylesheet" href="{{ url('assets/vendor/animate.css/animate.min.css') }}">
	<link rel="stylesheet" href="{{ url('assets/vendor/whirl/dist/whirl.css') }}">
	<link rel="stylesheet" href="{{ url('assets/vendor/weather-icons/css/weather-icons.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ url('assets/vendor/icon-pack-1/font/flaticon.css') }}">
	<link rel="stylesheet" href="{{ url('assets/css/bootstrap.css') }}" id="bscss">
	<link rel="stylesheet" href="{{ url('assets/css/app.css') }}" id="maincss">
	@stack('styles')
	@if(\App::environment('production'))
		<script type="text/javascript">
            (function (i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function () {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
                a = s.createElement(o),
                    m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

			{{-- TODO: Make this a proper config value --}}
            ga('create', '{{config('app.google_analytics')}}', 'auto');
            ga('send', 'pageview');
		</script>
	@endif
</head>

<body>
<div id="app" class="wrapper">
	<header class="topnavbar-wrapper">
		<nav class="navbar topnavbar" role="navigation">
			<div class="navbar-header">
				<a class="navbar-brand" href="#/">
					<div class="brand-logo">
						<img class="img-responsive" height="30px" src="{{ url('assets/img/logo.png') }}" alt="App Logo">
					</div>
					<div class="brand-logo-collapsed">
						<img class="img-responsive" src="{{ url('assets/img/logo-sg.png') }}" alt="App Logo">
					</div>
				</a>
			</div>
			<div class="nav-wrapper">
				<ul class="nav navbar-nav">
					<li>
						<a class="hidden-xs" href="#" data-trigger-resize="" data-toggle-state="aside-collapsed">
							<em class="fa fa-navicon"></em>
						</a>
						<a class="visible-xs sidebar-toggle" href="#" data-toggle-state="aside-toggled"
						   data-no-persist="true">
							<em class="fa fa-navicon"></em>
						</a>
					</li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li>
						<a href="#" data-search-open="">
							<em class="icon-magnifier"></em>
						</a>
					</li>
					<li class="active">
						<a href="/support">
							<em class="icon-question visible-xs"></em>
							<span class="visible-lg visible-md">@lang('Help')</span>
						</a>
					</li>
					<li>
						<a href="#">
							<em class="icon-speech visible-xs"></em>
							<span class="visible-lg visible-md">Messages</span>
						</a>
					</li>
					<li class="dropdown dropdown-list visible-lg visible-md">
						<a href="#" data-toggle="dropdown">
							<span>Notifications</span>
						</a>
						<ul class="dropdown-menu animated flipInX">
							<li>
								<div class="list-group">
									<a class="list-group-item" href="#">
										<div class="media-box">
											<div class="pull-left">
												<em class="fa fa-twitter fa-2x text-info"></em>
											</div>
											<div class="media-box-body clearfix">
												<p class="m0">New followers</p>
												<p class="m0 text-muted">
													<small>1 new follower</small>
												</p>
											</div>
										</div>
									</a>
									<a class="list-group-item" href="#">
										<div class="media-box">
											<div class="pull-left">
												<em class="fa fa-envelope fa-2x text-warning"></em>
											</div>
											<div class="media-box-body clearfix">
												<p class="m0">New e-mails</p>
												<p class="m0 text-muted">
													<small>You have 10 new emails</small>
												</p>
											</div>
										</div>
									</a>
									<a class="list-group-item" href="#">
										<div class="media-box">
											<div class="pull-left">
												<em class="fa fa-tasks fa-2x text-success"></em>
											</div>
											<div class="media-box-body clearfix">
												<p class="m0">Pending Tasks</p>
												<p class="m0 text-muted">
													<small>11 pending task</small>
												</p>
											</div>
										</div>
									</a>
									<!-- last list item-->
									<a class="list-group-item" href="#">
										<small>More notifications</small>
										<span class="label label-danger pull-right">14</span>
									</a>
								</div>
								<!-- END list group-->
							</li>
						</ul>
						<!-- END Dropdown menu-->
					</li>
					<li class="visible-xs">
						<a href="">
							<em class="icon-bell"></em>
						</a>
					</li>
					<!-- END Alert menu-->
					<li>
						<a href="#">
							<em class="icon-basket visible-xs"></em>
							<span class="visible-lg visible-md">@lang('Upgrade')</span>
						</a>
					</li>
					<li>
						<a href="{{ route('account.profile') }}">
							<em class="icon-user visible-xs"></em>
							<span class="visible-lg visible-md">@lang('Profile')</span>
						</a>
					</li>
					@if(!empty($user))
						<li>
							<a href="{{ route('logout') }}"
							   onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
								<em class="icon-login"></em>
							</a>

							<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
								{{ csrf_field() }}
							</form>
						</li>
				@endif
				<!-- END Offsidebar menu-->
				</ul>
				<!-- END Right Navbar-->
			</div>
			<!-- END Nav wrapper-->
			<!-- START Search form-->
			<form class="navbar-form" role="search" action="">
				<div class="form-group has-feedback">
					<input class="form-control" type="text" placeholder="Type and hit enter ...">
					<div class="fa fa-times form-control-feedback" data-search-dismiss=""></div>
				</div>
				<button class="hidden btn btn-default" type="submit">@lang('Submit')</button>
			</form>
			<!-- END Search form-->
		</nav>
		<!-- END Top Navbar-->
	</header>
	<!-- sidebar-->
	<aside class="aside">
		<!-- START Sidebar (left)-->
		<div class="aside-inner">
			<side-nav></side-nav>
		</div>

		<!-- END Sidebar (left)-->
	</aside>
	<!-- offsidebar-->

	<!-- Main section-->
	<section>
		<!-- Page content-->
		@if(!empty($user) && $user->confirmed === false)
			<div class="callout callout-danger text-center text-danger">
				<i style="font-size:60px;" class="fa fa-exclamation-triangle"></i>
				<h5 class="">
					@lang('Your account is not confirmed yet.')
					@lang('Please follow instructions received on the email.')
				</h5>
				<a href="{{ route('auth.resend-verification') }}">@lang('Click here to resend confirmation email')</a>

			</div>
		@else
			@if ($user->role->name == \App\Models\Permissions\Role::TENANT_ROLE)
				{{-- @if ($user->onGenericTrial() && !$user->subscribed('main'))
					<div class="alert alert-warning" role="alert">
						@lang('You are currently on a trial.') <a href="{{ route('subscriptions.subscribe') }}">@lang('Subscribe now')</a>
						@lang('to avoid any service interruptions').
					</div>
				@elseif (!empty($user->trial_ends_at) && !$user->subscribed('main'))
					<div class="alert alert-warning" role="alert">
						@lang('You are currently not subscribed to a plan.') <a href="{{ route('subscriptions.subscribe') }}">@lang('Subscribe now')</a>
						@lang('to avoid any service interruptions').
					</div>
				@endif --}}
			@endif
			@yield('content')
			<router-view></router-view>
		@endif
	</section>
	<!-- Page footer-->
	<footer>
		<span>&copy; A&M Digital Technlogies</span>
	</footer>
</div>
<!-- =============== VENDOR SCRIPTS ===============-->
<!-- MODERNIZR-->
<script src="{{ url('assets/vendor/modernizr/modernizr.custom.js') }}"></script>
<!-- MATCHMEDIA POLYFILL-->
<script src="{{ url('assets/vendor/matchMedia/matchMedia.js') }}"></script>
<script src="{{mix('/js/app.js')}}"></script>
<!-- JQUERY-->
 {{-- <script src="{{ url('assets/vendor/jquery/dist/jquery.js') }}"></script> --}}
<!-- BOOTSTRAP-->
{{-- <script src="{{ url('assets/vendor/bootstrap/dist/js/bootstrap.js') }}"></script> --}}
<!-- STORAGE API-->
<script src="{{ url('assets/vendor/jQuery-Storage-API/jquery.storageapi.js') }}"></script>
<!-- JQUERY EASING-->
<script src="{{ url('assets/vendor/jquery.easing/js/jquery.easing.js') }}"></script>
<!-- ANIMO-->
<script src="{{ url('assets/vendor/animo.js/animo.js') }}"></script>
<!-- SLIMSCROLL-->
<script src="{{ url('assets/vendor/slimScroll/jquery.slimscroll.min.js') }}"></script>

<!-- =============== PAGE VENDOR SCRIPTS ===============-->
<!-- SPARKLINE-->
<script src="{{ url('assets/vendor/sparkline/index.js') }}"></script>
<!-- FLOT CHART-->
<script src="{{ url('assets/vendor/flot/jquery.flot.js') }}"></script>
<script src="{{ url('assets/vendor/flot.tooltip/js/jquery.flot.tooltip.min.js') }}"></script>
<script src="{{ url('assets/vendor/flot/jquery.flot.resize.js') }}"></script>
<script src="{{ url('assets/vendor/flot/jquery.flot.pie.js') }}"></script>
<script src="{{ url('assets/vendor/flot/jquery.flot.time.js') }}"></script>
<script src="{{ url('assets/vendor/flot/jquery.flot.categories.js') }}"></script>
<script src="{{ url('assets/vendor/flot-spline/js/jquery.flot.spline.min.js') }}"></script>
<!-- EASY PIE CHART-->
<script src="{{ url('assets/vendor/jquery.easy-pie-chart/dist/jquery.easypiechart.js') }}"></script>
<!-- MOMENT JS-->
<script src="{{ url('assets/vendor/moment/min/moment-with-locales.min.js') }}"></script>

<script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
<script src="https://unpkg.com/imagesloaded@4/imagesloaded.pkgd.min.js"></script>
<!-- =============== APP SCRIPTS ===============-->
<script src="{{ url('assets/js/app.js') }}"></script>

<script src="https://js.stripe.com/v2/"></script>
<script src="https://js.stripe.com/v3/"></script>
@include('partials.flash')
@stack('scripts')
@stack('modals')
<script type="text/javascript">
    $('.modal ').insertAfter($('#app'));
</script>

</body>


</html>
