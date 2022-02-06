@extends('layouts.v1.auth')

@section('content')


    <div id="main-wrapper" class="h-100">
        <div class="container-fluid px-0 h-100">
            <div class="row no-gutters h-100">
                <div class="col-md-6">
                    <div class="hero-wrap d-flex align-items-center h-100">
                        <div class="hero-mask opacity-8 bg-dark-1"></div>
                        <div class="hero-bg hero-bg-scroll" style="background-image:url({{url('assets/images/bg-pokeapay.jpg')}});"></div>
                        <div class="hero-content mx-auto w-100 h-100 d-flex flex-column">
                            <div class="row  no-gutters">
                                <div class="col-10 col-lg-9 mx-auto">
                                    <div class="logo mt-5 mb-5 mb-md-0">
                                        <a class="d-flex" href="#" title="PokeaPay">
                                            <img height="50 " src="{{url("assets/images/logo.png")}}" alt="PokeaPay"></a>
                                    </div>
                                </div>
                            </div>
                            <div class="row no-gutters my-auto">
                                <div class="col-10 col-lg-9 mx-auto">
                                    <h1 class="text-11 text-white mb-4">Payments Simplified.</h1>
                                    <p class="text-4 text-white line-height-4 mb-5">An all-in-one payments platform that helps you increase your revenues and make sales easier.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Login Form
                ============================================= -->
                <div class="col-md-6 d-flex align-items-center">
                    <div class="container my-4">

                        <div class="row">
                            <div class="col-11 col-lg-9 col-xl-8 mx-auto">
                                <h3 class="font-weight-400 mb-4">{{ __('Reset Password') }}</h3>
                                <div class="errorMsg"></div>
                                <form method="POST" action="{{ route('password-update') }}" id="reset-password">
                                    @csrf
                                    <input type="hidden" name="token" value="{{ $token }}">

                                    <div class="form-group">
                                        <label for="emailAddress">{{ __('Email Address') }}</label>
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="loginPassword">{{ __('Password') }}</label>
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="loginPassword">{{ __('Confirm Password') }}</label>
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-submit">
                                        {{ __('Reset Password') }}
                                    </button>
                                    <p class="text-3  text-muted mt-3">Back to Login? <a class="btn-link" href="{{route('login')}}">Login</a></p>
                                </form>

                            </div>
                        </div>

                    </div>
                </div>
                <div class="bg-map"><img src="{{'assets/images/bg/bg-map.png'}}" width="50%" alt="image"></div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
<script>
    $(document).on('submit', '#reset-password', function (e) {
        e.preventDefault();
        $('.btn-submit').text('');
        $('.btn-submit').append('<div class="circle"></div>');
        var url = $('#reset-password').attr('action');
        $.post(url, $("#reset-password").serialize())
            .done(function (data) {
                if (data['success']) {
                    GrowlNotification.notify({
                        title: '',
                        description: "Successfully sent",
                        type: 'success',
                        position: 'top-center',
                        showProgress: true,
                        closeTimeout: 30000
                    });

                    setTimeout(function () {
                        $('.btn-submit').text('Save Changes');
                        location.href= data['response']['intended'];
                    }, 3000);
                }
            })
            .fail(function (data) {
                $('.btn-submit').text('Save Changes');
                var errors = data.responseJSON;
                $.each(errors.errors, function (key, value) {
                    GrowlNotification.notify({
                        title: '',
                        description: value[0],
                        type: 'warning',
                        position: 'top-center',
                        showProgress: true,
                        closeTimeout: 30000
                    });
                });
            })
    });
</script>
@endsection
