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
    <link rel="stylesheet" href="{{ asset('main/css/footer.css') }}">
    

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
                    <img src="{{ Auth::user()->img_avatar == null ? 'https://drive.google.com/uc?id=1k4YLSor3SKwcT6v_3HcX_MCiDYkssn9V&export=media': Auth::user()->img_avatar }}" alt="Avatar" class="avatar">
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    @if (Auth::user()->email_verified_at == null)
                        <a class="dropdown-item" href="#">Xác nhận tài khoản email</a>
                    @endif
                    <a class="dropdown-item" href="{{route('profile.user',['name' => Str::slug(Auth::user()->fullName()),'id'=>Auth::id()])}}">Xem tiểu sử</a>
                    <a class="dropdown-item" href="{{route('password.change')}}">Thay đổi mật khẩu</a>
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

    
    {{-- <footer>
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
    </footer> --}}
    

    <footer class="new_footer_area bg_color">
        <div class="new_footer_top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="f_widget company_widget wow fadeInLeft" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInLeft;">
                            <h3 class="f-title f_600 t_color f_size_18">Giới thiệu</h3>
                            <p>TripReview là nền tảng đánh giá Homestay-Resort lớn nhất thế giới*, 
                              với 463 triệu lượt người dùng mỗi tháng**, giúp họ biến mỗi chuyến đi thành trải nghiệm tuyệt vời nhất. 
                              Du khách trên toàn thế giới sử dụng trang web và ứng dụng của Tripadvisor để duyệt hơn 859 triệu đánh giá 
                              và ý kiến về hàng triệu chỗ nghỉ.</p>
                        
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="f_widget about-widget pl_70 wow fadeInLeft" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInLeft;">
                            <h3 class="f-title f_600 t_color f_size_18">Download</h3>
                            <ul class="list-unstyled f_list">
                                <li><a href="#">Company</a></li>
                                <li><a href="#">Android App</a></li>
                                <li><a href="#">ios App</a></li>
                                <li><a href="#">Desktop</a></li>
                                <li><a href="#">Projects</a></li>
                                <li><a href="#">My tasks</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="f_widget about-widget pl_70 wow fadeInLeft" data-wow-delay="0.6s" style="visibility: visible; animation-delay: 0.6s; animation-name: fadeInLeft;">
                            <h3 class="f-title f_600 t_color f_size_18">Hỗ trợ</h3>
                            <ul class="list-unstyled f_list">
                        
                                <li><a href="#">FAQ</a></li>
                                <li><a href="#">Term &amp; conditions</a></li>
                                <li><a href="#">Reporting</a></li>
                                <li><a href="#">Support Policy</a></li>
                                <li><a href="#">Privacy</a></li>
                                <li>Hotline: 08484621xx</li>
                                <li>Email: TripReview@gmail.com</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="f_widget social-widget pl_70 wow fadeInLeft" data-wow-delay="0.8s" style="visibility: visible; animation-delay: 0.8s; animation-name: fadeInLeft;">
                            <h3 class="f-title f_600 t_color f_size_18">Trang thông tin</h3>
                            <div class="f_social_icon">
                                <a href="https://www.facebook.com/" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                <a href="https://twitter.com/" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                <a href="https://www.instagram.com/" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer_bg">
                <div class="footer_bg_one"></div>
                <div class="footer_bg_two"></div>
            </div>
        </div>
        <div class="footer_bottom">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-sm-7">
                        <p class="mb-0 f_400">© cakecounter Inc.. 2019 All rights reserved.</p>
                         <p>Copyright 2020 Stand Blog Co.
                    
                          | Design: <a rel="nofollow" href="https://templatemo.com" target="_parent">TemplateMo</a></p>
                    </div>
                    <div class="col-lg-6 col-sm-5 text-right">
                        <p>Made with <i class="icon_heart"></i> in <a href="http://cakecounter.com" target="_blank">CakeCounter</a></p>
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