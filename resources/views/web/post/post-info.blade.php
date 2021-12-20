@extends('layouts.main')

@section('title', $post->name." Review" )

@section('head')
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css"/> --}}
    {{-- <link rel="stylesheet" href="{{ asset('dashboard/vendors/rater-js/style.css') }}"> --}}

    <!-- Magnific Popup core CSS file -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/magnific-popup@1.1.0/dist/magnific-popup.css">


    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
    integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
    crossorigin=""/>
    <link rel="stylesheet" href="{{ asset('main/css/loading.css') }}">
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
    integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
    crossorigin=""></script>
    

@endsection

@section('content')

    <div class="heading-page header-text">
        <div class="container ">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb" style="background-color:transparent;">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">{{ $post->type == 0? 'Homestay':'Resort'  }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $post->name }}</li>
                </ol>
            </nav>
        </div>
      <section class="page-heading shadow" style="background-image: url('{{ $post->img_wall }}'); height:400px;  position:relative ">
        <div class="avatar-name">
          <img src="{{ $post->img_avatar }}" alt="Avatar" class="avatar avatar-size-lg">
          <p style="color: white">{{ $post->name }}</p>
        </div>
      </section>
  
    </div>
    
    <!-- Banner Ends Here -->

    <section class="blog-posts grid-system">
      <div class="container shadow rounded">
        <div class="row p-4">
            <div class="col-lg-12">
                <h4>{{ $post->name }}</h4>
                  <fieldset class="rating">
                    <input type="radio" id="star5" name="rating" value="5" /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
                    <input type="radio" id="star4half" name="rating" value="4.5" checked /><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
                    <input type="radio" id="star4" name="rating" value="4" /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
                    <input type="radio" id="star3half" name="rating" value="3.5" /><label class="half" for="star3half" title="Meh - 3.5 stars"></label>
                    <input type="radio" id="star3" name="rating" value="3" /><label class = "full" for="star3" title="Meh - 3 stars"></label>
                    <input type="radio" id="star2half" name="rating" value="2.5" /><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
                    <input type="radio" id="star2" name="rating" value="2" /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                    <input type="radio" id="star1half" name="rating" value="1.5" /><label class="half" for="star1half" title="Meh - 1.5 stars"></label>
                    <input type="radio" id="star1" name="rating" value="1" /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
                    <input type="radio" id="starhalf" name="rating" value="0.5" /><label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
                  </fieldset>
            </div>
            <div class="col-lg-4">
                <div class="sidebar">
                    <div class="row">
                       
                        <div class="col-lg-12 mt-3">
                          <div class="sidebar-item categories">
                              <div class="sidebar-heading">
                              <h2 style="color:#f48840">Thông tin</h2>
                              </div>
                              <div class="content">
                                  <ul>
                                    <li>- Địa chỉ: {{ $post->address.", ".$post->district.', '.$post->streets.', '.$location->province }}.</li>
                                    <li>- Thời gian hoạt động: {{ $post->open.' - '.$post->closes }}.</li>
                                    <li>- Số lượng khách: {{ $post->min_guest.' - '.$post->max_guest }} người.</li>
                                    <li>- Sđt liên hệ: {{ $post->phone }}.</li>
                                    <li>- Email: {{ $post->email }}</li>
                                    <li>- Trang: {{ $post->link }}</li>
                                
                                  </ul>
                              </div>
                          </div>
                        </div>
                        
                        <div class="col-lg-12">
                        <div class="sidebar-item tags">
                            <div class="sidebar-heading">
                            <h2>Đánh giá sao</h2>
                            </div>
                            <div class="content">
                              <div class="row">
                                <div class="col-2 d-flex justify-content-center" style="padding: 0px">
                                  <span class='num-rate'>5.0</span>
                                </div>
                                <div class="col-10">
                                  <div class="row">
                                    <div class="col-12">
                                      Tuyệt vời
                                    </div>
                                    <div class="col-12">
                                      <div class="row">
                                        <div class="col-6 col-md-12 p-0">
                                          <fieldset class="rating">
                                            <input type="radio" id="star5" name="rating1" value="5" /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
                                            <input type="radio" id="star4half" name="rating1" value="4.5" checked /><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
                                            <input type="radio" id="star4" name="rating1" value="4" /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
                                            <input type="radio" id="star3half" name="rating1" value="3.5" /><label class="half" for="star3half" title="Meh - 3.5 stars"></label>
                                            <input type="radio" id="star3" name="rating1" value="3" /><label class = "full" for="star3" title="Meh - 3 stars"></label>
                                            <input type="radio" id="star2half" name="rating1" value="2.5" /><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
                                            <input type="radio" id="star2" name="rating1" value="2" /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                                            <input type="radio" id="star1half" name="rating1" value="1.5" /><label class="half" for="star1half" title="Meh - 1.5 stars"></label>
                                            <input type="radio" id="star1" name="rating1" value="1" /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
                                            <input type="radio" id="starhalf" name="rating1" value="0.5" /><label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
                                          </fieldset>
                                        </div>
                                        <span class="col-6 col-md-12">3000 đánh giá</span>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <hr>
                              <div class="row">
                                <div class="col-12 " style="display: flex;padding: 0;align-items: center;">
                                   <fieldset class="rating">
                                      <input type="radio" id="star5" name="rating3" value="5" checked/><label class = "full" for="star5" title="Awesome - 5 stars"></label>
                                      <input type="radio" id="star4half" name="rating3" value="4.5"  /><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
                                      <input type="radio" id="star4" name="rating3" value="4" /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
                                      <input type="radio" id="star3half" name="rating3" value="3.5" /><label class="half" for="star3half" title="Meh - 3.5 stars"></label>
                                      <input type="radio" id="star3" name="rating3" value="3" /><label class = "full" for="star3" title="Meh - 3 stars"></label>
                                      <input type="radio" id="star2half" name="rating3" value="2.5" /><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
                                      <input type="radio" id="star2" name="rating3" value="2" /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                                      <input type="radio" id="star1half" name="rating3" value="1.5" /><label class="half" for="star1half" title="Meh - 1.5 stars"></label>
                                      <input type="radio" id="star1" name="rating3" value="1" /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
                                      <input type="radio" id="starhalf" name="rating3" value="0.5" /><label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
                                    </fieldset>
                                    <span style="font-size: 15px">| Đánh giá dịch vụ</span>
                                </div>
                                 <div class="col-12" style="display: flex;padding: 0;align-items: center;" >
                                   <fieldset class="rating">
                                      <input type="radio" id="star5" name="rating4" value="5" /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
                                      <input type="radio" id="star4half" name="rating4" value="4.5" /><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
                                      <input type="radio" id="star4" name="rating4" value="4" checked/><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
                                      <input type="radio" id="star3half" name="rating4" value="3.5" /><label class="half" for="star3half" title="Meh - 3.5 stars"></label>
                                      <input type="radio" id="star3" name="rating4" value="3" /><label class = "full" for="star3" title="Meh - 3 stars"></label>
                                      <input type="radio" id="star2half" name="rating4" value="2.5" /><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
                                      <input type="radio" id="star2" name="rating4" value="2" /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                                      <input type="radio" id="star1half" name="rating4" value="1.5" /><label class="half" for="star1half" title="Meh - 1.5 stars"></label>
                                      <input type="radio" id="star1" name="rating4" value="1" /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
                                      <input type="radio" id="starhalf" name="rating4" value="0.5" /><label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
                                    </fieldset>
                                    <span style="font-size: 15px">| Đánh giá giá trị</span>
                                </div>
                                 <div class="col-12" style="display: flex;padding: 0;align-items: center;">
                                   <fieldset class="rating">
                                      <input type="radio" id="star5" name="rating5" value="5" /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
                                      <input type="radio" id="star4half" name="rating5" value="4.5"  /><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
                                      <input type="radio" id="star4" name="rating5" value="4" /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
                                      <input type="radio" id="star3half" name="rating5" value="3.5" checked /><label class="half" for="star3half" title="Meh - 3.5 stars"></label>
                                      <input type="radio" id="star3" name="rating5" value="3" /><label class = "full" for="star3" title="Meh - 3 stars"></label>
                                      <input type="radio" id="star2half" name="rating5" value="2.5" /><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
                                      <input type="radio" id="star2" name="rating5" value="2" /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                                      <input type="radio" id="star1half" name="rating5" value="1.5" /><label class="half" for="star1half" title="Meh - 1.5 stars"></label>
                                      <input type="radio" id="star1" name="rating5" value="1" /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
                                      <input type="radio" id="starhalf" name="rating5" value="0.5" /><label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
                                    </fieldset>
                                    <span style="font-size: 15px">| Đánh giá giấc ngủ</span>
                                </div>
                              </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
          </div>
          <div class="col-lg-8">
            <div class="all-blog-posts">
              <div class="row">
                <div class="col-lg-12">
                  <div class="blog-post">
                    <div class="blog-thumb">
                      <div class="row">
                        <div class="owl-photo owl-carousel">
                            @forelse ($photos as $item)
                                <div class="item">
                                    <img class="photo-item" src="{{ $item->path }}" alt="">
                                
                                </div>
                            @empty
                                 <div class="item">
                                    <img src="{{ asset('main/images/banner-item-04.jpg') }}" alt="">
                                
                                </div>
                            @endforelse
                                  
                        </div>
                        <div class="row col-12 album-photo" >
                          <div class="col-6 "  data-toggle="modal" data-target="#show-photo">
                            <img src="{{ $photos[0]->path }}" alt="" >
                            <div class="text-photo">
                              <i class="fa fa-camera" aria-hidden="true"></i>
                              <p> Ảnh phòng</p>
                            </div>
                          </div>
                          <div class="col-6">
                            <img src="{{ $post->img_avatar }}" alt=""  >
                            <div class="text-photo">
                              <i class="fa fa-hospital-o" aria-hidden="true"></i>
                              <p> Khách du lịch</p>
                            </div>
                          </div>
                        </div>
                      </div>
                                          
                    </div>
                    <div class="down-content">
                      <span>Giới thiệu</span>
              

                      <ul class="post-info">
                        <li><a href="#">Admin</a></li>
                        <li><a href="#">May 12, 2020</a></li>
                        <li><a href="#">10 Comments</a></li>
                      </ul>
                      <p>{{ $post->introduce }}</p>
                      <div class="post-options">
                        <div class="row">
                          <div class="col-6">
                            <ul class="post-tags">
                              <li><i class="fa fa-tags"></i></li>
                              <li><a href="#">Best Templates</a>,</li>
                              <li><a href="#">TemplateMo</a></li>
                            </ul>
                          </div>
                          <div class="col-6">
                            <ul class="post-share">
                              <li><i class="fa fa-share-alt"></i></li>
                              <li><a href="#">Facebook</a>,</li>
                              <li><a href="#"> Twitter</a></li>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-12">
                  <div class="down-content">
                    <span>Tiện nghi</span>
                    <hr>
                
                      <ul class="row">
                        @forelse ($amenity as $item)
                            <li class="col-12 col-md-6">- <strong>{{$item->name}}</strong>: {{$item->description}}</li>
                        @empty
                            <li>Không có tiện ích</li>
                        @endforelse

                      </ul>
                      <hr>
                      <span>Loại phòng</span>
                      
                      <ul class="row" >
                        @forelse ($roomtype as $item)
                            <li class="col-12 col-md-6">- <strong>{{$item->name}}</strong>: {{$item->description}}</li>
                        @empty
                            <li>Không có loại phòng</li>
                        @endforelse

                      </ul>
                     
                  </div>
                </div>
                <div class="col-md-12 mb-4">
                  <div  id="map" style="height: 375px; width: 100%; z-index:1;"></div> 
                  <button class="btn btn-show-map" data-toggle="modal" data-target="#show-map">
                    <i class="fa fa-expand" aria-hidden="true"></i> Toàn màn hình
                  </button>
                </div>
               
                <div class="col-lg-12" style="background-color: #f2f2f2;">

                  <div class="down-content">
                    <span>Đánh giá</span>    
                    <hr>      
                    <div class="sidebar-item comments">
                      <div class="sidebar-heading d-flex justify-content-between ">
                        <h2>{{$reviews->count()}} Đánh giá</h2>
                        <a href="{{ route('form.review',['slug' => Str::slug($post->name),'id'=>$post->id]) }}" class="btn" target="_blank" style="background-color: #f48840;color:white;"><i class="fa fa-edit"></i> Viết đánh giá</a>
                      </div>
                      <hr>
                      <div id="data-review">
                        @include('web.post.data-review')
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="sidebar-item submit-comment">
                    <div class="sidebar-heading">
                      <h2>Your comment</h2>
                    </div>
                    <div class="content">
                      <form id="comment" action="#" method="post">
                        <div class="row">
                          <div class="col-md-6 col-sm-12">
                            <fieldset>
                              <input name="name" type="text" id="name" placeholder="Your name" required="">
                            </fieldset>
                          </div>
                          <div class="col-md-6 col-sm-12">
                            <fieldset>
                              <input name="email" type="text" id="email" placeholder="Your email" required="">
                            </fieldset>
                          </div>
                          <div class="col-md-12 col-sm-12">
                            <fieldset>
                              <input name="subject" type="text" id="subject" placeholder="Subject">
                            </fieldset>
                          </div>
                          <div class="col-lg-12">
                            <fieldset>
                              <textarea name="message" rows="6" id="message" placeholder="Type your comment" required=""></textarea>
                            </fieldset>
                          </div>
                          <div class="col-lg-12">
                            <fieldset>
                              <button type="submit" id="form-submit" class="main-button">Submit</button>
                            </fieldset>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
         
        </div>
      </div>
    </section>

  <div class="modal fade " id="show-photo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  >
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document" style="z-index: 4" id="abc">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ảnh về {{ $post->name }}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="load-more">
          <div class="container">
             <h1>Ảnh của Resort</h1>    
              <p>
                <section class="img-gallery-magnific">
                  <div class="row" id="gallery-photo">
                    @forelse ($photos as $item)
                      <div class="magnific-img col-12 col-md-4 mt-2">
                        <a class="image-popup-vertical-fit" href="{{ $item->path }}" title="1.jpg">
                          <img src="{{ $item->path }}" alt="1.jpg" />
                        </a>
                      </div>

                    @empty
                      <div class="magnific-img  col-md-4">
                        <a class="image-popup-vertical-fit" href="https://unsplash.it/888/?random" title="1.jpg">
                          <img src="https://unsplash.it/888/?random" alt="1.jpg" />
                      
                        </a>
                      </div>
                    @endforelse

                  </div>
                </section>
                <div class="clear"></div>
              </p>

          </div>
        </div>
      
      </div>
    </div>
  </div>

  <div class="modal fade " id="show-map" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog size-map" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-map-marker" aria-hidden="true"></i> {{ $post->name }}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
           <div  id="map1" style="height: 70vh; width: 100%; z-index:1;"></div> 
        </div>
       
      </div>
    </div>
  </div>

  {{-- <div class="modal fade " id="quick-login" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Đăng nhập nhanh</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
           <form id='login'>
             @csrf
              <div class="form-group">
                <label for="email-login">Email</label>
                <input type="email" class="form-control" id="email-login" name ='email' aria-describedby="emailHelp" placeholder="Enter email">
             
              </div>
              <div class="form-group">
                <label for="password">Mật khẩu</label>
                <input type="password" class="form-control" id="password" name='password' placeholder="Password">
              </div>
              <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="customCheck1" checked="">
                <label class="custom-control-label" for="customCheck1">Remember</label>
              </div>
              <button type="submit" class="btn btn-primary float-right" id="btn-login">Đăng nhập</button>
            </form>
        </div>
        <div class="modal-footer">
          <span>Nếu chưa có tài khoản, hãy cùng <a href="{{route('register.page')}}"> tham gia </a> TripReview</span>
      </div>
      
      </div>
    </div>
  </div> --}}


  <div class="modal fade" id="edit-rep" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Sửa câu trả lời</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id='form-edit-rep'>
            @csrf
                <input type="hidden" name="id_review" id='id-edit-review'>
           

              <div class="form-group">
                
                  <textarea class="form-control write-rep-review" id="text-edit-rep" rows="10" name='rep' placeholder="Trả lời đánh giá"></textarea>
              </div>
              <button type="submit" class="btn btn-primary send-rep float-right">Lưu</button>
          </form>
      </div>
      
    </div>
  </div>
