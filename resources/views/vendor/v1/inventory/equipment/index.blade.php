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

                        @include("vendor.v1.inventory.includes.nav")
                        <div class="col-xl-8">
                            <div class="content-title mt-0">
                                <h4>All Equipments</h4>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table data-table">
                                        <thead class="thead-light">
                                        <tr>
                                            <th>Business</th>
                                            <th>Registration ID</th>
                                            <th>Type</th>
                                            <th>Model</th>
                                            <th>Plate No</th>
                                            <th>Status</th>
                                            <th>Images</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(!empty($equipments))
                                            @foreach($equipments as $equipment)
                                                @if($equipment->status!==4)
                                                <tr>

                                                    <td>{{$equipment->business->name}}</td>
                                                    <td>{{$equipment->reg_no}}</td>
                                                    <td>{{$equipment->equipmentType->name}}</td>
                                                    <td>{{$equipment->equipmentModel->name}}</td>
                                                    <td>{{$equipment->plate_no}}</td>
                                                    <td>
                                                        @if($equipment->status==0)
                                                            <label class="badge badge-info">Pending Approval by {{env("APP_NAME")}}</label>
                                                            @elseif($equipment->status==0)
                                                            <label class="badge badge-success">Active</label>
                                                            @elseif($equipment->status==2)
                                                            <label class="badge badge-warning">Inactive</label>
                                                             @elseif($equipment->status==3)
                                                            <label class="badge badge-danger">Declined </label>
                                                             @endif
                                                    </td>
                                                    <td>
                                                        <div class="avatar-group">
                                                            <figure class="avatar avatar-sm" title="" data-toggle="tooltip" data-original-title="Front Image">
                                                                <a class="image-popup-gallery-item" href="{{url(\App\Helpers\UploadFiles::viewDocument(json_decode($equipment->images)->equipment_front_image))}}">
                                                                    <img src="{{url("assets/media/image/truck.png")}}" class="img-fluid" alt="image">
                                                                </a>
                                                            </figure>
                                                            <figure class="avatar avatar-sm" title="" data-toggle="tooltip" data-original-title="Back Image">
                                                                <a class="image-popup-gallery-item" href="{{url(\App\Helpers\UploadFiles::viewDocument(json_decode($equipment->images)->equipment_back_image))}}">
                                                                    <img src="{{url("assets/media/image/truck.png")}}" class="img-fluid" alt="image">
                                                                </a>
                                                            </figure>
                                                            <figure class="avatar avatar-sm" title="" data-toggle="tooltip" data-original-title="Right Image">
                                                                <a class="image-popup-gallery-item" href="{{url(\App\Helpers\UploadFiles::viewDocument(json_decode($equipment->images)->equipment_right_image))}}">
                                                                    <img src="{{url("assets/media/image/truck.png")}}" class="img-fluid" alt="image">
                                                                </a>
                                                            </figure>
                                                            <figure class="avatar avatar-sm" title="" data-toggle="tooltip" data-original-title="Left Image">
                                                                <a class="image-popup-gallery-item" href="{{url(\App\Helpers\UploadFiles::viewDocument(json_decode($equipment->images)->equipment_left_image))}}">
                                                                    <img src="{{url("assets/media/image/truck.png")}}" class="img-fluid" alt="image">
                                                                </a>
                                                            </figure>
                                                        </div>

                                                    </td>

                                                    <td>
                                                        <div class="dropdown">
                                                            <a href="#" class="btn btn-floating" data-toggle="dropdown">
                                                                <i class="ti-more-alt"></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a href="#" class="dropdown-item" onclick="viewEquipmentModal('{{$equipment->business->name}}','{{json_encode($equipment->only(["reg_no","equipmentType", "equipmentModel","plate_no","yom","axel", "tw","gw","description","ownership","fuel_type","engine_capacity","status","comment",]))}}')">View Details</a>
                                                                <a href="{{route("vendor.inventory.edit.equipment",$equipment->id)}}" class="dropdown-item">Update </a>
                                                               <a href="#" class="dropdown-item" onclick="deleteRecord('{{route("vendor.delete.equipment",$equipment->id)}}')">Delete</a>

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

    @include("vendor.v1.inventory.modals.view-equiments")
    <!-- App scripts -->
    <script src="{{url("assets/js/mijengo/select2.js")}}"></script>
    <script src="{{url("assets/js/mijengo/ajax/inventory.js")}}"></script>
@endsection