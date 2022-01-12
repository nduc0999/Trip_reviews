@extends('layouts.main')
@section('title','Đánh giá')

@section('head')

    <link rel="stylesheet" href="{{ asset('main/css/search.css') }}">
    <link rel="stylesheet" href="{{ asset('main/css/custom.css') }}">
    <style>
        .full,.half{
            font-size: 13px;
        }
    </style>
  
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
                            <input type="text" placeholder="Search" id="search" name="search" autocomplete="off" value="">
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
        <div class="container mt-5 " align="center">
            <h3>Đánh giá các địa điểm bạn đã đến thăm</h3>
        </div>
    </div>

    <section class="blog-posts">
        <div class="container p-0">
            <span>Bạn đã đến đó chưa? Khách du lịch muốn xem thêm đánh giá về những địa điểm này.</span>
            <div class="layout mt-4">
                
            </div>
            <section class="home-blog bg-sand">
                <div class="container">
                    <!-- section title -->
                    
                    <!-- section title ends -->
                    <div class="row ">

                        @forelse ($list as $item)
                            <div class="col-md-6">
                                <div class="media blog-media">
                                <a href="{{ route('post.show',['slug' => Str::slug($item->name),'id' => $item->id]) }}">
                                    <img class="d-flex" src="{{$item->img_avatar}}"  alt="Generic placeholder image">
                                </a>
                                <div class="circle">
                                    <h5 class="day">{{ date('d', strtotime($item->created_at)) }}</h5>
                                    <span class="month">{{ date('M', strtotime($item->created_at)) }}</span>
                                </div>
                                <div class="media-body">
                                 
                                    <a href="{{ route('post.show',['slug' => Str::slug($item->name),'id' => $item->id]) }}"><h5 class="mt-0">{{$item->name}}</h5></a>
                                    <span class="">{!! \Illuminate\Support\Str::words(nl2br($item->introduce), 15, $end = '...') !!} </span>
                                    <a href="{{ route('post.show',['slug' => Str::slug($item->name),'id' => $item->id]) }}" style="color: #007bff" class="post-link">[Đọc thêm]</a>
                                  
                                    <div style="position: absolute; bottom: 10px; width:80%" >
                                        <ul>
                                            <li>by: Admin</li>
                                            <li class="text-right"><a href="blog-post-left-sidebar.html">{{$item->count_review}} Đánh giá</a></li>
                                        </ul>       
                                        <a href="{{ route('form.review',['slug' => Str::slug($item->name),'id'=>$item->id]) }}" target="_blank" class="btn btn-primary mt-2" style="float:right;">Đánh giá</a>
                                   
                                    </div>
                                </div>
                                </div>
                            </div>      
                        @empty
                            @forelse ($listRandom as $item)
                                <div class="col-md-6">
                                <div class="media blog-media">
                               <a href="{{ route('post.show',['slug' => Str::slug($item->name),'id' => $item->id]) }}">
                                    <img class="d-flex" src="{{$item->img_avatar}}"  alt="Generic placeholder image">
                                </a>
                                <div class="circle">
                                    <h5 class="day">{{ date('d', strtotime($item->created_at)) }}</h5>
                                    <span class="month">{{ date('M', strtotime($item->created_at)) }}</span>
                                </div>
                                <div class="media-body">
                                  <a href="{{ route('post.show',['slug' => Str::slug($item->name),'id' => $item->id]) }}"><h5 class="mt-0">{{$item->name}}</h5></a>
                                    <span class="">{!! \Illuminate\Support\Str::words(nl2br($item->introduce), 15, $end = '...') !!} </span>
                                    <a href="{{ route('post.show',['slug' => Str::slug($item->name),'id' => $item->id]) }}" style="color: #007bff" class="post-link">[Đọc thêm]</a>
                                    <div style="position: absolute; bottom: 10px; width:80%" >
                                        <ul>
                                            <li>by: Admin</li>
                                            <li class="text-right"><a href="blog-post-left-sidebar.html">{{$item->count_review}} Đánh giá</a></li>
                                        </ul>       
                                        <a href="{{ route('form.review',['slug' => Str::slug($item->name),'id'=>$item->id]) }}" target="_blank" class="btn btn-primary mt-2" style="float:right;">Đánh giá</a>

                                   
                                    </div>
                                </div>
                                </div>
                            </div>  
                            @empty
                                <span>Không có dữ liệu</span>
                            @endforelse 
                        @endforelse

                       
                    </div>
                </div>
            </section>
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