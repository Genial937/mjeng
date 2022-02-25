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
//edit project details
const editProjectDetails=function(project){
    //decode
    let decoded_project=$.parseJSON(project);
    //show edit modal
    $("#edit-project").modal('show');
    //set values
    $("#modal-input-project-name").val(decoded_project.name);
    $("#modal-input-project-description").val(decoded_project.description);
    $('#modal-input-start-date').val(decoded_project.start_date);
    $("#modal-input-end-date").val(decoded_project.end_date);

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
            console.log(data)
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
            console.log(data)
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
            console.log(data)
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
            console.log(data)
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
            console.log(data)
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
