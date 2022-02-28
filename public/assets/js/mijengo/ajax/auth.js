'use strict';
$(document).ready(function () {
    toastr.options = {
        timeOut: 3000,
        progressBar: true,
        showMethod: "slideDown",
        hideMethod: "slideUp",
        showDuration: 1500,
        hideDuration: 1500
    };
    $('.btn-verify-submit').hide();
    $('#login-verification').on('input', function() {
        $('.btn-verify-submit').show();
    });
    $(document).on('submit', '#login-form', function (e) {
        e.preventDefault();
        let submit_btn=$('.btn-login-submit');
        let verify_btn=$('.btn-verify-submit');
        let resend_btn= $('.btn-resend-submit');
        let form=$('#login-form');
        submit_btn.text('').append('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span> Loading...').prop('disabled', true);
        verify_btn.show().text('').append('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span> Loading...').prop('disabled', true);
        resend_btn.hide();
        var url =form.attr('action');
        $.post(url, form.serialize())
            .done(function (data) {
                if (data['success']) {
                    if (data['otp']) {
                        //deal with otp
                        $(".login-section").slideUp();
                        $(".login-otp-section").slideDown();
                        toastr.success(data['message']);
                        submit_btn.text('Login').prop('disabled', false);
                        verify_btn.text('Verify Code').prop('disabled', false);
                        resend_btn.show();

                    } else {
                        submit_btn.text('Login').prop('disabled', false);
                       verify_btn.text('Verify Code').prop('disabled', false);
                        toastr.success(data['message']);
                        setTimeout(function () {
                            location.reload();
                        }, 1000);

                    }
                }
            })
            .fail(function (data) {
                console.error(data)
                resend_btn.show();
                submit_btn.text('Login').prop('disabled', false);
                verify_btn.text('Verify Code').prop('disabled', false);
                var errors = data.responseJSON;
                $.each(errors.errors, function (key, value) {
                    toastr.error(value[0]);
                });
            })
    });
    $(document).on('submit', '#register-form', function (e) {
        e.preventDefault();
        let submit_btn=$('.btn-register-submit');
        let form=$('#register-form');
        submit_btn.text('').append('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span> Loading...').prop('disabled', true);
        var url =form.attr('action');
        $.post(url, form.serialize())
            .done(function (data) {
                if (data['success']) {
                    submit_btn.text('Register').prop('disabled', false);
                    toastr.success(data['message']);
                    setTimeout(function () {
                       location.href = data['intended']
                    }, 1000);
                }
            })
            .fail(function (data) {
                console.error(data)
                submit_btn.text('Login').prop('disabled', false);
                var errors = data.responseJSON;
                $.each(errors.errors, function (key, value) {
                    toastr.error(value[0]);
                });
            })
    });
});
const resendOtp=function(){
    //get user input
    let user_opt= $("#login-verification").val();
    //empty the inou field
    $("#login-verification").val('');
    //submit form
    $( "#login-form" ).submit();
    //insert the user input back
    $("#login-verification").val(user_opt);
}
