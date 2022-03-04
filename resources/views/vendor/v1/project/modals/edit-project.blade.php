<div class="modal fade" id="edit-project" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">

                 <button type="button" class="close pull-right" data-dismiss="modal" aria-label="Close">
                    <i class="ti-close"></i>
                </button>
            </div>
            <div class="modal-body">

                    <div class="row">
                        <div class="col-md-10 offset-1">
                            <h5 class="modal-title">
                                <figure class="avatar avatar-sm mr-3">
                                    <span class="avatar-title bg-warning text-black-50 rounded-pill">
                                        <i class="ti-file"></i>
                                    </span>
                                </figure>
                                Edit Project Details</h5>
                            <hr>
                            <form class=" margin-5-p" novalidate action="{{route("admin.edit.project.details")}}" id="edit-project-detail-form">
                                        <div class="form-row">
                                            <div class="col-md-12 mb-3">
                                                <label >Choose project owner(contractor business)</label>
                                                <select class=" form-control form-select-2" name="business_id" id="modal-input-business-id">
                                                    <option>Choose contractor business</option>
                                                    @if(!empty($businesses))
                                                        @foreach($businesses as $business)
                                                            <option class="text-capitalize"
                                                                    value="{{$business->id}}">{{$business->name}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-12 mb-3">
                                                <label for="project-name">Project name</label>
                                                <input type="text" class="form-control" name="name" id="modal-input-project-name"
                                                       placeholder="Project name e.g ABC Construction" required>
                                            </div>

                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-12 mb-3">
                                                <label for="start-date">Start Date</label>
                                                <input type="text" class="form-control date-picker" id="modal-input-start-date" name="start_date"
                                                       placeholder="" required>

                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label for="end-date">End Date</label>
                                                <input type="text" class="form-control date-picker" id="modal-input-end-date" name="end_date"
                                                       placeholder="" required>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-12 mb-3">
                                                <label for="project-description">Description</label>
                                                <textarea class="form-control" id="modal-input-project-description" name="description" placeholder="Construction of super Mombasa to Nairobi Dual Carrier. "></textarea>
                                            </div>
                                        </div>
                                        <div class="content-title margin-5-p">
                                            <h4>Project Location</h4>
                                            <p>This county and subcounty the project is situated/located.</p>
                                        </div>
                                        <div class="form-row ">
                                            <div class="col-md-12 mb-3">
                                                <label for="start-date">County</label>
                                                <select class="form-control form-select-2" name="county_id" id="modal-input-county-id" onchange="getEditSubcounties()">
                                                    <option>Choose a county</option>
                                                    @if(!empty($counties))
                                                        @foreach($counties as $county)
                                                            <option value="{{$county->id}}">{{$county->name}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label for="end-date">Sub County</label>
                                                <select class=" form-control form-select-2" name="sub_county_id" id="modal-input-sub-county-id">
                                                    <option>Select subcounty</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row margin-5-p">
                                            <button class="btn btn-primary  btn-uppercase btn-rounded btn-edit-project-details" type="submit">
                                                Save Changes
                                            </button>
                                            <input type="hidden" name="id" id="modal-input-project-id">
                                        </div>
                            </form>
                        </div>
                    </div>

            </div>
        </div>
    </div>
</div>
