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


                    <div class="row">

                        <div class="col-xl-10 offset-1">
                            <div class="content-title mt-0">
                                <h4>Projects</h4>
                                <nav>
                                    <ol class="cd-breadcrumb">
                                        <li><a href="{{route("vendor.dashboard")}}" class="text-sm-left">Home</a></li>
                                        <li class="current"><em>Projects</em></li>
                                    </ol>
                                </nav>


                            </div>

                            <div class="d-md-flex justify-content-between mb-4">

                            </div>
                            <div class="table-responsive">
                                <table  class="table table-borderless table-hover data-table-">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Location</th>
                                        <th>Durations</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(!empty($projects))
                                        @foreach($projects as $project)
                                            @if($project->status==1||$project->status==3)
                                                <tr>
                                                    <td class="text-wrap">
                                                        <a href="#l" class="d-flex align-items-center">
                                                            <figure class="avatar avatar-sm mr-3">
                                                              <span class="avatar-title bg-warning text-black-50 rounded-pill">
                                                                <i class="ti-folder"></i>
                                                              </span>
                                                            </figure>
                                                            <span class="d-flex flex-column">
                                                           <span class="text-primary">{{$project->name}}</span>
                                                            <span class="small font-italic ">{{$project->description}}</span>
                                                          </span>
                                                        </a>
                                                    </td>
                                                    <td class="text-wrap">
                                                        <a href="#l" class="d-flex align-items-center">
                                                            <span class="d-flex flex-column">
                                                            <span class="text-primary">{{$project->subCounty->name}}</span>
                                                            <span  class="small font-italic ">{{$project->subCounty->county->name}}</span>
                                                           </span>
                                                        </a>
                                                    </td>
                                                    <td class="text-wrap">
                                                        <a href="#l" class="d-flex align-items-center">
                                                            <span class="d-flex flex-column">
                                                            <span class="text-dark">{{$project->start_date}}  to  {{$project->end_date}} </span>
                                                            <span  class="small font-italic ">{{App\Helpers\GeneralFunctions::getMonths($project->start_date,$project->end_date)}} months</span>
                                                           </span>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        @if($project->status==0)
                                                            <div class="badge badge-info-bright text-info">Draft</div>
                                                        @elseif($project->status==1)
                                                            <div class="badge badge-info text-capitalize">Open(Ongoing Application)</div>
                                                        @elseif($project->status==3)
                                                            <div class="badge bg-info-bright text-info">Closed</div>
                                                        @elseif($project->status==4)
                                                            <div class="badge bg-info-bright text-info">Deleted</div>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{route("vendor.project.equipment.required",$project->id)}}" class="btn btn-dark text-white">Apply Now </a>
                                                    </td>
                                                </tr>

                                            @endif
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
    <!-- modals  -->
    @include("admin.v1.project.modals.edit-project")
    <!-- Files page  -->
    <script src="{{url("assets/js/mijengo/select2.js")}}"></script>
    <script src="{{url("assets/js/mijengo/datepicker.js")}}"></script>
    <script src="{{url("assets/js/mijengo/ajax/project.js")}}"></script>
@endsection
