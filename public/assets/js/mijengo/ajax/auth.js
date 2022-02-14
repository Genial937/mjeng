'use strict';
$(document).ready(function () {
    $(document).on('submit', '#login-form', function (e) {
        e.preventDefault();
        $('.btn-login-submit').text('');
        $('.btn-login-submit').append('<div class="circle"></div>');
        var url = $('#login-form').attr('action');
        $.post(url, $("#login-form").serialize())
            .done(function (data) {
                console.log(data)
                if (data['success']) {
                    if (data['otp']) {
                        $(".login-section").slideUp();
                        $(".login-otp-section").slideDown();
                        toastr.success(data['message']);
                        $('.btn-login-submit').text('Verify Code');
                    } else {
                        toastr.success('Successfully completed');
                        setTimeout(function () {
                            $('.btn-login-submit').text('Login');
                            location.reload();
                        }, 1000);
                    }
                }
            })
            .fail(function (data) {
                $('.btn-login-submit').text('Try Again');
                var errors = data.responseJSON;

                $.each(errors.errors, function (key, value) {
                    toastr.error(value[0]);
                });
            })
    });
});
