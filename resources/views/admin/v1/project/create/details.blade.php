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

                        <div class="col-xl-10 offset-1">
                            <div class="content-title mt-0">
                                <h4>Create Project</h4>
                                <div class="text-right">
                                    <a href="#" class="btn btn-primary btn-uppercase btn-link text-white">Back</a>
                                </div>
                            </div>

                            <div id="wizard2">
                                <h3>Personal Information</h3>
                                <section class="card card-body border mb-0">
                                    <h5>Personal Information</h5>
                                    <p>Try the keyboard navigation by clicking arrow left or right!</p>
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
                                    <p>Wonderful transition effects.</p>
                                    <form id="form2">
                                        <div class="form-group wd-xs-300">
                                            <label class="form-control-label">Email: <span
                                                    class="tx-danger">*</span></label>
                                            <input id="email" class="form-control" name="email"
                                                   placeholder="Enter email address"
                                                   type="email" required>
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                        </div><!-- form-group -->
                                    </form>
                                </section>
                                <h3>Payment Details</h3>
                                <section class="card card-body border mb-0">
                                    <h5>Payment Details</h5>
                                    <p>The next and previous buttons help you to navigate through your content.</p>
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
