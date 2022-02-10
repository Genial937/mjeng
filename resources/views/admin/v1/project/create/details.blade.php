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

                            <div id="wizard2">
                                <h3>Project Details</h3>
                                <section class="card card-body border mb-0">
                                    <form id="form1">
                                        <div class="form-group wd-xs-300">
                                            <label>First name</label>
                                            <input type="text" class="form-control" placeholder="First name" required>
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                        </div><!-- form-group -->
                                        <div class="form-group wd-xs-300">
                                            <label>Last name</label>
                                            <input type="text" class="form-control" name="lastname"
                                                   placeholder="Enter lastname"
                                                   required>
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                        </div><!-- form-group -->
                                    </form>
                                </section>
                                <h3>Billing Information</h3>
                                <section class="card card-body border mb-0">
                                    <h5>Billing Information</h5>

                                </section>
                                <h3>Payment Details</h3>
                                <section class="card card-body border mb-0">
                                    <h5>Payment Details</h5>
                                   
                                </section>
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
@endsection
