<div class="modal fade" id="edit-material-required" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">

                 <button type="button" class="close pull-right" data-dismiss="modal" aria-label="Close">
                    <i class="ti-close"></i>
                </button>
            </div>
            <div class="modal-body">

                    <div class="row">
                        <div class="col-md-8 offset-2">
                            <h5 class="modal-title">
                                <figure class="avatar avatar-sm mr-3">
                                    <span class="avatar-title bg-warning text-black-50 rounded-pill">
                                        <i class="ti-file"></i>
                                    </span>
                                </figure>
                                Edit Material Required</h5>
                            <hr>
                            <form class=" margin-10-p" id="edit-material-required-form" action="{{route("admin.edit.project.material.required")}}">
                                <div class="form-row">
                                    <div class="col-md-12 mb-3">
                                        <label >Choose a project site</label>
                                        <select class="form-select-2" id="modal-input-site-id" name="site_id" onchange="formEditGetSiteTasks()">
                                            <option>Choose site</option>
                                            @if(!empty($sites))
                                                @foreach($sites as $site)
                                                    <option class="text-capitalize"
                                                            value="{{$site->id}}">{{$site->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12 mb-3">
                                        <label >Choose a site task</label>
                                        <select class="form-select-2" id="modal-input-task-id" name="task_id" onchange="formEditGetTaskMaterialType()">
                                            <option>Select</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12 mb-3">
                                        <label >Choose an material type</label>
                                        <select class="form-select-2" id="modal-input-material-type-id" name="material_type_id" onchange="formEditGetMaterialClass()">
                                            <option>Select</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12 mb-3">
                                        <label >Choose an material classification</label>
                                        <select class="form-select-2" id="modal-input-material-class-id" name="material_class_id" >
                                            <option>Select</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12 mb-3">
                                        <label >Quantity of material required e.g 30tonnes</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" id="modal-input-quantity-required"
                                                   placeholder="30" name="quantity_required"
                                                   required>
                                            <div class="input-group-prepend">
                                                <select class="form-control" name="quantity_required_unit" id="modal-input-quantity-required-unit">
                                                    @if(!empty($measurement_units))
                                                        @foreach($measurement_units as $measurement_unit)
                                                            <option class="text-capitalize" value="{{$measurement_unit->symbol}}">{{$measurement_unit->name}}({{$measurement_unit->symbol}})</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12 mb-3">
                                        <label >Minimum quantity of material required per day</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" id="modal-input-quantity-required-per-day"
                                                   name="quantity_required_per_day"
                                                   placeholder="3"
                                                   required>
                                            <div class="input-group-prepend">
                                                <select class="form-control" id="modal-input-quantity-required-per-day-unit" name="quantity_required_per_day_unit">
                                                    @if(!empty($measurement_units))
                                                        @foreach($measurement_units as $measurement_unit)
                                                            <option class="text-capitalize" value="{{$measurement_unit->symbol}}">{{$measurement_unit->name}}({{$measurement_unit->symbol}})</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12 mb-3">
                                        <label >Payment Terms e.g KES 3000/Tonnes</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <select name="currency" class="form-control" id="modal-input-currency">
                                                    @if(!empty($currencies))
                                                        @foreach($currencies as $currency)
                                                            <option class="text-capitalize" value="{{$currency->symbol}}">{{$currency->symbol}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                            <input type="number" class="form-control" id="modal-input-lease-rates" name="lease_rates"
                                                   placeholder="amount">
                                            <div class="input-group-prepend">
                                                <select name="lease_modality" class="form-control" id="modal-input-lease-modality">
                                                    @if(!empty($measurement_units))
                                                        @foreach($measurement_units as $measurement_unit)
                                                            <option class="text-capitalize" value="{{$measurement_unit->symbol}}">{{$measurement_unit->symbol}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12 mb-3">
                                        <label for="end-date">Payment term description</label>
                                        <textarea name="payment_term_desc" id="modal-input-payment-term-desc" class="form-control" required placeholder="e.g Payment is KES200 per Km per tone"></textarea>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12 mb-3">
                                        <label for="end-date">CESS Provision</label>
                                        <select class="form-control" name="cess" id="modal-input-cess-provision">
                                            <option>Select</option>
                                            <option value="OWNER">OWNER</option>
                                            <option value="COMPANY">COMPANY</option>
                                        </select>
                                    </div>
                                </div>
                                <input type="hidden" name="id" id="modal-input-material-required-id">
                                <button class="btn btn-primary btn-rounded btn-edit-material-required" type="submit">Save Changes</button>
                            </form>
                        </div>
                    </div>

            </div>
        </div>
    </div>
</div>
