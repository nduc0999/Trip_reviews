@extends('layouts.main')
@section('title','Kết quả tìm kiếm')

@section('head')

    <link rel="stylesheet" href="{{ asset('main/css/search.css') }}">
    <link rel="stylesheet" href="{{ asset('main/css/tab.css') }}">
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
                            <input type="text" placeholder="Search" id="search" name="search" autocomplete="off" value="{{ $search }}">
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
        <div class="container">
            
        </div>
    </div>

    <section class="blog-posts">
        <div class="container shadow p-0">
           
            <div class="layout mt-4">
                <input name="nav" type="radio" class=" home-radio" id="all" value="0" checked="checked" />
                <div class="page home-page">
                    <div class="page-contents">

                        <div class=" mt-3 mb-4">
                            <div class="d-flex row">
                                <div class="col-md-12" id='all-data'>
                                   @include('web.search.list-result-search')
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <label class="nav1" for="all" data-type='2'>
                    <span>
                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                    Tất cả
                    </span>
                </label>

                <input name="nav" type="radio" class=" about-radio"  id="homestay" />
                <div class="page about-page">
                    <div class="page-contents">
                        <div class=" mt-3">
                            <div class="d-flex  row">
                                <div class="col-md-12" id="homestay-data">
            
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <label class="nav1" for="homestay" data-type='0'>
                    <span>
                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><circle cx="12" cy="12" r="10"></circle><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path><line x1="12" y1="17" x2="12" y2="17"></line></svg>
                    Homestay
                    </span>
                    </label>

                <input name="nav" type="radio" class=" contact-radio" value="2" id="resort" />
                <div class="page contact-page">
                    <div class="page-contents">
                        <div class=" mt-3">
                            <div class="d-flex  row">
                                <div class="col-md-12" id="resort-data">
                                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <label class="nav1" for="resort" data-type = '1'>
                    <span>
                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
                    Resort
                    </span>
                    
                </label>
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
    <script>
        var type =2;
        $('.nav1').click(function(){
            type = $(this).data('type');

            loadPage(1);
        })


        function loadPage(page){
            $.ajax({
                url: "{{ route('post.search.result') }}?page="+page,
                type: "GET",
                data: {
                        'type': type,
                        'search': "{{$search}}",
                    },
                success: function(result){
                
                    switch(type) {
                        case 0:
                            $('#homestay-data').html(result);
                            break;
                        case 1:
                            $('#resort-data').html(result);
                            break;
                        case 2:
                            $('#all-data').html(result);
                            break;
                        default:
                            // code block
                        }
                },
                error: function(e){
                    console.log(e)
                }
            })
        }

        function Pagination() {
            $(document).on('click','.pagination a',function(e){
                e.preventDefault();
                page = $(this).attr('href').split('&page=')[1];
                
                loadPage(page);
              
                
            });
        
        };

        $(document).ready(function(){
            Pagination();
        })
    </script>

@endsection