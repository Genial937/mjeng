@extends('layouts.auth')

@section('content')
    <div id="main-wrapper" class="h-100">
        <div class="container-fluid px-0 h-100">
            <div class="row no-gutters h-100">
                <div class="col-md-6">
                    <div class="hero-wrap d-flex align-items-center h-100">
                        <div class="hero-mask opacity-8 bg-dark-1"></div>
                        <div class="hero-bg hero-bg-scroll" style="background-image:url('./../assets/images/bg-pokeapay.jpg');"></div>
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
                <div class="col-md-6 d-flex align-items-center">
                    <!-- SignUp Form
                    ============================================= -->
                    <div class="container my-4">
                        <div class="row">
                            <div class="col-11 col-lg-9 col-xl-8 mx-auto">
                                <h3 class="font-weight-400 mb-4">{{ __('Sign Up') }}</h3>
                                <p>Please fill in your details to get started.</p>
                                <hr>
                                <form method="POST" action="{{ route('register') }}" id="registerForm">
                                    @csrf
                                    <div class="form-group">
                                        <label for="fullName">{{ __('First Name') }}</label>
                                        <input id="firstname" type="text" class="form-control @error('first name') is-invalid @enderror" name="firstname" value="{{ old('firstname') }}" required autocomplete="firstname" placeholder="John" autofocus>
                                    </div>
                                    <div class="form-group">
                                        <label for="fullName">{{ __('Surname') }}</label>
                                        <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ old('surname') }}" required autocomplete="surname" placeholder="Doe"  autofocus>
                                    </div>
                                    <div class="form-group">
                                        <label for="fullName">{{ __('Mobile Phone') }}</label>
                                        <input id="phone" type="text" class="form-control " name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus placeholder="722XXXXXX" style="padding-left: 50px!important;">
                                    </div>
                                    <div class="form-group">
                                        <label for="emailAddress">{{ __('Email Address') }}</label>
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="John@email.com" >
                                    </div>
                                    <div class="form-group">
                                        <label for="loginPassword">{{ __('Password') }}</label>
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" >
                                    </div>
                                    <div class="form-group">
                                        <label for="loginPassword">{{ __('Confirm Password') }}</label>
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">

                                    </div>
                                    <div class="form-check custom-control custom-checkbox mb-3">
                                        <input id="confirm-me-m" name="confirm-terms-and-conditions" class="custom-control-input" type="checkbox">
                                        <label class="custom-control-label" for="confirm-me-m">By Signing up you agree with our <a href="https://pokeapay.com/terms-and-conditions/ ">Terms and Conditions</a></label>
                                    </div>
                                    <button class="btn btn-primary btn-block btn-submit my-4" type="submit"> {{ __('Register') }}</button>
                                </form>
                                <p class="text-3 text-center text-muted">Already have an account? <a class="btn-link" href="{{route('login')}}">Login</a></p>
                            </div>
                        </div>
                    </div>
                    <!-- SignUp Form End -->
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script type="text/javascript">
        $("#phone").intlTelInput();

        $( document ).on('submit','#registerForm',function(e) {
            e.preventDefault();
            $('.btn-submit').text('');
            $('.btn-submit').append('<div class="circle"></div>');
            var url=$('#registerForm').attr('action');
            $.post( url, $( "#registerForm" ).serialize())
                .done(function( data ) {
                    if (data['response']['auth']==true) {
                        GrowlNotification.notify({
                            title: 'Success',
                            description: data['message'],
                            type: 'success',
                            position: 'top-right',
                            showProgress:true,
                            closeTimeout: 30000
                        });

                        setTimeout(function(){
                            $('.btn-submit').text('Register');
                            location.href= data['response']['intended'];
                        }, 3000);
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
                            position: 'top-right',
                            showProgress:true,
                            closeTimeout: 30000
                        });
                    });
                })
        });
    </script>
@endsection
