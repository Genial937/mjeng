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
                            <div class="row">
                                <div class="col-md-8 offset-2">
                                 <form class="needs-validation margin-10-p" novalidate>
                                     <div class="content-title mt-0">
                                         <h4>Detail</h4>
                                     </div>
                                <div class="form-row">
                                    <div class="col-md-6 mb-3">
                                        <label for="validationCustom01">Choose Contractor</label>
                                        <select class=" form-control form-select-2" name="contractor_id">
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
                                        <label for="project-name">Project name</label>
                                        <input type="text" class="form-control" id="project-name"
                                               placeholder="Project name e.g ABC Contruction" required>
                                        <div class="invalid-feedback">
                                            Please provide a project name.
                                        </div>
                                    </div>

                                </div>
                                     <div class="form-row">
                                     <div class="col-md-6 mb-3">
                                         <label for="start-date">Start Date</label>
                                         <input type="text" class="form-control date-picker" id="start-date"
                                                placeholder="" required>
                                         <div class="invalid-feedback">
                                             Please provide a valid start date.
                                         </div>
                                     </div>
                                     <div class="col-md-6 mb-3">
                                         <label for="end-date">End Date</label>
                                         <input type="text" class="form-control date-picker" id="end-date"
                                                placeholder="" required>
                                         <div class="invalid-feedback">
                                             Please provide a valid end date.
                                         </div>
                                     </div>
                                     </div>
                                     <div class="form-row">
                                         <div class="col-md-12 mb-3">
                                             <label for="project-description">Description</label>
                                             <textarea class="form-control" id="project-description"></textarea>
                                         </div>
                                     </div>
                                     <div class="content-title mt-0">
                                         <h4>Project Location</h4>
                                     </div>
                                     <div class="form-row margin-5-p">
                                         <div class="col-md-6 mb-3">
                                             <label for="start-date">County</label>
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
                                         <div class="col-md-6 mb-3">
                                             <label for="end-date">Sub County</label>
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
                                     <div class="form-row margin-5-p">
                                <button class="btn btn-primary  btn-uppercase btn-rounded" type="submit">Save & Continue</button>
                                     </div>
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
    <script src="{{url("assets/js/mijengo/datepicker.js")}}"></script>
@endsection
