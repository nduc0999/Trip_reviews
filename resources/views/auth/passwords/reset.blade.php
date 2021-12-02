@extends('layouts.main')

@section('title','Reset password')

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
                <img src="{{ asset('main/images/confirm-password.svg') }}" alt="Image" class="img-fluid">
                </div>
                <div class="col-md-6 contents">
                     @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            Đã gửi link reset password đến mail
                        </div>
                    @endif
                    <div class="row justify-content-center mt-4">
                        <div class="col-md-8">
                            <div class="mb-4">
                            <h3>Reset Password <br></h3>
                            <p class="mb-4">Vui lòng nhập mật khẩu mới cho tài khoản</p>
                        
                            </div>
                            <form method="POST" action="{{ route('password.update') }}">
                                @csrf
                                
                                <input type="hidden" name="token" value="{{ $token }}">

                                <div class="form-group first">
                                    <label for="email">E-Mail Address</label>

                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>

                                <div class="form-group ">
                                    <label for="password">Password</label>

                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>

                                <div class="form-group last">
                                    <label for="password-confirm">Confirm Password</label>
                                   
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">

                                </div>

                                <input type="submit" value="Reset Password" class="btn text-white btn-block btn-primary">

                            
                            </form>
                        </div>
                    </div>  
                </div>
                
            </div>
        </div>
    </div>

@endsection
