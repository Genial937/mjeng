'use strict';
$(document).ready(function () {
    $(document).on('submit', '#login-form', function (e) {
        e.preventDefault();
        $('.btn-login-submit').text('');
        $('.btn-login-submit').append('<div class="circle"></div>');
        var url = $('#loginForm').attr('action');
        $.post(url, $("#loginForm").serialize())
            .done(function (data) {
                console.log(data)
                if (data['success']) {
                    if (data['otp']) {
                        $(".login-section").slideUp();
                        $(".login-otp-section").slideDown();
                        toastr.error(data['message']);
                        $('.btn-login-submit').text('Verify Code');
                    } else {
                        toastr.success('Successfully completed');
                        setTimeout(function () {
                            $('.btn-login-submit').text('Login');
                            location.reload();
                        }, 1000);
                    }
                }
                ;
            })
            .fail(function (data) {
                $('.btn-submit').text('Login');
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
});
