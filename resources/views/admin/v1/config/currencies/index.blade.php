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
                        <h2>Currencies</h2>
                        <a href="#" class="files-toggler">
                            <i class="ti-menu"></i>
                        </a>
                    </div>
                    <div class="row">
                        @include("admin.v1.config.includes.nav")
                        <div class="col-xl-8">
                            <div class="content-title mt-0">
                                <h4>Add a Currency</h4>
                            </div>
                            <div class="row">
                                <div class="col-md-4 margin-10-b">
                                    <form action="{{route("admin.create.currency")}}" id="create-currency-form">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Currency Name</label>
                                                    <input type="text" name="name" id="currency-name"
                                                           minlength="3"
                                                           maxlength="20"
                                                           required
                                                           class="form-control border-input"
                                                           placeholder="e.g Kenya Shilling">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Currency Symbol</label>
                                                    <input type="text" name="symbol" id="currency-symbol"
                                                           minlength="1"
                                                           maxlength="20"
                                                           required
                                                           class="form-control border-input"
                                                           placeholder="e.g KES">
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary  btn-uppercase btn-rounded btn-create-currency">
                                            Save Changes
                                        </button>
                                    </form>
                                </div>
                                <div class="col-md-8">
                                    <p>All Currencies</p>
                                    <table class="table data-table">
                                        <thead class="thead-light">
                                        <tr>
                                            <th>Name</th>
                                            <th>Symbol</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(!empty($currencies))
                                            @foreach($currencies as $currency)
                                                <tr>
                                                    <td>{{$currency->name}}</td>
                                                    <td>{{$currency->symbol}} </td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <a href="#" class="btn btn-floating" data-toggle="dropdown">
                                                                <i class="ti-more-alt"></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a href="javascript:void(0)"
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
