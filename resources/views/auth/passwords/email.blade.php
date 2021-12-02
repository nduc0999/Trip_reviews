@extends('layouts.main')

@section('title','Forgot password')

@section('head')
    <link rel="stylesheet" href="{{ asset('main/css/login.css') }}">
@endsection

@section('content')
    <div class="heading-page header-text">
       
    </div>

    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-6 order-md-2">
                <img src="{{ asset('main/images/forgot-password.svg') }}" alt="Image" class="img-fluid">
                </div>
                <div class="col-md-6 contents">
                     @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            Đã gửi link Reset Password đến Mail
                        </div>
                    @endif
                    <div class="row justify-content-center mt-4">
                        <div class="col-md-8">
                            <div class="mb-4">
                            <h3>Quên mật khẩu <br></h3>
                            <p class="mb-4">Vui lòng nhập Mail để có thể lấy lại mật khẩu</p>
                        
                            </div>
                            <form action="{{ route('password.email') }}" method="POST">
                                @csrf
                            <div class="form-group first">
                                <label for="email">Email</label>
                                {{-- <input type="text" class="form-control" id="username"> --}}

                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                            

                            <input type="submit" value="Gửi link Reset Password" class="btn text-white btn-block btn-primary">

                            
                            </form>
                        </div>
                    </div>  
                </div>
                
            </div>
        </div>
    </div>

@endsection
