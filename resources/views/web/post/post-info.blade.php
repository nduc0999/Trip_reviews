@extends('layouts.main')

@section('title', $post->name." Review" )

@section('head')
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css"/> --}}
    {{-- <link rel="stylesheet" href="{{ asset('dashboard/vendors/rater-js/style.css') }}"> --}}

    <!-- Magnific Popup core CSS file -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/magnific-popup@1.1.0/dist/magnific-popup.css">
    <link rel="stylesheet" href="{{ asset('dashboard/vendors/sweetalert2/sweetalert2.min.css') }}">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
    integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
    crossorigin=""/>
    <link rel="stylesheet" href="{{ asset('main/css/loading.css') }}">
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
    integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
    crossorigin=""></script>
    
    <style>
    .image-source-link {
      color: #98C3D1;
    }
    .mfp-title{
      background-color: rgba(0, 0, 0, 0.5);
      color: white;
      
    }

    </style>

@endsection

@section('content')

    <div class="heading-page header-text">
        <div class="container ">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb" style="background-color:transparent;">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    {{-- <li class="breadcrumb-item"><a href="#">{{ $post->type == 0? 'Homestay':'Resort'  }}</a></li> --}}
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
              <div>
                <h4>{{ $post->name }}</h4>
                <div class="add-heart" data-id="{{$post->id}}" style="box-shadow: rgba(0, 0, 0, 0.15) 0px 2px 8px;" >
                    @if ($post->heart == 1)
                      <i class="fa fa-heart" style='color: #ff5d5d;'></i>
                        
                    @else
                      <i class="fa fa-heart-o" data-toggle="modal" data-target="#modal-list-travel"></i>
                        
                    @endif
                
                </div>
              </div>
              <fieldset class="rating">
                <input type="radio" value="5" @if($post->avg_rate == 5.0 )checked @endif/><label class = "full" title="Awesome - 5 stars"></label>
                <input type="radio" value="4.5" @if($post->avg_rate >= 4.5 and $post->avg_rate < 5  )checked @endif /><label class="half" title="Pretty good - 4.5 stars"></label>
                <input type="radio" value="4" @if($post->avg_rate >= 4 and $post->avg_rate < 4.5 )checked @endif /><label class = "full" title="Pretty good - 4 stars"></label>
                <input type="radio" value="3.5" @if($post->avg_rate >= 3.5 and $post->avg_rate < 4  )checked @endif /><label class="half" title="Meh - 3.5 stars"></label>
                <input type="radio" value="3" @if($post->avg_rate >= 3 and $post->avg_rate < 3.5 )checked @endif /><label class = "full" title="Meh - 3 stars"></label>
                <input type="radio" value="2.5" @if($post->avg_rate >= 2.5 and $post->avg_rate < 3 )checked @endif /><label class="half" title="Kinda bad - 2.5 stars"></label>
                <input type="radio" value="2" @if($post->avg_rate >= 2 and $post->avg_rate < 2.5 )checked @endif /><label class = "full" title="Kinda bad - 2 stars"></label>
                <input type="radio" value="1.5" @if($post->avg_rate >= 1.5 and $post->avg_rate < 2 )checked @endif /><label class="half" title="Meh - 1.5 stars"></label>
                <input type="radio" value="1" @if($post->avg_rate >= 1 and $post->avg_rate < 1.5 )checked @endif /><label class = "full" title="Sucks big time - 1 star"></label>
                <input type="radio" value="0.5" @if($post->avg_rate >= 0.5 and $post->avg_rate < 1 )checked @endif /><label class="half" title="Sucks big time - 0.5 stars"></label>
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
                                  <span class='num-rate'>{{ number_format($post->avg_rate, 1)}}</span>
                                </div>
                                <div class="col-10">
                                  <div class="row">
                                    <div class="col-12">
                                      @if ($post->avg_rate > 4 and $post->avg_rate <= 5  )
                                          <span>Tuyệt vời</span>
                                      @endif
                                      @if ($post->avg_rate > 3 and $post->avg_rate <= 4  )
                                          <span>Rất tốt</span>
                                      @endif
                                      @if ($post->avg_rate > 2 and $post->avg_rate <= 3  )
                                          <span>Trung bình</span>
                                      @endif
                                      @if ($post->avg_rate > 1 and $post->avg_rate <= 2  )
                                          <span>Tồi</span>
                                      @endif
                                      @if ($post->avg_rate > 0 and $post->avg_rate <= 1 )
                                          <span>Kinh khủng</span>
                                      @endif
                                      @if ($post->avg_rate ==0 )
                                          <span>Chưa có đánh giá nào</span>
                                      @endif
                                    </div>
                                    <div class="col-12">
                                      <div class="row">
                                        <div class="col-6 col-md-12 p-0">
                                          <fieldset class="rating">
                                            <input type="radio" value="5" @if($post->avg_rate == 5.0 )checked @endif/><label class = "full" title="Awesome - 5 stars"></label>
                                            <input type="radio" value="4.5" @if($post->avg_rate >= 4.5 and $post->avg_rate < 5  )checked @endif /><label class="half" title="Pretty good - 4.5 stars"></label>
                                            <input type="radio" value="4" @if($post->avg_rate >= 4 and $post->avg_rate < 4.5 )checked @endif /><label class = "full" title="Pretty good - 4 stars"></label>
                                            <input type="radio" value="3.5" @if($post->avg_rate >= 3.5 and $post->avg_rate < 4  )checked @endif /><label class="half" title="Meh - 3.5 stars"></label>
                                            <input type="radio" value="3" @if($post->avg_rate >= 3 and $post->avg_rate < 3.5 )checked @endif /><label class = "full" title="Meh - 3 stars"></label>
                                            <input type="radio" value="2.5" @if($post->avg_rate >= 2.5 and $post->avg_rate < 3 )checked @endif /><label class="half" title="Kinda bad - 2.5 stars"></label>
                                            <input type="radio" value="2" @if($post->avg_rate >= 2 and $post->avg_rate < 2.5 )checked @endif /><label class = "full" title="Kinda bad - 2 stars"></label>
                                            <input type="radio" value="1.5" @if($post->avg_rate >= 1.5 and $post->avg_rate < 2 )checked @endif /><label class="half" title="Meh - 1.5 stars"></label>
                                            <input type="radio" value="1" @if($post->avg_rate >= 1 and $post->avg_rate < 1.5 )checked @endif /><label class = "full" title="Sucks big time - 1 star"></label>
                                            <input type="radio" value="0.5" @if($post->avg_rate >= 0.5 and $post->avg_rate < 1 )checked @endif /><label class="half" title="Sucks big time - 0.5 stars"></label>
                                          </fieldset>
                                        </div>
                                        <span class="col-6 col-md-12">{{$post->count_review}} Đánh giá</span>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <hr>
                              <div class="row">
                                <div class="col-12 " style="display: flex;padding: 0;align-items: center;">
                                    <fieldset class="rating">
                                      <input type="radio" value="5" @if($post->avg_rate_service == 5.0 )checked @endif/><label class = "full" title="Awesome - 5 stars"></label>
                                      <input type="radio" value="4.5" @if($post->avg_rate_service >= 4.5 and $post->avg_rate_service < 5  )checked @endif /><label class="half" title="Pretty good - 4.5 stars"></label>
                                      <input type="radio" value="4" @if($post->avg_rate_service >= 4 and $post->avg_rate_service < 4.5 )checked @endif /><label class = "full" title="Pretty good - 4 stars"></label>
                                      <input type="radio" value="3.5" @if($post->avg_rate_service >= 3.5 and $post->avg_rate_service < 4  )checked @endif /><label class="half" title="Meh - 3.5 stars"></label>
                                      <input type="radio" value="3" @if($post->avg_rate_service >= 3 and $post->avg_rate_service < 3.5 )checked @endif /><label class = "full" title="Meh - 3 stars"></label>
                                      <input type="radio" value="2.5" @if($post->avg_rate_service >= 2.5 and $post->avg_rate_service < 3 )checked @endif /><label class="half" title="Kinda bad - 2.5 stars"></label>
                                      <input type="radio" value="2" @if($post->avg_rate_service >= 2 and $post->avg_rate_service < 2.5 )checked @endif /><label class = "full" title="Kinda bad - 2 stars"></label>
                                      <input type="radio" value="1.5" @if($post->avg_rate_service >= 1.5 and $post->avg_rate_service < 2 )checked @endif /><label class="half" title="Meh - 1.5 stars"></label>
                                      <input type="radio" value="1" @if($post->avg_rate_service >= 1 and $post->avg_rate_service < 1.5 )checked @endif /><label class = "full" title="Sucks big time - 1 star"></label>
                                      <input type="radio" value="0.5" @if($post->avg_rate_service >= 0.5 and $post->avg_rate_service < 1 )checked @endif /><label class="half" title="Sucks big time - 0.5 stars"></label>
                                    </fieldset>
                                    <span style="font-size: 15px">| Đánh giá dịch vụ</span>
                                </div>
                                 <div class="col-12" style="display: flex;padding: 0;align-items: center;" >
                                    <fieldset class="rating">
                                      <input type="radio" value="5" @if($post->avg_rate_value == 5.0 )checked @endif/><label class = "full" title="Awesome - 5 stars"></label>
                                      <input type="radio" value="4.5" @if($post->avg_rate_value >= 4.5 and $post->avg_rate_value < 5  )checked @endif /><label class="half" title="Pretty good - 4.5 stars"></label>
                                      <input type="radio" value="4" @if($post->avg_rate_value >= 4 and $post->avg_rate_value < 4.5 )checked @endif /><label class = "full" title="Pretty good - 4 stars"></label>
                                      <input type="radio" value="3.5" @if($post->avg_rate_value >= 3.5 and $post->avg_rate_value < 4  )checked @endif /><label class="half" title="Meh - 3.5 stars"></label>
                                      <input type="radio" value="3" @if($post->avg_rate_value >= 3 and $post->avg_rate_value < 3.5 )checked @endif /><label class = "full" title="Meh - 3 stars"></label>
                                      <input type="radio" value="2.5" @if($post->avg_rate_value >= 2.5 and $post->avg_rate_value < 3 )checked @endif /><label class="half" title="Kinda bad - 2.5 stars"></label>
                                      <input type="radio" value="2" @if($post->avg_rate_value >= 2 and $post->avg_rate_value < 2.5 )checked @endif /><label class = "full" title="Kinda bad - 2 stars"></label>
                                      <input type="radio" value="1.5" @if($post->avg_rate_value >= 1.5 and $post->avg_rate_value < 2 )checked @endif /><label class="half" title="Meh - 1.5 stars"></label>
                                      <input type="radio" value="1" @if($post->avg_rate_value >= 1 and $post->avg_rate_value < 1.5 )checked @endif /><label class = "full" title="Sucks big time - 1 star"></label>
                                      <input type="radio" value="0.5" @if($post->avg_rate_value >= 0.5 and $post->avg_rate_value < 1 )checked @endif /><label class="half" title="Sucks big time - 0.5 stars"></label>
                                    </fieldset>
                                    <span style="font-size: 15px">| Đánh giá giá trị</span>
                                </div>
                                 <div class="col-12" style="display: flex;padding: 0;align-items: center;">
                                    <fieldset class="rating">
                                      <input type="radio" value="5" @if($post->avg_rate_sleep == 5.0 )checked @endif/><label class = "full" title="Awesome - 5 stars"></label>
                                      <input type="radio" value="4.5" @if($post->avg_rate_sleep >= 4.5 and $post->avg_rate_sleep < 5  )checked @endif /><label class="half" title="Pretty good - 4.5 stars"></label>
                                      <input type="radio" value="4" @if($post->avg_rate_sleep >= 4 and $post->avg_rate_sleep < 4.5 )checked @endif /><label class = "full" title="Pretty good - 4 stars"></label>
                                      <input type="radio" value="3.5" @if($post->avg_rate_sleep >= 3.5 and $post->avg_rate_sleep < 4  )checked @endif /><label class="half" title="Meh - 3.5 stars"></label>
                                      <input type="radio" value="3" @if($post->avg_rate_sleep >= 3 and $post->avg_rate_sleep < 3.5 )checked @endif /><label class = "full" title="Meh - 3 stars"></label>
                                      <input type="radio" value="2.5" @if($post->avg_rate_sleep >= 2.5 and $post->avg_rate_sleep < 3 )checked @endif /><label class="half" title="Kinda bad - 2.5 stars"></label>
                                      <input type="radio" value="2" @if($post->avg_rate_sleep >= 2 and $post->avg_rate_sleep < 2.5 )checked @endif /><label class = "full" title="Kinda bad - 2 stars"></label>
                                      <input type="radio" value="1.5" @if($post->avg_rate_sleep >= 1.5 and $post->avg_rate_sleep < 2 )checked @endif /><label class="half" title="Meh - 1.5 stars"></label>
                                      <input type="radio" value="1" @if($post->avg_rate_sleep >= 1 and $post->avg_rate_sleep < 1.5 )checked @endif /><label class = "full" title="Sucks big time - 1 star"></label>
                                      <input type="radio" value="0.5" @if($post->avg_rate_sleep >= 0.5 and $post->avg_rate_sleep < 1 )checked @endif /><label class="half" title="Sucks big time - 0.5 stars"></label>
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
                        <div class="owl-photo owl-carousel ">

                          @if (isset($photos))
                            @for ($i = 0; $i < $photos->count(); $i++)
                              @if ($i==5)
                                  @break
                              @endif
                              <div class="item">
                                  <img class="photo-item" src="{{ $photos[$i]->path }}" alt="">
                              </div>    
                            @endfor
                          @else
                            <div class="item">
                                <img src="{{ asset('main/images/banner-item-04.jpg') }}" alt="">
                            </div>
                          @endif
                            
                        </div>
                        <div class="row col-12 album-photo pr-0">
                          <div class="col-6 pr-0"  data-toggle="modal" data-target="#show-photo" style="height: 200px">
                            <img src="{{ $photos[0]->path }}" alt="" >
                            <div class="text-photo">
                              <i class="fa fa-camera" aria-hidden="true"></i>
                              <p> Ảnh phòng</p>
                            </div>
                          </div>
                          <div class="col-6 pr-0" data-toggle="modal" data-target="#show-photo-user" style="height: 200px">
                            <img src="{{ $photoUser != '' ? $photoUser[0]->path : $post->img_avatar }}" alt=""  >
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
                        <li><a href="#">{{date('M d, Y', strtotime($post->created_at))}}</a></li>
                        <li><a href="#">{{$post->count_review}} đánh giá</a></li>
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
                        <h2>{{$reviews->total()}} Đánh giá được hiển thị</h2>
                        <a href="{{ route('form.review',['slug' => Str::slug($post->name),'id'=>$post->id]) }}" class="btn" target="_blank" style="background-color: #f48840;color:white;"><i class="fa fa-edit"></i> Viết đánh giá</a>
                      </div>
                      <hr>
                      <div id="data-review">
                        @include('web.post.data-review')
                      </div>
                    </div>
                  </div>
                </div>
               
              </div>
            </div>
          </div>
         
        </div>
      </div>
      <div class="col-12 mg-top d-flex justify-content-center">
        <span><strong>Các Homestay-Resort tương tự</strong></span>
      </div>
       <div class="col-12 mb-3 d-flex justify-content-center" >
        
        
          <div class="row mt-2" style="width:900px">
            @forelse ($listRandom as $item)
                 <a class="col-md-4" href="{{ route('post.show',['slug' => Str::slug($item->name),'id' => $item->id]) }}">
                  <div class="card border-0 card-region mb-2">
                    <img class="card-img-top" src="{{$item->img_avatar}}" alt="Card image cap">
                    <div class="title-region">
                      <h4>{{$item->name}}</h4>
                       <fieldset class="rating">
                        <input type="radio" value="5" @if($item->avg_rate == 5.0 )checked @endif/><label class = "full" title="Awesome - 5 stars"></label>
                        <input type="radio" value="4.5" @if($item->avg_rate >= 4.5 and $item->avg_rate < 5  )checked @endif /><label class="half" title="Pretty good - 4.5 stars"></label>
                        <input type="radio" value="4" @if($item->avg_rate >= 4 and $item->avg_rate < 4.5 )checked @endif /><label class = "full" title="Pretty good - 4 stars"></label>
                        <input type="radio" value="3.5" @if($item->avg_rate >= 3.5 and $item->avg_rate < 4  )checked @endif /><label class="half" title="Meh - 3.5 stars"></label>
                        <input type="radio" value="3" @if($item->avg_rate >= 3 and $item->avg_rate < 3.5 )checked @endif /><label class = "full" title="Meh - 3 stars"></label>
                        <input type="radio" value="2.5" @if($item->avg_rate >= 2.5 and $item->avg_rate < 3 )checked @endif /><label class="half" title="Kinda bad - 2.5 stars"></label>
                        <input type="radio" value="2" @if($item->avg_rate >= 2 and $item->avg_rate < 2.5 )checked @endif /><label class = "full" title="Kinda bad - 2 stars"></label>
                        <input type="radio" value="1.5" @if($item->avg_rate >= 1.5 and $item->avg_rate < 2 )checked @endif /><label class="half" title="Meh - 1.5 stars"></label>
                        <input type="radio" value="1" @if($item->avg_rate >= 1 and $item->avg_rate < 1.5 )checked @endif /><label class = "full" title="Sucks big time - 1 star"></label>
                        <input type="radio" value="0.5" @if($item->avg_rate >= 0.5 and $item->avg_rate < 1 )checked @endif /><label class="half" title="Sucks big time - 0.5 stars"></label>
                      </fieldset>
                    </div>
                  </div>
                </a>
            @empty
                <span>Không có dữ liệu</span>
            @endforelse
                

          </div>
        </div>

    </section>

