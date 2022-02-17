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
    //add county
    $(document).on('submit', '#create-county-form', function (e) {
        e.preventDefault();
        $('.btn-create-county').text('').append('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span> Loading...').prop('disabled', true);
        var url = $('#create-county-form').attr('action');
        $.post(url, $("#create-county-form").serialize())
            .done(function (data) {
                if (data['success']) {
                    $('.btn-create-county').text('Save').prop('disabled', false);
                    toastr.success(data['message']);
                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                } else {
                    $('.btn-create-county').text('Save').prop('disabled', false);
                    toastr.success(data['message']);
                }
            })
            .fail(function (data) {
                console.error(data)
                $('.btn-create-county').text('Save').prop('disabled', false);
                var errors = data.responseJSON;
                $.each(errors.errors, function (key, value) {
                    toastr.error(value[0]);
                });
            })
    });
   //add subcounty
    $(document).on('submit', '#create-subcounty-form', function (e) {
        e.preventDefault();
        $('.btn-create-subcounty').text('').append('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span> Loading...').prop('disabled', true);
        var url = $('#create-subcounty-form').attr('action');
        $.post(url, $("#create-subcounty-form").serialize())
            .done(function (data) {
                if (data['success']) {
                    $('.btn-create-subcounty').text('Save').prop('disabled', false);
                    toastr.success(data['message']);
                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                } else {
                    $('.btn-create-subcounty').text('Save').prop('disabled', false);
                    toastr.success(data['message']);
                }
            })
            .fail(function (data) {
                console.error(data)
                $('.btn-create-subcounty').text('Save').prop('disabled', false);
                var errors = data.responseJSON;
                $.each(errors.errors, function (key, value) {
                    toastr.error(value[0]);
                });
            })
    });
   //add currency
    $(document).on('submit', '#create-currency-form', function (e) {
        e.preventDefault();
        $('.btn-create-currency').text('').append('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span> Loading...').prop('disabled', true);
        var url = $('#create-currency-form').attr('action');
        $.post(url, $("#create-currency-form").serialize())
            .done(function (data) {
                if (data['success']) {
                    $('.btn-create-currency').text('Save').prop('disabled', false);
                    toastr.success(data['message']);
                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                } else {
                    $('.btn-create-currency').text('Save').prop('disabled', false);
                    toastr.success(data['message']);
                }
            })
            .fail(function (data) {
                console.error(data)
                $('.btn-create-currency').text('Save').prop('disabled', false);
                var errors = data.responseJSON;
                $.each(errors.errors, function (key, value) {
                    toastr.error(value[0]);
                });
            })
    });
    //add measurement units
    $(document).on('submit', '#create-measurement-unit-form', function (e) {
        e.preventDefault();
        $('.btn-create-measurement-unit').text('').append('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span> Loading...').prop('disabled', true);
        var url = $('#create-measurement-unit-form').attr('action');
        $.post(url, $("#create-measurement-unit-form").serialize())
            .done(function (data) {
                if (data['success']) {
                    $('.btn-create-measurement-unit').text('Save').prop('disabled', false);
                    toastr.success(data['message']);
                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                } else {
                    $('.btn-create-measurement-unit').text('Save').prop('disabled', false);
                    toastr.success(data['message']);
                }
            })
            .fail(function (data) {
                console.error(data)
                $('.btn-create-measurement-unit').text('Save').prop('disabled', false);
                var errors = data.responseJSON;
                $.each(errors.errors, function (key, value) {
                    toastr.error(value[0]);
                });
            })
    });
    //add task-activities
    $(document).on('submit', '#create-task-form', function (e) {
        e.preventDefault();
        $('.btn-create-task').text('').append('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span> Loading...').prop('disabled', true);
        var url = $('#create-task-form').attr('action');
        $.post(url, $("#create-task-form").serialize())
            .done(function (data) {
                if (data['success']) {
                    $('.btn-create-task').text('Save').prop('disabled', false);
                    toastr.success(data['message']);
                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                } else {
                    $('.btn-create-task').text('Save').prop('disabled', false);
                    toastr.success(data['message']);
                }
            })
            .fail(function (data) {
                console.error(data)
                $('.btn-create-task').text('Save').prop('disabled', false);
                var errors = data.responseJSON;
                $.each(errors.errors, function (key, value) {
                    toastr.error(value[0]);
                });
            })
    });
    //material type
    $(document).on('submit', '#create-material-type-form', function (e) {
        e.preventDefault();
        $('.btn-create-material-type').text('').append('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span> Loading...').prop('disabled', true);
        var url = $('#create-material-type-form').attr('action');
        $.post(url, $("#create-material-type-form").serialize())
            .done(function (data) {
                if (data['success']) {
                    $('.btn-create-material-type').text('Save').prop('disabled', false);
                    toastr.success(data['message']);
                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                } else {
                    $('.btn-create-material-type').text('Save').prop('disabled', false);
                    toastr.success(data['message']);
                }
            })
            .fail(function (data) {
                console.error(data)
                $('.btn-create-material-type').text('Save').prop('disabled', false);
                var errors = data.responseJSON;
                $.each(errors.errors, function (key, value) {
                    toastr.error(value[0]);
                });
            })
    });
    //material class
    $(document).on('submit', '#create-material-class-form', function (e) {
        e.preventDefault();
        $('.btn-create-material-class').text('').append('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span> Loading...').prop('disabled', true);
        var url = $('#create-material-class-form').attr('action');
        $.post(url, $("#create-material-class-form").serialize())
            .done(function (data) {
                if (data['success']) {
                    $('.btn-create-material-class').text('Save').prop('disabled', false);
                    toastr.success(data['message']);
                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                } else {
                    $('.btn-create-material-class').text('Save').prop('disabled', false);
                    toastr.success(data['message']);
                }
            })
            .fail(function (data) {
                console.error(data)
                $('.btn-create-material-class').text('Save').prop('disabled', false);
                var errors = data.responseJSON;
                $.each(errors.errors, function (key, value) {
                    toastr.error(value[0]);
                });
            })
    });
    //add equipment type
    $(document).on('submit', '#create-equipment-type-form', function (e) {
        e.preventDefault();
        $('.btn-create-equipment-type').text('').append('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span> Loading...').prop('disabled', true);
        var url = $('#create-equipment-type-form').attr('action');
        $.post(url, $("#create-equipment-type-form").serialize())
            .done(function (data) {
                if (data['success']) {
                    $('.btn-create-equipment-type').text('Save').prop('disabled', false);
                    toastr.success(data['message']);
                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                } else {
                    $('.btn-create-equipment-type').text('Save').prop('disabled', false);
                    toastr.success(data['message']);
                }
            })
            .fail(function (data) {
                console.error(data)
                $('.btn-create-equipment-type').text('Save').prop('disabled', false);
                var errors = data.responseJSON;
                $.each(errors.errors, function (key, value) {
                    toastr.error(value[0]);
                });
            })
    });
    //add equipment type
    $(document).on('submit', '#create-equipment-make-form', function (e) {
        e.preventDefault();
        $('.btn-create-equipment-make').text('').append('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span> Loading...').prop('disabled', true);
        var url = $('#create-equipment-make-form').attr('action');
        $.post(url, $("#create-equipment-make-form").serialize())
            .done(function (data) {
                if (data['success']) {
                    $('.btn-create-equipment-make').text('Save').prop('disabled', false);
                    toastr.success(data['message']);
                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                } else {
                    $('.btn-create-equipment-make').text('Save').prop('disabled', false);
                    toastr.success(data['message']);
                }
            })
            .fail(function (data) {
                console.error(data)
                $('.btn-create-equipment-make').text('Save').prop('disabled', false);
                var errors = data.responseJSON;
                $.each(errors.errors, function (key, value) {
                    toastr.error(value[0]);
                });
            })
    });
    //add equipment model
    $(document).on('submit', '#create-equipment-model-form', function (e) {
        e.preventDefault();
        $('.btn-create-equipment-model').text('').append('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span> Loading...').prop('disabled', true);
        var url = $('#create-equipment-model-form').attr('action');
        $.post(url, $("#create-equipment-model-form").serialize())
            .done(function (data) {
                if (data['success']) {
                    $('.btn-create-equipment-model').text('Save').prop('disabled', false);
                    toastr.success(data['message']);
                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                } else {
                    $('.btn-create-equipment-model').text('Save').prop('disabled', false);
                    toastr.success(data['message']);
                }
            })
            .fail(function (data) {
                console.error(data)
                $('.btn-create-equipment-model').text('Save').prop('disabled', false);
                var errors = data.responseJSON;
                $.each(errors.errors, function (key, value) {
                    toastr.error(value[0]);
                });
            })
    });
});
//edit county
const editCounty = function (county_id,name, url) {
    //confirm to delete
    swal({
        text: 'Edit County '+name+". Please insert new name below.",
        content: "input",
        input:{value: "E.g john"},
        button: {
            text: "Save Changes",
            closeModal: false,
        },
    }).then(name => {
        if (!name) {
            return null;
         }
          return $.post(url,{id:county_id,name});
        })
        .then(results => {
            if(results.success){
                toastr.success(results.message);
                swal.stopLoading();
                swal.close();
                return results;
            }else{
                return new Error(results.errors);
            }
        })
        .catch(err => {
            if (err) {
                swal("OOPS!", "Something went wrong", "error");
            } else {
                swal.stopLoading();
                swal.close();
            }
        });
}
