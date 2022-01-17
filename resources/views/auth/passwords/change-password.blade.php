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
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header">{{ __('Nhập lại mật khẩu cũ') }}</div>

                                    <div class="card-body">

                                        <form method="POST" action="{{route('password.change.check')}}">
                                            @csrf

                                            <div class="form-group row">
                                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                                <div class="col-md-6">
                                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                                    @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row mb-0">
                                                <div class="col-md-8 offset-md-4">
                                                    <button type="submit" class="btn btn-primary">
                                                    Kiểm tra
                                                    </button>

                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </section>

  

@endsection