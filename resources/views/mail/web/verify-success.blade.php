@extends('layouts.main')

@section('title','Verify Successfully')
    
@section('content')

    
    <div class="heading-page header-text">
  
        
    </div>
    <div class="container mt-3">
      <div class="row d-flex justify-content-center">
        <div class="col-md-8 probootstrap-section-heading text-center">
          <h2>Xác nhận địa chỉ email thành công</h2>
        
            <p class="lead">
                Chào mừng bạn đến với Trip Review. Hãy chia sẻ các đánh giá trải nghiệm của bạn cùng với mọi người nhé!
                    <a href="{{ route('home') }}" class="btn btn-link p-0 m-0 align-baseline">Đến trang chủ</a>
            </p>
          <p><img src="{{ asset('main/images/curve.svg') }}" class="svg" alt="Free HTML5 Bootstrap Template"></p>
        </div>
      </div>
    </div>
    
@endsection