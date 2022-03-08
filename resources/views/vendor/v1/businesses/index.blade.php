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
                    <div class="page-header d-flex justify-content-between">
                        <a href="#" class="files-toggler">
                            <i class="ti-menu"></i>
                        </a>
                    </div>
                    <div class=" mt-0">
                        <nav>
                            <ol class="cd-breadcrumb">
                                <li><a href="{{route("vendor.dashboard")}}" class="text-sm-left">Home</a></li>
                                <li class="current"><em>Businesses</em></li>
                            </ol>
                        </nav>
                    </div>
                    <div class="row">

                        @include("vendor.v1.businesses.includes.nav")
                        <div class="col-xl-8">
                            <div class="content-title mt-0">
                                <h4>All Business</h4>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table data-table">
                                        <thead class="thead-light">
                                        <tr>
                                            <th>Business Name</th>
                                            <th>Contact Phone</th>
                                            <th>Contact Email</th>
                                            <th>Business Address</th>
                                            <th>Status</th>
                                            <th>Staffs</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(!empty($businesses))
                                            @foreach($businesses as $business)
                                                @if($business->status!==4)
                                                <tr>
                                                    <td>{{$business->name}}</td>
                                                    <td>{{$business->email}}</td>
                                                    <td>{{$business->phone}}</td>
                                                    <td>{{$business->address}}</td>
                                                    <td>
                                                        @if($business->status==1)
                                                            <label class="badge badge-info">Pending Approval by {{env("APP_NAME")}}</label>
                                                            @elseif($business->status==2)
                                                            <label class="badge badge-success">Approved</label>
                                                            @elseif($business->status==3)
                                                            <label class="badge badge-warning">Decline with reason</label>
                                                             @elseif($business->status==4)
                                                            <label class="badge badge-danger">Delete </label>
                                                             @endif
                                                    </td>
                                                    <td>
                                                        <div class="avatar-group">
                                                            @if(!empty($business->users))
                                                                @foreach($business->users as $user)
                                                                    <figure class="avatar avatar-sm text-capitalize" title=""
                                                                            data-toggle="tooltip"
                                                                            data-original-title="{{$user->firstname}} {{$user->surname}} - @if(!empty($user->roles)) @foreach($user->roles as $role) {{$role->display_name}} @endforeach @endif">
                                                                        <img
                                                                            src="{{asset("assets/media/image/user/avatar.png")}}"
                                                                            class="rounded-circle" alt="image">
                                                                    </figure>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <div class="dropdown">
                                                            <a href="#" class="btn btn-floating" data-toggle="dropdown">
                                                                <i class="ti-more-alt"></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a href="#" class="dropdown-item" onclick="viewBusinessModal('{{json_encode($business->only(['id', 'name', 'email','phone','address','type','status','comments']))}}','{{json_encode(json_decode($business->documents))}}')">View Details</a>
                                                                <a href="{{route("vendor.edit.business",$business->id)}}"
                                                                   class="dropdown-item">Update </a>
                                                                <a href="javascript:void(0)" onclick="viewStaffsModal('{{json_encode($business->only(['id', 'name', 'email','phone','address','type','users']))}}')" class="dropdown-item">View Staff(s)</a>
                                                                <a href="javascript:void(0)" onclick="addStaffModal('{{json_encode($business->only(['id', 'name', 'email','phone','address','type']))}}','{{route("admin.create.user")}}?type=CONTRACTOR&business_id={{$business->id}}')" class="dropdown-item">Add Staff(s)</a>
                                                                <a href="#" class="dropdown-item" onclick="deleteRecord('{{route("vendor.business.delete",$business->id)}}')">Delete</a>

                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endif
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
            @include('vendor.v1.includes.footer')
            <!-- ./ Footer -->
            </div>
            <!-- ./ Content body -->
        </div>
        <!-- ./ Content wrapper -->
    </div>
    @include("vendor.v1.businesses.modals.add-staffs")
    @include("vendor.v1.businesses.modals.view-staffs")
    @include("vendor.v1.businesses.modals.view-business")
    <!-- App scripts -->
    <script src="{{url("assets/js/mijengo/select2.js")}}"></script>
    <script src="{{url("assets/js/mijengo/ajax/business.js")}}"></script>
@endsection
