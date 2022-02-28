@extends('layouts.v1.auth')

@section('content')
    <div class="form-wrapper ">
        <!-- form -->
        <form id="verify-email-form" action="{{route("verify.post")}}">
            @csrf
            <div class="verify-section">
                <div class="text-left">
                    <h4>Verify your email address </h4>
                    <p>Enter 6 digit code sent to your email address.</p>
                </div>
                <div class="form-group text-left">
                    <label>Verification Code</label>
                    <input type="text" class="form-control" placeholder="XXXXXX"  name="code" >
                </div>
                <button class="btn btn-primary btn-block  btn-uppercase btn-rounded btn-verify-email-submit btn-lg">Verify</button>
            </div>
        </form>
        <!-- ./ form -->
    </div>
    <!-- App scripts -->
    <script src="{{url("assets/js/mijengo/ajax/auth.js")}}"></script>
@endsection
