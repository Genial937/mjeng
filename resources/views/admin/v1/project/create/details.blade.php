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
                        <div class="content-title mt-0">
                            <nav>
                                <ol class="cd-breadcrumb">
                                    <li><a href="{{route("admin.dashboard")}}" class="text-sm-left">Home</a></li>
                                    <li class="current"><em>Businesses</em></li>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-xl-12">
                            @include("admin.v1.project.create.includes.form-steps")
                            <form class="needs-validation margin-5-p" novalidate action="{{route("admin.create.project.details")}}" id="create-project-detail-form">
                                <div class="row">
                                    <div class="col-md-4 offset-1">
                                        <div class="content-title mt-0">
                                            <h4>Detail</h4>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6 mb-3">
                                                <label for="validationCustom01">Choose project owner(contractor business)</label>
                                                <select class=" form-control form-select-2" name="business_id">
                                                    <option>Choose contractor business</option>
                                                    @if(!empty($businesses))
                                                        @foreach($businesses as $business)
                                                            <option class="text-capitalize"
                                                                    value="{{$business->id}}">{{$business->name}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6 mb-3">
                                                <label for="project-name">Project name</label>
                                                <input type="text" class="form-control" id="project-name" name="name"
                                                       placeholder="Project name e.g ABC Construction" required>
                                            </div>

                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6 mb-3">
                                                <label for="start-date">Start Date</label>
                                                <input type="text" class="form-control date-picker" id="start-date" name="start_date"
                                                       placeholder="" required>

                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="end-date">End Date</label>
                                                <input type="text" class="form-control date-picker" id="end-date" name="end_date"
                                                       placeholder="" required>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-12 mb-3">
                                                <label for="project-description">Description</label>
                                                <textarea class="form-control" id="project-description" name="description" placeholder="Construction of super Mombasa to Nairobi Dual Carrier. "></textarea>
                                            </div>
                                        </div>
                                        <div class="content-title margin-5-p">
                                            <h4>Project Location</h4>
                                            <p>This county and subcounty the project is situated/located.</p>
                                        </div>
                                        <div class="form-row ">
                                            <div class="col-md-6 mb-3">
                                                <label for="start-date">County</label>
                                                <select class="form-control form-select-2" name="county_id" id="county-id" onchange="getSubcounties()">
                                                    <option>Choose a county</option>
                                                    @if(!empty($counties))
                                                        @foreach($counties as $county)
                                                            <option value="{{$county->id}}">{{$county->name}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="end-date">Sub County</label>
                                                <select class=" form-control form-select-2" name="sub_county_id" id="sub-county-id">
                                                    <option>Select subcounty</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row margin-5-p">
                                            <button class="btn btn-primary  btn-uppercase btn-rounded btn-create-project-details" type="submit">
                                                Save & Continue
                                            </button>
                                        </div>

                                    </div>
                                    <div class="col-md-6">

                                    </div>

                                </div>
                            </form>
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
    <script src="{{url("assets/js/mijengo/ajax/project.js")}}"></script>
@endsection
