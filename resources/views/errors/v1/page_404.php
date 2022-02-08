<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="robots" content="noindex">
    <meta name="googlebot" content="noindex">
    <title>{{env("APP_NAME")}} - PAGE NOT FOUND</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{url("assets/media/image/favicon.png")}}"/>
    <!-- fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&family=Poppins:wght@200;400;500&display=swap" rel="stylesheet">
    <!-- Plugin styles -->
    <link rel="stylesheet" href="{{url("plugins/bundle.css")}}" type="text/css">

    <!-- App styles -->
    <link rel="stylesheet" href="{{url("assets/css/app.min.css")}}" type="text/css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

</head>
<body class="error-page bg-white" style="background: url({{asset("assets/media/image/image1.jpg")}})">
<div>
    <h4 class="mb-0 font-weight-normal">Upps! Page not found!</h4>
    <div class="my-4">
        <span class="error-page-item font-weight-bold">4</span>
        <span class="error-page-item font-weight-bold">0</span>
        <span class="error-page-item font-weight-bold">4</span>
    </div>
    <a href="#" class="btn bg-white btn-lg">Go Home</a>
</div>

<!-- Plugin scripts -->
<script src="{{url("plugins/bundle.js")}}"></script>

<!-- App scripts -->
<script src="{{"assets/js/app.min.js"}}"></script>
</body>

</html>
