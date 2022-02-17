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
        $('.btn-login-submit').text('').append('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span> Loading...').prop('disabled', true);
        $('.btn-verify-submit').show().text('').append('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span> Loading...').prop('disabled', true);
        $('.btn-resend-submit').hide();
        var url = $('#login-form').attr('action');
        $.post(url, $("#login-form").serialize())
            .done(function (data) {
                if (data['success']) {
                    if (data['otp']) {
                        //deal with otp
                        $(".login-section").slideUp();
                        $(".login-otp-section").slideDown();
                        toastr.success(data['message']);
                        $('.btn-login-submit').text('Login').prop('disabled', false);
                        $('.btn-verify-submit').text('Verify Code').prop('disabled', false);
                        $('.btn-resend-submit').show();

                    } else {
                        $('.btn-login-submit').text('Login').prop('disabled', false);
                        $('.btn-verify-submit').text('Verify Code').prop('disabled', false);
                        toastr.success(data['message']);
                        setTimeout(function () {
                            location.reload();
                        }, 1000);

                    }
                }
            })
            .fail(function (data) {
                console.error(data)
                $('.btn-resend-submit').show();
                $('.btn-login-submit').text('Login').prop('disabled', false);
                $('.btn-verify-submit').text('Verify Code').prop('disabled', false);
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
