@extends('layouts.main')

@section('title', "Thay đổi mật khẩu" )

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
                    <img src="{{ asset('main/images/change-password.svg') }}" alt="" style="width: 30%">
                </div>
                <div class="col-12 d-flex justify-content-center align-items-center" style="flex-direction: column">

                    <h1>Đổi mật khẩu thành công!!</h1>
                    <span>Quay lại <a href="{{route('home')}}">Trang chủ</a></span>
                        
                </div>
            </div>
            
        </div>
    </section>

  

@endsection