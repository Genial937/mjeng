'use strict';
$(document).ready(function () {
    toastr.options = {
        timeOut: 3000,
        progressBar: true,
        showMethod: "slideDown",
        hideMethod: "slideUp",
        showDuration: 500,
        hideDuration: 500
    };
    $(document).on('submit', '#login-form', function (e) {
        e.preventDefault();
        $('.btn-login-submit').text('');
        $('.btn-login-submit').append('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span> Loading...').prop('disabled', true);;
        var url = $('#login-form').attr('action');
        $.post(url, $("#login-form").serialize())
            .done(function (data) {
                if (data['success']) {
                    if (data['otp']) {
                        $(".login-section").slideUp();
                        $(".login-otp-section").slideDown();
                        toastr.success(data['message']);
                        $('.btn-login-submit').text('Verify Code');
                    } else {
                        toastr.success(data['message']);
                        setTimeout(function () {
                            $('.btn-login-submit').text('Login').prop('disabled', false);
                            location.reload();
                        }, 1000);

                    }
                }
            })
            .fail(function (data) {
                $('.btn-login-submit').text('Try Again').prop('disabled', false);
                var errors = data.responseJSON;

                $.each(errors.errors, function (key, value) {
                    toastr.error(value[0]);
                });
            })
    });
});
