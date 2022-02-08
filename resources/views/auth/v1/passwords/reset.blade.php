@extends('layouts.v1.auth')

@section('content')
    <div class="form-wrapper ">
        <!-- form -->
        <form>
            <div class="text-left">
                <h4>Reset my password </h4>
                <p>Lost your password? Please enter your email address. You will receive a reset token that you can user
                    to reset password.</p>
            </div>
            <div class="form-group text-left">
                <label>Username or email</label>
                <input type="text" class="form-control" placeholder="Username or email" required autofocus>
            </div>
            <button class="btn btn-primary btn-block btn-lg btn-uppercase">Send</button>
            <div class="form-group mt-3">
                <p>I remember my password  <a href="{{route("web.login")}}" class="btn btn-primary btn-block btn-rounded btn-uppercase">Login</a></p>

            </div>
        </form>
        <!-- ./ form -->
    </div>

@endsection
