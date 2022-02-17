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
    $("#contractor-fields").slideUp();
    $("#vendor-fields").slideUp();
    $("#admin-fields").slideUp();

    //form usertype- vendor -organisation
    $("#vendor-organisation-fields").slideUp();

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

});
//function expression
const checkUserInputFields=function(){
    //check user type input
    let userType=$("#user-type").val()
    //hide/show user input field
    switch(userType){
        case "CONTRACTOR":
            $("#contractor-fields").slideDown();
            $("#vendor-fields").slideUp();
            $("#admin-fields").slideUp();
            break;
        case "VENDOR" :
            $("#contractor-fields").slideUp();
            $("#vendor-fields").slideDown();
            $("#admin-fields").slideUp();
            break;
        case "ADMIN" :
            $("#contractor-fields").slideUp();
            $("#vendor-fields").slideUp();
            $("#admin-fields").slideDown();
            break;
        default:
            $("#contractor-fields").slideUp();
            $("#vendor-fields").slideUp();
            $("#admin-fields").slideUp();
    }

}
//function expression
const checkVendorAccType=function(){
    //check vendor type input
    let accType=$("#vendor-acc-type").val()
    //hide/show user input field
    switch(accType){
        case "INDIVIDUAL":
            $("#vendor-organisation-fields").slideUp();
            break;
        case "ORGANIZATION" :
            $("#vendor-organisation-fields").slideDown();
            break;
        default:
            $("#vendor-organisation-fields").slideUp();

    }

}
