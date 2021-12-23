@extends('layouts.main')

@section('title', "Đề xuất thành công" )

@section('head')


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
                    <img src="{{ asset('main/images/review-success.svg') }}" alt="" style="width: 20%">
                </div>
                <div class="col-12 d-flex justify-content-center align-items-center" style="flex-direction: column">
                    <h3>{{ Auth::user()->first_name }},</h3>
                    <h3 style="color: orchid">Cảm ơn bạn đã đề xuất Homestay-Resort!</h3>
                    <h5>Những đề xuất này sẽ cần thời gian để đội ngũ TripReview xét duyệt.</h5>
                        <h5>Hãy tiếp tục với TripReview nha!</h5>
                        <a href="{{route('home')}}">Home</a>
                </div>
            </div>
            
        </div>
    </section>

  

@endsection