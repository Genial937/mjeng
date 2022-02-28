@extends('layouts.v1.auth')

@section('content')
    <div class="form-wrapper ">
        <!-- form -->
        <form id="register-form" action="{{route("register.post")}}">
            @csrf
            <div class="signup-section">
                <div class="text-left">
                    <h4>Register as Supplier </h4>
                    <p>Enter your email and password</p>
                </div>
                <div class="form-group text-left">
                    <label>Firstname</label>
                    <input type="text" class="form-control" placeholder="firstname e.g john"  name="firstname" required >
                </div>
                <div class="form-group text-left">
                    <label>Surname</label>
                    <input type="text" class="form-control" placeholder="surname e.g doe"  name="surname" required >
                </div>
                <div class="form-group text-left">
                    <label>Email</label>
                    <input type="text" class="form-control" placeholder="email"  name="email" required >
                </div>
                <div class="form-group text-left">
                    <label>Password</label>
                    <input type="password" class="form-control" placeholder="Password" name="password" required >
                </div>
                <div class="form-group text-left">
                    <label>Confirm Password</label>
                    <input type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation" required >
                </div>
                <div class="form-group d-flex justify-content-between">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="terms">
                        <label class="custom-control-label" for="terms">Accept <a href="#">Terms & Conditions</a></label>
                    </div>
                </div>
                <button class="btn btn-primary btn-block  btn-uppercase btn-rounded btn-register-submit btn-lg">Let's go</button>
            </div>
            <div class="register-otp-section">
                <div class="form-group text-left">
                    <h4>Email Verification</h4>
                    <p>An Email with your verification code has been sent to your phone and email address.</p>
                    <label>6-character code</label>
                    <input type="text" class="form-control" placeholder="6-character code" name="otp" id="login-verification" >

                </div>
                <button class="btn btn-primary btn-block btn-lg btn-uppercase btn-rounded btn-verify-submit">Verify Code</button>
                <div class="form-group mt-3">
                    <p>Didn't receive an SMS/Email?</p>
                </div>

                <a href="javascript:void(0)" onclick="resendOtp()" class="btn btn-primary btn-block btn-rounded btn-uppercase text-white btn-lg  btn-resend-submit">Resend</a>
            </div>
        </form>
        <!-- ./ form -->
    </div>
    <script>
        $(".register-otp-section").slideUp();
    </script>
    <!-- App scripts -->
    <script src="{{url("assets/js/mijengo/ajax/auth.js")}}"></script>
@endsection
