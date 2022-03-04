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

    //create vendor business
    $(document).on('submit', '#create-vendor-equipment-form', function (e) {
        e.preventDefault();
        let form= $('#create-vendor-equipment-form');
        let button= $('.btn-create-equipment');
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
    //edit vendor equipment
    $(document).on('submit', '#edit-vendor-equipment-form', function (e) {
        e.preventDefault();
        let form= $('#edit-vendor-equipment-form');
        let button= $('.btn-edit-equipment');
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
                    button.text('Save Changes').prop('disabled', false);
                    toastr.success(data['message']);
                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                } else {
                    button.text('Save Changes').prop('disabled', false);
                    toastr.success(data['message']);
                }
            },
            error: function (data) {
                console.error(data)
                button.text('Save Changes').prop('disabled', false);
                var errors = data.responseJSON;
                $.each(errors.errors, function (key, value) {
                    toastr.error(value[0]);
                });
            }
        })
    });
    //add material
    $(document).on('submit', '#create-vendor-material-form', function (e) {
        e.preventDefault();
        let form= $('#create-vendor-material-form');
        let button= $('.btn-create-material');
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
                    button.text('Save ').prop('disabled', false);
                    toastr.success(data['message']);
                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                } else {
                    button.text('Save ').prop('disabled', false);
                    toastr.success(data['message']);
                }
            },
            error: function (data) {
                console.error(data)
                button.text('Save ').prop('disabled', false);
                var errors = data.responseJSON;
                $.each(errors.errors, function (key, value) {
                    toastr.error(value[0]);
                });
            }
        })
    });
})


const getEquipmentMake=function(){
    //get the equipement type id
    let equipment_type_id =$("#equipment-type-id").val();
    $("#equipment-make-id").empty().append('<option selected  >Loading ...</option>');
    //request
    $.get("/admin/config/equipment/type/"+equipment_type_id)
        .done(function (data) {
            if(data["equipment_type"] && data["equipment_type"].equipment_makes.length >0){
                //clear select
                $("#equipment-make-id").empty().append('<option selected  >Choose equipment make</option>');
                //populate
                $.each(data["equipment_type"].equipment_makes,function(key ,val){
                    $("#equipment-make-id").append('<option value="'+val.id+'"  >'+val.name+'</option>');
                })
            }

        })
        .fail(function (data) {
            console.log(data)
            var errors = data.responseJSON;
            $.each(errors.errors, function (key, value) {
                toastr.error(value[0]);
            });
        })
}
const getEquipmentModel=function(){
    //get the equipement make id
    let equipment_make_id =$("#equipment-make-id").val();
    let select=$("#equipment-model-id");
    select.empty().append('<option selected  >Loading ...</option>');
    //request
    $.get("/admin/config/equipment/make/"+equipment_make_id)
        .done(function (data) {
            if(data["equipment_make"] && data["equipment_make"].equipment_models.length >0){
                //clear select
                select.empty().append('<option selected  >Choose equipment make</option>');
                //populate
                $.each(data["equipment_make"].equipment_models,function(key ,val){
                    select.append('<option value="'+val.id+'"  >'+val.name+'</option>');
                })
            }

        })
        .fail(function (data) {
            console.log(data)
            var errors = data.responseJSON;
            $.each(errors.errors, function (key, value) {
                toastr.error(value[0]);
            });
        })
}


$('.image-popup').magnificPopup({
    type: 'image',
    zoom: {
        enabled: true,
        duration: 300,
        easing: 'ease-in-out',
        opener: function(openerElement) {
            return openerElement.is('img') ? openerElement : openerElement.find('img');
        }
    }
});
Dropzone.options.imageUpload = {
    maxFilesize: 1,
    acceptedFiles: ".jpeg,.jpg,.png,.gif"
};
Dropzone.options.fileUploader = {
    parallelUploads: 1,
    maxFiles:1,
    init: function () {
        this.on("error", function (file, responseText) { //the status from the response is 400
            var status = $(file.previewElement).find('.dz-error-message');
            status.text(responseText.message);
            status.show();
            var msgContainer =  $(file.previewElement).find('.dz-image');
            msgContainer.css({"border" : "2px solid #d90101"}) //red border if fail
        });

    },
    success: function (file, response) {  //the status from the response is 200
        console.log(response)
        var msgContainer =  $(file.previewElement).find('.dz-image');
        msgContainer.css({"border" : "2px solid #38873C"}) //green border
        //set id file to remove link function
        var removeLink = $(file.previewElement).find('.dz-remove')
        removeLink.attr("data-dz-remove", response.data.path);
        //set the url to
        $('input[name=equipment_'+response.data.side+'_image]').val(response.data.path);
    },
};

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

