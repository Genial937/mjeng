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
                                <h4>Create Project</h4>
                            </div>
                            @include("admin.v1.project.create.includes.form-steps")
                            <div class="row margin-5-p">
                                <div class="col-md-8 offset-2">
                                    <div class="content-title mt-0">
                                        <h4>Project Sites</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2"></div>
                                <div class="col-md-4">
                                    <h4>Add New Sites</h4>
                                    <form class="needs-validation margin-10-p" novalidate>
                                        <div class="form-row">
                                            <div class="col-md-12 mb-3">
                                                <label for="site-name">Site name</label>
                                                <input type="text" class="form-control" id="site-name"
                                                       placeholder="Site name e.g Mombasa-Syokimau Extension" required>
                                                <div class="invalid-feedback">
                                                    Please provide a site name.
                                                </div>
                                            </div>

                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-12 mb-3">
                                                <label for="project-description">Description</label>
                                                <textarea class="form-control" id="project-description"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-12 mb-3">
                                                <label for="end-date">Choose an activities happening at this site e.g excavation</label>
                                                <select class="form-select-2" multiple>
                                                    <option>Select</option>
                                                    <option value="France">France</option>
                                                    <option value="Brazil">Brazil</option>
                                                    <option value="Yemen">Yemen</option>
                                                    <option value="United States">United States</option>
                                                    <option value="China">China</option>
                                                    <option value="Argentina">Argentina</option>
                                                    <option value="Bulgaria">Bulgaria</option>
                                                </select>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary" type="submit">Save</button>
                                        <a href="#" class="btn btn-light-info text-white" >Next</a>
                                    </form>
                                </div>
                                <div class="col-md-4 border-left">
                                    <h4>Sites Added</h4>
                                    <div >
                                        <table class="table data-table">
                                            <thead class="thead-light">
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Site</th>
                                                <th scope="col">Description</th>
                                                <th scope="col">Task</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <th scope="row">1</th>
                                                <td>Site A</td>
                                                <td class="text-wrap">Construction of bridge along Mombasa-Syokimau Rd</td>
                                                <td class="text-wrap"><span class="badge badge-warning">Excavating</span><span class="badge badge-warning">Transporting</span></td>
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
