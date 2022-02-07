@extends('layouts.v1.auth')

@section('content')
    <div class="form-wrapper">

        <!-- logo -->
        <div id="logo">
            <img src="{{asset("assets/media/image/logo-dark.png")}}" alt="image">
        </div>
        <!-- ./ logo -->


        <h5>Sign in</h5>

        <!-- form -->
        <form>
            <div class="form-group">
                <label>Username or email</label>
                <input type="text" class="form-control" placeholder="Username or email" required autofocus>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" placeholder="Password" required>
            </div>
            <div class="form-group d-flex justify-content-between">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" checked="" id="customCheck1">
                    <label class="custom-control-label" for="customCheck1">Remember me</label>
                </div>
                <a href="#">Reset password</a>
            </div>
            <button class="btn btn-primary btn-block">Sign in</button>
            <hr>
            <p class="text-muted">Don't have an account?</p>
            <a href="register.html" class="btn btn-outline-light btn-sm">Register now!</a>
        </form>
        <!-- ./ form -->
    </div>
@endsection
