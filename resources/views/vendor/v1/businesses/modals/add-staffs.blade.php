<div class="modal fade" id="add-staff" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">

                 <button type="button" class="close pull-right" data-dismiss="modal" aria-label="Close">
                    <i class="ti-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="add-staff-modal-form" action="{{route("vendor.add.business.user")}}">
                    <div class="row">
                        <div class="col-md-8 offset-2">
                            <h5 class="modal-title">
                                <figure class="avatar avatar-sm mr-3">
                                    <span class="avatar-title bg-warning text-black-50 rounded-pill">
                                        <i class="ti-user"></i>
                                    </span>
                                </figure>
                                Add Staffs</h5>
                            <h5 class="margin-5-p">Business : <span class="business-name"></span></h5>
                            <hr>
                            <p>To add an existing user, searching the user by email below.</p>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Search Staff </label>
                                        <select id="users" name="users[]" class="form-control form-select-2" multiple required>
                                            @if($staffs)
                                                @foreach($staffs as $user)
                                                    <option
                                                        value="{{$user->id}}">{{$user->firstname}} {{$user->surname}}
                                                        ({{$user->email}})
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <input type="hidden" name="business_id">
                                    <div class="form-group">
                                        <button class="btn btn-primary ml-2 btn-rounded btn-add-business-users" type="submit">Add Staff(s)</button>
                                    </div>
                                </div>

                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <h5 class="modal-title">
                                        Staff doesnt exist? Create new staff.
                                    </h5>
                                    <p>If user doesn't exist create a new user by clicking the add new button below.</p>

                                    <a href="{{route('vendor.create.user')}}"  class="btn btn-dark text-white mr-2 btn-rounded " ><i
                                            class="ti-plus"></i>New Staff</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
