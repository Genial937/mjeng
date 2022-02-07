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

    <!-- Plugin styles -->
    <link rel="stylesheet" href="{{url("plugins/bundle.css")}}" type="text/css">

    <!-- App styles -->
    <link rel="stylesheet" href="{{url("assets/css/app.min.css")}}" type="text/css">
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
