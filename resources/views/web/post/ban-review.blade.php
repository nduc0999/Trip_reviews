@extends('layouts.main')

@section('title', "Cấm Đánh giá" )

@section('head')


    <!-- Magnific Popup core CSS file -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/magnific-popup@1.1.0/dist/magnific-popup.css">

    <link rel="stylesheet" href="{{ asset('main/css/loading.css') }}">


@endsection

@section('content')

    <div class="heading-page header-text">
        <div class="container ">
            
        </div>
      
  
    </div>
    
    <!-- Banner Ends Here -->

    <section class="blog-posts grid-system">
        <div class="container">
            <div class="row">
                <div class="col-12 d-flex justify-content-center">
                    <img src="{{ asset('main/images/warning.svg') }}" alt="" style="width: 20%">
                </div>
                <div class="col-12 d-flex justify-content-center align-items-center" style="flex-direction: column">
                    <h3>Xin lỗi,</h3>
                    <h3 style="color: orchid"> {{ Auth::user()->first_name }}.</h3>
                    <h5>Do bạn có thái độ tiêu cực nên đội ngũ TripReview đã cấm các đánh giá của bạn.</h5>
                        <h5>Nếu có thắc mắc vui lòng liên hệ đến </h5>
                        <h5> Email: <strong>TripReview@gmail.com</strong> để được hỗ trợ</h5>
                        <a href="{{route('home')}}">Trang chủ</a>
                </div>
            </div>
            
        </div>
    </section>

  

    
@endsection