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

                        <div class="col-xl-8 offset-2">
                            <div class="content-title mt-0">
                                <h4>Create Project</h4>
                                <div class="text-right">
                                    <a href="#" class="btn btn-primary btn-uppercase btn-link text-white">Back</a>
                                </div>
                            </div>
                            <div class="m-15 row mb-5">
                                <div class="col-md-12 text-center">
                                    <a href="#" class="btn btn-primary btn-uppercase btn-lg text-white ">1. Details</a>
                                    <a href="#" class="btn  btn-primary btn-uppercase btn-lg text-white">2. Sites</a>
                                    <a href="#" class="btn btn-apple btn-uppercase btn-lg"><span><span>3. Equipment Required</span></span></a>
                                    <a href="#" class="btn btn-apple btn-uppercase btn-lg"><span><span>4. Material Required</span></span></a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <form class="needs-validation margin-10-p" novalidate>
                                        <div class="content-title mt-0">
                                            <h4>Site Details</h4>
                                        </div>

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
                                        <a hre="#" class="btn btn-primary text-white" >Next</a>
                                    </form>
                                </div>
                                <div class="col-md-6">
                                    <div class="accordion" id="accordionExample">
                                        <div class="card">
                                            <div class="card-header" id="headingOne">
                                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne"
                                                        aria-expanded="true" aria-controls="collapseOne">
                                                    Collapsible Group Item #1
                                                </button>
                                            </div>
                                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                                 data-parent="#accordionExample">
                                                <div class="card-body">...</div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header" id="headingTwo">
                                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                                        data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                    Collapsible Group Item #2
                                                </button>
                                            </div>
                                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                                 data-parent="#accordionExample">
                                                <div class="card-body">...</div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header" id="headingThree">
                                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                                        data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                    Collapsible Group Item #3
                                                </button>
                                            </div>
                                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                                                 data-parent="#accordionExample">
                                                <div class="card-body">...</div>
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
