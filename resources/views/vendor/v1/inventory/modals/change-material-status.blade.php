<div class="modal fade" id="change-material-status" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">

                 <button type="button" class="close pull-right" data-dismiss="modal" aria-label="Close">
                    <i class="ti-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="edit-vendor-material-form" action="{{route("vendor.material.edit")}}">
                    <div class="row">
                        <div class="col-md-8 offset-2">
                            <h5 class="modal-title">
                                <figure class="avatar avatar-sm mr-3">
                                    <span class="avatar-title bg-warning text-black-50 rounded-pill">
                                        <i class="ti-truck"></i>
                                    </span>
                                </figure>
                               Material</h5>
                            <p class="margin-5-p">Business: <span class="modal-business-name"></span></p>
                            <p class="margin-5-p">Material Type: <span class="modal-material-type"></span></p>
                            <p class="margin-5-p">Material Class: <span class="modal-material-class"></span></p>
                            <hr>
                            <p>Tell us the status of the material to enable us serve our client better.</p>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Change the material status. </label>
                                        <select  name="status" class="form-control form-select-2 modal-material-status"  required>
                                            <option value="1">In stock</option>
                                            <option value="2">Out of stock</option>
                                            <option value="4">Not selling anymore</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Comment</label>
                                        <textarea  name="comment" class="form-control modal-material-comment" required></textarea>
                                    </div>
                                    <input type="hidden" name="id" class="modal-material-id">
                                    <div class="form-group">
                                        <button class="btn btn-primary ml-2 btn-rounded btn-edit-material" type="submit">Save Changes</button>
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
