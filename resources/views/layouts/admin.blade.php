<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      
    <title>@yield('title')</title>
    
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('dashboard/css/bootstrap.css') }}">
    
    <link rel="stylesheet" href="{{ asset('dashboard/vendors/iconly/bold.css') }}">

    <link rel="stylesheet" href="{{ asset('dashboard/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/css/app.css') }}">
    <link rel="shortcut icon" href="{{ asset('dashboard/images/favicon.svg" type="image/x-icon') }}">

    @yield('head')
</head>

<body>
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo">
                            <a href="{{ route('admin.home') }}"><img src="{{ asset('main/images/logo3.png') }}" alt="Logo" srcset="" style="height: 70px"></a>
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>
                        
                        <li class="sidebar-item {{ url()->current() == route('admin.home') ? 'active':''}} ">
                            <a href="{{ route('admin.home') }}" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                           <li class="sidebar-item">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Approval Post</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Post</span>
                            </a>
                        </li>

                        
                        <li class="sidebar-item  has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-stack"></i>
                                <span>Manager Review</span>
                            </a>
                            <ul class="submenu ">
                                <li class="submenu-item ">
                                    <a href="component-alert.html">Approval Review</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="component-badge.html">Hide Review</a>
                                </li>
                            </ul>
                        </li>

                        <li class="sidebar-item">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Manager Post</span>
                            </a>
                        </li>

                        <li class="sidebar-item {{ url()->current() == route('admin.manager.amenity') ? 'active':''}}">
                            <a href="{{ route('admin.manager.amenity') }}" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Manager Amenities</span>
                            </a>
                        </li>

                         <li class="sidebar-item">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Manager Roomtype</span>
                            </a>
                        </li>

                         <li class="sidebar-item">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Manager Location</span>
                            </a>
                        </li>

                         <li class="sidebar-item">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Manager Question</span>
                            </a>
                        </li>

                         <li class="sidebar-item">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Manager Customer</span>
                            </a>
                        </li>

                        
                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            @yield('content')

            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>2021 &copy; Mazer</p>
                    </div>
                    <div class="float-end">
                        <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by <a
                                href="http://ahmadsaugi.com">A. Saugi</a></p>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="{{ asset('dashboard/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('dashboard/js/bootstrap.bundle.min.js') }}"></script>
    
      <script src="{{ asset('main/vendor/jquery/jquery.min.js') }}"></script>
    {{-- <script src="{{ asset('dashboard/js/pages/dashboard.js') }}"></script> --}}
    @yield('script')
    <script src="{{ asset('dashboard/js/mazer.js') }}"></script>
</body>

</html>
