<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="csrf-token" content="{{ csrf_token() }}">

   <script>
      window.Laravel = {!! json_encode([
          'csrfToken' => csrf_token(),
      ]) !!};
   </script>
   <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
   <meta name="description" content="tykcare admin panel">
   <meta name="keywords" content="admin">
   <title>{{env('COMPANY_NAME')}}</title>
   <!-- =============== VENDOR STYLES ===============-->
   <!-- FONT AWESOME-->
   <link rel="stylesheet" href="{{ url('assets/vendor/fontawesome/css/font-awesome.min.css') }}">
   <!-- SIMPLE LINE ICONS-->
   <link rel="stylesheet" href="{{ url('assets/vendor/simple-line-icons/css/simple-line-icons.css') }}">
   <!-- ANIMATE.CSS-->
   <link rel="stylesheet" href="{{ url('assets/vendor/animate.css/animate.min.css') }}">
   <!-- WHIRL (spinners)-->
   <link rel="stylesheet" href="{{ url('assets/vendor/whirl/dist/whirl.css') }}">
   <!-- =============== PAGE VENDOR STYLES ===============-->
   <!-- WEATHER ICONS-->
   <link rel="stylesheet" href="{{ url('assets/vendor/weather-icons/css/weather-icons.min.css') }}">
   <link rel="stylesheet" type="text/css" href="{{ url('assets/vendor/icon-pack-1/font/flaticon.css') }}">
   <!-- =============== BOOTSTRAP STYLES ===============-->
   <link rel="stylesheet" href="{{ url('assets/css/bootstrap.css') }}" id="bscss">
   <!-- =============== APP STYLES ===============-->
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
            ga('create', '{{env('GOOGLE_ANALYTICS')}}', 'auto');
            ga('send', 'pageview');
        </script>
    @endif
</head>

