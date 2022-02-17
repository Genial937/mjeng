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
                                <h4>Users</h4>
                                <div class="text-right">
                                    <a href="{{route("admin.create.user")}}" class="btn btn-primary btn-uppercase btn-link text-white">Create a User</a>
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
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Roles</th>
                                        <th>User type</th>
                                        <th>Date Created</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($users)
                                        @foreach($users as $user)
                                            <tr>
                                                <td>#</td>
                                                <td class="sorting_1">
                                                    <a href="#">
                                                        <figure class="avatar avatar-sm mr-2">
                                                            <span class="avatar-title @if($user->id%2) bg-success @else bg-warning @endif rounded-circle">{{$user->firstname[0]}}</span>
                                                        </figure>
                                                        {{$user->firstname}}
                                                    </a>
                                                </td>
                                                <td>{{$user->email??"_"}}</td>
                                                <td>{{$user->phone??"_"}}</td>
                                                <td>
                                                    @if(count($user->roles)>0)
                                                        @foreach($user->roles as $role)
                                                            <span  class="label label-info">{{$role->display_name}}  </span>
                                                @endforeach
                                                @endif
                                                <td>{{$user->user_type}}</td>
                                                <td>{{\Carbon\Carbon::parse($user->created_at)->diffForHumans()}}</td>
                                                <td class="text-right">
                                                    <div class="dropdown">
                                                        <a href="#" class="btn btn-floating" data-toggle="dropdown">
                                                            <i class="ti-more-alt"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a href="{{route("admin.edit.user",$user->id)}}" class="dropdown-item">View Details</a>
                                                            <a href="{{route("admin.edit.user",$user->id)}}" class="dropdown-item">Update</a>
                                                            <a href="#" class="dropdown-item">Delete</a>
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


