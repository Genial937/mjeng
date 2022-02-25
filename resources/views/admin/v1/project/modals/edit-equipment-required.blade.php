<div class="modal fade" id="edit-equipment-required" tabindex="-1" role="dialog" aria-hidden="true">
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
                                Edit  Equipment Required</h5>
                            <hr>
                            <form class="margin-5-p" id="edit-equipment-required-form" action="{{route("admin.update.project.equipment.required")}}">
                                <div class="form-row">
                                    <div class="col-md-12 mb-3">
                                        <label for="end-date">Choose a project site</label>
                                        <select class="modal-form-select-2" id="modal-input-site-id" name="site_id" onchange="formEditGetSiteTasks()">
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
                                        <label for="end-date">Choose a site task</label>
                                        <select class="modal-form-select-2" id="modal-input-task-id" name="task_id" onchange="formEditGetTaskEquipmentType()">
                                            <option>Choose</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12 mb-3">
                                        <label for="end-date">Choose an equipment type</label>
                                        <select class="modal-form-select-2" id="modal-input-equipment-type-id" name="equipment_type_id" >
                                            <option>Choose</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12 mb-3">
                                        <label for="no-equipment">Number of equipments type required</label>
                                        <input type="number" class="form-control" id="modal-input-no-equipment"
                                               placeholder="2" name="no_equipment">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12 mb-3">
                                        <label for="site-name">Equipment type minimum loading capacity e.g 30 tonnes</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" id="modal-input-min-loading-capacity" name="payload_capacity"
                                                   placeholder="3">
                                            <div class="input-group-prepend">
                                                <select class="form-control" name="payload_unit" id="modal-input-payload-unit">
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
                                        <label for="duration">Duration the Equipments Type is Required e.g 5days</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" id="modal-input-duration"
                                                   placeholder="2" name="duration">
                                            <div class="input-group-prepend">
                                                <select name="duration_unit" class="form-control" id="modal-input-duration-unit">
                                                    <option value="HOURS">Hrs</option>
                                                    <option selected value="DAYS">Days</option>
                                                    <option value="MONTHS">Months</option>
                                                </select>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12 mb-3">
                                        <label >Payment Terms e.g KES 3000/day</label>
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
                                                    <option value="HOUR">Hrs</option>
                                                    <option selected value="DAY">Day</option>
                                                    <option value="MONTH">Month</option>
                                                    <option value="MONTH">Year</option>
                                                </select>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12 mb-3">
                                        <label>Fuel Provision</label>
                                        <select class="form-control" name="fuel_provision" id="modal-input-fuel-provision">
                                            <option>Select</option>
                                            <option value="OWNER">OWNER</option>
                                            <option value="COMPANY">COMPANY</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12 mb-3">
                                        <label for="end-date">CESS Provision</label>
                                        <select class="form-control" name="cess_provision" id="modal-input-cess-provision">
                                            <option>Select</option>
                                            <option value="OWNER">OWNER</option>
                                            <option value="COMPANY">COMPANY</option>
                                        </select>
                                    </div>
                                </div>


                                <button class="btn btn-primary btn-rounded btn-edit-equipment-required" type="submit">Save Changes</button>
                                <input type="hidden" name="id" id="modal-equipment-required-id">
                            </form>
                        </div>
                    </div>

            </div>
        </div>
    </div>
</div>
