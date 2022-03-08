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
                        location.reload();
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
            //filter admin
            if(val.roles.some(e => e.name !== 'admin'))
               data.push([val.firstname+' '+val.surname, val.email, val.phone, '<button type="button" id="remove-business-staff-' + val.id + '" onclick="removeBusinessStaff(' + val.id + ',' + business.id + ')" class="btn btn-danger btn-floating"><i class="ti-close"></i></button>']);

        });
        if(data.length > 0)
           $('.staff-table').dataTable().fnAddData(data);
    }else{
        toastr.error("Business doesn't have staff to view.");
    }
}

const removeBusinessStaff=function(user_id,business_id){
    //prompt
    swal({
        title: "Are you sure?",
        text: "",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
            if (willDelete) {
                $('#remove-business-staff-'+user_id).empty('').append('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>').prop('disabled', true);
                $.post("/admin/business/contractor/detach/user",{business_id,user_id})
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


};
const viewBusinessModal=function (jsonBusiness,jsonDocuments){
    $("#view-business").modal("show");
    let business=JSON.parse(jsonBusiness)
    let documents=JSON.parse(jsonDocuments)
   //details
    console.log(business.comment)
    $(".modal-business-name").text(business.name);
    $(".modal-business-email").text(business.email);
    $(".modal-business-phone").text(business.phone);
    $(".modal-business-address").text(business.address);
    $(".modal-business-type").text(business.type);
    $(".modal-business-status").empty().append(business.status===1?'<label class="badge badge-warning">Pending Approval</label>':business.status===2?'<label class="badge badge-success">Approved</label>':"<label class=\"badge badge-danger\">Decline with reason</label>");
    $(".modal-business-description").empty().append(business.status===1?'<label class="badge badge-warning">'+business.comments+'</label>':business.status===2?'<label class="badge badge-success">'+business.comments+'</label>':'<label class="badge badge-danger">'+business.comments+'</label>');

    //documents
    $(".modal-business-documents").empty()
    $.each(documents, function (key, value) {
        $(".modal-business-documents").append(' <p class="margin-5-p">'+value.doc_type+' : <span class="text-danger ">'+value.doc_no+'</span></p>');
        $(".modal-business-documents").append(' <p class="margin-5-p">Document View : <span class="text-danger "><a class="btn-link" target="_blank" href="'+value.doc_url+'"><i class="ti-eye"></i> View</a> </span></p>');
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

const documentTypeJson=JSON.parse('[{"business_type":"PARTNERSHIP", "document_type":"ID"},{"business_type":"PARTNERSHIP", "document_type":"PASSPORT"},{"business_type":"SOLE_PROPRIETOR", "document_type":"ID"},{"business_type":"SOLE_PROPRIETOR", "document_type":"PASSPORT"},{"business_type":"COMPANY", "document_type":"CERTIFICATE"}]');
const getBusinessDocTye=function () {
    let business_type=$("#business-type").val()
    //clear select
    $("#business-doc-type").empty().append('<option selected>Choose document type</option>');
    //populate
    $.each(documentTypeJson,function(key ,val){
        if(business_type===val.business_type)
          $("#business-doc-type").append('<option value="'+val.document_type+'"  >'+val.document_type+'</option>');
    })
}
