@extends('layouts.main')
@section('title','Trip Review')

@section('head')

    <link rel="stylesheet" href="{{ asset('main/css/search.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/vendors/sweetalert2/sweetalert2.min.css') }}">
@endsection

@section('content')

    <div class="heading-page header-text">
      <section class="page-heading">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <div class="text-content">
                <h4>Đánh giá Homestay - Resort</h4>
                <h2>Single blog post</h2>
         
                <div class="container">
                    <div class="search-box">
                        <div class="search-icon"><i class="fa fa-search search-icon"></i></div>
                        <form action="{{route('post.search.result')}}" method="GET" class="search-form">
                       
                            <input type="search" placeholder="Search" id="search" name='search' autocomplete="off">
                        </form>
                        <svg class="search-border" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/" x="0px" y="0px" viewBox="0 0 671 111" style="enable-background:new 0 0 671 111;"
                        xml:space="preserve">
                            <path class="border" d="M335.5,108.5h-280c-29.3,0-53-23.7-53-53v0c0-29.3,23.7-53,53-53h280"/>
                            <path class="border" d="M335.5,108.5h280c29.3,0,53-23.7,53-53v0c0-29.3-23.7-53-53-53h-280"/>
                         </svg>
                        <div class="go-icon"><i class="fa fa-arrow-right"></i></div>
                    </div>

                </div>
         
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
    <div class="main-banner header-text">
      <div class="container-fluid mt-4">
        <h2 style="text-align: center;color: orange">Đánh giá cao</h2>
        <div class="owl-banner owl-carousel">
          @forelse ($post_slide as $item)
            <div class="item">
              <img src="{{ $item->img_avatar }}" alt="">
              <div class="item-content">
                <div class="main-content">
                  <div class="meta-category">
                    <span>{{ $item->type == 0 ? 'Homestsay':'Resort' }}</span>
                  </div>
                  <a href="{{ route('post.show',['slug' => Str::slug($item->name),'id' => $item->id]) }}"><h4>{{ $item->name }}</h4></a>
                  <ul class="post-info">
                    <li><a href="#">Admin</a></li>
                    <li><a href="#">May 12, 2020</a></li>
                    <li><a href="#">12 Comments</a></li>
                  </ul>
                </div>
              </div>
            </div>
          @empty
            <div class="item">
              <img src="{{ asset('main/images/banner-item-04.jpg') }}" alt="">
              <div class="item-content">
                <div class="main-content">
                  <div class="meta-category">
                    <span>Fashion</span>
                  </div>
                  <a href="#"><h4>Responsive and Mobile Ready Layouts</h4></a>
                  <ul class="post-info">
                    <li><a href="#">Admin</a></li>
                    <li><a href="#">May 18, 2020</a></li>
                    <li><a href="#">48 Comments</a></li>
                  </ul>
                </div>
              </div>
            </div>  
          @endforelse
         
          <div class="item">
            <img src="{{ asset('main/images/banner-item-05.jpg') }}" alt="">
            <div class="item-content">
              <div class="main-content">
                <div class="meta-category">
                  <span>Nature</span>
                </div>
                <a href="post-details.html"><h4>Cras congue sed augue id ullamcorper</h4></a>
                <ul class="post-info">
                  <li><a href="#">Admin</a></li>
                  <li><a href="#">May 24, 2020</a></li>
                  <li><a href="#">64 Comments</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="item">
            <img src="{{ asset('main/images/banner-item-06.jpg') }}" alt="">
            <div class="item-content">
              <div class="main-content">
                <div class="meta-category">
                  <span>Lifestyle</span>
                </div>
                <a href="post-details.html"><h4>Suspendisse nec aliquet ligula</h4></a>
                <ul class="post-info">
                  <li><a href="#">Admin</a></li>
                  <li><a href="#">May 26, 2020</a></li>
                  <li><a href="#">72 Comments</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <section class="blog-posts">
      <div class="container">
        @if (isset($last_post))
          <div class="row  mb-4">
            <h3>Đã xem gần đây</h3>
            <div class="slider owl-carousel mt-2">
              @forelse ($last_post as $item)
                <div class="card">
                  <a class="link-name" href="{{ route('post.show',['slug' => Str::slug($item->name),'id' => $item->id]) }}">
                    <div class="img">
                      <img class="img_hover" src="{{ $item->img_avatar }}" alt="">
                    </div>
                    <div class="content">
                      <div class="title">{{ $item->name }}</div>
                      <div class="sub-title">      
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
                  <div class="add-heart" >
                    @if ($item->heart == 1)
                      <i class="fa fa-heart" style='color: #ff5d5d;'></i>
                        
                    @else
                      <i class="fa fa-heart-o" data-toggle="modal" data-target="#modal-list-travel"></i>
                        
                    @endif
                  </div>
                </div>   
              @empty
                <div class="card">
                  <div class="img">
                    <img src="#" alt="">
                  </div>
                  <div class="content">
                    <div class="title">Pricilla Preez</div>
                  
                    <div class="btn">
                      <button>Read more</button>
                    </div>
                  </div>
                </div>   
              @endforelse

            </div>
          </div>   
        @endif
        <div class="row  mb-4 mg-top">
          <h3>Homestay-Resrort mới</h3>
          <div class="slider owl-carousel mt-2">
            @forelse ($post_new as $item)
              <div class="card">
                <a class="link-name" href="{{ route('post.show',['slug' => Str::slug($item->name),'id' => $item->id]) }}">
                  <div class="img">
                    <img class="img_hover" src="{{ $item->img_avatar }}" alt="">
                  </div>
                  <div class="content">
                    <div class="title">{{ $item->name }}</div>
                    <div class="sub-title">      
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
                <div class="add-heart" data-id="{{$item->id}}" >
                    @if ($item->heart == 1)
                      <i class="fa fa-heart" style='color: #ff5d5d;'></i>
                        
                    @else
                      <i class="fa fa-heart-o" data-toggle="modal" data-target="#modal-list-travel"></i>
                        
                    @endif
                
                </div>
              </div>   
            @empty
              <div class="card">
                <div class="img">
                  <img src="#" alt="">
                </div>
                <div class="content">
                  <div class="title">Pricilla Preez</div>
                
                  <div class="btn">
                    <button>Read more</button>
                  </div>
                </div>
              </div>   
            @endforelse

          </div>
        </div>
        <div class="row mb-4 mg-top">
          <h3>Có thể bạn sẽ thích</h3>
          <div class="slider owl-carousel mt-2">
            @forelse ($post_slide as $item)
              <div class="card">
                <a class="link-name" href="{{ route('post.show',['slug' => Str::slug($item->name),'id' => $item->id]) }}">
                  <div class="img">
                    <img class="img_hover" src="{{ $item->img_avatar }}" alt="">
                  </div>
                  <div class="content">
                    <div class="title">{{ $item->name }}</div>
                    <div class="sub-title">      
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
               <div class="add-heart" data-id="{{$item->id}}" >
                    @if ($item->heart == 1)
                      <i class="fa fa-heart" style='color: #ff5d5d;'></i>
                        
                    @else
                      <i class="fa fa-heart-o" data-toggle="modal" data-target="#modal-list-travel"></i>
                        
                    @endif
                
                </div>
              </div>   
            @empty
              <div class="card">
                <div class="img">
                  <img src="#" alt="">
                </div>
                <div class="content">
                  <div class="title">Pricilla Preez</div>
                
                  <div class="btn">
                    <button>Read more</button>
                  </div>
                </div>
              </div>   
            @endforelse

          </div>
        </div>
        <div class="row mg-top">
          <h3>Địa điểm nổi bật</h3>
          <div class="slider owl-carousel mt-2">
            @forelse ($post_slide as $item)
              <div class="card">
                <a class="link-name" href="{{ route('post.show',['slug' => Str::slug($item->name),'id' => $item->id]) }}">
                  <div class="img">
                    <img class="img_hover" src="{{ $item->img_avatar }}" alt="">
                  </div>
                  <div class="content">
                    <div class="title">{{ $item->name }}</div>
                    <div class="sub-title">      
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
                <div class="add-heart" data-id="{{$item->id}}" >
                    @if ($item->heart == 1)
                      <i class="fa fa-heart" style='color: #ff5d5d;'></i>
                        
                    @else
                      <i class="fa fa-heart-o" data-toggle="modal" data-target="#modal-list-travel"></i>
                        
                    @endif
                
                </div>
              </div>   
            @empty
              <div class="card">
                <div class="img">
                  <img src="#" alt="">
                </div>
                <div class="content">
                  <div class="title">Pricilla Preez</div>
                
                  <div class="btn">
                    <button>Read more</button>
                  </div>
                </div>
              </div>   
            @endforelse

          </div>
        </div>
      </div>
    </section>
    


<!-- Modal -->
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
    <script src="{{ asset('dashboard/vendors/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            $("#search").focus(function() {
            $(".search-box").addClass("border-searching");
            $(".search-icon").addClass("si-rotate");
            });
            $("#search").blur(function() {
            $(".search-box").removeClass("border-searching");
            $(".search-icon").removeClass("si-rotate");
            });
            $("#search").keyup(function() {
                if($(this).val().length > 0) {
                $(".go-icon").addClass("go-in");
                }
                else {
                $(".go-icon").removeClass("go-in");
                }
            });
            $(".go-icon").click(function(){
            $(".search-form").submit();
            });

            
        });

        var url_loadList = "{{route('home.list.travel')}}";
        var url_addTravel = "{{ route('home.add.travel') }}";
        var url_createTravel = "{{ route('travel.store') }}";
        var csrf = "{{ csrf_token() }}";

    </script>

    <script src="{{asset('main/js/addTravel.js')}}"></script>
   
@endsection