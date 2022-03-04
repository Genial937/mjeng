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
                            <div class="content-title mt-0">
                                <h4>Create User</h4>
                                <p>To enable user to login to {{env("APP_NAME")}} platform.</p>
                            </div>
                            <div class="row">

                                <form id="create-user-form" method="POST"
                                      action="{{route("vendor.create.user")}}">
                                    @csrf
                                    <div class="col-lg-6 col-md-6">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>First Name</label>
                                                    <input type="text" name="firstname"
                                                           required
                                                           class="form-control border-input"
                                                           placeholder="firstname e.g John">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Last Name</label>
                                                    <input type="text" name="surname"
                                                           required
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
                                                           placeholder="e.g john@email.com">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="phone">Phone</label>
                                                    <input type="tel" name="phone" id="phone"
                                                           minlength="9"
                                                           maxlength="10"
                                                           required
                                                           data-input-mask="phone"
                                                           class="form-control border-input"
                                                           placeholder="(254) 722 222 222">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label> Strong Password</label>
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
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Confirm Password</label>
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
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="role-permissions">Role</label>
                                                    <select title="Select role" id="role"
                                                            name="role_id" class="form-control form-select-2">
                                                        <option value="">Choose a role</option>
                                                        @if($roles)
                                                            @foreach($roles as $role)
                                                                <option
                                                                    value="{{$role->id}}">{{$role->display_name}}
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-left margin-5-p">
                                            <button type="submit"
                                                    class="btn btn-primary  btn-uppercase btn-rounded btn-create-user">
                                                Save User
                                            </button>

                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                    </div>
                                </form>
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