{{-- Modal --}}

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
                        <a class="image-popup-vertical-fit" href="{{ $item->path }}" data-source="" data-name="{{$post->name}}" title="{{$item->note}}">
                          <img src="{{ $item->path }}"  />
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

   <div class="modal fade " id="show-photo-user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  >
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document" style="z-index: 4" id="abc">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" >Ảnh về {{ $post->name }}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="load-more-photo-user">
          <div class="container">
             <h1>Ảnh của Resort</h1>    
              <p>
                <section class="img-gallery-magnific">
                  <div class="row" id="gallery-photo-user">
                    @forelse ($photoUser as $item)
                      <div class="magnific-img col-12 col-md-4 mt-2">
                        <a class="image-popup-vertical-fit" href="{{ $item->path }}" data-source="{{route('profile.user',['name' => Str::slug($item->postphoto->user->fullname()),'id'=>$item->postphoto->id_user])}}" data-name="{{$item->postphoto->user->fullname()}}" title="{{$item->description}}">
                          <img src="{{ $item->path }}" alt="1.jpg" />
                        </a>
                      </div>
                    @empty
                      <div class="magnific-img  col-md-4">
                        <h3>Không có ảnh nào</h3>
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


<div class="modal fade" id="modal-list-travel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-heart-o"></i> Lưu một chuyến đi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body list-travel" style="height: 370px;overflow-y: scroll;overflow-x: hidden;">
    
       
      </div>
      <div class="modal-footer " style="justify-content: start">
        <div class="row" style="padding: 0px 10px" data-toggle="modal" data-target="#modal-create-travel">
          <div class="col-3 square-travel">

              <i class="fa fa-plus fa-2x" aria-hidden="true"></i>
            
          </div>
          <div class="col-9 d-flex align-items-center">
            <h5>Tạo một chuyến đi</h5>
          </div>
        </div>
     
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal-create-travel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-heart-o" aria-hidden="true"></i> Tạo một chuyến đi</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form id="form-create-travel">
            @csrf
            <div class="modal-body">
                <div class="container">
                    
                        <div class="form-group">
                            <label for="title">Tên chuyến đi</label>
                            <input type="text" class="form-control" name="title" id="title"  value="">
                            <span class="text-danger error-text title_err"></span>
                        </div>
                        <p>Chọn những người có thể thấy Chuyến đi của bạn</p>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="private" name="status" class="custom-control-input" value="0" checked="">
                            <label class="custom-control-label" for="private">
                                <div class="d-flex">
                                    <div class="d-flex justify-content-center mr-3">
                                        <div class="icon-status-modal">
                                            <i class="fa fa-lock" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                    
                                    <div class="">
                                        <p><strong class="text-dark">Riêng tư</strong></p>
                                        <p style="line-height: 1.2;">Không hiển thị với người dùng và thành viên TripReview khác, trừ bạn và bạn bè được chia sẻ Chuyến đi.</p>
                                    </div>
                                </div>
                            </label>
                        </div>
                        
                        <div class="custom-control custom-radio mt-3">
                            <input type="radio" id="public" name="status" class="custom-control-input" value="1" >
                            <label class="custom-control-label" for="public">
                                <div class="d-flex">
                                    <div class="d-flex justify-content-center mr-3">
                                        <div class="icon-status-modal">
                                            <i class="fa fa-unlock" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                    
                                    <div class="">
                                        <p><strong class="text-dark">Công khai</strong></p>
                                        <p style="line-height: 1.2;">Hiển thị với mọi khách du lịch trên TripReview, bao gồm mọi bạn bè được bạn chia sẻ Chuyến đi</p>
                                    </div>
                                </div>
                            </label>
                        </div>
                    
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" type="submit" class="btn btn-primary btn-create-travel" disabled>Tạo</button>
            </div>
        </form>
    </div>
  </div>
