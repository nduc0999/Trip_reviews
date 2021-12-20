@extends('layouts.main')

@section('title', " Review" )

@section('head')


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
                    {{-- <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">{{ $post->type == 0? 'Homestay':'Resort'  }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $post->name }}</li> --}}
                     <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Hà Nội</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Homestay</li>
                </ol>
            </nav>
        </div>
      
  
    </div>
    
    <!-- Banner Ends Here -->

    <section class="blog-posts grid-system">
        <div class="container">
            <div class="row">
                <div class="col-12 d-flex justify-content-center">
                    <img src="{{ asset('main/images/review-success.svg') }}" alt="" style="width: 20%">
                </div>
                <div class="col-12 d-flex justify-content-center align-items-center" style="flex-direction: column">
                    <h3>{{ Auth::user()->first_name }},</h3>
                    <h3 style="color: orchid">Cảm ơn đánh giá của bạn!</h3>
                    <h5>Mỗi lượt đánh giá của bạn đã góp phần cho cộng đồng TripReview phát triển hơn.</h5>
                        <h5>Hãy tiếp tục! Xếp hạng và đánh giá các địa điểm khác</h5>
                        <a href="{{route('home')}}">Home</a>
                </div>
            </div>
            
        </div>
    </section>

  

    
@endsection