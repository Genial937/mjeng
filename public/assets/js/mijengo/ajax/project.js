'use strict';
/*
 * Created by James Mwangi
 * Project module
 */
$(document).ready(function () {
    toastr.options = {
        timeOut: 9000,
        progressBar: true,
        showMethod: "slideDown",
        hideMethod: "slideUp",
        showDuration: 1200,
        hideDuration: 1500
    };
    //save project details
    $(document).on('submit', '#create-project-detail-form', function (e) {
        e.preventDefault();
        let form=$('#create-project-detail-form');
        let submit_button= $('.btn-create-project-details');
        submit_button.text('').append('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span> Loading...').prop('disabled', true);
        var url =form.attr('action');
        $.post(url,form.serialize())
            .done(function (data) {
                if (data['success']) {
                    submit_button.text('Save').prop('disabled', false);
                    toastr.success(data['message']);
                    setTimeout(function () {
                        //go to the next step
                        location.href=data["next_step"];
                    }, 2000);
                } else {
                    submit_button.text('Save').prop('disabled', false);
                    toastr.success(data['message']);
                }
            })
            .fail(function (data) {
                console.error(data)
                submit_button.text('Save').prop('disabled', false);
                var errors = data.responseJSON;
                $.each(errors.errors, function (key, value) {
                    toastr.error(value[0]);
                });
            })
    });
    //save project sites
    $(document).on('submit', '#create-project-site-form', function (e) {
        e.preventDefault();
        let form=$('#create-project-site-form');
        let submit_button= $('.btn-create-project-site');
        submit_button.text('').append('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span> Loading...').prop('disabled', true);
        var url =form.attr('action');
        $.post(url, form.serialize())
            .done(function (data) {
                if (data['success']) {
                    submit_button.text('Save').prop('disabled', false);
                    toastr.success(data['message']);
                    //reset the form
                    form.trigger("reset");
                    location.reload();
                } else {
                    submit_button.text('Save').prop('disabled', false);
                    toastr.success(data['message']);
                }
            })
            .fail(function (data) {
                console.error(data)
                submit_button.text('Save').prop('disabled', false);
                var errors = data.responseJSON;
                $.each(errors.errors, function (key, value) {
                    toastr.error(value[0]);
                });
            })
    });
    //edit project site
    $(document).on('submit', '#edit-project-site-form', function (e) {
        e.preventDefault();
        let form=$('#edit-project-site-form');
        let submit_button= $('.btn-edit-project-site');
        submit_button.text('').append('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span> Loading...').prop('disabled', true);
        var url =form.attr('action');
        $.post(url, form.serialize())
            .done(function (data) {
                if (data['success']) {
                    submit_button.text('Save').prop('disabled', false);
                    toastr.success(data['message']);
                    //close modal
                    $("#edit-site").modal('hide');
                    //reload page
                    location.reload();
                } else {
                    submit_button.text('Save').prop('disabled', false);
                    toastr.success(data['message']);
                }
            })
            .fail(function (data) {
                console.error(data)
                submit_button.text('Save').prop('disabled', false);
                var errors = data.responseJSON;
                $.each(errors.errors, function (key, value) {
                    toastr.error(value[0]);
                });
            })
    });

    //add equipment required
    $(document).on('submit', '#create-equipment-required-form', function (e) {
        e.preventDefault();
        let form=$('#create-equipment-required-form');
        let submit_button= $('.btn-create-equipment-required');
        submit_button.text('').append('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span> Loading...').prop('disabled', true);
        var url =form.attr('action');
        $.post(url, form.serialize())
            .done(function (data) {
                if (data['success']) {
                    submit_button.text('Save').prop('disabled', false);
                    toastr.success(data['message']);
                    //reload page
                    location.reload();
                } else {
                    submit_button.text('Save').prop('disabled', false);
                    toastr.success(data['message']);
                }
            })
            .fail(function (data) {
                console.error(data)
                submit_button.text('Save').prop('disabled', false);
                var errors = data.responseJSON;
                $.each(errors.errors, function (key, value) {
                    toastr.error(value[0]);
                });
            })
    });
    //edit equipment required
    $(document).on('submit', '#edit-equipment-required-form', function (e) {
        e.preventDefault();
        let form=$('#edit-equipment-required-form');
        let submit_button= $('.btn-edit-equipment-required');
        submit_button.text('').append('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span> Loading...').prop('disabled', true);
        var url =form.attr('action');
        $.post(url, form.serialize())
            .done(function (data) {
                if (data['success']) {
                    submit_button.text('Save Changes').prop('disabled', false);
                    toastr.success(data['message']);
                    //show edit modal
                    $("#edit-equipment-required").modal('hide');
                    setTimeout(function () {
                        location.reload();
                    },2000)
                } else {
                    submit_button.text('Save Changes').prop('disabled', false);
                    toastr.success(data['message']);
                }
            })
            .fail(function (data) {
                console.error(data)
                submit_button.text('Save Changes').prop('disabled', false);
                var errors = data.responseJSON;
                $.each(errors.errors, function (key, value) {
                    toastr.error(value[0]);
                });
            })
    });
    //add material required
    $(document).on('submit', '#create-material-required-form', function (e) {
        e.preventDefault();
        let form=$('#create-material-required-form');
        let submit_button= $('.btn-create-material-required');
        submit_button.text('').append('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span> Loading...').prop('disabled', true);
        var url =form.attr('action');
        $.post(url, form.serialize())
            .done(function (data) {
                if (data['success']) {
                    submit_button.text('Save').prop('disabled', false);
                    toastr.success(data['message']);
                    setTimeout(function () {
                        location.reload();
                    },2000)
                } else {
                    submit_button.text('Save').prop('disabled', false);
                    toastr.success(data['message']);
                }
            })
            .fail(function (data) {
                console.error(data)
                submit_button.text('Save').prop('disabled', false);
                var errors = data.responseJSON;
                $.each(errors.errors, function (key, value) {
                    toastr.error(value[0]);
                });
            })
    });

    //edit project
    $(document).on('submit', '#edit-project-detail-form', function (e) {
        e.preventDefault();
        let form=$('#edit-project-detail-form');
        let submit_button= $('.btn-edit-project-details');
        submit_button.text('').append('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span> Loading...').prop('disabled', true);
        var url =form.attr('action');
        $.post(url, form.serialize())
            .done(function (data) {
                if (data['success']) {
                    submit_button.text('Save Changes').prop('disabled', false);
                    toastr.success(data['message']);
                    setTimeout(function () {
                        location.reload();
                    },2000)
                } else {
                    submit_button.text('Save Changes').prop('disabled', false);
                    toastr.success(data['message']);
                }
            })
            .fail(function (data) {
                console.error(data)
                submit_button.text('Save Changes').prop('disabled', false);
                var errors = data.responseJSON;
                $.each(errors.errors, function (key, value) {
                    toastr.error(value[0]);
                });
            })
    });
    //edit material required
    $(document).on('submit', '#edit-material-required-form', function (e) {
        e.preventDefault();
        let form=$('#edit-material-required-form');
        let submit_button= $('.btn-edit-material-required');
        submit_button.text('').append('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span> Loading...').prop('disabled', true);
        var url =form.attr('action');
        $.post(url, form.serialize())
            .done(function (data) {
                if (data['success']) {
                    submit_button.text('Save Changes').prop('disabled', false);
                    toastr.success(data['message']);
                    setTimeout(function () {
                        location.reload();
                    },2000)
                } else {
                    submit_button.text('Save Changes').prop('disabled', false);
                    toastr.success(data['message']);
                }
            })
            .fail(function (data) {
                console.error(data)
                submit_button.text('Save Changes').prop('disabled', false);
                var errors = data.responseJSON;
                $.each(errors.errors, function (key, value) {
                    toastr.error(value[0]);
                });
            })
    });
    //add project equipment required
    $(document).on('submit', '#add-equipment-required-form', function (e) {
        e.preventDefault();
        let form=$('#add-equipment-required-form');
        let submit_button= $('.btn-equipment-required');
        submit_button.text('').append('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span> Loading...').prop('disabled', true);
        var url =form.attr('action');
        $.post(url,form.serialize())
            .done(function (data) {
                if (data['success']) {
                    submit_button.text('Save').prop('disabled', false);
                    toastr.success(data['message']);
                    setTimeout(function () {
                        //go to the next step
                        location.reload()
                    }, 2000);
                } else {
                    submit_button.text('Save').prop('disabled', false);
                    toastr.success(data['message']);
                }
            })
            .fail(function (data) {
                console.error(data)
                submit_button.text('Save').prop('disabled', false);
                var errors = data.responseJSON;
                $.each(errors.errors, function (key, value) {
                    toastr.error(value[0]);
                });
            })
    });
    //add project material required
    $(document).on('submit', '#add-material-required-form', function (e) {
        e.preventDefault();
        let form=$('#add-material-required-form');
        let submit_button= $('.btn-material-required');
        submit_button.text('').append('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span> Loading...').prop('disabled', true);
        var url =form.attr('action');
        $.post(url,form.serialize())
            .done(function (data) {
                if (data['success']) {
                    submit_button.text('Save').prop('disabled', false);
                    toastr.success(data['message']);
                    setTimeout(function () {
                        //go to the next step
                        location.reload()
                    }, 2000);
                } else {
                    submit_button.text('Save').prop('disabled', false);
                    toastr.success(data['message']);
                }
            })
            .fail(function (data) {
                console.error(data)
                submit_button.text('Save').prop('disabled', false);
                var errors = data.responseJSON;
                $.each(errors.errors, function (key, value) {
                    toastr.error(value[0]);
                });
            })
    });
});
//get the county{id}-subcounties
const getSubcounties=function(){
    let county_id =$("#county-id").val();
    let form_select= $("#sub-county-id");
    form_select.empty().append('<option selected  >Loading ...</option>');
    //request
    $.get("/admin/config/county/find/"+county_id)
        .done(function (data) {
            if(data["county"] && data["county"].subcounties.length >0){
                //clear select
                form_select.empty().append('<option selected  >Choose subcounty</option>');
                //populate
                $.each(data["county"].subcounties,function(key ,val){
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
const getEditSubcounties=function(){
    let county_id =$("#modal-input-county-id").val();
    let form_select= $("#modal-input-sub-county-id");
    form_select.empty().append('<option selected  >Loading ...</option>');
    //request
    $.get("/admin/config/county/find/"+county_id)
        .done(function (data) {
            if(data["county"] && data["county"].subcounties.length >0){
                //clear select
                form_select.empty().append('<option selected  >Choose subcounty</option>');
                //populate
                $.each(data["county"].subcounties,function(key ,val){
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
//edit project details
const editProjectDetails=function(project){
    //decode
    let decoded_project=$.parseJSON(project);
    console.log(decoded_project)
    //show edit modal
    $("#edit-project").modal('show');
    //set values
    $("#modal-input-project-name").val(decoded_project.name);
    $("#modal-input-project-description").val(decoded_project.description);
    $('#modal-input-start-date').val(decoded_project.start_date);
    $("#modal-input-end-date").val(decoded_project.end_date);
    $("#modal-input-business-id").select2().val(decoded_project.business_id).trigger('change');
    $("#modal-input-county-id").select2().val(decoded_project.sub_county.county.id).trigger('change');
    setTimeout(function () {
        $("#modal-input-sub-county-id").select2().val(decoded_project.sub_county.id).trigger('change');
    },5000)
    $("#modal-input-project-id").val(decoded_project.id);

}
//edit site
const editProjectSites=function(site){
    //decode
    let decode_site=$.parseJSON(site);
    //show edit modal
    // create an task_ids array from decode_site.tasks
    let task_ids = decode_site.tasks.map(item => item.id);
    $("#edit-site").modal('show');
    //set values
    $("#modal-input-site-name").val(decode_site.name);
    $("#modal-input-site-description").val(decode_site.description);
    $('#modal-input-site-tasks').select2().val(task_ids).trigger('change');
    $("#modal-input-site-id").val(decode_site.id);

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
//get site-tasks
const formAddGetSiteTasks=function (){
    let site_id =$("#site-id").val();
    let form_select= $("#task-id");
    form_select.empty().append('<option selected  >Loading ...</option>');
    //request
    $.get("/admin/projects/find/site/"+site_id)
        .done(function (data) {
            if(data["site"] && data["site"].tasks.length >0){
                //clear select
                form_select.empty().append('<option selected  >Choose task</option>');
                //populate
                $.each(data["site"].tasks,function(key ,val){
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
//get task-equipment type
const formAddGetTaskEquipmentType=function (){
    let task_id =$("#task-id").val();
    let form_select= $("#equipment-type-id");
    form_select.empty().append('<option selected  >Loading ...</option>');
    //request
    $.get("/admin/config/task/find/"+task_id)
        .done(function (data) {
            if(data["task"] && data["task"].equipment_types.length >0){
                //clear select
                form_select.empty().append('<option selected  >Choose equipment type</option>');
                //populate
                $.each(data["task"].equipment_types,function(key ,val){
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
//get task-material type
const formAddGetTaskMaterialType=function (){
    let task_id =$("#task-id").val();
    let form_select= $("#material-type-id");
    form_select.empty().append('<option selected  >Loading ...</option>');
    //request
    $.get("/admin/config/task/find/"+task_id)
        .done(function (data) {
            if(data["task"] && data["task"].material_types.length >0){
                //clear select
                form_select.empty().append('<option selected  >Choose material type</option>');
                //populate
                $.each(data["task"].material_types,function(key ,val){
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
//get task-material type
const formEditGetTaskMaterialType=function (){
    let task_id =$("#modal-input-task-id").val();
    let form_select= $("#modal-input-material-type-id");
    form_select.empty().append('<option selected  >Loading ...</option>');
    //request
    $.get("/admin/config/task/find/"+task_id)
        .done(function (data) {
            if(data["task"] && data["task"].material_types.length >0){
                //clear select
                form_select.empty().append('<option selected  >Choose material type</option>');
                //populate
                $.each(data["task"].material_types,function(key ,val){
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
//get material-class type
const formAddGetMaterialClass=function (){
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
//get material-class type
const formEditGetMaterialClass=function (){
    let material_type_id =$("#modal-input-material-type-id").val();
    let form_select= $("#modal-input-material-class-id");
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
//get site-tasks
const formEditGetSiteTasks=function (){
    let site_id =$("#modal-input-site-id").val();
    let form_select= $("#modal-input-task-id");
    form_select.empty().append('<option selected  >Loading ...</option>');
    //request
    $.get("/admin/projects/find/site/"+site_id)
        .done(function (data) {
            if(data["site"] && data["site"].tasks.length >0){
                //clear select
                form_select.empty().append('<option selected  >Choose task</option>');
                //populate
                $.each(data["site"].tasks,function(key ,val){
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
//get task-equipment type
const formEditGetTaskEquipmentType=function (){
    let task_id =$("#modal-input-task-id").val();
    let form_select= $("#modal-input-equipment-type-id");
    form_select.empty().append('<option selected  >Loading ...</option>');
    //request
    $.get("/admin/config/task/find/"+task_id)
        .done(function (data) {
            if(data["task"] && data["task"].equipment_types.length >0){
                //clear select
                form_select.empty().append('<option selected  >Choose task</option>');
                //populate
                $.each(data["task"].equipment_types,function(key ,val){
                    form_select.append('<option value="'+val.id+'"  >'+val.name+'</option>');
                })
            }

        })
        .fail(function (data) {
            var errors = data.responseJSON;
            $.each(errors.errors, function (key, value) {
                toastr.error(value[0]);
            });
        })
}
//edit equipment required
const editEquipmentRequired=function(requirement){
    //decode
    let decode_requirement=$.parseJSON(requirement);
    //show edit modal
    $("#edit-equipment-required").modal('show');
    //set values
    $("#modal-input-site-id").select2().val(decode_requirement.site.id).trigger('change');
    //wait for 5sec- for the site change event to fetch task
    setTimeout(function () {
        $("#modal-input-task-id").select2().val(decode_requirement.task_id).trigger('change');
        //wait for 5sec- for the site change event to fetch task
        setTimeout(function () {
            $("#modal-input-equipment-type-id").select2().val(decode_requirement.equipment_type_id).trigger('change');
        }, 5000);
    }, 5000);
    $("#modal-input-no-equipment").val(decode_requirement.no_equipment);
    $("#modal-input-min-loading-capacity").val(decode_requirement.payload_capacity);
    $("#modal-input-payload-unit").val(decode_requirement.payload_unit);
    $("#modal-input-duration").val(decode_requirement.duration);
    $("#modal-input-duration-unit").val(decode_requirement.duration_unit);
    $("#modal-input-currency").val(decode_requirement.currency);
    $("#modal-input-lease-rates").val(decode_requirement.lease_rates);
    $("#modal-input-lease-modality").val(decode_requirement.lease_modality);
    $("#modal-input-fuel-provision").val(decode_requirement.fuel_provision);
    $("#modal-input-cess-provision").val(decode_requirement.cess_provision);
    $("#modal-equipment-required-id").val(decode_requirement.id);

}
//edit material required
const editMaterialRequired=function(requirement){
    //decode
    let decode_requirement=$.parseJSON(requirement);
    //show edit modal
    $("#edit-material-required").modal('show');
    //set values
    $("#modal-input-site-id").select2().val(decode_requirement.site.id).trigger('change');
    //wait for 5sec- for the site change event to fetch task
    setTimeout(function () {
        $("#modal-input-task-id").select2().val(decode_requirement.task_id).trigger('change');
        //wait for 5sec- for the site change event to fetch task
        setTimeout(function () {
            $("#modal-input-material-type-id").select2().val(decode_requirement.material_type_id).trigger('change');
            setTimeout(function () {
                $("#modal-input-material-class-id").select2().val(decode_requirement.material_class_id).trigger('change');
            }, 5000);
        }, 5000);
    }, 5000);

    $("#modal-input-quantity-required").val(decode_requirement.quantity_required);
    $("#modal-input-quantity-required-unit").val(decode_requirement.quantity_required_unit);
    $("#modal-input-quantity-required-per-day").val(decode_requirement.quantity_required_per_day);
    $("#modal-input-quantity-required-per-day-unit").val(decode_requirement.quantity_required_per_day_unit);
    $("#modal-input-currency").val(decode_requirement.currency);
    $("#modal-input-lease-rates").val(decode_requirement.lease_rates);
    $("#modal-input-lease-modality").val(decode_requirement.lease_modality);
    $("#modal-input-payment-term-desc").val(decode_requirement.payment_term_desc);
    $("#modal-input-cess-provision").val(decode_requirement.cess);
    $("#modal-input-material-required-id").val(decode_requirement.id);

}
//assign material required
const assignEquipmentFromInventory=function(requirement){
    //decode
    let decode_requirement=$.parseJSON(requirement);
    $(".modal-equipment-type-name").text(decode_requirement.equipment_type.name);
    $("#modal-add-equipment-type-id").val(decode_requirement.equipment_type.id);
    $(".modal-equipment-no-required").text(decode_requirement.no_equipment);
    $("#modal-equipment-required-id").val(decode_requirement.id);
    //show edit modal
    $("#add-equipments").modal('show');
}

const getBusinessEquipments=function (){
    let business_id=$("#modal-add-equipment-business-id").val();
    let equipment_type_id=$("#modal-add-equipment-type-id").val();
    let form_select= $("#modal-add-equipments");
    form_select.empty().append('<option selected  >Loading ...</option>');
    //get business equipments
    $.get("/admin/business/find/"+business_id)
        .done(function (data) {
            if(data["business"] && data["business"].equipments.length >0){
                //clear select
                form_select.empty();
                //filter by equipment type required
                let equipments= data["business"].equipments.filter(o=>Object.values(o).includes(parseInt(equipment_type_id)))
                //populate
                $.each(equipments,function(key ,val){
                    //check if equipment is open
                    if(val.status!==0||val.status!==6||val.status!==3||val.status!==4) {
                        //check if here is any equipment assign for the business
                        if (val.equipment_required.length > 0) {
                            //check if the equipment is already added and is approved by company
                            if (val.equipment_required.some(e => e.pivot.equipment_inventory_id !== val.id))
                                form_select.append('<option value="' + val.id + '"  >' + val.plate_no + '(' + val.equipment_type.name + ')</option>');
                        } else {
                            form_select.append('<option value="' + val.id + '"  >' + val.plate_no + '(' + val.equipment_type.name + ')</option>');
                        }
                    }
                })
            }
        })
        .fail(function (data) {
            var errors = data.responseJSON;
            $.each(errors.errors, function (key, value) {
                toastr.error(value[0]);
            });
        })
}
const viewEquipmentRequiredAssignedModal=function (jsonEquipments){
    let equipments=$.parseJSON(jsonEquipments);

    if(equipments.equipment_inventory.length > 0) {
        $("#view-equipment-added").modal("show");

        let data = [];
        let table=$('.equipment-assigned-table');
        table.dataTable().fnClearTable();
        $.each(equipments.equipment_inventory, function (key, val) {
                data.push([val.business.name, val.plate_no, '<button type="button" id="remove-project-equipment-assigned-' + val.id + '" onclick="removeProjectEquipmentAssigned(' + val.id + ',' + equipments.id + ')" class="btn btn-dark">remove</button>']);
        });
        if(data.length > 0)
            table.dataTable().fnAddData(data);
    }else{
        toastr.error("No Equipment submitted.");
    }
}

const removeProjectEquipmentAssigned=function(equipment_id,equipment_required_id){
    //prompt
    swal({
        title: "Are you sure?",
        text: "",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            $('#remove-project-equipment-assigned-'+equipment_id).empty('').append('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>').prop('disabled', true);
            $.post("/vendor/projects/remove/equipment/required",{equipment_id,equipment_required_id})
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
//assign material required
const assignMaterialFromInventory=function(material){
    //decode
    let decode_material=$.parseJSON(material);
    console.log(decode_material)
    $(".modal-material-type-name").text(decode_material.material_type.name);
    $(".modal-material-class-required").text(decode_material.classification.name);
    $("#modal-add-material-type-id").val(decode_material.material_type.id);
    $("#modal-material-required-id").val(decode_material.id);
    //show  modal
    $("#add-materials").modal('show');
}

const getBusinessMaterials=function (){
    let business_id=$("#modal-add-material-business-id").val();
    let material_type_id=$("#modal-add-material-type-id").val();
    let form_select= $("#modal-add-material-inventory");
    form_select.empty().append('<option selected  >Loading ...</option>');
    //get business equipments
    $.get("/admin/business/find/"+business_id)
        .done(function (data) {
            console.log(data)
            if(data["business"] && data["business"].materials.length >0){
                //clear select
                form_select.empty();
                //filter by material by type required
                let materials= data["business"].materials.filter(o=>Object.values(o).includes(parseInt(material_type_id)))
                //populate
                $.each(materials,function(key ,val){
                  //check if the material is instock
                    if(val.status===1) {
                        //check if here is any material assign/added for the business
                        if (val.material_required.length > 0) {
                            //check if the equipment is already added
                            if (val.material_required.some(e => e.pivot.material_inventory_id !== val.id))
                                form_select.append('<option value="' + val.id + '"  >' + val.material_type.name + '</option>');
                        } else {
                            form_select.append('<option value="' + val.id + '"  >' + val.material_type.name + '(' + val.material_class.name + ')</option>');
                        }
                    }
                })
            }
        })
        .fail(function (data) {
            var errors = data.responseJSON;
            $.each(errors.errors, function (key, value) {
                toastr.error(value[0]);
            });
        })
}
