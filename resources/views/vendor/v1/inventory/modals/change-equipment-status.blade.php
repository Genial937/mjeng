<div class="modal fade" id="change-equipment-status" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">

                 <button type="button" class="close pull-right" data-dismiss="modal" aria-label="Close">
                    <i class="ti-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="edit-vendor-equipment-form" action="{{route("vendor.edit.equipment")}}">
                    <div class="row">
                        <div class="col-md-8 offset-2">
                            <h5 class="modal-title">
                                <figure class="avatar avatar-sm mr-3">
                                    <span class="avatar-title bg-warning text-black-50 rounded-pill">
                                        <i class="ti-truck"></i>
                                    </span>
                                </figure>
                               Equipment</h5>
                            <p class="margin-5-p">Business: <span class="modal-business-name"></span></p>
                            <p class="margin-5-p">Equipment Plate no: <span class="modal-equipment-plate-no"></span></p>
                            <hr>
                            <p>Tell us the status of the equipment to enable us serve our client better.</p>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Change the equipment status. </label>
                                        <select  name="status" class="form-control form-select-2 modal-equipment-status"  required>
                                                    <option value="1">Ready to work</option>
                                                    <option value="2">Engaged Outside</option>
                                                    <option value="7">Engaged by {{env("APP_NAME")}}</option>
                                                    <option value="5">On Maintenance</option>
                                                    <option value="6">Out of Service</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Comment</label>
                                        <textarea id="modal-equipment-comment" name="comment" class="form-control" required></textarea>
                                    </div>
                                    <input type="hidden" name="id" class="modal-equipment-id">
                                    <div class="form-group">
                                        <button class="btn btn-primary ml-2 btn-rounded btn-edit-equipment" type="submit">Save Changes</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
