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
                                <h4>Projects</h4>
                                <div class="text-right">
                                    <a href="{{route("admin.form.create.project.details")}}" class="btn btn-primary btn-uppercase btn-link text-white">Create a project</a>
                                </div>

                            </div>

                            <div class="d-md-flex justify-content-between mb-4">
                                <ul class="list-inline mb-3">
                                    <li class="list-inline-item mb-0">
                                        <a href="#" class="btn btn-outline-light dropdown-toggle" data-toggle="dropdown">
                                            Export
                                        </a>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#">CSV</a>
                                            <a class="dropdown-item" href="#">PDF</a>
                                        </div>
                                    </li>

                                    <li class="list-inline-item mb-0">
                                        <a href="#" class="btn btn-outline-light dropdown-toggle" data-toggle="dropdown">
                                            Sort
                                        </a>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#">Published</a>
                                            <a class="dropdown-item" href="#">Draft</a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="table-responsive">
                                <table id="table-files" class="table table-borderless table-hover">
                                    <thead>
                                    <tr>
                                        <th>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="files-select-all">
                                                <label class="custom-control-label" for="files-select-all"></label>
                                            </div>
                                        </th>
                                        <th>Name</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Status</th>
                                        <th>Contractor</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(!empty($projects))
                                    @foreach($projects as $project)
                                    <tr>
                                        <td></td>
                                        <td>
                                            <a href="#" class="d-flex align-items-center">
                                                <figure class="avatar avatar-sm mr-3">
                                    <span class="avatar-title bg-warning text-black-50 rounded-pill">
                                        <i class="ti-folder"></i>
                                    </span>
                                                </figure>
                                                <span class="d-flex flex-column">
                                    <span class="text-primary">{{$project->name}}</span>

                                </span>
                                            </a>
                                        </td>
                                        <td>{{$project->start_date}}</td>
                                        <td>{{$project->end_date}}</td>
                                        <td>
                                            @if($project->status==0)
                                            <div class="badge bg-info-bright text-info">Draft</div>
                                            @elseif($project->status==1)
                                            <div class="badge bg-info-bright text-info">Published</div>
                                            @elseif($project->status==2)
                                                <div class="badge bg-info-bright text-info">Ongoing</div>
                                            @elseif($project->status==3)
                                                <div class="badge bg-info-bright text-info">Closed</div>
                                            @elseif($project->status==4)
                                                <div class="badge bg-info-bright text-info">Deleted</div>
                                            @endif

                                        </td>
                                        <td>
                                            <div class="avatar-group">
                                                <figure class="avatar avatar-sm" title="{{$project->business->name}}"
                                                        data-toggle="tooltip">
                                                    <img src="{{asset("assets/media/image/user/avatar.png")}}"
                                                         class="rounded-circle"
                                                         alt="image">
                                                    {{$project->business->name}}
                                                </figure>

                                            </div>
                                        </td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a href="#" class="btn btn-floating" data-toggle="dropdown">
                                                    <i class="ti-more-alt"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a href="#" class="dropdown-item" data-sidebar-target="#view-detail">View
                                                        Details</a>
                                                    <a href="{{route("admin.form.create.project.sites",$project->id)}}?action=edit" class="dropdown-item">Project Sites</a>
                                                    <a href="{{route("admin.form.create.project.equipment.required",$project->id)}}?action=edit" class="dropdown-item">Equipment Required</a>
                                                    <a href="{{route("admin.form.create.material.required",$project->id)}}?action=edit" class="dropdown-item">Material Required</a>
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
