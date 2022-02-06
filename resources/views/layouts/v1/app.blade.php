<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{url("img/apple-icon.png")}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{url("img/favicon.png")}}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{env("APP_NAME")}}</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <!-- Bootstrap core CSS     -->
    <link href="{{asset("css/bootstrap.min.css")}}" rel="stylesheet" />
    <!--  Paper Dashboard core CSS    -->
    <link href="{{url("css/paper-dashboard.css")}}" rel="stylesheet"/>
    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href=" {{url("css/demo.css")}}" rel="stylesheet" />
    <link href=" {{url("css/custom.css")}}" rel="stylesheet" />
     <!-- Web Fonts ============================================= -->
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@400;700&display=swap" rel="stylesheet">
    <link href=" {{url("css/themify-icons.css")}}" rel="stylesheet" />
    <link href=" {{url("notify/colored-theme.min.css")}}" rel="stylesheet" />

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <!--  Fonts and icons     -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />

    <script src="{{url("js/jquery.min.js")}}" type="text/javascript"></script>
    <script src="{{url("js/jquery-ui.min.js")}}" type="text/javascript"></script>
    <script src="{{url("js/perfect-scrollbar.min.js")}}" type="text/javascript"></script>
    <script src="{{url("js/bootstrap.min.js")}}" type="text/javascript"></script>
    <script src="{{url("notify/growl-notification.min.js")}}"></script>

    <!--  Forms Validations Plugin -->
    <script src="{{url("js/jquery.validate.min.js")}}"></script>

    <!-- Promise Library for SweetAlert2 working on IE -->
    <script src="{{url("js/es6-promise-auto.min.js")}}"></script>

    <!--  Plugin for Date Time Picker and Full Calendar Plugin-->
    <script src="{{url("js/moment.min.js")}}"></script>

    <!--  Date Time Picker Plugin is included in this js file -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <!--  Select Picker Plugin -->
    <script src="{{url("js/bootstrap-selectpicker.js")}}"></script>

    <!--  Switch and Tags Input Plugins -->
    <script src="{{url("js/bootstrap-switch-tags.js")}}"></script>

    <script src="//cdn.jsdelivr.net/chartist.js/latest/chartist.min.js"></script>
    <link href="//cdn.jsdelivr.net/chartist.js/latest/chartist.min.css" rel="stylesheet" type="text/css" />


    <!--  Notifications Plugin    -->
    <script src="{{url("js/bootstrap-notify.js")}}"></script>



    <!-- Sweet Alert 2 plugin -->
    <script src="{{url("js/sweetalert2.js")}}"></script>

    <!-- Vector Map plugin -->
    <script src="{{url("js/jquery-jvectormap.js")}}"></script>
    <script src="{{url("js/tableHTMLExport.js")}}"></script>
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
    </script>
</head>

<body>
@yield('content')


</body>


</html>
