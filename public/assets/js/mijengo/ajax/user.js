'use strict';
$(document).ready(function () {
    toastr.options = {
        timeOut: 9000,
        progressBar: true,
        showMethod: "slideDown",
        hideMethod: "slideUp",
        showDuration: 1200,
        hideDuration: 1500
    };
    // form user type sections
    // $("#contractor-fields").slideUp();
    // $("#vendor-fields").slideUp();
    // $("#admin-fields").slideUp();

    //form usertype- vendor -organisation
    // $("#vendor-organisation-fields").slideUp();

    $(document).on('submit', '#create-user-form', function (e) {
        e.preventDefault();
        $('.btn-create-user').text('').append('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span> Loading...').prop('disabled', true);
        var url = $('#create-user-form').attr('action');
        $.post(url, $("#create-user-form").serialize())
            .done(function (data) {
                if (data['success']) {
                    $('.btn-create-user').text('Save User').prop('disabled', false);
                        toastr.success(data['message']);
                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                    } else {
                    $('.btn-create-user').text('Save User').prop('disabled', false);
                        toastr.success(data['message']);
                    }
            })
            .fail(function (data) {
                console.error(data)
                $('.btn-create-user').text('Save User').prop('disabled', false);
                var errors = data.responseJSON;
                $.each(errors.errors, function (key, value) {
                    toastr.error(value[0]);
                });
            })
    });
    $(document).on('submit', '#update-user-form', function (e) {
        e.preventDefault();
        $('.btn-update-user').text('').append('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span> Loading...').prop('disabled', true);
        var url = $('#update-user-form').attr('action');
        $.post(url, $("#update-user-form").serialize())
            .done(function (data) {
                if (data['success']) {
                    $('.btn-update-user').text('Save Changes').prop('disabled', false);
                    toastr.success(data['message']);
                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                } else {
                    $('.btn-update-user').text('Save Changes').prop('disabled', false);
                    toastr.success(data['message']);
                }
            })
            .fail(function (data) {
                console.error(data)
                $('.btn-update-user').text('Save Changes').prop('disabled', false);
                var errors = data.responseJSON;
                $.each(errors.errors, function (key, value) {
                    toastr.error(value[0]);
                });
            })
    });
    $(document).on('submit', '#update-user-businesses', function (e) {
        e.preventDefault();
        $('.btn-update-user-business').text('').append('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span> Loading...').prop('disabled', true);
        var url = $('#update-user-businesses').attr('action');
        $.post(url, $("#update-user-businesses").serialize())
            .done(function (data) {
                if (data['success']) {
                    $('.btn-update-user-business').text('Save Changes').prop('disabled', false);
                    toastr.success(data['message']);
                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                } else {
                    $('.btn-update-user-business').text('Save Changes').prop('disabled', false);
                    toastr.success(data['message']);
                }
            })
            .fail(function (data) {
                console.error(data)
                $('.btn-update-user-business').text('Save Changes').prop('disabled', false);
                var errors = data.responseJSON;
                $.each(errors.errors, function (key, value) {
                    toastr.error(value[0]);
                });
            })
    });
    //change password
    $(document).on('submit', '#change-password-form', function (e) {
        e.preventDefault();
        $('.btn-change-password').text('').append('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span> Loading...').prop('disabled', true);
        var url = $('#change-password-form').attr('action');
        $.post(url, $("#change-password-form").serialize())
            .done(function (data) {
                if (data['success']) {
                    $('.btn-change-password').text('Save Changes').prop('disabled', false);
                    toastr.success(data['message']);
                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                } else {
                    $('.btn-change-password').text('Save Changes').prop('disabled', false);
                    toastr.success(data['message']);
                }
            })
            .fail(function (data) {
                console.error(data)
                $('.btn-change-password').text('Save Changes').prop('disabled', false);
                var errors = data.responseJSON;
                $.each(errors.errors, function (key, value) {
                    toastr.error(value[0]);
                });
            })
    });
});
//function expression
// const checkUserInputFields=function(){
//     //check user type input
//     let userType=$("#user-type").val()
//     //hide/show user input field
//     switch(userType){
//         case "CONTRACTOR":
//             $("#contractor-fields").slideDown();
//             $("#vendor-fields").slideUp();
//             $("#admin-fields").slideUp();
//             break;
//         case "VENDOR" :
//             $("#contractor-fields").slideUp();
//             $("#vendor-fields").slideDown();
//             $("#admin-fields").slideUp();
//             break;
//         case "ADMIN" :
//             $("#contractor-fields").slideUp();
//             $("#vendor-fields").slideUp();
//             $("#admin-fields").slideDown();
//             break;
//         default:
//             $("#contractor-fields").slideUp();
//             $("#vendor-fields").slideUp();
//             $("#admin-fields").slideUp();
//     }
//
// }
//function expression
// const checkVendorAccType=function(){
//     //check vendor type input
//     let accType=$("#vendor-acc-type").val()
//     //hide/show user input field
//     switch(accType){
//         case "INDIVIDUAL":
//             $("#vendor-organisation-fields").slideUp();
//             break;
//         case "ORGANIZATION" :
//             $("#vendor-organisation-fields").slideDown();
//             break;
//         default:
//             $("#vendor-organisation-fields").slideUp();
//
//     }
//
// }
//detach user from the business/organisation
const deleteUser=function(user_id,url){
    //confirm to delete
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this record!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                $.post(url, {user_id})
                    .done(function (data) {
                        if (data['success']) {
                            toastr.success(data['message']);
                            // setTimeout(function () {
                            //     location.reload();
                            // }, 2000);
                        } else {
                            toastr.success(data['message']);
                        }

                    })
                    .fail(function (data) {
                        console.error(data)
                        var errors = data.responseJSON;
                        $.each(errors.errors, function (key, value) {
                            toastr.error(value[0]);
                        });
                    })

            } else {
                toastr.info('Delete Cancelled!');
            }
        })
}
$('.toggle-password').click(function(){
    let input = $(this).prev();
    input.attr('type', input.attr('type') === 'password' ? 'text' : 'password');
});
