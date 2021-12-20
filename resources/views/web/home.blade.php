@extends('layouts.main')
@section('title','Trip Review')

@section('head')

    <link rel="stylesheet" href="{{ asset('main/css/search.css') }}">
  
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
                        <form action="" class="search-form">
                            <input type="text" placeholder="Search" id="search" autocomplete="off">
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
                          <input type="radio" id="star5" name="last_view_{{$item->id}}" value="5" disabled/><label class = "full" for="star5" title="Awesome - 5 stars"></label>
                          <input type="radio" id="star4half" name="last_view_{{$item->id}}" value="4.5" checked disabled /><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
                          <input type="radio" id="star4" name="last_view_{{$item->id}}" value="4" disabled /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
                          <input type="radio" id="star3half" name="last_view_{{$item->id}}" value="3.5" disabled/><label class="half" for="star3half" title="Meh - 3.5 stars"></label>
                          <input type="radio" id="star3" name="last_view_{{$item->id}}" value="3" disabled /><label class = "full" for="star3" title="Meh - 3 stars"></label>
                          <input type="radio" id="star2half" name="last_view_{{$item->id}}" value="2.5" disabled/><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
                          <input type="radio" id="star2" name="last_view_{{$item->id}}" value="2" disabled/><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                          <input type="radio" id="star1half" name="last_view_{{$item->id}}" value="1.5" disabled/><label class="half" for="star1half" title="Meh - 1.5 stars"></label>
                          <input type="radio" id="star1" name="last_view_{{$item->id}}" value="1" disabled/><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
                          <input type="radio" id="starhalf" name="last_view_{{$item->id}}" value="0.5" disabled/><label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
                        </fieldset>
                      </div>
                    </div>
                  </a>
                  <div class="add-heart">
                    <i class="fa fa-heart-o" ></i>
                    <i class="fa fa-heart d-none" style='color: #ff5d5d;'></i>
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
                        <input type="radio" id="star5" name="new_{{$item->id}}" value="5" disabled/><label class = "full" for="star5" title="Awesome - 5 stars"></label>
                        <input type="radio" id="star4half" name="new_{{$item->id}}" value="4.5" checked disabled /><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
                        <input type="radio" id="star4" name="new_{{$item->id}}" value="4" disabled /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
                        <input type="radio" id="star3half" name="new_{{$item->id}}" value="3.5" disabled/><label class="half" for="star3half" title="Meh - 3.5 stars"></label>
                        <input type="radio" id="star3" name="new_{{$item->id}}" value="3" disabled /><label class = "full" for="star3" title="Meh - 3 stars"></label>
                        <input type="radio" id="star2half" name="new_{{$item->id}}" value="2.5" disabled/><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
                        <input type="radio" id="star2" name="new_{{$item->id}}" value="2" disabled/><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                        <input type="radio" id="star1half" name="new_{{$item->id}}" value="1.5" disabled/><label class="half" for="star1half" title="Meh - 1.5 stars"></label>
                        <input type="radio" id="star1" name="new_{{$item->id}}" value="1" disabled/><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
                        <input type="radio" id="starhalf" name="new_{{$item->id}}" value="0.5" disabled/><label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
                      </fieldset>
                    </div>
                  </div>
                </a>
                <div class="add-heart">
                  <i class="fa fa-heart-o" aria-hidden="true"></i>
                  <i class="fa fa-heart d-none" style='color: #ff5d5d;'></i>
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
                        <input type="radio" id="star5" name="like_{{$item->id}}" value="5" disabled/><label class = "full" for="star5" title="Awesome - 5 stars"></label>
                        <input type="radio" id="star4half" name="like_{{$item->id}}" value="4.5" checked disabled /><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
                        <input type="radio" id="star4" name="like_{{$item->id}}" value="4" disabled /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
                        <input type="radio" id="star3half" name="like_{{$item->id}}" value="3.5" disabled/><label class="half" for="star3half" title="Meh - 3.5 stars"></label>
                        <input type="radio" id="star3" name="like_{{$item->id}}" value="3" disabled /><label class = "full" for="star3" title="Meh - 3 stars"></label>
                        <input type="radio" id="star2half" name="like_{{$item->id}}" value="2.5" disabled/><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
                        <input type="radio" id="star2" name="like_{{$item->id}}" value="2" disabled/><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                        <input type="radio" id="star1half" name="like_{{$item->id}}" value="1.5" disabled/><label class="half" for="star1half" title="Meh - 1.5 stars"></label>
                        <input type="radio" id="star1" name="like_{{$item->id}}" value="1" disabled/><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
                        <input type="radio" id="starhalf" name="like_{{$item->id}}" value="0.5" disabled/><label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
                      </fieldset>
                    </div>
                  </div>
                </a>
                <div class="add-heart">
                  <i class="fa fa-heart-o" aria-hidden="true"></i>
                  <i class="fa fa-heart d-none" style='color: #ff5d5d;'></i>
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
                        <input type="radio" id="star5" name="highlight_{{$item->id}}" value="5" disabled/><label class = "full" for="star5" title="Awesome - 5 stars"></label>
                        <input type="radio" id="star4half" name="highlight_{{$item->id}}" value="4.5" checked disabled /><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
                        <input type="radio" id="star4" name="highlight_{{$item->id}}" value="4" disabled /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
                        <input type="radio" id="star3half" name="highlight_{{$item->id}}" value="3.5" disabled/><label class="half" for="star3half" title="Meh - 3.5 stars"></label>
                        <input type="radio" id="star3" name="highlight_{{$item->id}}" value="3" disabled /><label class = "full" for="star3" title="Meh - 3 stars"></label>
                        <input type="radio" id="star2half" name="highlight_{{$item->id}}" value="2.5" disabled/><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
                        <input type="radio" id="star2" name="highlight_{{$item->id}}" value="2" disabled/><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                        <input type="radio" id="star1half" name="highlight_{{$item->id}}" value="1.5" disabled/><label class="half" for="star1half" title="Meh - 1.5 stars"></label>
                        <input type="radio" id="star1" name="highlight_{{$item->id}}" value="1" disabled/><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
                        <input type="radio" id="starhalf" name="highlight_{{$item->id}}" value="0.5" disabled/><label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
                      </fieldset>
                    </div>
                  </div>
                </a>
                <div class="add-heart">
                  <i class="fa fa-heart-o" aria-hidden="true"></i>
                  <i class="fa fa-heart d-none" style='color: #ff5d5d;'></i>
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
    
@endsection
@section('script')
    
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

        $(".add-heart").click(function(){
          $(this).find('i').toggleClass('d-none');
        });

    </script>
   
@endsection