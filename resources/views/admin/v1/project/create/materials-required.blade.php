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


                    <div class="row">
                        <div class="col-xl-12">
                            @if(Request::get('action')=="edit")
                                @include("admin.v1.project.create.includes.form-steps")
                            @else
                                <div class="content-title mt-0">
                                    <a href="{{route("admin.project")}}" class="btn btn-gradient-dark text-white"><i class="ti-arrow-left"></i>Back to projects</a>
                                </div>
                            @endif
                            <div class="row margin-5-p">
                                <div class="col-md-3 offset-1">
                                    <div class="content-title mt-0">
                                        <h4>Add a Material Required</h4>
                                    </div>
                                    <form class=" margin-10-p" id="create-material-required-form" action="{{route("admin.create.project.material.required")}}">
                                        <div class="form-row">
                                            <div class="col-md-12 mb-3">
                                                <label >Choose a project site</label>
                                                <select class="form-select-2" id="site-id" name="site_id" onchange="formAddGetSiteTasks()">
                                                    <option>Choose site</option>
                                                    @if(!empty($sites))
                                                        @foreach($sites as $site)
                                                            <option class="text-capitalize"
                                                                    value="{{$site->id}}">{{$site->name}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-12 mb-3">
                                                <label >Choose a site task</label>
                                                <select class="form-select-2" id="task-id" name="task_id" onchange="formAddGetTaskMaterialType()">
                                                    <option>Select</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-12 mb-3">
                                                <label >Choose an material type</label>
                                                <select class="form-select-2" id="material-type-id" name="material_type_id" onchange="formAddGetMaterialClass()">
                                                    <option>Select</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-12 mb-3">
                                                <label >Choose an material classification</label>
                                                <select class="form-select-2" id="material-class-id" name="material_class_id" >
                                                    <option>Select</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-12 mb-3">
                                                <label >Quantity of material required e.g 30tonnes</label>
                                                <div class="input-group">
                                                    <input type="number" class="form-control" id="quantity-required"
                                                           placeholder="30" name="quantity_required"
                                                           required>
                                                    <div class="input-group-prepend">
                                                        <select class="form-control" name="quantity_required_unit" id="quantity-required-unit">
                                                            @if(!empty($measurement_units))
                                                                @foreach($measurement_units as $measurement_unit)
                                                                    <option class="text-capitalize" value="{{$measurement_unit->symbol}}">{{$measurement_unit->name}}({{$measurement_unit->symbol}})</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-12 mb-3">
                                                <label >Minimum quantity of material required per day</label>
                                                <div class="input-group">
                                                    <input type="number" class="form-control" id="quantity-required-per-day"
                                                           name="quantity_required_per_day"
                                                           placeholder="3"
                                                           required>
                                                    <div class="input-group-prepend">
                                                        <select class="form-control" id="quantity-required-per-day-unit" name="quantity_required_per_day_unit">
                                                            @if(!empty($measurement_units))
                                                                @foreach($measurement_units as $measurement_unit)
                                                                    <option class="text-capitalize" value="{{$measurement_unit->symbol}}">{{$measurement_unit->name}}({{$measurement_unit->symbol}})</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-12 mb-3">
                                                <label >Payment Terms e.g KES 3000/Tonnes</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <select name="currency" class="form-control">
                                                            @if(!empty($currencies))
                                                                @foreach($currencies as $currency)
                                                                    <option class="text-capitalize" value="{{$currency->symbol}}">{{$currency->symbol}}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                    <input type="number" class="form-control" id="lease-rates" name="lease_rates"
                                                           placeholder="amount">
                                                    <div class="input-group-prepend">
                                                        <select name="lease_modality" class="form-control" id="lease-modality">
                                                            @if(!empty($measurement_units))
                                                                @foreach($measurement_units as $measurement_unit)
                                                                    <option class="text-capitalize" value="{{$measurement_unit->symbol}}">{{$measurement_unit->symbol}}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-12 mb-3">
                                                <label for="end-date">CESS Provision</label>
                                                <select class="form-control" name="cess" id="cess-provision">
                                                    <option>Select</option>
                                                    <option value="OWNER">OWNER</option>
                                                    <option value="COMPANY">COMPANY</option>
                                                </select>
                                            </div>
                                        </div>
                                        @if(Request::get('action')!="edit")
                                        <a href="{{route("admin.form.create.material.required",Request::segment(7))}}" class="btn btn-gradient-dark btn-rounded text-white"> <i class="ti-arrow-left"></i>Back</a>
                                         @endif
                                        <button class="btn btn-primary btn-rounded btn-create-material-required" type="submit">Save</button>
                                     </form>
                                </div>
                                <div class="col-md-7 border-left">
                                    <div class="content-title mt-0">
                                    <h4>Material Required List</h4>
                                    </div>
                                    <div >
                                        <table class="table data-table">
                                            <thead class="thead-light">
                                            <tr>
                                                <th scope="col">Site</th>
                                                <th scope="col">Task</th>
                                                <th scope="col">Material Type</th>
                                                <th scope="col">Material Class</th>
                                                <th scope="col">Quantity Required</th>
                                                <th scope="col">Quantity Required Daily</th>
                                                <th scope="col">Payment Terms</th>
                                                <th scope="col">CESS Provision</th>
                                                <th scope="col">Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if(!empty($materials_required))
                                                @foreach($materials_required as $material)
                                            <tr>
                                                <td>{{$material->site->name}}</td>
                                                <td>{{$material->task->name}}</td>
                                                <td>{{$material->materialType->name}}</td>
                                                <td>{{$material->classification->name}}</td>
                                                <td>{{$material->quantity_required}} {{$material->quantity_required_unit}}</td>
                                                <td>{{$material->quantity_required_per_day}} {{$material->quantity_required_per_day_unit}}</td>
                                                <td>{{$material->currency}} {{$material->lease_rates}}/{{$material->lease_modality}}</td>
                                                <td>{{$material->cess}}</td>
                                                <td class="text-left">
                                                    <div class="dropdown">
                                                        <a href="#" class="btn btn-floating" data-toggle="dropdown">
                                                            <i class="ti-more-alt"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a href="#" class="dropdown-item" onclick="editMaterialRequired('{{json_encode($material)}}')">Edit</a>
                                                            <a href="#" class="dropdown-item" onclick="deleteRecord('{{route("admin.delete.material.required",$material->id)}}')">Delete</a>
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
    <!-- modals  -->
    @include("admin.v1.project.modals.edit-equipment-required")
    <!-- Files page  -->
    <script src="{{url("assets/js/mijengo/select2.js")}}"></script>
    <script src="{{url("assets/js/mijengo/ajax/project.js")}}"></script>

@endsection
