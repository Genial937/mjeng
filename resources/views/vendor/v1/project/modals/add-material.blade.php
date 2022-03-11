<div class="modal fade" id="add-materials" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">

                 <button type="button" class="close pull-right" data-dismiss="modal" aria-label="Close">
                    <i class="ti-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="add-equipment-required-form" action="{{route("vendor.project.add.equipment.required")}}">
                    <div class="row">
                        <div class="col-md-8 offset-2">
                            <h5 class="modal-title">
                                <figure class="avatar avatar-sm mr-3">
                                    <span class="avatar-title bg-warning text-black-50 rounded-pill">
                                        <i class="ti-truck"></i>
                                    </span>
                                </figure>
                                Add material required </h5>
                            <p class="margin-5-p"> Type Required : <span class="modal-material-type-name text-danger"></span></p>
                            <p class="margin-5-p"> Classification Required: <span class="modal-material-class-required text-danger"></span></p>
                            <hr>

                            <p>Please note you are choosing material that are approved by {{env("APP_NAME")}} from your inventory.</p>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Choose Business </label>
                                        <select id="modal-add-material-business-id" name="business_id" class="form-control form-select-2" onchange="getBusinessMaterials()" required>
                                            <option selected>
                                                Choose Business
                                            </option>
                                            @if(!empty($businesses))
                                                @foreach($businesses as $business)
                                                    <option
                                                        value="{{$business->id}}">{{$business->name}}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Choose Material </label>
                                        <select id="modal-add-material-inventory" name="material_inventory_id" class="form-control form-select-2"  required>
                                        </select>
                                    </div>
                                    <input type="hidden" name="material_required_id" id="modal-material-required-id">
                                    <input type="hidden" name="material_type_id" id="modal-add-material-type-id">
                                    <div class="form-group">
                                        <button class="btn btn-primary ml-2 btn-rounded btn-material-required" type="submit">Save</button>
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
