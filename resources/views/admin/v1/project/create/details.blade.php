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
                                <a href="#" class="btn btn-apple btn-uppercase btn-lg"><span><span>2. Sites</span></span></a>
                                <a href="#" class="btn btn-apple btn-uppercase btn-lg"><span><span>3. Equipment Required</span></span></a>
                                <a href="#" class="btn btn-apple btn-uppercase btn-lg"><span><span>4. Material Required</span></span></a>
                            </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8 offset-2">
                                 <form class="needs-validation margin-10-p" novalidate>
                                <div class="form-row">
                                    <div class="col-md-6 mb-3">
                                        <label for="validationCustom01">Choose Contractor</label>
                                        <select class=" form-control form-select-2">
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
                                <div class="form-row">
                                    <div class="col-md-6 mb-3">
                                        <label for="validationCustom03">Project name</label>
                                        <input type="text" class="form-control" id="validationCustom03"
                                               placeholder="City" required>
                                        <div class="invalid-feedback">
                                            Please provide a valid city.
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="validationCustom04">State</label>
                                        <input type="text" class="form-control" id="validationCustom04"
                                               placeholder="State" required>
                                        <div class="invalid-feedback">
                                            Please provide a valid state.
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="validationCustom05">Zip</label>
                                        <input type="text" class="form-control" id="validationCustom05"
                                               placeholder="Zip" required>
                                        <div class="invalid-feedback">
                                            Please provide a valid zip.
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="invalidCheck"
                                               required>
                                        <label class="form-check-label" for="invalidCheck">
                                            Agree to terms and conditions
                                        </label>
                                        <div class="invalid-feedback">
                                            You must agree before submitting.
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-primary" type="submit">Submit form</button>
                            </form>
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
@endsection
