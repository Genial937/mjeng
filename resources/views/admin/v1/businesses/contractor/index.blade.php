@extends('layouts.v1.app')

@section('content')

    <!-- Layout wrapper -->
    <div class="layout-wrapper">
        <!-- Header -->
    @include('admin.v1.includes.header')
    <!-- ./ Header -->
        <!-- Content wrapper -->
        <div class="content-wrapper">
            <!-- begin::navigation -->
        @include('admin.v1.includes.main_nav')
        <!-- end::navigation -->
            <!-- Content body -->
            <div class="content-body">

                <!-- Content -->
                <div class="content">
                    <div class="page-header d-flex justify-content-between">
                        <h2>Contractor Businesses</h2>
                        <a href="#" class="files-toggler">
                            <i class="ti-menu"></i>
                        </a>
                    </div>
                    <div class="row">
                        @include("admin.v1.businesses.includes.nav")
                        <div class="col-xl-8">
                            <div class="content-title mt-0">
                                <h4>Add a Contractor Businesses</h4>
                            </div>
                            <div class="row">
                                <div class="col-md-4 margin-10-b">
                                    <form action="{{route("admin.create.county")}}" id="create-contractor-business-form">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Business Type</label>
                                                    <select id="business-type" name="type"
                                                            class="form-control form-select-2">
                                                        <option value="">Choose business type</option>
                                                        <option value="SOLE">Sole Proprietor</option>
                                                        <option value="PARTNERSHIP">Partnership</option>
                                                        <option value="COMPANY">Company</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Business Name</label>
                                                        <input type="text" name="name" id="business-name"
                                                               minlength="3"
                                                               maxlength="20"
                                                               required
                                                               class="form-control border-input"
                                                               placeholder="e.g. China WUYI">
                                                    </div>
                                                </div>
                                            </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Contact Phone</label>
                                                    <input type="tel" name="phone" id="phone"
                                                           minlength="9"
                                                           maxlength="10"
                                                           required
                                                           data-input-mask="phone"
                                                           class="form-control border-input"
                                                           placeholder="(254) 722 222 222">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Contact Email</label>
                                                    <input type="email" id="email" name="email"
                                                           pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                                                           class="form-control border-input"
                                                           placeholder="office@email.com">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Business Address</label>
                                                    <input type="text" id="address" name="address"
                                                           class="form-control border-input"
                                                           placeholder="e.g One Pandmore Place,13th floor, Kilimani Kenya">
                                                </div>
                                            </div>
                                        </div>
                                            <button
                                                class="btn btn-primary  btn-uppercase btn-rounded btn-create-county ">
                                                Save Changes
                                            </button>
                                    </form>
                                </div>
                                <div class="col-md-8">
                                    <p>All Businesses</p>
                                    <table class="table data-table">
                                        <thead class="thead-light">
                                        <tr>
                                            <th>Business Name</th>
                                            <th>Staffs</th>
                                            <th>Contact Phone</th>
                                            <th>Contact Email</th>
                                            <th>Business Address</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(!empty($business))
                                            @foreach($businesses as $business)
                                                <tr>
                                                    <td>{{$business->name}}</td>
                                                    <td>{{$business->email}}</td>
                                                    <td>{{$business->email}}</td>
                                                    <td>{{$business->phone}}</td>
                                                    <td>{{$business->address}}</td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <a href="#" class="btn btn-floating" data-toggle="dropdown">
                                                                <i class="ti-more-alt"></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a href="javascript:void(0)"
                                                                   class="dropdown-item">Edit</a>
                                                                <a href="javascript:void(0)"
                                                                   class="dropdown-item">Add Staff</a>
                                                                <a href="javascript:void(0)" class="dropdown-item">Delete</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
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
    <script src="{{url("assets/js/mijengo/tagsinput.js")}}"></script>
    <script src="{{url("assets/js/mijengo/ajax/config.js")}}"></script>
@endsection
