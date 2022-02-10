<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="robots" content="noindex">
    <meta name="googlebot" content="noindex">
    <title>{{env("APP_NAME")}}</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{url("assets/media/image/favicon.png")}}"/>
    <!-- fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&family=Poppins:wght@200;400;500&display=swap" rel="stylesheet">
    <!-- Plugin styles -->
    <link rel="stylesheet" href="{{url("plugins/bundle.css")}}" type="text/css">

    <!-- App styles -->
    <link rel="stylesheet" href="{{url("assets/css/app.min.css")}}" type="text/css">

    <!-- Plugin scripts -->
    <script src="{{url("plugins/bundle.js")}}"></script>

</head>
<body class="form-membership" style="background: url({{asset("assets/media/image/image1.jpg")}})">

<!-- begin::preloader-->
{{--<div class="preloader">--}}
{{--    <div class="preloader-icon"></div>--}}
{{--</div>--}}
<!-- end::preloader -->
@yield('content')
<!-- App scripts -->
<script src="{{"assets/js/app.min.js"}}"></script>

</body>

</html>