</div>
   
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/magnific-popup@1.1.0/dist/jquery.magnific-popup.min.js"></script>

    <script>
       
      const diadiem ={
          lat: "{{ $post->latitude }}",
          long: "{{ $post->longtitude }}",
       };

      var position = [diadiem.lat, diadiem.long];

      var map = L.map('map').setView(position, 15);

      var map1 = L.map('map1').setView(position, 13);

    

      // $(window).resize(function() {
        var width = $(window).width();
        if (width > 500){
          map.dragging.disable();
          map.touchZoom.disable();
          map.doubleClickZoom.disable();
          map.scrollWheelZoom.disable();
        
        }
      // });

      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
          attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
      }).addTo(map);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
          attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
      }).addTo(map1);


      $('#show-map').on('show.bs.modal', function() {
                setTimeout(function() {
                    map1.invalidateSize();
                    L.marker([diadiem.lat,diadiem.long]).addTo(map1)
                      .bindPopup(`<div class="card" style="width: 200px;height:200px">
                                  <img class="card-img-top" src="{{ $post->img_avatar }}" alt="Card image cap">
                                  <div class="card-body">
                                  {{$post->name}}
                                  </div>
                                </div>`)
                      .openPopup();
                }, 10);
                });

      L.marker([diadiem.lat,diadiem.long]).addTo(map)
      .bindPopup(`<div class='row' style='width:100px;'>
                    <div class='col-md-12'>
                      <img src='{{ $post->img_avatar }}' style='width:100%;'>
                    </div>
                    <div class='col-md-12'>
                      <span style='font-size:9px;'>{{$post->name}}</span>
                    </div>
                  </div>`)
      .openPopup();

      // [21.009516, 105.839284]
      


      map1.on('click', function(e) {
          $('#lat_add').val(e.latlng.lat);
          $('#long_add').val(e.latlng.lng);
              L.popup().setLatLng(e.latlng)
              .setContent("You clicked the map at " + e.latlng.toString())
              .openOn(map1);
      });
  

    </script>
    <script>

    

      $(document).ready(function(){
        let searchParams = new URLSearchParams(window.location.search);
        if(searchParams.has('review')){
          a= $('#data-review').offset().top;
          $(document).scrollTop(a+200);
        }
    
        popupPhoto();
        
      });
     

      var loadPhoto = 2;
      var lastPhoto = 2;
      $('#load-more').scroll(function() {
         let div = $(this).get(0);
        
            if(div.scrollTop + div.clientHeight + 1 >= div.scrollHeight){
              if(loadPhoto <= lastPhoto){
                $.ajax({
                  url:"{{ route('post.show',['slug' => Str::slug($post->name),'id' => $post->id]) }}?page="+loadPhoto,
                  type: "get",
                  success: function(result){
                    loadPhoto = result.photos.current_page+1;
                    lastPhoto = result.photos.last_page;
                      html = '';
                        result.photos.data.forEach(element => {
                            html += `<div class="magnific-img  col-md-4">
                                      <a class="image-popup-vertical-fit" href="${element.path}" title="1.jpg">
                                        <img src="${element.path}" alt="1.jpg" />
                                      </a>
                                    </div>`
                        });
                      $('#gallery-photo').append(html);
                      popupPhoto();
                  }
                })
                }else{
                console.log('Đã trang cuối');
              }
            }
        
      });

      function popupPhoto(){
        $('.image-popup-vertical-fit').magnificPopup({
          type: 'image',
          mainClass: 'mfp-with-zoom', 
          gallery:{
              enabled:true
            },

          zoom: {
            enabled: true, 

            duration: 300, // duration of the effect, in milliseconds
            easing: 'ease-in-out', // CSS transition easing function

            opener: function(openerElement) {

              return openerElement.is('img') ? openerElement : openerElement.find('img');
          }
        }

        });
      }

      $('.fa-thumbs-o-up').click(function(){
          let id = $(this).data('id');
          let like = $(this);
        $.ajax({
          url: "{{route('review.like')}}",
          type: 'POST',
          data: {
            "_token": "{{ csrf_token() }}",
            "id": id
          },
          success: function(result){
            console.log(result);
            if(result.status){
              
            count = result.count+ ' cảm ơn';
            like.closest('.nav-like-rep').find('.count-like').html(count);
            }else{
               if(like.hasClass('like')){
                  like.removeClass('like');
                }else{
                  like.addClass('like');
                }
        
              console.log(result.mess);
            }
          },
          error: function(e){
            if(like.hasClass('like')){
                like.removeClass('like');
              }else{
                like.addClass('like');
              }
        
        
            // if( e.responseJSON.message == 'Unauthenticated.'){
            //   $('#quick-login').modal('show');
            // }
            // console.log(e.responseJSON.message);
          }
        })
        if(like.hasClass('like')){
          like.removeClass('like');
        }else{
          like.addClass('like');
        }
        
      });

      $('.read-more').click(function(){
        $(this).closest('.comment').find('.show-more').toggle();
        if($(this).hasClass('read-less')){
          $(this).removeClass('read-less');
          let html =`<p style="text-decoration: underline;color:orange;font-size:14px">Đọc thêm</p><i class="fa fa-caret-down ml-2" aria-hidden="true"></i>`;
          $(this).html(html);
        }else{
          $(this).addClass('read-less');
          let html = `<p style="text-decoration: underline;color:orange;font-size:14px">Rút gọn</p><i class="fa fa-caret-up ml-2" aria-hidden="true"></i>`;
          $(this).html(html);
        }
        
      })

      $('.read-more-rep').click(function(){
        $(this).closest('.rep').find('.show-rep-dot').addClass('d-none');
        $(this).closest('.rep').find('.show-rep').removeClass('d-none');
        $(this).html('');
      
      })

      $('.fa-comment-o').click(function(){
        id_review = $(this).data('id');
        id_post = $(this).data('id_post');
        let html = `<form id='form-rep'>
                      @csrf
                         <input type="hidden" name="id_review" value='${id_review}'>
                         <input type="hidden" name="id_post" value='${id_post}'>

                        <div class="form-group">
                            <label for="write-rep-review"></label>
                            <textarea class="form-control write-rep-review"  rows="5" name='rep' placeholder="Trả lời đánh giá"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary send-rep">Rep</button>
                    </form>`;
        $(this).closest('.review-activity').find('.write-rep').html(html);
        
        $('.send-rep').click(function(e){
          e.preventDefault();
          let form = $(this).closest('#form-rep');
          var data = new FormData(form[0]);
        
          $.ajax({
                url: "{{ route('review.rep') }}",
                type: "POST",
                data: data,
                processData: false,
                contentType: false,
                success: function(result){

                    if(result.status){
                      location.reload();
                    }else{
                      console.log(result.mess);
                    }

                },
                error: function(e){
                  console.log(e)
                }
          });
        })
      })

      $('.fa-trash-o').click(function(){
        id = $(this).data('id_review');
        $.ajax({
          url: "{{route('review.rep.delete')}}",
          type: 'POST',
          data: {
            "_token": "{{ csrf_token() }}",
            "id_review": id
          },
          success: function(result){
          
            if(result.status){
              location.reload();
            }else{
              console.log(result.mess);
            }

          },
        })
      })

      $('.fa-pencil-square-o').click(function(){
        id = $(this).data('id_review');
        rep = $(this).closest('.col-6').closest('.row').closest('.rep').find('.show-rep').text();
        $('#id-edit-review').val(id);
        $('#text-edit-rep').text(rep);
      })
      
      $('#form-edit-rep').submit(function(e){
        e.preventDefault();
        let form = $(this);
        var data = new FormData(form[0]);
        
          $.ajax({
                url: "{{ route('review.rep.update') }}",
                type: "POST",
                data: data,
                processData: false,
                contentType: false,
                success: function(result){
               

                    if(result.status){
                      location.reload();
                    }else{
                      console.log(result.mess);
                    }

                },
                error: function(e){
                  console.log(e)
                }
          });
      })

      $('.hidden-review').click(function(){
        id = $(this).data('id');
        $.ajax({
          url: "{{route('review.hidden')}}",
          type: 'POST',
          data: {
            "_token": "{{ csrf_token() }}",
            "id_review": id
          },
          success: function(result){
          
            if(result.status){
              location.reload();
            }else{
              console.log(result.mess);
            }

          },
        })
      })

    </script>
    
@endsection
