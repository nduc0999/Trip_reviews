<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Page not found</title>
    <link href="{{ asset('main/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
</head>
<body>
    <div id="error">
        <div class="error-page container">
            <div class="col-md-8 col-12 offset-md-2">
                <img class="img-error" src="{{ asset('main/images/404.svg') }}" alt="Not Found">
                <div class="text-center">
                    <h1 class="error-title">NOT FOUND</h1>
                    <p class='fs-5 text-gray-600'>Không thể tìm thấy trang.</p>
                    <a href="{{route('home')}}" class="btn btn-lg btn-outline-primary mt-3">Quay lại trang chủ</a>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('main/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('main/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>