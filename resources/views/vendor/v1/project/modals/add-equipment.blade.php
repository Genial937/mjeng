<div class="modal fade" id="add-equipments" tabindex="-1" role="dialog" aria-hidden="true">
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
                                Supply Equipment Required</h5>
                            <p class="margin-5-p">Equipment Type Required : <span class="modal-equipment-type-name text-danger"></span></p>
                            <p class="margin-5-p">Number of Equipment Required : <span class="modal-equipment-no-required text-danger"></span></p>
                            <hr>
                            <p>Add equipments from my inventory.</p>
                            <p>Please note you are choosing equipments that are approved by {{env("APP_NAME")}}.</p>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Choose Business </label>
                                        <select id="modal-add-equipment-business-id" name="business_id" class="form-control form-select-2" onchange="getBusinessEquipments()" required>
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
                                        <label>Choose Equipments </label>
                                        <select id="modal-add-equipments" name="equipments[]" class="form-control form-select-2" multiple required>
                                        </select>
                                    </div>
                                    <input type="hidden" name="equipment_required_id" id="modal-equipment-required-id">
                                    <input type="hidden" name="equipment_type_id" id="modal-add-equipment-type-id">
                                    <div class="form-group">
                                        <button class="btn btn-primary ml-2 btn-rounded btn-equipment-required" type="submit">Save</button>
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
