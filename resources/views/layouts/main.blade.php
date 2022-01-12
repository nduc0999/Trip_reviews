<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="TemplateMo">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&display=swap" rel="stylesheet">

    <title>@yield('title')- Trip Review</title>


    <!-- Bootstrap core CSS -->
    <link href="{{ asset('main/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">


    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="{{ asset('main/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('main/css/templatemo-stand-blog.css') }}">
    <link rel="stylesheet" href="{{ asset('main/css/owl.css') }}">
    <link rel="stylesheet" href="{{ asset('main/css/custom.css') }}">
    

    @yield('head')

  </head>

  <body>

    <!-- ***** Preloader Start ***** -->
    {{-- <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>   --}}
    <!-- ***** Preloader End ***** -->
    

    <!-- Header -->
    <header class="">
      <nav class="navbar navbar-expand-lg">
        <div class="container">
          {{-- <a class="navbar-brand" href="{{ route('home') }}"><h2>Trip Review<em>.</em></h2></a> --}}
          <a class="navbar-brand" href="{{ route('home') }}"><img src="{{ asset('main/images/logo3.png') }}" id='logo-brand' alt=""></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" 
            aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation" style="border-radius: 10px">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item @if(url()->current() == route('propose.show')) active @endif">
                <a class="nav-link" href="{{ route('propose.show') }}"><i class="fa fa-hospital-o mr-2" aria-hidden="true"></i>Đề xuất
                  <span class="sr-only">(current)</span>
                </a>
              </li> 
              <li class="nav-item">
                <a class="nav-link {{ url()->current() == route('list.post.review')? 'active':'' }}" href="{{ route('list.post.review') }}"><i class="fa fa-pencil-square-o fa-lg mr-2" aria-hidden="true"></i>Đánh giá</a>
              </li>
              <li class="nav-item @if(url()->current() == route('travel')) active @endif">
                <a class="nav-link" href="{{ route('travel') }}"><i class="fa fa-heart-o fa-lg mr-2" aria-hidden="true"></i>Chuyến đi</a>
              @guest
                </li>
                  <li class="nav-item @if(url()->current() == route('login.page') | url()->current() == route('register.page')) active @endif }}">
                  <a class="nav-link" href="{{ route('login.page') }}">Đăng nhập</a>
                </li>
              @endguest
              @auth
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" style="padding-top: 0px" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ Auth::user()->fullName() }}
                    <img src="{{ Auth::user()->img_avatar }}" alt="Avatar" class="avatar">
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    @if (Auth::user()->email_verified_at == null)
                        <a class="dropdown-item" href="#">Xác nhận tài khoản email</a>
                    @endif
                    <a class="dropdown-item" href="{{route('profile.user',['name' => Str::slug(Auth::user()->fullName()),'id'=>Auth::id()])}}">Xem tiểu sử</a>
                    <a class="dropdown-item" href="#">Thông tin tài khoản</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('logout') }}">Đăng xuất</a>
                  </div>
                </li>
              @endauth
            </ul>
          </div>
        </div>
      </nav>
    </header>

    <!-- Page Content -->
    <!-- Banner Starts Here -->
    
    <!-- Banner Ends Here -->




   @yield('content')

    
    <footer>
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <ul class="social-icons">
              <li><a href="#">Facebook</a></li>
              <li><a href="#">Twitter</a></li>
              <li><a href="#">Behance</a></li>
              <li><a href="#">Linkedin</a></li>
              <li><a href="#">Dribbble</a></li>
            </ul>
          </div>
          <div class="col-lg-12">
            <div class="copyright-text">
              <p>Copyright 2020 Stand Blog Co.
                    
                 | Design: <a rel="nofollow" href="https://templatemo.com" target="_parent">TemplateMo</a></p>

            </div>
          </div>
        </div>
      </div>
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="{{ asset('main/vendor/jquery/jquery.min.js') }}"></script>
   
    <script src="{{ asset('main/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Additional Scripts -->
   
    <script src="{{ asset('main/js/owl.js') }}"></script>
    <script src="{{ asset('main/js/slick.js') }}"></script>
    <script src="{{ asset('main/js/isotope.js') }}"></script>
    <script src="{{ asset('main/js/accordions.js') }}"></script>
    
    @yield('script')
  
    <script src="{{ asset('main/js/custom.js') }}"></script>
    <script language = "text/Javascript"> 
      cleared[0] = cleared[1] = cleared[2] = 0; //set a cleared flag for each field
      function clearField(t){                   //declaring the array outside of the
      if(! cleared[t.id]){                      // function makes it static and global
          cleared[t.id] = 1;  // you could use true and false, but that's more typing
          t.value='';         // with more chance of typos
          t.style.color='#fff';
          }
      }
    </script>

  </body>
</html>