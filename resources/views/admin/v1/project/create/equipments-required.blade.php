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
                            @include("admin.v1.project.create.includes.form-steps")
                            <div class="row margin-5-p">
                                <div class="col-md-3 offset-1">
                                    <div class="content-title mt-0">
                                        <h4>Project Equipment Required</h4>
                                    </div>
                                    <form class="needs-validation margin-5-p">
                                        <div class="form-row">
                                            <div class="col-md-12 mb-3">
                                                <label for="end-date">Choose a Site</label>
                                                <select class="form-select-2" id="site-id" name="site_id">
                                                    <option>Select</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-12 mb-3">
                                                <label for="end-date">Choose a Site Task</label>
                                                <select class="form-select-2" id="task-id" name="task_id">
                                                    <option>Select</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-12 mb-3">
                                                <label for="end-date">Choose an Equipment Type</label>
                                                <select class="form-select-2" id="equipment-type-id" name="equipment_type_id" >
                                                    <option>Select</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-12 mb-3">
                                                <label for="no-equipment">Number of Equipments Type Required</label>
                                                <input type="number" class="form-control" id="no-equipment"
                                                       placeholder="2" name="no_equipment">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-12 mb-3">
                                                <label for="site-name">Equipment Minimum Loading Capacity e.g 30 tonnes</label>
                                                <div class="input-group">
                                                    <input type="number" class="form-control" id="min-loading-capacity" name="payload_capacity"
                                                           placeholder="3">
                                                    <div class="input-group-prepend">
                                                        <select class="form-control">
                                                            <option>TONNES</option>
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
                                                           placeholder="Username" name="duration">
                                                    <div class="input-group-prepend">
                                                        <select name="duration_unit" class="form-control">
                                                            <option>DAYS</option>
                                                        </select>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-12 mb-3">
                                                <label >Payment Term e.g 3000/day</label>
                                                <div class="input-group">
                                                    <input type="number" class="form-control" id="lease-rates"
                                                           placeholder="Payment term">
                                                    <div class="input-group-prepend">
                                                        <select name="lease_modality" class="form-control">
                                                            <option>DAYS</option>
                                                        </select>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-12 mb-3">
                                                <label>Fuel Provision</label>
                                                <select class="form-select-2" name="fuel_provision">
                                                    <option>Select</option>
                                                    <option value="France">OWNER</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-12 mb-3">
                                                <label for="end-date">CESS Provision</label>
                                                <select class="form-select-2" name="cess_provision">
                                                    <option>Select</option>
                                                    <option value="France">OWNER</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-12 mb-3">
                                                <label for="project-description">Description</label>
                                                <textarea class="form-control" id="project-description"></textarea>
                                            </div>
                                        </div>

                                        <button class="btn btn-primary btn-rounded" type="submit">Save</button>
                                        <a href="#" class="btn btn-gradient-dark btn-rounded text-white" >Next</a>
                                    </form>
                                </div>
                                <div class="col-md-6 border-left">

                                    <div >
                                        <table class="table data-table">
                                            <thead class="thead-light">
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Equipment Type</th>
                                                <th scope="col">Loading Capacity</th>
                                                <th scope="col">Required Number</th>
                                                <th scope="col">Duration Required</th>
                                                <th scope="col">Payment Terms</th>
                                                <th scope="col">Fuel Provision</th>
                                                <th scope="col">CESS Provision</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <th scope="row">1</th>
                                                <td>Equipment Type</td>
                                                <td class="text-wrap">Loading Capacity</td>
                                                <td class="text-wrap">Loading Capacity</td>
                                                <td class="text-wrap">Loading Capacity</td>
                                                <td class="text-wrap">Loading Capacity</td>
                                                <td class="text-wrap">Loading Capacity</td>
                                                <td class="text-wrap">Loading Capacity</td>
                                             </tr>
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
    <!-- Files page  -->
    <script src="{{url("assets/js/mijengo/select2.js")}}"></script>
    <script src="{{url("assets/js/mijengo/datepicker.js")}}"></script>
@endsection
