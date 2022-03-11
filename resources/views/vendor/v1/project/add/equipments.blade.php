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


                    <div class="row">
                        @include("vendor.v1.project.add.includes.nav")
                        <div class="col-xl-8">
                            <div class="content-title mt-0">
                                <h4>Equipment Required</h4>
                                <nav>
                                    <ol class="cd-breadcrumb">
                                        <li><a href="{{route("vendor.dashboard")}}" class="text-sm-left">Home</a></li>
                                        <li><a href="{{route("vendor.project")}}" class="text-sm-left">Projects</a></li>
                                        <li class="current"><em>Equipment Required</em></li>
                                    </ol>
                                </nav>
                            </div>
                            <div class="margin-5-b">
                            <p>Project Name: {{$project->name}} </p>
                            <p>Start Date : {{$project->start_date}} </p>
                            <p>End Date : {{$project->end_date}}</p>

                            </div>
                            <div class="d-md-flex justify-content-between mb-4 margin-5-b">

                                <form id="search-equipment" method="GET">
                                    <ul class="list-inline mb-3">
                                        <li class="list-inline-item mb-0">
                                            <label>Filter by Site</label>
                                            <select id="site-id" name="site_id" required
                                                    class="form-control form-select-2">
                                                <option selected value="">Choose site</option>
                                                @if(!empty($sites))
                                                    @foreach($sites as $site)
                                                        <option @if(Request::get("site_id")==$site->id) selected @endif value="{{$site->id}}">{{$site->name}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </li>
                                        <li class="list-inline-item mb-0">
                                            <label>Filter by Equipment Type</label>
                                            <select id="site-id" name="equipments_type_id" required
                                                    class="form-control form-select-2">
                                                <option selected value="">Choose Equipment Type</option>
                                                @if(!empty($equipments_types))
                                                    @foreach($equipments_types as $equipments_type)
                                                        <option @if(Request::get("equipments_type_id")==$equipments_type->id) selected @endif value="{{$equipments_type->id}}">{{$equipments_type->name}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </li>
                                        <li class="list-inline-item mb-0">
                                            <button class="btn btn-dark" ><i class="ti-search"></i> Search</button>
                                        </li>
                                    </ul>
                                </form>
                            </div>
                            <table class="table data-table-">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">Site</th>
                                    <th scope="col">Task</th>
                                    <th scope="col">Required Number</th>
                                    <th scope="col">Payload Capacity</th>
                                    <th scope="col">Duration Required</th>
                                    <th scope="col">Payment Terms</th>
                                    <th scope="col">Fuel Provision</th>
                                    <th scope="col">CESS Provision</th>
                                    <th scope="col"></th>
                                </tr>
                                </thead>
                                <tbody>

                                @if(!empty($equipments_required))

                                    @foreach($equipments_required as $equipment)
                                        <tr>
                                            <td>{{$no++}}</td>
                                            <td>{{$equipment->site->name}}</td>
                                            <td>{{$equipment->task->name}}</td>
                                            <td>{{$equipment->no_equipment}} {{$equipment->equipmentType->name}}</td>
                                            <td >{{$equipment->payload_capacity}} {{$equipment->payload_unit}}</td>
                                            <td>{{$equipment->duration}} {{$equipment->duration_unit}}</td>
                                            <td>{{$equipment->currency}} {{$equipment->lease_rates}}/{{$equipment->lease_modality}}</td>
                                            <td>{{$equipment->fuel_provision}}</td>
                                            <td>{{$equipment->cess_provision}}</td>
                                            <td >
                                                <div class="dropdown">
                                                    <a href="#" class="btn btn-floating" data-toggle="dropdown">
                                                        <i class="ti-more-alt"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a href="#" class="dropdown-item" onclick="assignEquipmentFromInventory('{{json_encode($equipment)}}')" > Add equipment(s)</a>
                                                        <a href="#" class="dropdown-item" onclick="viewEquipmentRequiredAssignedModal('{{json_encode($equipment)}}')" > View added equipments(s)</a>

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
    @include("vendor.v1.project.modals.add-equipment")
    @include("vendor.v1.project.modals.view-equipments")
    <!-- Files page  -->
    <script src="{{url("assets/js/mijengo/select2.js")}}"></script>
    <script src="{{url("assets/js/mijengo/datepicker.js")}}"></script>
    <script src="{{url("assets/js/mijengo/ajax/project.js")}}"></script>
@endsection
