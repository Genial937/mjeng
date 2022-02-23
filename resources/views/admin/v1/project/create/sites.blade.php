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
                        <div class="col-xl-12">
                            @include("admin.v1.project.create.includes.form-steps")
                            <div class="row margin-5-p">
                                <div class="col-md-3 offset-1">
                                    <div class="content-title mt-0">
                                        <h4>Project Sites</h4>
                                    </div>
                                    <form class="margin-10-p" id="create-project-site-form"
                                          action="{{route("admin.create.sites.details")}}">
                                        <div class="form-row">
                                            <div class="col-md-12 mb-3">
                                                <label for="site-name">Site name</label>
                                                <input type="text" class="form-control" id="site-name" name="name"
                                                       placeholder="Site name e.g Mombasa-Syokimau Extension" required>
                                            </div>

                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-12 mb-3">
                                                <label for="project-description">Description</label>
                                                <textarea class="form-control" id="site-description"
                                                          name="description" required placeholder="Construction of Athi River Bridge "></textarea>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-12 mb-3">
                                                <label for="end-date">Choose a task e.g excavating</label>
                                                <select class="form-select-2" multiple name="tasks[]" required id="site-task">
                                                    @if(!empty($tasks))
                                                        @foreach($tasks as $task)
                                                            <option class="text-capitalize"
                                                                    value="{{$task->id}}">{{$task->name}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <input type="hidden" name="project_id" value="{{Request::segment(5)}}" >
                                        <button class="btn btn-primary btn-rounded  btn-create-project-site" type="submit">
                                            Save
                                        </button>
                                        <a href="{{route("admin.form.create.project.equipment.required",Request::segment(5))}}" class="btn btn-gradient-dark btn-rounded text-white">Next</a>
                                    </form>
                                </div>
                                <div class="col-md-6 border-left">
                                    <div>
                                        <table class="table data-table">
                                            <thead class="thead-light">
                                            <tr>
                                                <th scope="col">Name</th>
                                                <th scope="col">Description</th>
                                                <th scope="col">Tasks</th>
                                                <th scope="col">Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if(!empty($sites))
                                                @foreach($sites as $site)
                                                    <tr>
                                                        <td>{{$site->name}}</td>
                                                        <td class="text-wrap">{{$site->description}}</td>
                                                        <td class="text-wrap">@if(isset($site->tasks)) @foreach($site->tasks as $task) <label class="badge badge-primary">{{$task->name}}</label> @endforeach @endif</td>
                                                        <td class="text-left">
                                                            <div class="dropdown">
                                                                <a href="#" class="btn btn-floating" data-toggle="dropdown">
                                                                    <i class="ti-more-alt"></i>
                                                                </a>
                                                                <div class="dropdown-menu dropdown-menu-right">
                                                                    <a href="#" class="dropdown-item" onclick="editProjectSites('{{json_encode($site)}}')">Edit</a>
                                                                    <a href="#" class="dropdown-item" onclick="deleteProjectSite('{{route("admin.delete.project.site",$site->id)}}')">Delete</a>
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
    <!-- modals  -->
    @include("admin.v1.project.modals.edit-site")
    <!-- Files page  -->
    <script src="{{url("assets/js/mijengo/select2.js")}}"></script>
    <script src="{{url("assets/js/mijengo/datepicker.js")}}"></script>
    <script src="{{url("assets/js/mijengo/ajax/project.js")}}"></script>
@endsection
