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
                            <div class="content-title mt-0">
                                <a href="" class="btn btn-outline-secondary btn-uppercase">
                                    <i class="ti-arrow-left mr-2"></i> Back
                                </a>
                            </div>
                            @include("admin.v1.project.create.includes.form-steps")
                            <div class="row margin-5-p">
                                <div class="col-md-8 offset-2">
                                    <div class="content-title mt-0">
                                        <h4>Site Equipment Required</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2"></div>
                                <div class="col-md-4">
                                    <h4>Add an Equipment Required</h4>
                                    <form class="needs-validation margin-10-p" novalidate>
                                        <div class="form-row">
                                            <div class="col-md-12 mb-3">
                                                <label for="end-date">Choose a Site</label>
                                                <select class="form-select-2" >
                                                    <option>Select</option>
                                                    <option value="France">Site A</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-12 mb-3">
                                                <label for="end-date">Choose a Task</label>
                                                <select class="form-select-2" >
                                                    <option>Select</option>
                                                    <option value="France">Transporting</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-12 mb-3">
                                                <label for="end-date">Choose an Equipment Type</label>
                                                <select class="form-select-2" >
                                                    <option>Select</option>
                                                    <option value="France">Tipper</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-12 mb-3">
                                                <label for="site-name">Equipment Minimum Loading Capacity </label>
                                                <input type="text" class="form-control" id="site-name"
                                                       placeholder="Site name e.g Mombasa-Syokimau Extension" required>
                                                <div class="invalid-feedback">
                                                    Please provide a Loading  Capacity.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-12 mb-3">
                                                <label for="site-name">Number of Equipments Type Required</label>
                                                <input type="text" class="form-control" id="site-name"
                                                       placeholder="Site name e.g Mombasa-Syokimau Extension" required>
                                                <div class="invalid-feedback">
                                                    Please provide a Loading  Capacity.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-12 mb-3">
                                                <label for="site-name">Duration the Equipments Type is Required</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="validationCustomUsername"
                                                           placeholder="Username" aria-describedby="inputGroupPrepend"
                                                           required="">
                                                    <div class="invalid-feedback">
                                                        Please choose a username.
                                                    </div>
                                                    <div class="input-group-prepend">
                                                        <select class="form-control">
                                                            <option>DAYS</option>
                                                        </select>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-12 mb-3">
                                                <label for="site-name">Payment Term</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="validationCustomUsername"
                                                           placeholder="Username" aria-describedby="inputGroupPrepend"
                                                           required="">
                                                    <div class="invalid-feedback">
                                                        Please choose a username.
                                                    </div>
                                                    <div class="input-group-prepend">
                                                        <select class="form-control">
                                                            <option>DAYS</option>
                                                        </select>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-12 mb-3">
                                                <label for="end-date">Fuel Provision</label>
                                                <select class="form-select-2" >
                                                    <option>Select</option>
                                                    <option value="France">OWNER</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-12 mb-3">
                                                <label for="end-date">CESS Provision</label>
                                                <select class="form-select-2" >
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

                                        <button class="btn btn-primary" type="submit">Save</button>
                                        <a href="#" class="btn btn-info text-white" >Next</a>
                                    </form>
                                </div>
                                <div class="col-md-4 border-left">
                                    <h4>Equipment Required Added</h4>
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
