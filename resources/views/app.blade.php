<!DOCTYPE html>
<html lang="en">

<head>
    <meta name=”robots” content=”noindex”>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Writer Admin - Administrator Area. Very Limited Access">

    <link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
    <title>Payment Gateway - 24Seven Developers</title>
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap"
        rel="stylesheet">
    {{-- font awesome --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/font awesome/css/font-awesome.css') }}">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/icofont.css') }}">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/themify.css') }}">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/flag-icon.css') }}">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/feather-icon.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/scrollbar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/chartist.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/date-picker.css') }}">


    @yield('styles')
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/custom.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/bootstrap.css') }}">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <link id="color" rel="stylesheet" href="{{ asset('assets/css/color-1.css') }}" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/responsive.css') }}">
</head>

<body>
    <div class="loader-wrapper">
        <div class="loader-index"><span></span></div>
        <svg>
            <defs></defs>
            <filter id="goo">
                <fegaussianblur in="SourceGraphic" stddeviation="11" result="blur"></fegaussianblur>
                <fecolormatrix in="blur" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="goo">
                </fecolormatrix>
            </filter>
        </svg>
    </div>
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        <!-- Page Header Start-->
        <div class="page-header">
            <div class="header-wrapper row m-0">
                <form class="form-inline search-full col" action="#" method="get">
                    <div class="form-group w-100">
                        <div class="Typeahead Typeahead--twitterUsers">
                            <div class="u-posRelative">
                                <input class="demo-input Typeahead-input form-control-plaintext w-100" type="text"
                                    placeholder="Search" name="q" title="" autofocus>
                                <div class="spinner-border Typeahead-spinner" role="status"><span
                                        class="sr-only">Loading...</span>
                                </div><i class="close-search" data-feather="x"></i>
                            </div>
                            <div class="Typeahead-menu"></div>
                        </div>
                    </div>
                </form>
                <div class="header-logo-wrapper col-auto p-0">
                    <div class="logo-wrapper"><a href="/"><img class="img-fluid"
                                src="{{ asset('assets/images/logo/logo.png') }}" alt=""></a></div>
                    <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle"
                            data-feather="align-center"></i>
                    </div>
                </div>
                <div class="left-header col horizontal-wrapper ps-0">
                </div>
                <div class="nav-right col-8 pull-right right-header p-0">
                    <ul class="nav-menus">
                        <li> <span class="header-search"><i data-feather="search"></i></span></li>
                        <li class="maximize"><a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()"><i
                                    data-feather="maximize"></i></a></li>
                        <li class="profile-nav onhover-dropdown p-0 me-0">
                            <div class="media profile-media"><img class="b-r-10"
                                    src="{{ asset('assets/images/dashboard/profile.jpg') }}" alt="">
                                <div class="media-body"><span>{{Auth::user()->name}}</span>
                                    <p class="mb-0 font-roboto">{{ucfirst(Auth::user()->role) . ' Admin'}} <i
                                            class="middle fa fa-angle-down"></i></p>
                                </div>
                            </div>
                            <ul class="profile-dropdown onhover-show-div">
                                <li><a href="#"><i data-feather="user"></i><span>Account </span></a></li>
                                <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();"><i data-feather="log-in">
                                        </i><span>Log Out</span></a></li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </ul>
                        </li>
                    </ul>
                </div>
                <script class="result-template" type="text/x-handlebars-template">
                    <div class="ProfileCard u-cf">
            <div class="ProfileCard-avatar"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay m-0"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg></div>
            <div class="ProfileCard-details">
            <div class="ProfileCard-realName">name</div>
            </div>
            </div>
          </script>
                <script class="empty-template" type="text/x-handlebars-template">
                    <div class="EmptyMessage">Your search turned up 0 results. This most likely means the backend is down, yikes!</div>
                </script>
            </div>
        </div>
        <!-- Page Header Ends -->
        <!-- Page Body Start-->
        <div class="page-body-wrapper">
            <!-- Page Sidebar Start-->
            <div class="sidebar-wrapper">
                <div>
                    <div class="logo-wrapper"><a href="/"><img class="img-fluid for-light"
                                src="{{ asset('assets/images/logo/logo.png') }}" alt=""><img class="img-fluid for-dark"
                                src="{{ asset('assets/images/logo/logo.png') }}" alt=""></a>
                        <div class="back-btn"><i class="fa fa-angle-left"></i></div>
                    </div>
                    <div class="logo-icon-wrapper"><a href="/"><img class="img-fluid"
                                src="{{ asset('assets/images/logo/logo-icon.png') }}" alt=""></a></div>
                    <nav class="sidebar-main">
                        <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
                        <div id="sidebar-menu">
                            <ul class="sidebar-links" id="simple-bar">
                                <li class="back-btn"><a href="/"><img class="img-fluid"
                                            src="{{ asset('assets/images/logo/logo-icon.png') }}" alt=""></a>
                                    <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2"
                                            aria-hidden="true"></i></div>
                                </li>
                                <li class="sidebar-main-title">
                                    <div>
                                        <h6 id="greeting">Navigation</h6>
                                        <p>24Seven Gateway</p>
                                    </div>
                                </li>
                                <style>
                                    .my-icon {
                                        margin-right: 6px;
                                        font-size: 20px;
                                    }

                                    .active-tab {
                                        background-color: rgba(34, 7, 107, 0.06);
                                        color: #2575fc !important;
                                    }
                                </style>
                                <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title link-nav {{Route::currentRouteName() === 'home' ? 'active-tab' : ''}}"
                                        href="{{route('home')}}"><i class="fa fa-dashboard my-icon">
                                        </i><span>Dashboard</span></a>
                                </li>
                                <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title link-nav {{explode('.', Route::currentRouteName())[0] === 'apps' ? 'active-tab' : ''}}"
                                        href="{{route('apps.index')}}"><i class="fa fa-briefcase my-icon"> </i>
                                        Apps</a>
                                </li>
                                <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title link-nav {{explode('.', Route::currentRouteName())[0] === 'transactions' ? 'active-tab' : ''}}"
                                        href="{{route('transactions.index')}}"><i class="fa fa-usd my-icon"> </i>
                                        Transactions</a>
                                </li>
                                <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title link-nav {{explode('.', Route::currentRouteName())[0] === 'admin.show_check_deposits' ? 'active-tab' : ''}}"
                                        href="{{route('admin.show_check_deposits')}}"><i class="fa fa-usd my-icon"> </i>
                                        Check Deposits</a>
                                </li>
                                <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title link-nav {{explode('.', Route::currentRouteName())[0] === 'complete_failed_transactions' ? 'active-tab' : ''}}"
                                        href="{{route('complete_failed_transactions')}}"><i class="fa fa-refresh my-icon"> </i>
                                        Refresh Transactions</a>
                                </li>
                            </ul>
                        </div>
                        <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
                    </nav>
                </div>
            </div>
            <!-- Page Sidebar Ends-->
            @yield('content')
            <!-- footer start-->

        </div>
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 footer-copyright text-center">
                        <p class="mb-0">Copyright 2021 © 24Seven Developers Payment Gateway</p>
                    </div>
                </div>
            </div>
        </footer>
    </div> <!-- latest jquery-->
    <script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>
    <!-- Bootstrap js-->
    <script src="{{ asset('assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <!-- feather icon js-->
    <script src="{{ asset('assets/js/icons/feather-icon/feather.min.js') }}"></script>
    <script src="{{ asset('assets/js/icons/feather-icon/feather-icon.js') }}"></script>
    <!-- scrollbar js-->
    <!-- Sidebar jquery-->
    <script src="{{ asset('assets/js/config.js') }}"></script>
    <!-- scrollbar js-->
    <script src="{{ asset('assets/js/scrollbar/simplebar.js') }}"></script>
    <script src="{{ asset('assets/js/scrollbar/custom.js') }}"></script>
    <script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>
    @yield('scripts')
    {{-- <script src="{{ asset('assets/js/dashboard/default.js') }}"></script> --}}
    <script src="{{ asset('assets/js/notify/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('assets/js/notify/index.js') }}"></script>
    <script src="{{ asset('assets/js/confirm.js') }}"></script>
    <!-- Theme js-->
    <script src="{{ asset('assets/js/script.js') }}"></script>
</body>

</html>
