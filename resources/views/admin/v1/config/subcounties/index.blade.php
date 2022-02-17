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
                        <h2>SubCounties</h2>
                        <a href="#" class="files-toggler">
                            <i class="ti-menu"></i>
                        </a>
                    </div>
                    <div class="row">
                        @include("admin.v1.config.includes.nav")
                        <div class="col-xl-8">
                            <div class="content-title mt-0">
                                <h4>Add a SubCounty</h4>
                            </div>
                                    <div class="row">
                                        <div class="col-md-4 margin-10-b">
                                            <form action="{{route("admin.create.subcounty")}}" id="create-subcounty-form" >
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>County</label>
                                                            <select id="county-id" name="county_id" class="form-control form-select-2" required>
                                                                <option value="">Choose a County</option>
                                                                @if(!empty($counties))
                                                                    @foreach($counties as $county)
                                                                        <option  value="{{$county->id}}">{{$county->name}}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Add Multiple SubCounties </label>
                                                            <input type="text" class="form-control tagsinput" id="subcounties " name="subcounties[]" >
                                                            <p class="text-sm-left">Please each subcounty you type hit enter.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button class="btn btn-primary  btn-uppercase btn-rounded btn-create-subcounty">Save</button>
                                            </form>
                                        </div>
                                        <div class="col-md-8 border-left">
                                            <p class="text-capitalize">All SubCounties.</p>
                                            <div >
                                                <table class="table data-table" >
                                                    <thead class="thead-light">
                                                    <tr>
                                                        <th scope="col">Subcounty</th>
                                                        <th scope="col">County</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @if(!empty($subcounties))
                                                        @foreach($subcounties as $subcounty)
                                                            <tr>
                                                                <td>{{$subcounty->name}}</td>
                                                                <td>{{$subcounty->county->name}}
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
