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
                        <h2>Counties</h2>
                        <a href="#" class="files-toggler">
                            <i class="ti-menu"></i>
                        </a>
                    </div>
                    <div class="row">
                        @include("admin.v1.config.includes.nav")
                        <div class="col-xl-8">
                            <div class="content-title mt-0">
                                <h4>Add a County</h4>
                            </div>
                            <div class="row">
                                <div class="col-md-4 margin-10-b">
                                    <form action="{{route("admin.create.county")}}" id="create-county-form">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>County Name</label>
                                                    <input type="text" name="name" id="county-name"
                                                           minlength="3"
                                                           maxlength="20"
                                                           required
                                                           class="form-control border-input"
                                                           placeholder="e.g Nairobi">
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary  btn-uppercase btn-rounded btn-create-county ">
                                            Save Changes
                                        </button>
                                    </form>
                                </div>
                                <div class="col-md-8">
                                    <p>All counties</p>
                                    <table class="table data-table">
                                        <thead class="thead-light">
                                        <tr>
                                            <th>County</th>
                                            <th>SubCounty</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(!empty($counties))
                                            @foreach($counties as $county)
                                                <tr>
                                                    <td>{{$county->name}}</td>
                                                    <td>{{count($county->subcounties)}} </td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <a href="#" class="btn btn-floating" data-toggle="dropdown">
                                                                <i class="ti-more-alt"></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a href="javascript:void(0)"
                                                                   onclick="editCounty('{{$county->id}}','{{$county->name}}','{{route('admin.edit.county')}}')"
                                                                   class="dropdown-item">Edit</a>
                                                                <a href="javascript:void(0)" class="dropdown-item">Delete</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
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
    <!-- App scripts -->
    <script src="{{url("assets/js/mijengo/select2.js")}}"></script>
    <script src="{{url("assets/js/mijengo/tagsinput.js")}}"></script>
    <script src="{{url("assets/js/mijengo/ajax/config.js")}}"></script>
@endsection
