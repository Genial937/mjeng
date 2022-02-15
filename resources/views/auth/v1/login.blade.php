@extends('layouts.v1.auth')

@section('content')
    <div class="form-wrapper ">
        <!-- form -->
        <form id="login-form" action="{{route("login.post")}}">
            @csrf
            <div class="login-section">
                <div class="text-left">
                    <h4>Login </h4>
                    <p>Enter your email or username and password</p>
                </div>
                <div class="form-group text-left">
                    <label>Username or email</label>
                    <input type="text" class="form-control" placeholder="Username or email"  name="email" required >
                </div>
                <div class="form-group text-left">
                    <label>Password</label>
                    <input type="password" class="form-control" placeholder="Password" name="password" required >
                </div>
                <div class="form-group d-flex justify-content-between">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" checked="" id="customCheck1">
                        <label class="custom-control-label" for="customCheck1">Remember me</label>
                    </div>

                    <a href="{{route("password.email")}}">Reset password</a>
                </div>
                <button class="btn btn-primary btn-block  btn-uppercase btn-rounded btn-login-submit btn-lg">Let's go</button>
            </div>
            <div class="login-otp-section">
                <div class="form-group text-left">
                    <h4>Two-factor authentication</h4>
                    <p>An Email with your verification code has been sent to your phone and email address.</p>
                    <label>6-character code</label>
                    <input type="text" class="form-control" placeholder="6-character code" name="otp" >
                </div>
                <button class="btn btn-primary btn-block btn-lg btn-uppercase btn-rounded">Verify Code</button>
                <div class="form-group ">
                    <p>Didn't receive an SMS/Email?</p>
                </div>
                <button class="btn btn-primary btn-block btn-rounded btn-uppercase btn-lg ">Resend</button>
            </div>
        </form>
        <!-- ./ form -->
    </div>
    <script>
        $(".login-otp-section").slideUp();
    </script>
    <!-- App scripts -->
    <script src="{{url("assets/js/mijengo/ajax/auth.js")}}"></script>
@endsection
