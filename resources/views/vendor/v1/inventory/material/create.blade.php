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
                                <li class="current"><em>Add Material</em></li>
                            </ol>
                        </nav>

                    </div>
                    <div class="row">
                        @include("vendor.v1.inventory.includes.nav")
                        <div class="col-xl-8">
                            <div class="content-title mt-0">
                                <h4> Create material your can supplier</h4>
                            </div>

                                <div class="row">
                                    <div class="col-md-6 margin-10-b">
                                        <form action="{{route("vendor.material.equipment")}}"
                                              id="create-vendor-material-form" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>My Business</label>
                                                        <select id="business-id" name="business_id" class="form-control form-select-2">
                                                            <option  value="">Choose business</option>
                                                            @if(!empty($businesses))
                                                                @foreach($businesses as $business)
                                                                    <option  value="{{$business->id}}">{{$business->name}}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Are you the Owner/Agent?</label>
                                                    <select id="ownership-id" name="ownership" class="form-control form-select-2">
                                                        <option  value="">Choose ownership</option>
                                                        <option  value="OWNER">Owner</option>
                                                        <option  value="AGENT">Agent</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Material Types</label>
                                                        <select id="material-type-id" name="material_type_id" class="form-control form-select-2" onchange="getMaterialClass()">
                                                            <option  value="">Choose types</option>
                                                            @if(!empty($material_types))
                                                                @foreach($material_types as $material_type)
                                                                    <option  value="{{$material_type->id}}">{{$material_type->name}}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Material Class</label>
                                                    <select id="material-class-id" name="material_class_id" class="form-control form-select-2" required >
                                                        <option selected value="" >Choose class</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Description/Additional information</label>
                                                        <textarea name="description" id="description"
                                                                  class="form-control border-input"
                                                                  placeholder="Additional information about the material"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        <button
                                            class="btn btn-primary  btn-uppercase btn-rounded btn-create-material ">
                                            Save Changes
                                        </button>
                                            <input type="hidden" name="user_id" value="{{auth()->id()}}">
                                     </form>
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
    <!-- App scripts -->
    <script src="{{url("assets/js/mijengo/select2.js")}}"></script>
    <script src="{{url("assets/js/mijengo/datepicker.js")}}"></script>
    <script src="{{url("assets/js/mijengo/ajax/inventory.js")}}"></script>
    <!-- Javascript -->

@endsection