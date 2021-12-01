@extends('layouts.main')

@section('title','Resend email')
    
@section('content')

    
    <div class="heading-page header-text">
  
        <div class="container">
            @if (Session::has('alert'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ Session::get('alert') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
        </div>
    </div>
    <div class="container mt-3">
      <div class="row d-flex justify-content-center">
        <div class="col-md-8 probootstrap-section-heading text-center">
          <h2>Xác nhận địa chỉ Email</h2>
            @if (session('resent'))
                <div class="alert alert-success" role="alert">
                    {{ __('A fresh verification link has been sent to your email address.') }}
                </div>
            @endif
            <p class="lead">
                Vui lòng Kiểm tra email vừa đăng ký
                <form class="d-inline" method="POST" action="{{ route('resend') }}">
                    @csrf
                    <button type="submit" class="btn btn-link p-0 m-0 align-baseline">Click vào đấy nếu bạn chưa nhận được email xác nhận</button>
                </form>
            </p>
          <p><img src="{{ asset('main/images/curve.svg') }}" class="svg" alt="Free HTML5 Bootstrap Template"></p>
        </div>
      </div>
    </div>
    
@endsection