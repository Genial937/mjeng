@extends('layouts.v1.auth')

@section('content')
    <div class="form-wrapper ">
        <!-- form -->
        <form>
            <div class="text-left">
                <h4>Reset my password </h4>
                <p>A reset token has been sent to your mail box.</p>
            </div>
            <div class="form-group text-left">
                <label>Reset token</label>
                <input type="text" class="form-control" placeholder="reset token" required autofocus>
            </div>
            <div class="form-group text-left">
                <label>New Password</label>
                <input type="text" class="form-control" placeholder="new password" required autofocus>
            </div>
            <div class="form-group text-left">
                <label>Confirm Password</label>
                <input type="text" class="form-control" placeholder="confirm password" required autofocus>
            </div>
            <button class="btn btn-primary btn-block btn-lg btn-uppercase">Confirm</button>
            <div class="form-group mt-3">
                <p>  <a href="{{route("password.email")}}">Back</a></p>
            </div>
        </form>
        <!-- ./ form -->
    </div>

@endsection
