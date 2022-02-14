$(document).on('submit', '#loginForm', function (e) {
    e.preventDefault();
    $('.btn-submit').text('');
    $('.btn-submit').append('<div class="circle"></div>');
    var url = $('#loginForm').attr('action');
    $.post(url, $("#loginForm").serialize())
        .done(function (data) {
            console.log(data)
            if (data['success']) {
                if (data['otp']) {
                    $(".login-pass").slideUp();
                    $(".login-otp").slideDown();
                    GrowlNotification.notify({
                        title: '',
                        description: data['message'],
                        type: 'success',
                        position: 'top-center',
                        showProgress: true,
                        closeTimeout: 10000
                    });

                    $('.btn-submit').text('Verify Code');

                }else {
                    GrowlNotification.notify({
                        title: '',
                        description: data['message'],
                        type: 'success',
                        position: 'top-center',
                        showProgress: true,
                        closeTimeout: 10000
                    });

                    setTimeout(function () {
                        $('.btn-submit').text('Login');
                        location.href = data['intended'];
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
