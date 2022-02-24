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

const deleteProjectSite=function(url) {
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
const getSiteTasks=function (){
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
const getTaskEquipmentType=function (){
    let task_id =$("#task-id").val();
    let form_select= $("#equipment-type-id");
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
    $("#modal-input-site-name").val(decode_site.name);
    $("#modal-input-site-description").val(decode_site.description);
    $('#modal-input-site-tasks').select2().val(task_ids).trigger('change');
    $("#modal-input-site-id").val(decode_site.id);

}
