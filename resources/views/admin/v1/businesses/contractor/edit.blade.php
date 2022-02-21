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
                    <div class="page-header d-flex justify-content-between">
                        <a href="#" class="files-toggler">
                            <i class="ti-menu"></i>
                        </a>
                    </div>
                    <div class="row">
                        @include("admin.v1.businesses.includes.nav")
                        <div class="col-xl-8">
                            <div class="content-title mt-0">
                                <h4> Business</h4>
                                <p>Edit a contractor business</p>
                            </div>
                            <form action="{{route("admin.update.business.contractor")}}"
                                  id="update-contractor-business-form">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 margin-10-b">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Business Type</label>
                                                    <select id="business-type" name="type"
                                                            class="form-control form-select-2">
                                                        <option value="">Choose business type</option>
                                                        <option @if($business->type=="SOLE_PROPRIETOR") selected
                                                                @endif value="SOLE_PROPRIETOR">Sole Proprietor
                                                        </option>
                                                        <option @if($business->type=="PARTNERSHIP") selected
                                                                @endif value="PARTNERSHIP">Partnership
                                                        </option>
                                                        <option @if($business->type=="COMPANY") selected
                                                                @endif value="COMPANY">Company
                                                        </option>
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
                                                           value="{{$business->name}}"
                                                           class="form-control border-input"
                                                           placeholder="e.g. China WUYI">
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
                                                           value="{{$business->phone}}"

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
                                                           class="form-control border-input"
                                                           value="{{$business->email}}"
                                                           placeholder="office@email.com">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Business Address</label>
                                                    <input type="text" id="address" name="address"
                                                           value="{{$business->address}}"
                                                           class="form-control border-input"
                                                           placeholder="e.g One Pandmore Place,13th floor, Kilimani Kenya">
                                                </div>
                                            </div>
                                        </div>
                                        <button
                                            class="btn btn-primary  btn-uppercase btn-rounded btn-update-contractor-business ">
                                            Save Changes
                                        </button>
                                        <input type="hidden" name="id" value="{{$business->id}}">

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
    <!-- App scripts -->
    <script src="{{url("assets/js/mijengo/select2.js")}}"></script>
    <script src="{{url("assets/js/mijengo/ajax/business.js")}}"></script>
@endsection
