@extends('layouts.v1.auth')

@section('content')
    <div class="form-wrapper ">
        <div class="text-left">
        <h5>Login</h5>
        </div>
        <div class="">
        <!-- form -->
        <form>
            <div class="form-group text-left">
                <label>Username or email</label>
                <input type="text" class="form-control" placeholder="Username or email" required autofocus>
            </div>
            <div class="form-group text-left">
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
            <button class="btn btn-primary btn-block btn-lg btn-uppercase">Let's go</button>

        </form>
        <!-- ./ form -->
    </div>
    </div>
@endsection
