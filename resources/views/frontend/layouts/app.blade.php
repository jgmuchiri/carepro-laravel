<!DOCTYPE html>
<!--[if lt IE 10]> <html  lang="en" class="iex"> <![endif]-->
<!--[if (gt IE 10)|!(IE)]><!-->
<html lang="en">
<!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Signflow - Ultra Modern Tech Template</title>
    <meta name="description" content="Multipurpose HTML template.">
    <script src="{{ url('frontend/scripts/jquery.min.js') }}"></script>
    <link rel="stylesheet" href="{{ url('frontend/scripts/bootstrap/css/bootstrap.css') }}">
    <script src="{{ url('frontend/scripts/script.js') }}"></script>
    <link rel="stylesheet" href="{{ url('frontend/style.css') }}">
    <link rel="stylesheet" href="{{ url('frontend/css/content-box.css') }}">
    <link rel="stylesheet" href="{{ url('frontend/css/image-box.css') }}">
    <link rel="stylesheet" href="{{ url('frontend/css/animations.css') }}">
    <link rel="stylesheet" href="{{ url('frontend/css/components.css') }}">
    <link rel="stylesheet" href="{{ url('frontend/scripts/flexslider/flexslider.css') }}">
    <link rel="stylesheet" href="{{ url('frontend/scripts/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ url('frontend/scripts/php/contact-form.css') }}">
    <link rel="icon" href="{{ url('frontend/images/favicon.png') }}">
    <link rel="stylesheet" href="{{ url('frontend/skin.css') }}">
</head>
<body class="transparent-header">
    <header class="fixed-top scroll-change {{ Request::is('/') ? 'bg-transparent menu-transparent' : '' }}" data-menu-anima="fade-bottom">
        <div class="navbar navbar-default mega-menu-fullwidth navbar-fixed-top" role="navigation">
            <div class="navbar navbar-main">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle">
                            <i class="fa fa-bars"></i>
                        </button>
                        @if(Request::is('/'))
                        <a class="navbar-brand scroll-hide" href="/">
                            <img class="logo-default" src="{{ url('frontend/images/logo.png') }}" alt="logo" />
                            <img class="logo-retina" src="{{ url('frontend/images/logo-retina.png') }}" alt="logo" />
                        </a>
                        @endif
                        <a class="navbar-brand {{ Request::is('/') ? 'scroll-show' : '' }}" href="/">
                            <img class="logo-default" src="{{ url('frontend/images/logo-black.png') }}" alt="logo" />
                            <img class="logo-retina" src="{{ url('frontend/images/logo-retina-black.png') }}" alt="logo" />
                        </a>
                    </div>
                    <div class="collapse navbar-collapse">
                        <div class="nav navbar-nav navbar-right">
                            <ul class="nav navbar-nav">
                                <li class="">
                                    <a href="{{ url('/') }}" role="button">Home</a>
                                </li>
                                <li class="">
                                    <a href="#" role="button">Features</a>
                                </li>
                                <li class="">
                                    <a href="{{ url('/plans') }}">Plans</a>
                                </li>
                                <li class="">
                                    <a href="{{ url('/contact') }}">Contact</a>
                                </li>
                                @if(Auth::check())
                                <li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                        Log Out
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                                @else
                                <li class="">
                                    <a href="{{ url('/login') }}">Log In</a>
                                </li>
                                <li class="" style="padding-top:3px;padding-left:10px;">
                                    <button class="circle-button btn btn-sm" onclick="location.href = '{{ url('/register')}}';" style="padding:8px 25px;">start free trial</button>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    @yield('content')


    <i class="scroll-top scroll-top-mobile show fa fa-sort-asc"></i>
    @include('frontend.layouts._footer')
</body>

</html>
