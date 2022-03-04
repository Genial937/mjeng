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
                                <li class="current"><em>Materials</em></li>
                            </ol>
                        </nav>
                    </div>
                    <div class="row">

                        @include("vendor.v1.inventory.includes.nav")
                        <div class="col-xl-8">
                            <div class="content-title mt-0">
                                <h4>Materials</h4>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table data-table">
                                        <thead class="thead-light">
                                        <tr>
                                            <th>Business</th>
                                            <th>Registration ID</th>
                                            <th>Type</th>
                                            <th>Class</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                         @if(!empty($materials))
                                            @foreach($materials as $material)
                                                @if($material->status!==4)
                                                <tr>
                                                    <td>{{$material->business->name}}</td>
                                                    <td>{{$material->reg_no}}</td>
                                                    <td>{{$material->materialType->name}}</td>
                                                    <td>{{$material->materialClass->name}}</td>
                                                    <td>
                                                        @if($material->status==0)
                                                            <label class="badge badge-info">Pending Approval by {{env("APP_NAME")}}</label>
                                                            @elseif($material->status==0)
                                                            <label class="badge badge-success">Active</label>
                                                            @elseif($material->status==2)
                                                            <label class="badge badge-warning">Inactive</label>
                                                             @elseif($material->status==3)
                                                            <label class="badge badge-danger">Declined </label>
                                                             @endif
                                                    </td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <a href="#" class="btn btn-floating" data-toggle="dropdown">
                                                                <i class="ti-more-alt"></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a href="#" class="dropdown-item" onclick="viewMaterialModal('{{$material->business->name}}','{{json_encode($material->only(["reg_no","materialClass", "materialType","description","ownership","status","comment",]))}}')">View Details</a>
                                                                <a href="{{route("vendor.inventory.edit.equipment",$material->id)}}" class="dropdown-item">Update </a>
                                                               <a href="#" class="dropdown-item" onclick="deleteRecord('{{route("vendor.delete.equipment",$material->id)}}')">Delete</a>

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

    @include("vendor.v1.inventory.modals.view-material")
    <!-- App scripts -->
    <script src="{{url("assets/js/mijengo/select2.js")}}"></script>
    <script src="{{url("assets/js/mijengo/ajax/inventory.js")}}"></script>
@endsection
