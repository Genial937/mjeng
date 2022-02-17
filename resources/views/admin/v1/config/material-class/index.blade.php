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
                        <h2>Material Classification</h2>
                        <a href="#" class="files-toggler">
                            <i class="ti-menu"></i>
                        </a>
                    </div>
                    <div class="row">
                        @include("admin.v1.config.includes.nav")
                        <div class="col-xl-8">
                            <div class="content-title mt-0">
                                <h4>Add a Material Class</h4>
                            </div>
                            <div class="row">
                                <div class="col-md-4 margin-10-b">
                                    <form action="{{route("admin.create.material.class")}}" id="create-material-class-form">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Material Type</label>
                                                    <select id="material-type-id" name="material_type_id" class="form-control form-select-2">
                                                        <option value="null">Choose material type</option>
                                                        @if(!empty($material_types))
                                                            @foreach($material_types as $material_type)
                                                                <option  value="{{$material_type->id}}">{{$material_type->name}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Classification Name</label>
                                                    <input type="text" name="name" id="class-name"
                                                           minlength="3"
                                                           maxlength="20"
                                                           required
                                                           class="form-control border-input"
                                                           placeholder="e.g Fine Sand(0.075 to 0.425mm)">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Classification Description</label>
                                                    <textarea  name="description" id="material-type-description"
                                                               minlength="3"
                                                               maxlength="200"
                                                               required
                                                               class="form-control border-input"
                                                               placeholder="e.g obtained from river streams and banks."></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary  btn-uppercase btn-rounded btn-create-material-class">
                                            Save Changes
                                        </button>
                                    </form>
                                </div>
                                <div class="col-md-8">
                                    <p>All Material Classes</p>
                                    <table class="table data-table">
                                        <thead class="thead-light">
                                        <tr>
                                            <th>Classification</th>
                                            <th>Material Type</th>
                                            <th>Description</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(!empty($material_classes))
                                            @foreach($material_classes as $material_class)
                                                <tr>
                                                    <td>{{$material_class->name}}</td>
                                                    <td>{{($material_class->materialType->name)}} </td>
                                                    <td>{{($material_class->description)}} </td>
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
