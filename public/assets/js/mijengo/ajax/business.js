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
    $(document).on('submit', '#create-contractor-business-form', function (e) {
        e.preventDefault();
        $('.btn-create-contractor-business').text('').append('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span> Loading...').prop('disabled', true);
        var url = $('#create-contractor-business-form').attr('action');
        $.post(url, $("#create-contractor-business-form").serialize())
            .done(function (data) {
                if (data['success']) {
                    $('.btn-create-contractor-business').text('Save').prop('disabled', false);
                    toastr.success(data['message']);
                    setTimeout(function () {
                        history.back();
                    }, 2000);
                } else {
                    $('.btn-create-contractor-business').text('Save').prop('disabled', false);
                    toastr.success(data['message']);
                }
            })
            .fail(function (data) {
                console.error(data)
                $('.btn-create-contractor-business').text('Save').prop('disabled', false);
                var errors = data.responseJSON;
                $.each(errors.errors, function (key, value) {
                    toastr.error(value[0]);
                });
            })
    });
    $(document).on('submit', '#update-contractor-business-form', function (e) {
        e.preventDefault();
        $('.btn-update-contractor-business').text('').append('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span> Loading...').prop('disabled', true);
        var url = $('#update-contractor-business-form').attr('action');
        $.post(url, $("#update-contractor-business-form").serialize())
            .done(function (data) {
                if (data['success']) {
                    $('.btn-update-contractor-business').text('Save').prop('disabled', false);
                    toastr.success(data['message']);
                    setTimeout(function () {
                      history.back();
                    }, 2000);
                } else {
                    $('.btn-update-contractor-business').text('Save').prop('disabled', false);
                    toastr.success(data['message']);
                }
            })
            .fail(function (data) {
                console.error(data)
                $('.btn-update-contractor-business').text('Save').prop('disabled', false);
                var errors = data.responseJSON;
                $.each(errors.errors, function (key, value) {
                    toastr.error(value[0]);
                });
            })
    });
    $(document).on('submit', '#add-staff-modal-form', function (e) {
        e.preventDefault();
        $('.btn-add-business-users').text('').append('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span> Loading...').prop('disabled', true);
        var url = $('#add-staff-modal-form').attr('action');
        $.post(url, $("#add-staff-modal-form").serialize())
            .done(function (data) {
                if (data['success']) {
                    $('.btn-add-business-users').text('Save').prop('disabled', false);
                    toastr.success(data['message']);
                    setTimeout(function () {
                       //close the modal
                        $("#add-staff").modal("hide");
                        //reload
                        location.reload();
                    }, 1000);
                } else {
                    $('.btn-add-business-users').text('Save').prop('disabled', false);
                    toastr.success(data['message']);
                }
            })
            .fail(function (data) {
                console.error(data)
                $('.btn-add-business-users').text('Save ').prop('disabled', false);
                var errors = data.responseJSON;
                $.each(errors.errors, function (key, value) {
                    toastr.error(value[0]);
                });
            })
    });
});

const addStaffModal=function (jsonBusiness,newStaffLink){
    $("#add-staff").modal("show");
    let business=$.parseJSON(jsonBusiness);
    $(".business-name").text(business.name);
    $("#add-staff-modal-form input[name=business_id]").val(business.id);
    $("#add-new-staff-href").attr("href",newStaffLink);
}
const viewStaffsModal=function (jsonBusiness){
    $("#view-busines-staff").modal("show");
    let business=$.parseJSON(jsonBusiness);
    let userTable = $('#staff-table').dataTable();
    let data=[];
    userTable.clear();
    $.each(business.users, function(key,val) {
        data.push([val.firstname,val.surname,val.email,'<button type="button" onclick="removeBusinessStaff('+val+')" class="btn btn-danger btn-floating"><i class="ti-close"></i></button>']);
    });
    console.log(data)
    userTable.fnAddData(data);
}

const removeBusinessStaff=function(users){
    //po
    console.log(users);
    $.post('/business/contractor/detach/user', {users})
        .done(function (data) {
            if (data['success']) {
                toastr.success(data['message']);
                setTimeout(function () {
                    //close the modal
                    $("#add-staff").modal("hide");
                    //reload
                    location.reload();
                }, 1000);
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

}
