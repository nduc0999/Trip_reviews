<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Page not found</title>
    <link href="{{ asset('main/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('dashboard/css/loginAdmin.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('main/css/fontawesome.css') }}">

</head>
<body>
   <section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-2">
					<h2 class="heading-section">Đăng nhập quản trị</h2>
                    <img src="{{ asset('main/images/logo3.png') }}" style="width:150px;heigth:150px" alt="">
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-5">
					<div class="login-wrap p-4 p-md-5">
                        <div class="icon d-flex align-items-center justify-content-center">
                            <i class="bi bi-person" style="color:white;font-size:40px"></i>
                        </div>
                        <h3 class="text-center mb-4"></h3>
                        <form  action="{{ route('admin.login.check') }}" method="post" class="login-form">
                            @csrf
                            <div class="form-group first">
                    

                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required placeholder="Email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                            </div>
                            <div class="form-group last mb-4">
                              
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Mật khẩu">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                
                            </div>
                            <div class="form-group d-md-flex">
                                <div class="w-50">
                                    <label class="checkbox-wrap checkbox-primary">Remember Me
                                                <input type="checkbox" checked name="remember">
                                                <span class="checkmark"></span>
                                                </label>
                                            </div>
                                            {{-- <div class="w-50 text-md-right">
                                                <a href="#">Forgot Password</a>
                                            </div> --}}
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary rounded submit p-3 px-5">Đăng nhập</button>
                            </div>
                    </form>
	        </div>
				</div>
			</div>
		</div>
	</section>

    <script src="{{ asset('main/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('main/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>