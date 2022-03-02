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
    //create vendor business
    $(document).on('submit', '#create-vendor-business-form', function (e) {
        e.preventDefault();
        let form= $('#create-vendor-business-form');
        let button= $('.btn-create-vendor-business');
        button.text('').append('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span> Loading...').prop('disabled', true);
        var url = form.attr('action');
        $.ajax({
            url: url,
            method: "POST",
            data:  new FormData( this ),
            contentType: false,
            cache: false,
            processData:false,
            dataType: "json",
            enctype: 'multipart/form-data',
            success: function (data) {
                console.log(data)
                if (data['success']) {
                    button.text('Save').prop('disabled', false);
                    toastr.success(data['message']);
                    setTimeout(function () {

                    }, 2000);
                } else {
                    button.text('Save').prop('disabled', false);
                    toastr.success(data['message']);
                }
            },
            error: function (data) {
                console.error(data)
                button.text('Save').prop('disabled', false);
                var errors = data.responseJSON;
                $.each(errors.errors, function (key, value) {
                    toastr.error(value[0]);
                });
            }
        })
    });
    //edit vendor business
    $(document).on('submit', '#edit-vendor-business-form', function (e) {
        e.preventDefault();
        let form= $('#edit-vendor-business-form');
        let button= $('.btn-edit-vendor-business');
        button.text('').append('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span> Loading...').prop('disabled', true);
        var url = form.attr('action');
        $.ajax({
            url: url,
            method: "POST",
            data:  new FormData( this ),
            contentType: false,
            cache: false,
            processData:false,
            dataType: "json",
            enctype: 'multipart/form-data',
            success: function (data) {
                console.log(data)
                if (data['success']) {
                    button.text('Save').prop('disabled', false);
                    toastr.success(data['message']);
                    setTimeout(function () {
                        location.reload()
                    }, 2000);
                } else {
                    button.text('Save').prop('disabled', false);
                    toastr.success(data['message']);
                }
            },
            error: function (data) {
                console.error(data)
                button.text('Save').prop('disabled', false);
                var errors = data.responseJSON;
                $.each(errors.errors, function (key, value) {
                    toastr.error(value[0]);
                });
            }
        })
    });
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
                       location.reload();
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
                        location.reload();
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
    let business=$.parseJSON(jsonBusiness);
    if(business.users.length > 0) {
        $("#view-busines-staff").modal("show");

        let data = [];
        $('.staff-table').dataTable().fnClearTable()
        $.each(business.users, function (key, val) {
            data.push([val.firstname, val.surname, val.email, '<button type="button" id="remove-business-staff-' + val.id + '" onclick="removeBusinessStaff(' + val.id + ',' + business.id + ')" class="btn btn-danger btn-floating"><i class="ti-close"></i></button>']);
        });
        $('.staff-table').dataTable().fnAddData(data);
    }else{
        toastr.error("Business doesn't have staff to view.");
    }
}

const removeBusinessStaff=function(user_id,business_id){
    //po
    $('#remove-business-staff-'+user_id).text('').append('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>').prop('disabled', true);
    $.post('/admin/business/contractor/detach/user', {business_id,user_id})
        .done(function (data) {
            if (data['success']) {
                toastr.success(data['message']);
                $("#view-busines-staff").modal("hide");

               // location.reload();
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

};
const viewBusinessModal=function (jsonBusiness,jsonDocuments){
    $("#view-business").modal("show");
    let business=JSON.parse(jsonBusiness)
    let documents=jsonDocuments
    console.log(documents)
   //details
    $(".modal-business-name").text(business.name);
    $(".modal-business-email").text(business.email);
    $(".modal-business-phone").text(business.phone);
    $(".modal-business-address").text(business.address);
    $(".modal-business-type").text(business.type);
    //documents
    $.each(documents, function (key, value) {
        $(".modal-business-type").append(' <h5 class="margin-5-p">'+value.doc_type+' : <span class="text-danger font-italic">'+value.doc_no+'</span></h5>');
        $(".modal-business-type").append(' <h5 class="margin-5-p">Document View : <span class="text-danger font-italic"><a class="btn btn-outline-danger" href="'+value.doc_url+'">View</a> </span></h5>');
    })
}
