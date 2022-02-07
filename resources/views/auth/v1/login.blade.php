@extends('layouts.v1.auth')

@section('content')


    <div class="wrapper wrapper-full-page">
        <div class="full-page login-page" data-color="" data-image="{{url("img/background/background-2.jpg")}}">
            <!--   you can change the color of the filter page using: data-color="blue | azure | green | orange | red | purple" -->
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
                            <form method="POST" action="{{route('login')}}" id="loginForm">
                                @csrf
                                <div class="card" data-background="color" data-color="blue">

                                    <div class="card-content">
                                        <div class="form-group">
                                            <label>Email address</label>
                                            <input type="email" name="email" placeholder="Enter email" class="form-control input-no-border">
                                        </div>
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" name="password" placeholder="Password" class="form-control input-no-border">
                                        </div>
                                    </div>

                                    <div class="card-footer text-center">
                                        <button type="submit" class="btn btn-fill btn-wd btn-submit ">Let's go</button>
                                        <div class="forgot">
                                            <a href="#pablo">Forgot your password?</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <footer class="footer footer-transparent">
                <div class="container">
                    <div class="copyright">
                        &copy; <script>document.write(new Date().getFullYear())</script>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script type="text/javascript">

        $( document ).on('submit','#loginForm',function(e) {
            e.preventDefault();
            $('.btn-submit').text('');
            $('.btn-submit').append('<div class="circle"></div>');
            var url=$('#loginForm').attr('action');
            $.post( url, $( "#loginForm" ).serialize())
                .done(function( data ) {
                    console.log(data)
                    if (data['success']) {
                        GrowlNotification.notify({
                            title: '',
                            description: data['message'],
                            type: 'success',
                            position: 'top-center',
                            showProgress:true,
                            closeTimeout: 10000
                        });
                        setTimeout(function(){
                            $('.btn-submit').text('Login');
                            location.href= data['intended'];
                        }, 1000);
                    };
                })
                .fail(function(data) {
                    $('.btn-submit').text('Login');
                    var errors = data.responseJSON;
                    $.each(errors.errors, function( key, value ) {
                        GrowlNotification.notify({
                            title: '',
                            description: value[0] ,
                            type: 'warning',
                            position: 'top-center',
                            showProgress:true,
                            closeTimeout: 30000
                        });
                    });
                })
        });
    </script>
@endsection