</div>
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/magnific-popup@1.1.0/dist/jquery.magnific-popup.min.js"></script>
    <script src="{{ asset('dashboard/vendors/sweetalert2/sweetalert2.all.min.js') }}"></script>

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
      
        var url_loadList = "{{route('home.list.travel')}}";
        var url_addTravel = "{{ route('home.add.travel') }}";
        var url_createTravel = "{{ route('travel.store') }}";
        var csrf = "{{ csrf_token() }}";

      map1.on('click', function(e) {
          $('#lat_add').val(e.latlng.lat);
          $('#long_add').val(e.latlng.lng);
              L.popup().setLatLng(e.latlng)
              .setContent("You clicked the map at " + e.latlng.toString())
              .openOn(map1);
      });
  

    </script>
    <script src="{{asset('main/js/addTravel.js')}}"></script>
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
                  data: {
                    'type': 'photo',
                  },
                  success: function(result){
                    loadPhoto = result.photos.current_page+1;
                    lastPhoto = result.photos.last_page;
                    let html = '';
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
                console.log('Đã trang cuối photo');
              }
            }
        
      });


      var loadPhotoUser = 2;
      var lastPhotoUser = 2;
      $('#load-more-photo-user').scroll(function() {
         let div = $(this).get(0);
        
            if(div.scrollTop + div.clientHeight + 1 >= div.scrollHeight){
              
              if(loadPhotoUser <= lastPhotoUser){
                $.ajax({
                  url:"{{ route('post.show',['slug' => Str::slug($post->name),'id' => $post->id]) }}?photoUser="+loadPhotoUser,
                  type: "get",
                  data: {
                    'type': 'photoUser',
                  },
                  success: function(result){
                    console.log(result);
                    loadPhotoUser = result.photoUser.current_page+1;
                    lastPhotoUser = result.photoUser.last_page;
                    let html = '';
                        result.photoUser.data.forEach(element => {
                            html += `<div class="magnific-img  col-md-4">
                                      <a class="image-popup-vertical-fit" href="${element.path}" >
                                        <img src="${element.path}"/>
                                      </a>
                                    </div>`
                        });
                      $('#gallery-photo-user').append(html);
                      popupPhoto();
                
                  }
                })
                }else{
                console.log('Đã trang cuối photo user');
              }
            }
        
      });

      function popupPhoto(){
        $('.image-popup-vertical-fit').magnificPopup({
          type: 'image',
          mainClass: 'mfp-with-zoom',
          image: {
            verticalFit: true,
            titleSrc: function(item) {
              return item.el.attr('title') + ' &middot; <a class="image-source-link" href="'+item.el.attr('data-source')+'" target="_blank">'+item.el.attr('data-name')+'</a>';
            }
          },
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
