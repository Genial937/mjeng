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
                                <li class="current"><em>Equipments</em></li>
                            </ol>
                        </nav>

                    </div>
                    <div class="row">
                        @include("vendor.v1.inventory.includes.nav")
                        <div class="col-xl-8">
                            <div class="content-title mt-0">
                                <h4> Equipment Details</h4>
                            </div>

                                <div class="row">
                                    <div class="col-md-6 margin-10-b">
                                        <form action="{{route("vendor.create.equipment")}}"
                                              id="create-vendor-equipment-form" enctype="multipart/form-data">
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
                                                        <label>Equipment Types</label>
                                                        <select id="equipment-type-id" name="equipment_type_id" class="form-control form-select-2" onchange="getEquipmentMake()">
                                                            <option  value="">Choose equipment types</option>
                                                            @if(!empty($equipment_types))
                                                                @foreach($equipment_types as $equipment_type)
                                                                    <option  value="{{$equipment_type->id}}">{{$equipment_type->name}}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Equipment Make</label>
                                                    <select id="equipment-make-id" name="equipment_make_id" class="form-control form-select-2" required onchange="getEquipmentModel()">
                                                        <option selected value="" >Choose make</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Equipment Model</label>
                                                    <select id="equipment-model-id" name="equipment_model_id" class="form-control form-select-2" required>
                                                        <option selected value="" >Choose model</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Registration/Plate no</label>
                                                    <input type="text" id="plate-no" name="plate_no"
                                                           placeholder="e.g. KCB 990K"
                                                           class="form-control border-input ">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Engine Capacity(cubic capacity)</label>
                                                    <input type="number" name="engine_capacity" id="engine-capacity"
                                                           maxlength="20"
                                                           class="form-control border-input"
                                                           placeholder="e.g. 3000">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Fuel Type</label>
                                                    <select id="fuel-type" name="fuel_type" class="form-control form-select-2" >
                                                        <option  value="">Choose fuel type</option>
                                                        <option  value="PETROL">Petrol</option>
                                                        <option  value="DIESEL">Diesel</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Number of Axels</label>
                                                    <input type="number" id="axel" name="axel"
                                                           class="form-control border-input"
                                                           placeholder="4">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Tare Weight(Tonne) i.e total weight when the vehicle is empty</label>
                                                    <input type="number" id="tw" name="tw"
                                                           class="form-control border-input"
                                                           placeholder="e.g 1.5">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Gross Weight(Tonne) i.e total weight when the vehicle is loaded</label>
                                                    <input type="number" id="gw" name="gw"
                                                           class="form-control border-input"
                                                           placeholder="e.g 3">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Year of Make</label>
                                                    <input type="text" id="yom" name="yom"
                                                           class="form-control border-input date-picker">
                                                </div>
                                            </div>
                                        </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Description/Additional information</label>
                                                        <textarea name="description" id="description"
                                                                  class="form-control border-input"
                                                                  placeholder="Additional information about the equipment"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        <button
                                            class="btn btn-primary  btn-uppercase btn-rounded btn-create-equipment ">
                                            Save Changes
                                        </button>
                                           <input type="hidden" name="equipment_front_image" >
                                            <input type="hidden" name="equipment_back_image" >
                                            <input type="hidden" name="equipment_right_image" >
                                            <input type="hidden" name="equipment_left_image" >
                                            <input type="hidden" name="user_id" value="{{auth()->id()}}">
                            </form>
                                    </div>
                                    <div class="col-md-6 ">

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Front Picture</label>
                                                    <form action="{{route("vendor.inventory.equipment.images",'front')}}"
                                                          enctype="multipart/form-data"
                                                          class="file-uploader dropzone"
                                                          id="file-uploader">
                                                        @csrf

                                                        <div class="fallback">
                                                            <input type="file" name="file" >
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Back Picture</label>
                                                    <form action="{{route("vendor.inventory.equipment.images",'back')}}"
                                                          enctype="multipart/form-data"
                                                          class="file-uploader dropzone"
                                                          id="file-uploader">
                                                        @csrf

                                                        <div class="fallback">
                                                            <input type="file" name="file" >
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Right Picture</label>
                                                    <form action="{{route("vendor.inventory.equipment.images",'right')}}"
                                                          enctype="multipart/form-data"
                                                          class="file-uploader dropzone"
                                                          id="file-uploader">
                                                        @csrf

                                                        <div class="fallback">
                                                            <input type="file" name="file" >
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Left Picture</label>
                                                    <form action="{{route("vendor.inventory.equipment.images",'left')}}"
                                                          enctype="multipart/form-data"
                                                          class="file-uploader dropzone"
                                                          id="file-uploader">
                                                        @csrf

                                                        <div class="fallback">
                                                            <input type="file" name="file" >
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>


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
