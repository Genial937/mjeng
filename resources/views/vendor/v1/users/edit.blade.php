@extends('layouts.v1.app')

@section('content')

    <!-- Layout wrapper -->
    <div class="layout-wrapper">
        <!-- Header -->
    @include('vendor.v1.includes.header')
    <!-- ./ Header -->
        <!-- Content wrapper -->
        <div class="content-wrapper">
            <!-- begin::navigation -->
        @include('vendor.v1.includes.main_nav')
        <!-- end::navigation -->
            <!-- Content body -->
            <div class="content-body">
                <!-- Content -->
                <div class="content">
                    <div class="row">
                        <div class="col-xl-10 offset-1">
                            <div class="mb-4">
                                <a href="{{route("vendor.users")}}"
                                   class="btn btn-outline-primary ">
                                    <i class="ti-arrow-left"></i> Back</a>
                            </div>


                    <div class="nav nav-pills mb-4" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-item nav-link active" id="v-pills-acc-tab" data-toggle="pill"
                           href="#v-pills-acc" role="tab" aria-controls="v-pills-home" aria-selected="true">Account Details</a>
                        <a class="nav-item nav-link" id="v-pills-messages-tab" data-toggle="pill"
                           href="#v-pills-security" role="tab" aria-controls="v-pills-security" aria-selected="false">Security</a>

                    </div>
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-acc" role="tabpanel"
                             aria-labelledby="v-pills-acc-tab">
                            <div class="content-title">
                                <h4>Account</h4>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <form action="{{route("vendor.update.user")}}" id="update-user-form">
                                        @csrf
                                        <div class="d-flex mb-3">
                                            <figure class="mr-3">
                                                <img width="80" class="rounded-pill"
                                                     src="{{url("assets/media/image/user/women_avatar1.jpg")}}"
                                                     alt="...">
                                            </figure>
                                            <div>
                                                <p class="text-capitalize">{{$user->firstname??""}} {{$user->surname??""}}</p>
                                                <button class="btn btn-outline-primary mr-2">Change Avatar</button>
                                                <button class="btn btn-outline-danger">Remove Avatar</button>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>First Name</label>
                                                    <input type="text" name="firstname"
                                                           required
                                                           value="{{$user->firstname??""}}"
                                                           class="form-control border-input"
                                                           placeholder="firstname e.g John">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Last Name</label>
                                                    <input type="text" name="surname"
                                                           required
                                                           value="{{$user->surname??""}}"
                                                           class="form-control border-input"
                                                           placeholder="Last Name e.g Doe">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="email">Email address</label>
                                                    <input type="email" id="email" name="email"
                                                           pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                                                           class="form-control border-input"
                                                           required
                                                           value="{{$user->email??""}}"
                                                           placeholder="e.g john@email.com">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="phone">Phone</label>
                                                    <input type="tel" name="phone" id="phone"
                                                           minlength="9"
                                                           maxlength="10"
                                                           data-input-mask="phone"
                                                           required
                                                           value="{{$user->phone??""}}"
                                                           class="form-control border-input"
                                                           placeholder="e.g (254) 722 222 222">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="role-permissions">Role</label>
                                                    <select title="Select role" id="role"
                                                            name="role_id" class="form-control form-select-2">
                                                        <option value="">Choose a role</option>
                                                        @if($roles)
                                                            @foreach($roles as $role)
                                                                <option
                                                                    @foreach($user->roles as $role_) @if($role->id===$role_->id) selected
                                                                    @endif   @endforeach value="{{$role->id}}">{{$role->display_name}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Status</label>
                                                    <select id="status" name="status"
                                                            class="form-control form-select-2">
                                                        <option value="">Choose a status</option>
                                                        <option @if($user->status===1) selected @endif  value="1">
                                                            Active
                                                        </option>
                                                        <option @if($user->status===2) selected @endif  value="2">
                                                            Blocked
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" value="{{$user->id}}" name="id">
                                        <button class="btn btn-primary  btn-uppercase btn-rounded btn-update-user">Save
                                            Changes
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-security" role="tabpanel"
                             aria-labelledby="v-pills-messages-tab">
                            <div class="content-title">
                                <h4>Change Password</h4>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <form id="change-password-form" action="{{route("vendor.change.user.password")}}">
                                        <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label> Strong New Password</label>
                                                <div class="input-group">
                                                    <input type="password" name="password"
                                                           {{--                                                                   pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}"--}}
                                                           title="Must contain at least one  number and one uppercase and lowercase letter, and at least 6 or more characters"
                                                           class="form-control border-input"
                                                           required
                                                           placeholder="password">
                                                    <div class="input-group-append toggle-password">
                                                        <span class="input-group-text mdi ti-eye"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Confirm New Password</label>
                                                <div class="input-group">
                                                    <input type="password" name="password_confirmation"
                                                           {{--                                                                   pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}"--}}
                                                           title="Must contain at least one  number and one uppercase and lowercase letter, and at least 6 or more characters"
                                                           class="form-control border-input"
                                                           required
                                                           placeholder="confirm password">
                                                    <div class="input-group-append toggle-password">
                                                        <span class="input-group-text mdi ti-eye"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                        <button class="btn btn-primary btn-change-password">Save Changes</button>
                                        <input type="hidden" value="{{$user->id}}" name="id">
                                    </form>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
                    </div>
                <!-- ./ Content -->

                <!-- Footer -->
            @include('admin.v1.includes.footer')
            <!-- ./ Footer -->
            </div>
            <!-- ./ Content body -->


        </div>
        <!-- ./ Content wrapper -->
    </div>
    <!-- App scripts -->
    <script src="{{url("assets/js/mijengo/select2.js")}}"></script>
    <script src="{{url("assets/js/mijengo/ajax/user.js")}}"></script>
@endsection
