<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"/>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script>
        window.Laravel ='<?php echo json_encode(['csrfToken' => csrf_token()]); ?>';
    </script>
    <link rel="apple-touch-icon" sizes="57x57" href="/img/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/img/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/img/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/img/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/img/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/img/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/img/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/img/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/img/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/img/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/img/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/img/favicon/favicon-16x16.png">
    <link rel="manifest" href="/img/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/img/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">


    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    {{-- TODO: Replace with daycare name --}}
    <title>{{env('COMPANY_NAME')}}</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'/>
    <meta name="viewport" content="width=device-width"/>
    @if(\App::environment('production'))
        <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    @endif

    <link href="/css/themify-icons.css" rel="stylesheet">
    <link href="/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="/css/font-awesome.min.css" rel="stylesheet">

    <link href="/css/fc.css" rel="stylesheet">
    <link href="/css/sweetalert.css" rel="stylesheet">

    <link href="/css/style.css" rel="stylesheet"/>

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
            ga('create', '{{env('GOOGLE_ANALYTICS')}}', 'auto');
            ga('send', 'pageview');
        </script>
    @endif
</head>
<body>

<div id="app">
    <div class="wrapper">
        <div class="sidebar" data-background-color="white" data-active-color="danger">
            <!--
                Tip 1: you can change the color of the sidebar's background using: data-background-color="white | black"
                Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
            -->
            <div class="sidebar-wrapper">
                <?php $logo = 'img/logo.png'; ?>
                @if(file_exists($logo))
                    <div class="logo" style="background-image:url('/{{$logo}}')">
                        <a class="navbar-brand" href="/">&nbsp;&nbsp;</a>
                    </div>
                @else
                    <div class="logo">
                        <a href="/" class="simple-text">
                            {{-- TODO: Make this come from actual company --}}
                            {{env('COMPANY_NAME')}}<br/>
                            <span style="font-size: 12px;">{{env('SLOGAN')}}</span>
                        </a>
                    </div>
                @endif

                <ul class="nav">
                    <li class="{{ $route_name === "home" ? 'active  bg-warning' : '' }}">
                        <a href="{{ route('home') }}">
                            <i class="ti-panel"></i>
                            <p>@lang('Dashboard')</p>
                        </a>
                    </li>

                    <li class="@if($route_name=="children") active  bg-warning @endif">
                        <a href="/children" style="color:#5101ed">
                            <i class="fa fa-child"></i>
                            <p>@lang('Children')</p>
                        </a>
                    </li>

                    @can('edit', \App\Models\ChildParent::class)
                        <li class="{{ $route_name == 'parents.index' ? "active  bg-warning": "" }}">
                            <a href="{{ route('parents.index') }}">
                                <i class="fa fa-users"></i>
                                <p>@lang('Parents')</p>
                            </a>
                        </li>
                    @endcan

                    @can('showGeneric', \App\Models\Groups\Group::class)
                        <li class="{{ $route_name == 'groups.index' ? "active  bg-warning": "" }}">
                            <a href="{{ route('groups.index') }}">
                                <i class="fa fa-users"></i>
                                <p>@lang('Groups')</p>
                            </a>
                        </li>
                    @endcan

                    @can('edit', \App\Models\Staff::class)
                        <li class="{{ $route_name == 'staff.index' ? "active  bg-warning": ""}}">
                            <a href="{{ route('staff.index') }}">
                                <i class="fa fa-users"></i>
                                <p>@lang('Staff Members')</p>
                            </a>
                        </li>
                    @endcan

                    {{--<li class="{{($route_name=="messages" || $route_name=="templates")?"active  bg-warning":""}}">--}}
                    {{--<a href="/messages/admin">--}}
                    {{--<i class="fa fa-envelope-o"></i>--}}
                    {{--<p>Messaging</p>--}}
                    {{--</a>--}}
                    {{--</li>--}}

                    <li class="{{($route_name=="users" || $route_name=="user")?"active  bg-warning":""}}">
                        <a href="/users">
                            <i class="ti-user"></i>
                            <p>@lang('Users')</p>
                        </a>
                    </li>

                    @can('edit', \App\Models\Permissions\Role::class)
                        <li class="{{ $route_name == 'roles.index' ? "active  bg-warning": ""}}">
                            <a href="{{ route('roles.index') }}">
                                <i class="fa fa-key"></i>
                                <p>@lang('Roles')</p>
                            </a>
                        </li>
                    @endcan

                    <li class="{{($route_name=='birthdays')?"active  bg-warning":""}}">
                        <a href="/birthdays">
                            <i class="fa fa-gift"></i>
                            <p>@lang('Birthdays')</p>
                        </a>
                    </li>

                    <li class="{{($route_name === 'account.profile')?"active  bg-warning":""}}">
                        <a href="{{ route('account.profile') }}">
                            <i class="ti-user"></i>
                            <p>@lang('Profile')</p>
                        </a>
                    </li>

                    @can('update', \App\Models\Subscriptions\Plan::class)
                        <li class="{{($route_name === 'admin.settings.edit')?"active  bg-warning":""}}">
                            <a href="{{ route('admin.settings.edit') }}">
                                <i class="ti-settings"></i>
                                <p>@lang('Application Settings')</p>
                            </a>
                        </li>
                    @endcan
                </ul>
            </div>
        </div>

        <div class="main-panel">
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle">
                            <span class="sr-only">@lang('Toggle navigation')</span>
                            <span class="icon-bar bar1"></span>
                            <span class="icon-bar bar2"></span>
                            <span class="icon-bar bar3"></span>
                        </button>
                        <span class="navbar-brand">@yield('title',__('Dashboard'))</span>
                    </div>
                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-nav navbar-left">

                        </ul>
                        <ul class="nav navbar-nav navbar-right">

                            <li>
                                <a href="/" target="_blank">
                                    <i class="fa fa-windows"></i>
                                    <p>@lang('Site')</p>
                                </a>
                            </li>

                            <li>
                                <a href="/support">
                                    <i class="ti-help"></i>
                                    <p>@lang('Help')</p>
                                </a>
                            </li>

                            @if(!empty($user))
                                <li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                        <i class="ti-lock"></i>
                                        <p>@lang('Logout')</p>
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            @endif
                        </ul>

                    </div>
                </div>
            </nav>

            <div class="content">
                <div class="container-fluid">
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
                            @if ($user->onGenericTrial() && !$user->subscribed('main'))
                                <div class="alert alert-warning" role="alert">
                                    @lang('You are currently on a trial.') <a href="{{ route('subscriptions.subscribe') }}">@lang('Subscribe now')</a>
                                    @lang('to avoid any service interruptions').
                                </div>
                            @elseif (!empty($user->trial_ends_at) && !$user->subscribed('main'))
                                <div class="alert alert-warning" role="alert">
                                    @lang('You are currently not subscribed to a plan.') <a href="{{ route('subscriptions.subscribe') }}">@lang('Subscribe now')</a>
                                    @lang('to avoid any service interruptions').
                                </div>
                            @endif
                        @endif
                        @yield('content')
                        <router-view></router-view>
                    @endif
                </div>
            </div>

            <footer class="footer">
                <div class="container-fluid">
                    <nav class="pull-left">
                    </nav>
                    <div class="copyright pull-right">
                        {{ Carbon\Carbon::now()->year }}
                        {{-- TODO: Make this come from proper place --}}
                        &copy; <a href="#">{{env('COMPANY_NAME')}}</a>
                    </div>
                </div>
            </footer>
        </div>

    </div>
</div>

<script src="/js/jquery.js"></script>

<script src="{{asset('js/bootstrap.min.js')}}"></script>

<script src="/js/bootstrap-notify.js"></script>
<script src="/js/moment.min.js"></script>
<script src="/js/sweetalert2.js"></script>

<script src="/js/fullcalendar.min.js" type="text/javascript"></script>

<script src="/js/paper-dashboard.js"></script>
@if(\App::environment('local'))
    <script src="/js/numeral.min.js"></script>
@else
    <script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/1.4.5/numeral.min.js"></script>
@endif

<script src="/js/jquery.maskedinput.min.js"></script>
<script>
    $("input[name=phone]").mask("(999) 999-9999? x9999");
</script>
<script src="{{asset('js/global.js')}}"></script>
<script src="https://js.stripe.com/v2/"></script>
<script src="https://js.stripe.com/v3/"></script>

<script src="{{asset('js/app.js')}}"></script>

@include('partials.flash')
@stack('scripts')
@stack('modals')
</body>
</html>
