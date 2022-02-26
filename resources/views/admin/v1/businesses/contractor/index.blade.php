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
                        <a href="#" class="files-toggler">
                            <i class="ti-menu"></i>
                        </a>
                    </div>
                    <div class="content-title mt-0">
                        <nav>
                            <ol class="cd-breadcrumb">
                                <li><a href="{{route("admin.dashboard")}}" class="text-sm-left">Home</a></li>
                                <li class="current"><em>Businesses</em></li>
                            </ol>
                        </nav>
                    </div>
                    <div class="row">

                        @include("admin.v1.businesses.includes.nav")
                        <div class="col-xl-8">
                            <div class="content-title mt-0">
                                <h4>Contractors Business</h4>
                                <p>All contractor businesses</p>
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
                                            <th>Staffs</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(!empty($businesses))
                                            @foreach($businesses as $business)
                                                <tr>
                                                    <td>{{$business->name}}</td>
                                                    <td>{{$business->email}}</td>
                                                    <td>{{$business->phone}}</td>
                                                    <td>{{$business->address}}</td>
                                                    <td>
                                                        <div class="avatar-group">
                                                            @if(!empty($business->users))
                                                                @foreach($business->users as $user)
                                                                    <figure class="avatar avatar-sm" title=""
                                                                            data-toggle="tooltip"
                                                                            data-original-title="{{$user->firstname}} {{$user->surname}}">
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
                                                                <a href="#" class="dropdown-item" data-sidebar-target="#view-detail">View
                                                                    Details</a>
                                                                <a href="{{route("admin.edit.contractor",$business->id)}}"
                                                                   class="dropdown-item">Edit</a>
                                                                <a href="javascript:void(0)" onclick="viewStaffsModal('{{json_encode($business)}}')" class="dropdown-item">View Staff(s)</a>
                                                                <a href="javascript:void(0)" onclick="addStaffModal('{{json_encode($business)}}','{{route("admin.create.user")}}?type=CONTRACTOR&business_id={{$business->id}}')" class="dropdown-item">Add Staff(s)</a>
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
    @include("admin.v1.businesses.modals.add-staffs")
    @include("admin.v1.businesses.modals.view-staffs")
    <!-- App scripts -->
    <script src="{{url("assets/js/mijengo/select2.js")}}"></script>
    <script src="{{url("assets/js/mijengo/ajax/business.js")}}"></script>
@endsection
