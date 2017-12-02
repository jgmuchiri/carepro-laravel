<!doctype html>
<html lang="en">


<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="assets/img/favicon.ico">
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>{{ env('COMPANY_NAME') }}</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <link href="{{ url('website/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ url('website/css/styles.css') }}" rel="stylesheet"/>
    <link href="{{ url('website/css/demo.css') }}" rel="stylesheet" />

    <!--     Fonts and icons     -->
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,300,700' rel='stylesheet' type='text/css'>
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{ url('website/css/nucleo-icons.css') }}" rel="stylesheet">
    @stack('styles')
    <script>
        window.Laravel ='<?php echo json_encode(['csrfToken' => csrf_token()]); ?>';
    </script>

</head>

<body class="{{ Request::is('/') ? "presentation-page loading" : "" }}">
    <nav class="navbar navbar-expand-lg fixed-top {{ Request::is('/') ? "navbar-transparent" : "" }}" {!! Request::is('/') ? 'color-on-scroll="500"' : '' !!}>
        <div class="container">
            <div class="navbar-translate">
                <div class="navbar-header">
                    <img src="{{ url('assets/img/logo.png') }}" alt="logo">
                </div>
                <button class="navbar-toggler navbar-burger" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-bar"></span>
                    <span class="navbar-toggler-bar"></span>
                    <span class="navbar-toggler-bar"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}" data-scroll="true" href="javascript:void(0)">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="" data-scroll="true" href="javascript:void(0)">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="" data-scroll="true" href="javascript:void(0)">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('plans') }}" data-scroll="true" href="javascript:void(0)">@lang('Plans')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="" data-scroll="true" href="javascript:void(0)">Contact Us</a>
                    </li>

                    @if (Auth::guest())
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/login') }}" data-scroll="true" href="javascript:void(0)">@lang('Login')</a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle"  data-toggle="dropdown" href="javascript:void(0)">{{ Auth::user()->name }}</a>
                            <ul class="dropdown-menu dropdown-menu-right dropdown-danger">
                                <a class="dropdown-item" href="{{ url('home') }}"><i class="nc-icon nc-bank"></i>&nbsp; Dashboard</a>
                                <a class="dropdown-item" href="{{ url('/logout') }}"
                                       onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
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

    @yield('content')

    <footer class="footer footer-black footer-big">
        <div class="container">
            <div class="row">
                <div class="col-md-2 text-center col-sm-3 col-12 ml-auto mr-auto">
                    <h4>A&M Technologies</h4>
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
                                    <li>
                                        <a href="#paper-kit" >
                                            Home
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#paper-kit">
                                            Discover
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#paper-kit">
                                            Blog
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#paper-kit">
                                            Live Support
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#paper-kit">
                                            Money Back
                                        </a>
                                    </li>
                                </ul>

                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-6">
                            <div class="links">
                                <ul class="uppercase-links stacked-links">
                                    <li>
                                        <a href="#paper-kit">
                                           Contact Us
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#paper-kit">
                                           We're Hiring
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#paper-kit">
                                           About Us
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-6">
                            <div class="links">
                                <ul class="uppercase-links stacked-links">
                                    <li>
                                        <a href="#paper-kit">
                                            Portfolio
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#paper-kit">
                                           How it works
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#paper-kit">
                                           Testimonials
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-6">
                            <div class="links">
                                <ul class="stacked-links">
                                    <li>
                                        <h4>13.723<br /> <small>accounts</small></h4>
                                    </li>
                                    <li>
                                        <h4>55.234<br /> <small>downloads</small></h4>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                    <hr />
                    <div class="copyright">
                        <div class="pull-left">
                            &copy; <script>document.write(new Date().getFullYear())</script> A&M Digital Technologies
                        </div>
                        <div class="links pull-right">
                            <ul>
                                <li>
                                    <a href="#paper-kit">
                                        Company Policy
                                    </a>
                                </li>
                                |
                                <li>
                                    <a href="#paper-kit">
                                        Terms
                                    </a>
                                </li>
                                |
                                <li>
                                    <a href="#paper-kit">
                                        Privacy
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </footer>
</body>

    <!--  Plugins -->
    <!-- Core JS Files -->
    <script src="{{ url('website/js/jquery-3.2.1.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('website/js/jquery-ui-1.12.1.custom.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('website/js/popper.js') }}" type="text/javascript"></script>
    <script src="{{ url('website/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('website/js/paper-kitf066.js') }}"></script>
    <script src="{{ url('website/js/demo.js') }}"></script>
    <!--  Plugins for presentation page -->
    <script src="{{ url('website/js/presentation-page/main.js') }}"></script>

    <!-- Sharrre plugin -->
    <script src="{{ url('website/js/presentation-page/jquery.sharrre.js') }}"></script>

    @stack('scripts')

</html>
