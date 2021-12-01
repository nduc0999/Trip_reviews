@extends('layouts.main')
@section('title','login')

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
                <img src="{{ asset('main/images/login.svg') }}" alt="Image" class="img-fluid">
                </div>
                <div class="col-md-6 contents">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                    <div class="mb-4">
                    <h3>Đăng nhập <br> <strong>Trip Review</strong></h3>
                    <p class="mb-4">Bạn không phải là thành viên?</p>
                    <p><a href="{{ route('register.page') }}"><strong style="text-decoration: underline">Tham gia</strong></a> để khám phá những điều tuyệt vời nhất từ Trip Review</p>
                    </div>
                    <form action="{{ route('login') }}" method="post">
                        @csrf
                    <div class="form-group first">
                        <label for="username">Email</label>
                        {{-- <input type="text" class="form-control" id="username"> --}}

                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                    </div>
                    <div class="form-group last mb-4">
                        <label for="password">Password</label>
                        {{-- <input type="password" class="form-control" id="password"> --}}
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        
                    </div>
                    
                    <div class="d-flex mb-5 align-items-center">
                            <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}">
                            <label class="custom-control-label" for="remember">Remember me</label>
                        </div>
                        
                        {{-- <label class="control control--checkbox mb-0"><span class="caption">Remember me</span>
                        <input type="checkbox" checked="checked"/>
                        <div class="control__indicator"></div>
                        </label> --}}
                        <span class="ml-auto"><a href="#" class="forgot-pass">Forgot Password</a></span> 
                    </div>

                    <input type="submit" value="Log In" class="btn text-white btn-block btn-primary">

                    <span class="d-block text-left my-4 text-muted"> or sign in with</span>
                    
                    <div class="social-login">
                        <a href="#" class="facebook">
                        <span class="icon-facebook mr-3"></span> 
                        </a>
                        <a href="#" class="twitter">
                        <span class="icon-twitter mr-3"></span> 
                        </a>
                        <a href="#" class="google">
                        <span class="icon-google mr-3"></span> 
                        </a>
                    </div>
                    </form>
                    </div>
                </div>
                
                </div>
                
            </div>
        </div>
    </div>
@endsection

@section('script')
<script>
    $(function() {
	'use strict';

  $('.form-control').on('input', function() {
	  var $field = $(this).closest('.form-group');
	  if (this.value) {
	    $field.addClass('field--not-empty');
	  } else {
	    $field.removeClass('field--not-empty');
	  }
	});

});
</script>
    
@endsection