const viewEquipmentModal=function (businessName,jsonEquipment){
    $("#view-equipment").modal("show");
    let equipment=JSON.parse(jsonEquipment)
     console.log(equipment)
    //details
    $(".modal-business-name").text(businessName);
    $(".modal-equipment-ownership").text(equipment.ownership);
    $(".modal-equipment-type").text(equipment.equipmentType.name);
    $(".modal-equipment-model").text(equipment.equipmentModel.name);
    $(".modal-equipment-reg-no").text(equipment.reg_no);
    $(".modal-equipment-plate-no").text(equipment.plate_no);
    $(".modal-equipment-yom").text(equipment.yom);
    $(".modal-equipment-axel").text(equipment.axel);
    $(".modal-equipment-tw").text(equipment.tw);
    $(".modal-equipment-gw").text(equipment.gw);
    $(".modal-equipment-description").text(equipment.description);
    $(".modal-equipment-fuel-type").text(equipment.fuel_type);
    $(".modal-equipment-engine-capacity").text(equipment.engine_capacity);
    $(".modal-equipment-status").append(equipment.status===0?'<label class="badge badge-warning">Pending Approval</label>':business.status===1?'<label class="badge badge-success">Active</label>':equipment.status===2?'<label class="badge badge-danger">Inactive</label>':equipment.status===3?'<label class="badge badge-danger">Approval rejected</label>':'<label class="badge badge-danger">Deleted</label>');
    $(".modal-equipment-comment").append(equipment.status===0?'<label class="badge badge-warning">'+equipment.comment+'</label>':business.status===1?'<label class="badge badge-success">'+equipment.comment+'</label>':equipment.status===2?'<label class="badge badge-danger">'+equipment.comment+'</label>':equipment.status===3?'<label class="badge badge-danger">'+equipment.comment+'</label>':'<label class="badge badge-danger">'+equipment.comment+'</label>');
}
let magnificPopupGalleryConfig = {
    type: 'image',
    gallery: {
        enabled: true
    },
    zoom: {
        enabled: true,
        duration: 300,
        easing: 'ease-in-out',
        opener: function(openerElement) {
            return openerElement.is('img') ? openerElement : openerElement.find('img');
        }
    }
};
$('.image-popup-gallery-item').magnificPopup(magnificPopupGalleryConfig);
//get material-class type
const getMaterialClass=function (){
    let material_type_id =$("#material-type-id").val();
    let form_select= $("#material-class-id");
    form_select.empty().append('<option selected  >Loading ...</option>');
    //request
    $.get("/admin/config/material/type/find/"+material_type_id)
        .done(function (data) {
            if(data["material_type"] && data["material_type"].classifications.length >0){
                //clear select
                form_select.empty().append('<option selected  >Choose material classification</option>');
                //populate
                $.each(data["material_type"].classifications,function(key ,val){
                    form_select.append('<option value="'+val.id+'"  >'+val.name+'</option>');
                })
            }

        })
        .fail(function (data) {
            console.log(data)
            var errors = data.responseJSON;
            $.each(errors.errors, function (key, value) {
                toastr.error(value[0]);
            });
        })
}

const viewMaterialModal=function (businessName,jsonMaterial){
    $("#view-material").modal("show");
    let material=JSON.parse(jsonMaterial)
    console.log(material)
    //details
    $(".modal-business-name").text(businessName);
    $(".modal-material-ownership").text(material.ownership);
    $(".modal-material-type").text(material.materialType.name);
    $(".modal-material-class").text(material.materialClass.name);
    $(".modal-material-reg-no").text(material.reg_no);
    $(".modal-material-description").text(material.description);
    $(".modal-material-status").append(material.status===0?'<label class="badge badge-warning">Pending Approval</label>':material.status===1?'<label class="badge badge-success">Active</label>':material.status===2?'<label class="badge badge-danger">Inactive</label>':material.status===3?'<label class="badge badge-danger">Approval rejected</label>':'<label class="badge badge-danger">Deleted</label>');
    $(".modal-material-comment").append(material.status===0?'<label class="badge badge-warning">'+material.comment+'</label>':material.status===1?'<label class="badge badge-success">'+material.comment+'</label>':equipment.status===2?'<label class="badge badge-danger">'+material.comment+'</label>':equipment.status===3?'<label class="badge badge-danger">'+material.comment+'</label>':'<label class="badge badge-danger">'+equipment.comment+'</label>');
}