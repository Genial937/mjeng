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
                    <div class="content-title mt-0">
                        <nav>
                            <ol class="cd-breadcrumb">
                                <li><a href="{{route("admin.dashboard")}}" class="text-sm-left">Home</a></li>
                                <li class="current"><em>Businesses</em></li>
                            </ol>
                        </nav>
                    </div>
                    <div class="row">
                        @include("admin.v1.businesses.includes.nav")
                        <div class="col-xl-8">
                            <div class="content-title mt-0">
                                <h4> Business</h4>
                                <p>Edit a contractor business</p>
                            </div>
                            <form action="{{route("admin.update.vendor.business")}}"
                                  id="edit-vendor-business-form" enctype="multipart/form-data">
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
                                                           value="{{$business->name}}"
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
                                                           value="{{$business->phone}}"
                                                           data-input-mask="phone"
                                                           class="form-control border-input"
                                                           placeholder="(254) 722 222 222">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Contact Email</label>
                                                    <input type="email"
                                                           id="email"
                                                           name="email"
                                                           pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                                                           class="form-control border-input"
                                                           required
                                                           value="{{$business->email}}"
                                                           placeholder="office@email.com">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Business Address</label>
                                                    <input type="text"
                                                           id="address"
                                                           name="address"
                                                           required
                                                           value="{{$business->address}}"
                                                           class="form-control border-input"
                                                           placeholder="e.g One Pandmore Place,13th floor, Kilimani Kenya">
                                                </div>
                                            </div>
                                        </div>
                                        @if($business->status==1||$business->status==3)
                                            <div>
                                                <div class="content-title mt-0">
                                                    <h4> Approve</h4>
                                                    <p>Approve or decline business with application and comment.</p>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Approve this business</label>
                                                            <select id="approve-status" name="status" required
                                                                    class="form-control form-select-2">
                                                                <option value="">Select</option>
                                                                <option @if($business->status==1) selected
                                                                        @endif value="2">Yes
                                                                </option>
                                                                <option @if($business->status==3) selected
                                                                        @endif value="3">No
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Approval Comment</label>
                                                            <textarea class="form-control"
                                                                      name="comment"
                                                                      required
                                                                      placeholder="Everything is okay"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        <button
                                            class="btn btn-primary  btn-uppercase btn-rounded btn-edit-vendor-business ">
                                            Save Changes
                                        </button>
                                        <input type="hidden" name="id" value="{{$business->id}}">
                                    </div>
                                    <div class="col-md-6 ">
                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Registration Document Type</label>
                                                    <select id="business-doc-type" name="doc_type[0]"
                                                            class="form-control form-select-2" required>
                                                        <option value="">Choose business document type</option>
                                                        <option @if($documents[0]->doc_type??""=="ID") selected
                                                                @endif value="ID">National ID
                                                        </option>
                                                        <option @if($documents[0]->doc_type??""=="PASSPORT") selected
                                                                @endif value="PASSPORT">Passport
                                                        </option>
                                                        <option @if($documents[0]->doc_type??""=="CERTIFICATE") selected
                                                                @endif value="CERTIFICATE">Certificate of Registration
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Registration Document No</label>
                                                    <input type="text" name="doc_no[0]"
                                                           id="business-doc-no"
                                                           minlength="3"
                                                           maxlength="20"
                                                           required
                                                           value="{{$documents[0]->doc_no??""}}"
                                                           class="form-control border-input"
                                                           placeholder="e.g. PVT-093929">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Attach Scanned Copy of the Registration Document </label>
                                                    <input type="file" class="form-control-file"
                                                           id="business-doc-url" name="doc_file[0]">
                                                    <div class="mt-4">
                                                        <a href="{{\App\Helpers\UploadFiles::viewDocument($documents[0]->doc_url??"")}}"
                                                           class="btn btn-outline-primary"><i class="ti-files"></i> View
                                                            Uploaded Document</a>
                                                    </div>
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
                                                        <option value="KRA"
                                                                @if($documents[1]->doc_type??""=="KRA") selected @endif >
                                                            KRA CERTIFICATE
                                                        </option>
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
                                                           value="{{$documents[1]->doc_no??""}}"
                                                           class="form-control border-input"
                                                           placeholder="e.g. A09379292P">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Attach Scanned Copy of the Document </label>
                                                    <input type="file" class="form-control-file"
                                                           id="business-doc-url2" name="doc_file[1]">
                                                    <div class="mt-4">
                                                        <a href="{{\App\Helpers\UploadFiles::viewDocument($documents[1]->doc_url??"")}}"
                                                           class="btn btn-outline-primary"><i class="ti-files"></i> View
                                                            Uploaded Document</a>
                                                    </div>
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
