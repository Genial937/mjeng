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
                    <div class="page-header d-flex justify-content-between">
                        <a href="#" class="files-toggler">
                            <i class="ti-menu"></i>
                        </a>
                    </div>
                    <div class=" mt-0">

                        <nav>
                            <ol class="cd-breadcrumb">
                                <li><a href="{{route("admin.dashboard")}}" class="text-sm-left">Home</a></li>
                                <li class="current"><em>Businesses</em></li>
                            </ol>
                        </nav>

                    </div>
                    <div class="row">
                        @include("vendor.v1.businesses.includes.nav")
                        <div class="col-xl-8">
                            <div class="content-title mt-0">
                                <h4> Business Details</h4>
                            </div>
                            <form action="{{route("vendor.create.business")}}"
                                  id="create-vendor-business-form" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 margin-10-b">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Business Type</label>
                                                    <select id="business-type" name="type" required
                                                            class="form-control form-select-2">
                                                        <option value="">Choose business type</option>
                                                        <option value="SOLE_PROPRIETOR">Sole Proprietor</option>
                                                        <option value="PARTNERSHIP">Partnership</option>
                                                        <option value="COMPANY">Company</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Business Name</label>
                                                    <input type="text" name="name" id="business-name"
                                                           minlength="3"
                                                           maxlength="20"
                                                           required
                                                           class="form-control border-input"
                                                           placeholder="e.g. HW Engineers">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Contact Phone</label>
                                                    <input type="tel" name="phone" id="phone"
                                                           minlength="9"
                                                           maxlength="10"
                                                           required
                                                           data-input-mask="phone"
                                                           class="form-control border-input"
                                                           placeholder="(254) 722 222 222">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Contact Email</label>
                                                    <input type="email" id="email" name="email"
                                                           pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                                                           class="form-control border-input" required
                                                           placeholder="office@email.com">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Business Address</label>
                                                    <input type="text" id="address" name="address" required
                                                           class="form-control border-input"
                                                           placeholder="e.g One Pandmore Place,13th floor, Kilimani Kenya">
                                                </div>
                                            </div>
                                        </div>
                                        <button
                                            class="btn btn-primary  btn-uppercase btn-rounded btn-create-vendor-business ">
                                            Save Changes
                                        </button>
                                        <input type="hidden" name="user_id" value="{{auth()->id()}}">

                                    </div>
                                    <div class="col-md-6 ">

                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Registration Document Type</label>
                                                    <select id="business-doc-type" name="doc_type[0]"
                                                            class="form-control form-select-2" required>
                                                        <option value="">Choose business document type</option>
                                                        <option value="ID">National ID</option>
                                                        <option value="PASSPORT">Passport</option>
                                                        <option value="CERTIFICATE">Certificate of Registration</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Registration Document No</label>
                                                    <input type="text" name="doc_no[0]" id="business-doc-no"
                                                           minlength="3"
                                                           maxlength="20"
                                                           required
                                                           class="form-control border-input"
                                                           placeholder="e.g. PVT-093929">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Attach Scanned Copy of the Registration Document </label>
                                                    <input type="file" class="form-control-file" required
                                                           id="business-doc-url" name="doc_file[0]">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Document Type</label>
                                                    <select id="business-doc-type1" name="doc_type[1]" required
                                                            class="form-control form-select-2">
                                                        <option disabled value="">Choose business document type</option>
                                                        <option value="KRA" selected>KRA CERTIFICATE</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>KRA Document Number</label>
                                                    <input type="text" name="doc_no[1]" id="business-doc-no1"
                                                           minlength="3"
                                                           maxlength="20"
                                                           required
                                                           class="form-control border-input"
                                                           placeholder="e.g. A09379292P">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Attach Scanned Copy of the Document </label>
                                                    <input type="file" class="form-control-file" required
                                                           id="business-doc-url2" name="doc_file[1]">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- ./ Content -->

                <!-- Footer -->
            @include('vendor.v1.includes.footer')
            <!-- ./ Footer -->
            </div>
            <!-- ./ Content body -->


        </div>
        <!-- ./ Content wrapper -->
    </div>
    <!-- App scripts -->
    <script src="{{url("assets/js/mijengo/select2.js")}}"></script>
    <script src="{{url("assets/js/mijengo/ajax/business.js")}}"></script>
@endsection
