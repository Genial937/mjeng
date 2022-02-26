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
                            @if(Request::get('action')!="edit")
                               @include("admin.v1.project.create.includes.form-steps")
                            @else
                                <div class="content-title mt-0">
                                    <nav>
                                        <ol class="cd-breadcrumb">
                                            <li><a href="{{route("admin.dashboard")}}" class="text-sm-left">Home</a></li>
                                            <li><a href="{{route("admin.project")}}">Projects</a></li>
                                            <li class="current"><em>Material Required</em></li>
                                        </ol>
                                    </nav>
                                </div>
                            @endif
                            <div class="row margin-5-p">
                                <div class="col-md-3 offset-1">
                                    <div class="content-title mt-0">
                                        <h4>Add an Equipment Required</h4>
                                    </div>
                                    <form class="margin-5-p" id="create-equipment-required-form" action="{{route("admin.create.project.equipment.required")}}">
                                        <div class="form-row">
                                            <div class="col-md-12 mb-3">
                                                <label for="end-date">Choose a project site</label>
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
                                                <label for="end-date">Choose a site task</label>
                                                <select class="form-select-2" id="task-id" name="task_id" onchange="formAddGetTaskEquipmentType()">
                                                    <option>Select</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-12 mb-3">
                                                <label for="end-date">Choose an equipment type</label>
                                                <select class="form-select-2" id="equipment-type-id" name="equipment_type_id" >
                                                    <option>Select</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-12 mb-3">
                                                <label for="no-equipment">Number of equipments type required</label>
                                                <input type="number" class="form-control" id="no-equipment"
                                                       placeholder="2" name="no_equipment">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-12 mb-3">
                                                <label for="site-name">Equipment type minimum loading capacity e.g 30 tonnes</label>
                                                <div class="input-group">
                                                    <input type="number" class="form-control" id="min-loading-capacity" name="payload_capacity"
                                                           placeholder="3">
                                                    <div class="input-group-prepend">
                                                        <select class="form-control" name="payload_unit" >
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
                                                <label for="duration">Duration the Equipments Type is Required e.g 5days</label>
                                                <div class="input-group">
                                                    <input type="number" class="form-control" id="duration"
                                                           placeholder="2" name="duration">
                                                    <div class="input-group-prepend">
                                                        <select name="duration_unit" class="form-control">
                                                            <option value="HOURS">Hrs</option>
                                                            <option selected value="DAYS">Days</option>
                                                            <option value="MONTHS">Months</option>
                                                        </select>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-12 mb-3">
                                                <label >Payment Terms e.g KES 3000/day</label>
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
                                                            <option value="HOUR">Hrs</option>
                                                            <option selected value="DAY">Day</option>
                                                            <option value="MONTH">Month</option>
                                                            <option value="MONTH">Year</option>
                                                        </select>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-12 mb-3">
                                                <label>Fuel Provision</label>
                                                <select class="form-control" name="fuel_provision">
                                                    <option>Select</option>
                                                    <option value="OWNER">OWNER</option>
                                                    <option value="COMPANY">COMPANY</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-12 mb-3">
                                                <label for="end-date">CESS Provision</label>
                                                <select class="form-control" name="cess_provision">
                                                    <option>Select</option>
                                                    <option value="OWNER">OWNER</option>
                                                    <option value="COMPANY">COMPANY</option>
                                                </select>
                                            </div>
                                        </div>


                                        <button class="btn btn-primary btn-rounded btn-create-equipment-required" type="submit">Save</button>
                                        @if(Request::get('action')!="edit")
                                        <a href="{{route("admin.form.create.material.required",$project_id)}}" class="btn btn-gradient-dark btn-rounded text-white">Continue <i class="ti-arrow-right"></i></a>
                                         @endif
                                    </form>
                                </div>
                                <div class="col-md-7 border-left">
                                    <div class="content-title mt-0">
                                        <h4>Project Equipment Required List</h4>
                                    </div>
                                    <div >
                                        <table class="table data-table">
                                            <thead class="thead-light">
                                            <tr>
                                                <th scope="col">Site</th>
                                                <th scope="col">Task</th>
                                                <th scope="col">Required Number</th>
                                                <th scope="col">Payload Capacity</th>
                                                <th scope="col">Duration Required</th>
                                                <th scope="col">Payment Terms</th>
                                                <th scope="col">Fuel Provision</th>
                                                <th scope="col">CESS Provision</th>
                                                <th scope="col">Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                                @if(!empty($equipments_required))
                                                    @foreach($equipments_required as $equipment)
                                                        <tr>
                                                        <td>{{$equipment->site->name}}</td>
                                                         <td>{{$equipment->task->name}}</td>
                                                        <td>{{$equipment->no_equipment}} {{$equipment->equipmentType->name}}</td>
                                                        <td >{{$equipment->payload_capacity}} {{$equipment->payload_unit}}</td>
                                                        <td>{{$equipment->duration}} {{$equipment->duration_unit}}</td>
                                                        <td>{{$equipment->currency}} {{$equipment->lease_rates}}/{{$equipment->lease_modality}}</td>
                                                        <td>{{$equipment->fuel_provision}}</td>
                                                        <td>{{$equipment->cess_provision}}</td>
                                                            <td class="text-left">
                                                                <div class="dropdown">
                                                                    <a href="#" class="btn btn-floating" data-toggle="dropdown">
                                                                        <i class="ti-more-alt"></i>
                                                                    </a>
                                                                    <div class="dropdown-menu dropdown-menu-right">
                                                                        <a href="#" class="dropdown-item" onclick="editEquipmentRequired('{{json_encode($equipment)}}')">Edit</a>
                                                                        <a href="#" class="dropdown-item" onclick="deleteRecord('{{route("admin.delete.equipment.required",$equipment->id)}}')">Delete</a>
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
