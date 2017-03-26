<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{env('COMPANY_NAME')}}</title>

    <link href="/css/app.css" rel="stylesheet">

    @stack('styles')
    <script>
        window.Laravel ='<?php echo json_encode(['csrfToken' => csrf_token()]); ?>';
    </script>
</head>
<body>
<div class="container container-fluid">

    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <?php $logo = 'img/logo.png'; ?>
                @if(file_exists($logo))
                    <div class="logo" style="background:url('/{{$logo}}'); width: 200px;
                            height: 46px;
                            background-size: contain;
                            margin-left: -10px;
                            background-position-y: 2px;
                            background-repeat: no-repeat;">
                        <a class="navbar-brand" href="/">&nbsp;&nbsp;</a>
                    </div>

                @else
                    <div class="logo">

                        <a class="navbar-brand" href="/">
                            {{env('COMPANY_NAME')}}
                        </a>
                    </div>
                @endif
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <ul class="nav navbar-nav">
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ url('/logout') }}"
                                       onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>


    @yield('content')
</div>

<script src="https://js.stripe.com/v2/"></script>
<script src="https://js.stripe.com/v3/"></script>
<script src="/js/app.js"></script>
@stack('scripts')
</body>
</html>
