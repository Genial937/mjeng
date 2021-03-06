'use strict';
$(document).ready(function () {
    toastr.options = {
        timeOut: 9000,
        progressBar: true,
        showMethod: "slideDown",
        hideMethod: "slideUp",
        showDuration: 100,
        hideDuration: 1500
    };
   ///create user
    $(document).on('submit', '#create-user-form', function (e) {
        e.preventDefault();
        let submit_button= $('.btn-create-user');
        let form=$('#create-user-form');
            submit_button.text('').append('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span> Loading...').prop('disabled', true);
        var url = form.attr('action');
        $.post(url, form.serialize())
            .done(function (data) {
                if (data['success']) {
                    submit_button.text('Save User').prop('disabled', false);
                        toastr.success(data['message']);
                    setTimeout(function () {
                        history.back();
                    }, 2000);
                    } else {
                    submit_button.text('Save User').prop('disabled', false);
                        toastr.success(data['message']);
                    }
            })
            .fail(function (data) {
                console.error(data)
                submit_button.text('Save User').prop('disabled', false);
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
                        history.back();
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
                        history.back();
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
                        history.back();
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
const viewUserModal=function (jsonUser){
    $("#view-user").modal("show");
    let user=JSON.parse(jsonUser)
    //details
    $(".modal-user-name").text(user.firstname+' '+user.middlename+' '+user.surname);
    $(".modal-user-email").text(user.email);
    $(".modal-user-phone").text(user.phone);
    $(".modal-user-status").append(user.status===1?'<label class="badge badge-primary">Active</label>':user.status===2?'<label class="badge badge-warning">Pending Email Verification</label>':"<label class=\"badge badge-danger\">Account Disabled</label>");
    //documents
    $(".modal-user-roles").text('')
    $.each(user.roles, function (key, value) {
        $(".modal-user-roles").append(' <a href="javascript:void(0)" class="text-white badge badge-dark">'+value.display_name+'</a>');
    })
}

const deleteRecord=function(url) {
    //confirm delete
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this record!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                $.get(url)
                    .done(function (data) {
                        if (data['success']) {
                            toastr.success(data['message']);
                            setTimeout(function () {
                                location.reload();
                            }, 2000);
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
