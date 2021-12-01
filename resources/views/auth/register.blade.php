@extends('layouts.main')

@section('title','Đăng ký')

@section('head')
    <link rel="stylesheet" href="{{ asset('main/css/login.css') }}">
    
@endsection

@section('content')

    <div class="heading-page header-text">
        @if (Session::has('alert'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <p>{{ Session::get('alert') }}</p>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif  
    </div>

    
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <img src="{{ asset('main/images/register.svg') }}" alt="Image" class="img-fluid">
                </div>
                <div class="col-md-6 contents">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="mb-4">
                            <h3 class="mb-4">Đăng ký <br> <strong>Trip Review</strong></h3>
                            <p> Đăng ký để trở thành thành viên của Trip Review</p>
                            </div>
                            <form action="{{ route('register.store') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-sm-6  col-md-6">
                                        
                                            <label for="firstname">First Name</label>

                                           <input id="firstname" type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname') }}" required autocomplete="firstname">

                                            @error('firstname')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        
                                    </div>
                                    <div class="form-group col-sm-6 col-md-6">
                                        
                                           <label for="lastname">Last Name</label>

                                            <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" required autocomplete="lastname">

                                            @error('lastname')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        
                                    </div>

                                </div>


                                <div class="form-group first">
                                    <label for="username">Email</label>

                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                                <div class="form-group last mb-4">
                                    <label for="password">Password</label>
                                    {{-- <input type="password" class="form-control" id="password"> --}}
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                    @error('password')
                                        {{-- @if ($message != "Password confirm không khớp") --}}
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        {{-- @endif --}}
                                    @enderror
                                    
                                </div>
                                <div class="form-group last mb-4">
                                    <label for="password-confirm">Confirm Password</label>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    
                                     
                                            <span class="invalid-feedback" role="alert">
                                                <strong>moi</strong>
                                            </span>
                                   
                                    
                                </div>
                        

                                <input type="submit" value="Tham gia" class="btn text-white btn-block btn-primary">

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