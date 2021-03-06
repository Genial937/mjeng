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
                            <div class="d-md-flex justify-content-between mb-4">
                                <form id="search-equipment" method="GET">
                                    <ul class="list-inline mb-3">
                                        <li class="list-inline-item mb-0">
                                            <label>Filter By Business</label>
                                            <select id="business-type" name="business_id" required
                                                    class="form-control form-select-2">
                                                <option selected >Choose business</option>
                                                @if(!empty($businesses))
                                                    @foreach($businesses as $business)
                                                        <option @if(Request::get("business_id")==$business->id||$default_business->id=$business->id) selected @endif value="{{$business->id}}">{{$business->name}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </li>
                                        <li class="list-inline-item mb-0">
                                            <label>Filter By Status</label>
                                            <select id="material-status" name="status"
                                                    class="form-control form-select-2">
                                                <option selected>Choose status</option>
                                                <option @if(Request::get("status")=="0") selected @endif value="0">Pending Approval</option>
                                                <option @if(Request::get("status")==1) selected @endif value="1">In stock</option>
                                                <option @if(Request::get("status")==2) selected @endif value="2">Out of stock</option>
                                                <option @if(Request::get("status")==4) selected @endif value="4">Not selling anymore</option>
                                            </select>
                                        </li>
                                        <li class="list-inline-item mb-0">
                                            <button class="btn btn-dark" ><i class="ti-search"></i> Search</button>
                                        </li>
                                    </ul>
                                </form>
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
                                            <th>County</th>
                                            <th>Sub County</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                         @if(!empty($materials))
                                            @foreach($materials as $material)
                                                @if($material->status!==3)
                                                <tr>
                                                    <td>{{$material->business->name}}</td>
                                                    <td>{{$material->reg_no}}</td>
                                                    <td>{{$material->materialType->name}}</td>
                                                    <td>{{$material->materialClass->name}}</td>
                                                    <td>{{$material->subCounty->county->name}}</td>
                                                    <td>{{$material->subCounty->name}}</td>
                                                    <td>
                                                        @if($material->status==0)
                                                            <label class="badge badge-info">Pending Approval by {{env("APP_NAME")}}</label>
                                                            @elseif($material->status==1)
                                                            <label class="badge badge-success">In Stock</label>
                                                            @elseif($material->status==2)
                                                            <label class="badge badge-warning">Out of Stock</label>
                                                             @elseif($material->status==3)
                                                            <label class="badge badge-danger">Deleted </label>
                                                           @elseif($material->status==4)
                                                            <label class="badge badge-danger">Not selling anymore</label>
                                                             @endif
                                                    </td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <a href="#" class="btn btn-floating" data-toggle="dropdown">
                                                                <i class="ti-more-alt"></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a href="#" class="dropdown-item" onclick="viewMaterialModal('{{$material->business->name}}','{{json_encode($material->only(["reg_no","materialClass", "materialType","description","ownership","subCounty","status","comment",]))}}')">View </a>
                                                                 @if($material->status==0)
                                                                    <a href="{{route("vendor.inventory.edit.material",$material->id)}}" class="dropdown-item">Update </a>
                                                                    <a href="#" class="dropdown-item" onclick="deleteRecord('{{route("vendor.delete.material",$material->id)}}')">Delete</a>
                                                                @else
                                                                    <a href="#" class="dropdown-item" onclick="changeMaterialStatusModal('{{$material->business->name}}','{{json_encode($material->only(["id","reg_no","materialClass", "materialType","description","ownership","subCounty","status","comment",]))}}')">Status</a>
                                                                @endif

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
    @include("vendor.v1.inventory.modals.change-material-status")
    <!-- App scripts -->
    <script src="{{url("assets/js/mijengo/select2.js")}}"></script>
    <script src="{{url("assets/js/mijengo/ajax/inventory.js")}}"></script>
@endsection
