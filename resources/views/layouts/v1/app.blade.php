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
    <!-- quill -->
    <link href="{{url("plugins/quill/quill.snow.css")}}" rel="stylesheet" type="text/css">
    <!-- quill -->
    <link href="{{url("plugins/jstree/themes/default/style.min.css")}}" rel="stylesheet" type="text/css">

    <!-- Clockpicker -->
    <link rel="stylesheet" href="{{url("plugins/clockpicker/bootstrap-clockpicker.min.css")}}" type="text/css">

    <!-- Datepicker -->
    <link rel="stylesheet" href="{{url("plugins/datepicker/daterangepicker.css")}}" type="text/css">

    <!-- Datatable -->
    <link rel="stylesheet" href="{{url("plugins/dataTable/datatables.min.css")}}" type="text/css">

    <!-- Select2 -->
    <link rel="stylesheet" href="{{url("plugins/select2/css/select2.min.css")}}" type="text/css">
    <!-- Prism -->
    <link rel="stylesheet" href="{{url("plugins/prism/prism.css")}}" type="text/css">

    <!-- App styles -->
    <link rel="stylesheet" href="{{url("assets/css/app.min.css")}}" type="text/css">


</head>
<body>

<!-- begin::preloader-->
{{--<div class="preloader">--}}
{{--    <div class="preloader-icon"></div>--}}
{{--</div>--}}
<!-- end::preloader -->
@yield('content')
<!-- Plugin scripts -->
<script src="{{url("plugins/bundle.js")}}"></script>
<!-- Datatable -->
<script src="{{url("plugins/dataTable/datatables.min.js")}}"></script>

<!-- Jstree -->
<script src="{{url("plugins/jstree/jstree.min.js")}}"></script>
<!-- Files page  -->
<script src="{{url("assets/js/mijengo/files.js")}}"></script>

<!-- Prism -->
<script src="{{url("plugins/prism/prism.js")}}"></script>
<!-- Select two -->
<script src="{{url("plugins/select2/js/select2.min.js")}}"></script>
<!-- App scripts -->
<script src="url({{"assets/js/app.min.js"}}"></script>

</body>

</html>
