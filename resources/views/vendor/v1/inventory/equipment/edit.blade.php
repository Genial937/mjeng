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
                        @if($equipment->status=="0"||$equipment->status=="4")
                             <div class="alert alert-info alert-with-border" role="alert">
                                <i class="ti-bell text-lg-center"></i> {{$equipment->comment}}
                             </div>

                        @endif
                    </div>
                    <div class="row">
                        @include("vendor.v1.inventory.includes.nav")
                        <div class="col-xl-8">
                            <div class="content-title mt-0">
                                <h4>Edit Equipment Details</h4>
                            </div>
                                <div class="row">
                                    <div class="col-md-6 margin-10-b">
                                        <form action="{{route("vendor.edit.equipment")}}"
                                              id="edit-vendor-equipment-form" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>My Business</label>
                                                        <select id="business-id" name="business_id" class="form-control form-select-2">
                                                            <option  value="">Choose business</option>
                                                            @if(!empty($businesses))
                                                                @foreach($businesses as $business)
                                                                    <option @if($business->id==$equipment->business->id) selected @endif value="{{$business->id}}">{{$business->name}}</option>
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
                                                        <option @if($equipment->ownership=="OWNER") selected @endif value="OWNER">Owner</option>
                                                        <option @if($equipment->ownership=="AGENT") selected @endif value="AGENT">Agent</option>
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
                                                                    <option @if($equipment->equipmentType->id==$equipment_type->id) selected @endif value="{{$equipment_type->id}}">{{$equipment_type->name}}</option>
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
                                                    <select id="equipment-make-id" name="equipment_make_id" class="form-control form-select-2"  onchange="getEquipmentModel()">
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
                                                        @if(!empty($equipment_models))
                                                            @foreach($equipment_models as $equipment_model)
                                                                <option @if($equipment->equipmentModel->id==$equipment_model->id) selected @endif value="{{$equipment_model->id}}">{{$equipment_model->name}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Registration/Plate no</label>
                                                    <input type="text" id="plate-no" name="plate_no"
                                                           value="{{$equipment->plate_no}}"
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
                                                           value="{{$equipment->engine_capacity}}"
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
                                                        <option @if($equipment->fuel_type=="PETROL") selected @endif value="PETROL">Petrol</option>
                                                        <option @if($equipment->fuel_type=="DIESEL") selected @endif value="DIESEL">Diesel</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Number of Axels</label>
                                                    <input type="number" id="axel" name="axel" value="{{$equipment->axel}}"
                                                           class="form-control border-input"
                                                           placeholder="4">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Tare Weight(Tonne) i.e total weight when the vehicle is empty</label>
                                                    <input type="number" id="tw" name="tw" value="{{$equipment->tw}}"
                                                           class="form-control border-input"
                                                           placeholder="e.g 1.5">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Gross Weight(Tonne) i.e total weight when the vehicle is loaded</label>
                                                    <input type="number" id="gw" name="gw" value="{{$equipment->gw}}"
                                                           class="form-control border-input"
                                                           placeholder="e.g 3">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Year of Make</label>
                                                    <input type="text" id="yom" name="yom" value="{{$equipment->yom??""}}"
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
                                                                  placeholder="Additional information about the equipment">{{$equipment->description}}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            @if($equipment->status==1 || $equipment->status==2|| $equipment->status==3)
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Equipment Status </label>
                                                        <select id="status" name="status" class="form-control form-select-2">
                                                            <option  value="">Choose ownership</option>
                                                            <option @if($equipment->status==1) selected @endif value="1">Active</option>
                                                            <option @if($equipment->status==2) selected @endif value="2">Inactive</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                        <button
                                            class="btn btn-primary  btn-uppercase btn-rounded btn-edit-equipment ">
                                            Save Changes
                                        </button>
                                           <input type="hidden" name="equipment_front_image" value="{{json_decode($equipment->images)->equipment_front_image}}">
                                            <input type="hidden" name="equipment_back_image" value="{{json_decode($equipment->images)->equipment_back_image}}">
                                            <input type="hidden" name="equipment_right_image" value="{{json_decode($equipment->images)->equipment_right_image}}">
                                            <input type="hidden" name="equipment_left_image" value="{{json_decode($equipment->images)->equipment_left_image}}">
                                            <input type="hidden" name="id" value="{{$equipment->id}}">
                            </form>
                                    </div>
                                    <div class="col-md-6 ">

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Change Front Image</label>
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
                                                    <div class="form-group ">
                                                        <a class="image-popup" href="{{url(\App\Helpers\UploadFiles::viewDocument(json_decode($equipment->images)->equipment_front_image))}}">
                                                            <img width="250" style="margin-top: 2.3em"  src="{{url(\App\Helpers\UploadFiles::viewDocument(json_decode($equipment->images)->equipment_front_image))}}" alt="image">
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Change Back Image</label>
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
                                                <div class="col-md-6">
                                                    <div class="form-group ">
                                                        <a class="image-popup" href="{{url(\App\Helpers\UploadFiles::viewDocument(json_decode($equipment->images)->equipment_back_image))}}">
                                                            <img width="250" style="margin-top: 3.3em" src="{{url(\App\Helpers\UploadFiles::viewDocument(json_decode($equipment->images)->equipment_back_image))}}" alt="image">
                                                        </a>
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Change Right Image</label>
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
                                                    <a class="image-popup" href="{{url(\App\Helpers\UploadFiles::viewDocument(json_decode($equipment->images)->equipment_right_image))}}">
                                                        <img width="250" style="margin-top: 2.3em"  src="{{url(\App\Helpers\UploadFiles::viewDocument(json_decode($equipment->images)->equipment_right_image))}}" alt="image">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Change Left Image</label>
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
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <a class="image-popup" href="{{url(\App\Helpers\UploadFiles::viewDocument(json_decode($equipment->images)->equipment_left_image))}}">
                                                        <img width="250" style="margin-top: 2.3em"  src="{{url(\App\Helpers\UploadFiles::viewDocument(json_decode($equipment->images)->equipment_left_image))}}" alt="image">
                                                    </a>
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
    <script>
        $(document).ready(function(){
            $("#equipment-type-id").trigger('change')
            setTimeout(function () {
                $("#equipment-make-id").val({{$equipment->equipmentModel->equipmentMake->id}}).trigger("change")
                setTimeout(function () {
                    $("#equipment-model-id").val({{$equipment->equipmentModel->id}}).trigger("change")
                },4000)
            },4000)
        })
    </script>
@endsection