<body>
   <div id="app" class="wrapper">
      <!-- top navbar-->
      <header class="topnavbar-wrapper">
         <!-- START Top Navbar-->
         <nav class="navbar topnavbar" role="navigation">
            <!-- START navbar header-->
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
            <!-- END navbar header-->
            <!-- START Nav wrapper-->
             <div class="nav-wrapper">
               <!-- START Left navbar-->
               <ul class="nav navbar-nav">
                  <li>
                     <!-- Button used to collapse the left sidebar. Only visible on tablet and desktops-->
                     <a class="hidden-xs" href="#" data-trigger-resize="" data-toggle-state="aside-collapsed">
                        <em class="fa fa-navicon"></em>
                     </a>
                     <!-- Button to show/hide the sidebar on mobile. Visible on mobile only.-->
                     <a class="visible-xs sidebar-toggle" href="#" data-toggle-state="aside-toggled" data-no-persist="true">
                        <em class="fa fa-navicon"></em>
                     </a>
                  </li>
               </ul>
               <!-- END Left navbar-->
               <!-- START Right Navbar-->
               <ul class="nav navbar-nav navbar-right">
                  <!-- Search icon-->
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
                        <span class="visible-lg visible-md" >Messages</span>
                     </a>
                  </li>
                  <!-- START Alert menu-->
                  <li class="dropdown dropdown-list visible-lg visible-md">
                     <a href="#" data-toggle="dropdown">
                        <span>Notifications</span>
                     </a>
                     <!-- START Dropdown menu-->
                     <ul class="dropdown-menu animated flipInX">
                        <li>
                           <!-- START list group-->
                           <div class="list-group">
                              <!-- list item-->
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
                              <!-- list item-->
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
                              <!-- list item-->
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
                     <a href="" >
                        <em class="icon-bell"></em>
                     </a>
                  </li>
                  <!-- END Alert menu-->
                  <li>
                     <a href="#">
                        <em class="icon-basket visible-xs"></em>
                        <span class="visible-lg visible-md">Upgrade</span>
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
               <button class="hidden btn btn-default" type="submit">Submit</button>
            </form>
            <!-- END Search form-->
         </nav>
         <!-- END Top Navbar-->
      </header>
      <!-- sidebar-->
      <aside class="aside">
         <!-- START Sidebar (left)-->
         <div class="aside-inner">
            <nav class="sidebar" data-sidebar-anyclick-close="">
               <!-- START sidebar nav-->
               <ul class="nav">
                  <!-- Iterates over all sidebar items-->
                  <li class="nav-heading ">
                     <span data-localize="sidebar.heading.HEADER">Main Navigation</span>
                  </li>
                  <li class="{{ $route_name == "home" ? 'active  bg-warning' : '' }}">
                     <a href="{{ url('/home') }}" title="@lang('Dashboard')">
                        <img src="{{ url('assets/vendor/icon-pack-1/svg/home-icon.png') }}" width="36" height="36" />
                        <span data-localize="sidebar.nav.DASHBOARD">@lang('Dashboard')</span>
                     </a>
                  </li>
                  <li class="@if($route_name=="children") active  bg-warning @endif">
                     <a href="{{ url('/children') }}" title="@lang('Children')">
                        <img src="{{ url('assets/vendor/icon-pack-1/svg/child.svg') }}" width="36" height="36" />
                        <span data-localize="sidebar.nav.WIDGETS">@lang('Children')</span>
                     </a>
                  </li>
                  @can('edit', \App\Models\ChildParent::class)
                  <li class="{{ $route_name == 'parents.index' ? "active  bg-warning": "" }}">
                     <a href="/parents" title="@lang('Parents')">
                        <img src="{{ url('assets/vendor/icon-pack-1/svg/couple.png') }}" width="36" height="36" />
                        <span data-localize="sidebar.nav.WIDGETS">@lang('Parents')</span>
                     </a>
                  </li>
                  @endcan

                  @can('edit', \App\Models\Staff::class)
                  <li class="{{ url() == '/staff' ? "active  bg-warning": ""}}">
                     <a href="/staff" title="@lang('Staff Members')">
                        <img src="{{ url('assets/vendor/icon-pack-1/svg/telemarketer.png') }}" width="36" height="36" />
                        <span data-localize="sidebar.nav.WIDGETS">@lang('Staff Members')</span>
                     </a>
                  </li>
                  @endcan

                  <li class=" ">
                     <a href="" title="Billing">
                        <img src="{{ url('assets/vendor/icon-pack-1/svg/billing.png') }}" width="36" height="36" />
                        <span data-localize="sidebar.nav.WIDGETS">Billing</span>
                     </a>
                  </li>

                  @can('showGeneric', \App\Models\Groups\Group::class)
                  <li class="{{ $route_name == 'groups.index' ? "active  bg-warning": "" }}">
                     <a href="/groups" title="@lang('Groups')">
                        <img src="{{ url('assets/vendor/icon-pack-1/svg/group.png') }}" width="36" height="36" />
                        <span data-localize="sidebar.nav.WIDGETS">@lang('Groups')</span>
                     </a>
                  </li>
                  @endcan

                  <li class=" ">
                     <a href="#admins" class="accordion-toggle collapsed" title="Admin" data-toggle="collapse">
                        <img src="{{ url('assets/vendor/icon-pack-1/svg/admin.png') }}" width="36" height="36" />
                        <span data-localize="sidebar.nav.form.FORM">Admin</span>
                     </a>
                     <ul class="nav sidebar-subnav collapse" id="admins">
                        <li class="sidebar-subnav-header">Forms</li>
                        <li class=" ">
                           <a href="" title="Settings">
                              <span data-localize="sidebar.nav.form.SETTINGS">Settings</span>
                           </a>
                        </li>
                        <li class=" ">
                           <a href="" title="Users">
                              <span data-localize="sidebar.nav.form.USERS">Users</span>
                           </a>
                        </li>
                        <li class=" ">
                           <a href="" title="Roles & Permissions">
                              <span>Roles & Permissions</span>
                           </a>
                        </li>
                        <li class=" ">
                           <a href="" title="Subcriptions">
                              <span>Subcriptions</span>
                           </a>
                        </li>
                     </ul>
                  </li>
               </ul>
               <div class="help-box">
                  <h5 class="visible-lg text-muted m-t-0">A&M Digital Technlogies</h5>
                  <h5 class="text-muted m-t-0">&copy; 2017 All Rights Reserved</h5>
               </div>
               <!-- END sidebar nav-->
            </nav>
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
   <script src="{{ url('assets/vendor/modernizr/modernizr.custom.js"') }}></script>
   <!-- MATCHMEDIA POLYFILL-->
   <script src="{{ url('assets/vendor/matchMedia/matchMedia.js') }}"></script>
   <!-- JQUERY-->
   <script src="{{ url('assets/vendor/jquery/dist/jquery.js') }}"></script>
   <!-- BOOTSTRAP-->
   <script src="{{ url('assets/vendor/bootstrap/dist/js/bootstrap.js') }}"></script>
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
   <!-- =============== APP SCRIPTS ===============-->
   <script src="{{ url('assets/js/app.js') }}"></script>
   <script src="{{mix('/js/app.js')}}"></script>
   <script src="https://js.stripe.com/v2/"></script>
   <script src="https://js.stripe.com/v3/"></script>
   @include('partials.flash')
   @stack('scripts')
   @stack('modals')
   <script type="text/javascript" >
      $('.modal ').insertAfter($('#app'));
   </script>

</body>


</html>
