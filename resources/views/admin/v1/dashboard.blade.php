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
                    <div class="content-title d-flex justify-content-between">
                        <h4>Quick Summary</h4>
                        <a href="#">View All</a>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between mb-4">
                                        <div>
                                            <i class="font-size-22 ti-folder"></i>
                                        </div>

                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <h5>PROJECTS</h5>
                                        <div class="dropdown">
                                            <a href="#" class="btn btn-floating" data-toggle="dropdown">
                                                <i class="ti-more-alt"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="#" class="dropdown-item" data-sidebar-target="#view-detail">View All</a>
                                                <a href="#" class="dropdown-item">View Published</a>
                                                <a href="#" class="dropdown-item">View Pending</a>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="small text-muted mb-0">1.754 Projects</p>
                                    <p class="small text-muted mb-0">1.754 Published</p>
                                    <p class="small text-muted mb-0">1.754 Pending</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between mb-4">
                                        <div>
                                            <i class="font-size-22 ti-user"></i>
                                        </div>

                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <h5>VENDORS</h5>
                                        <div class="dropdown">
                                            <a href="#" class="btn btn-floating" data-toggle="dropdown">
                                                <i class="ti-more-alt"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="#" class="dropdown-item" data-sidebar-target="#view-detail">View All</a>
                                                <a href="#" class="dropdown-item">View Active</a>
                                                <a href="#" class="dropdown-item">View Inactive</a>

                                            </div>
                                        </div>
                                    </div>
                                    <p class="small text-muted mb-0">3.512 Vendors</p>
                                    <p class="small text-muted mb-0">3.512 Active</p>
                                    <p class="small text-muted mb-0">3.512 Inactive</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between mb-4">
                                        <div>
                                            <i class="font-size-22 ti-user"></i>
                                        </div>

                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <h5>CONTRACTORS</h5>
                                        <div class="dropdown">
                                            <a href="#" class="btn btn-floating" data-toggle="dropdown">
                                                <i class="ti-more-alt"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="#" class="dropdown-item" data-sidebar-target="#view-detail">View Details</a>
                                                <a href="#" class="dropdown-item">Share</a>
                                                <a href="#" class="dropdown-item">Download</a>

                                            </div>
                                        </div>
                                    </div>
                                    <p class="small text-muted mb-0">1.908 Contractors</p>
                                    <p class="small text-muted mb-0">1.908 Active</p>
                                    <p class="small text-muted mb-0">1.908 Inactive</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between mb-4">
                                        <div>
                                            <i class="font-size-22 ti-file"></i>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <h5>INVOICES</h5>
                                        <div class="dropdown">
                                            <a href="#" class="btn btn-floating" data-toggle="dropdown">
                                                <i class="ti-more-alt"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="#" class="dropdown-item" data-sidebar-target="#view-detail">View Details</a>
                                                <a href="#" class="dropdown-item">Share</a>
                                                <a href="#" class="dropdown-item">Download</a>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="small text-muted mb-0">218 Invoices</p>
                                    <p class="small text-muted mb-0">218 invoices pending worth KES 21,800</p>
                                    <p class="small text-muted mb-0">218 invoices paid worth KES 21,800</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="content-title d-flex justify-content-between">
                        <h4>Recent Equipment in the Inventory</h4>
                        <a href="#">View All</a>
                    </div>

                    <div class="mb-4">
                        <div class="table-responsive">
                            <table class="table table-borderless table-hover mb-0">
                                <thead>
                                <tr>
                                    <th>Registration</th>
                                    <th>Type</th>
                                    <th>Make</th>
                                    <th>Model</th>
                                    <th>Vendor</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        <a href="#">
                                            <figure class="avatar avatar-sm mr-2">
                                <span class="avatar-title bg-warning text-black-50 rounded-pill">
                                    <i class="ti-truck"></i>
                                </span>
                                            </figure>
                                            User Research
                                        </a>
                                    </td>
                                    <td>2MB</td>
                                    <td>3/9/19, 2:40PM</td>
                                    <td>
                                        <div class="badge bg-warning-bright text-warning">Project</div>
                                    </td>
                                    <td>
                                        <div class="avatar-group">
                                            <figure class="avatar avatar-sm" title="Lisle Essam"
                                                    data-toggle="tooltip">
                                                <img src="../../assets/media/image/user/women_avatar2.jpg"
                                                     class="rounded-circle"
                                                     alt="image">
                                            </figure>
                                            <figure class="avatar avatar-sm" title="Baxie Roseblade"
                                                    data-toggle="tooltip">
                                                <img src="../../assets/media/image/user/man_avatar5.jpg"
                                                     class="rounded-circle"
                                                     alt="image">
                                            </figure>
                                        </div>
                                    </td>
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a href="#" class="btn btn-floating" data-toggle="dropdown">
                                                <i class="ti-more-alt"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="#" class="dropdown-item" data-sidebar-target="#view-detail">View Details</a>
                                                <a href="#" class="dropdown-item">Share</a>
                                                <a href="#" class="dropdown-item">Download</a>
                                                <a href="#" class="dropdown-item">Copy to</a>
                                                <a href="#" class="dropdown-item">Move to</a>
                                                <a href="#" class="dropdown-item">Rename</a>
                                                <a href="#" class="dropdown-item">Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="#">
                                            <figure class="avatar avatar-sm mr-2">
                                <span class="avatar-title bg-warning text-black-50 rounded-pill">
                                    <i class="ti-folder"></i>
                                </span>
                                            </figure>
                                            Design Thinking Project
                                        </a>
                                    </td>
                                    <td>10MB</td>
                                    <td>3/9/19, 2:40PM</td>
                                    <td>
                                        <div class="badge bg-secondary-bright text-secondary">Software</div>
                                    </td>
                                    <td>
                                    </td>
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a href="#" class="btn btn-floating" data-toggle="dropdown">
                                                <i class="ti-more-alt"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="#" class="dropdown-item" data-sidebar-target="#view-detail">View Details</a>
                                                <a href="#" class="dropdown-item">Share</a>
                                                <a href="#" class="dropdown-item">Download</a>
                                                <a href="#" class="dropdown-item">Copy to</a>
                                                <a href="#" class="dropdown-item">Move to</a>
                                                <a href="#" class="dropdown-item">Rename</a>
                                                <a href="#" class="dropdown-item">Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="#">
                                            <figure class="avatar avatar-sm mr-2">
                                <span class="avatar-title rounded-pill">
                                    <i class="ti-file"></i>
                                </span>
                                            </figure>
                                            Meeting-notes.doc
                                        </a>
                                    </td>
                                    <td>139KB</td>
                                    <td>3/9/19, 2:40PM</td>
                                    <td>
                                        <div class="badge bg-primary-bright text-primary">Public</div>
                                    </td>
                                    <td>
                                        <div class="avatar-group">
                                            <figure class="avatar avatar-sm" title="Lisle Essam"
                                                    data-toggle="tooltip">
                                                <img src="../../assets/media/image/user/women_avatar2.jpg"
                                                     class="rounded-circle"
                                                     alt="image">
                                            </figure>
                                            <figure class="avatar avatar-sm" title="Baxie Roseblade"
                                                    data-toggle="tooltip">
                                                <img src="../../assets/media/image/user/man_avatar5.jpg"
                                                     class="rounded-circle"
                                                     alt="image">
                                            </figure>
                                            <figure class="avatar avatar-sm" title="Mella Mixter"
                                                    data-toggle="tooltip">
                                                <img src="../../assets/media/image/user/women_avatar1.jpg"
                                                     class="rounded-circle"
                                                     alt="image">
                                            </figure>
                                            <figure class="avatar avatar-sm" title="Jo Hugill"
                                                    data-toggle="tooltip">
                                                <img src="../../assets/media/image/user/man_avatar1.jpg"
                                                     class="rounded-circle"
                                                     alt="image">
                                            </figure>
                                            <figure class="avatar avatar-sm" title="Cullie Philcott"
                                                    data-toggle="tooltip">
                                                <img src="../../assets/media/image/user/women_avatar5.jpg"
                                                     class="rounded-circle"
                                                     alt="image">
                                            </figure>
                                            <figure class="avatar avatar-sm" title="" data-toggle="tooltip"
                                                    data-original-title="Cullie Philcott">
                                                <span class="avatar-title bg-primary rounded-circle">+ 5</span>
                                            </figure>
                                        </div>
                                    </td>
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a href="#" class="btn btn-floating" data-toggle="dropdown">
                                                <i class="ti-more-alt"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="#" class="dropdown-item" data-sidebar-target="#view-detail">View Details</a>
                                                <a href="#" class="dropdown-item">Share</a>
                                                <a href="#" class="dropdown-item">Download</a>
                                                <a href="#" class="dropdown-item">Copy to</a>
                                                <a href="#" class="dropdown-item">Move to</a>
                                                <a href="#" class="dropdown-item">Rename</a>
                                                <a href="#" class="dropdown-item">Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="#">
                                            <figure class="avatar avatar-sm mr-2">
                                <span class="avatar-title rounded-pill">
                                    <i class="ti-image"></i>
                                </span>
                                            </figure>
                                            Sitemap.png
                                        </a>
                                    </td>
                                    <td>810KB</td>
                                    <td>3/9/19, 2:40PM</td>
                                    <td>
                                        <div class="badge bg-success-bright text-success">Social Media</div>
                                    </td>
                                    <td>
                                        <div class="avatar-group">
                                            <figure class="avatar avatar-sm" title="Lisle Essam"
                                                    data-toggle="tooltip">
                                                <img src="../../assets/media/image/user/women_avatar2.jpg"
                                                     class="rounded-circle"
                                                     alt="image">
                                            </figure>
                                            <figure class="avatar avatar-sm" title="Baxie Roseblade"
                                                    data-toggle="tooltip">
                                                <img src="../../assets/media/image/user/man_avatar5.jpg"
                                                     class="rounded-circle"
                                                     alt="image">
                                            </figure>
                                            <figure class="avatar avatar-sm" title="Mella Mixter"
                                                    data-toggle="tooltip">
                                                <img src="../../assets/media/image/user/women_avatar1.jpg"
                                                     class="rounded-circle"
                                                     alt="image">
                                            </figure>
                                        </div>
                                    </td>
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a href="#" class="btn btn-floating" data-toggle="dropdown">
                                                <i class="ti-more-alt"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="#" class="dropdown-item" data-sidebar-target="#view-detail">View Details</a>
                                                <a href="#" class="dropdown-item">Share</a>
                                                <a href="#" class="dropdown-item">Download</a>
                                                <a href="#" class="dropdown-item">Copy to</a>
                                                <a href="#" class="dropdown-item">Move to</a>
                                                <a href="#" class="dropdown-item">Rename</a>
                                                <a href="#" class="dropdown-item">Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="#">
                                            <figure class="avatar avatar-sm mr-2">
                                <span class="avatar-title rounded-pill">
                                    <i class="ti-file"></i>
                                </span>
                                            </figure>
                                            Analytics.pdf
                                        </a>
                                    </td>
                                    <td>10KB</td>
                                    <td>3/9/19, 2:40PM</td>
                                    <td>
                                        <div class="badge bg-info-bright text-info">Design</div>
                                    </td>
                                    <td>
                                        <div class="avatar-group">
                                            <figure class="avatar avatar-sm" title="Lisle Essam"
                                                    data-toggle="tooltip">
                                                <img src="../../assets/media/image/user/women_avatar2.jpg"
                                                     class="rounded-circle"
                                                     alt="image">
                                            </figure>
                                            <figure class="avatar avatar-sm" title="Baxie Roseblade"
                                                    data-toggle="tooltip">
                                                <img src="../../assets/media/image/user/man_avatar5.jpg"
                                                     class="rounded-circle"
                                                     alt="image">
                                            </figure>
                                            <figure class="avatar avatar-sm" title="Mella Mixter"
                                                    data-toggle="tooltip">
                                                <img src="../../assets/media/image/user/women_avatar1.jpg"
                                                     class="rounded-circle"
                                                     alt="image">
                                            </figure>
                                            <figure class="avatar avatar-sm" title="Mella Mixter"
                                                    data-toggle="tooltip">
                                                <img src="../../assets/media/image/user/women_avatar4.jpg"
                                                     class="rounded-circle"
                                                     alt="image">
                                            </figure>
                                        </div>
                                    </td>
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a href="#" class="btn btn-floating" data-toggle="dropdown">
                                                <i class="ti-more-alt"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="#" class="dropdown-item" data-sidebar-target="#view-detail">View Details</a>
                                                <a href="#" class="dropdown-item">Share</a>
                                                <a href="#" class="dropdown-item">Download</a>
                                                <a href="#" class="dropdown-item">Copy to</a>
                                                <a href="#" class="dropdown-item">Move to</a>
                                                <a href="#" class="dropdown-item">Rename</a>
                                                <a href="#" class="dropdown-item">Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="content-title d-flex justify-content-between">
                        <h4>Last Activities</h4>
                    </div>

                    <div class="timeline">
                        <div class="timeline-item">
                            <div>
                                <figure class="avatar mr-3">
                                    <span class="avatar-title bg-success rounded-circle">j</span>
                                </figure>
                            </div>
                            <div>
                                <h6 class="d-md-flex justify-content-between mb-3">
                    <span class="d-block">
                        A file of <a href="#" class="link-1">Jonny Richie</a> has been shared.
                    </span>
                                    <span class="text-muted font-weight-normal">4h</span>
                                </h6>
                                <div class="avatar-group">
                                    <figure class="avatar" title="Lisle Essam"
                                            data-toggle="tooltip">
                                        <img src="../../assets/media/image/user/women_avatar2.jpg"
                                             class="rounded-circle"
                                             alt="image">
                                    </figure>
                                    <figure class="avatar" title="Baxie Roseblade"
                                            data-toggle="tooltip">
                                        <img src="../../assets/media/image/user/man_avatar5.jpg"
                                             class="rounded-circle"
                                             alt="image">
                                    </figure>
                                    <figure class="avatar" title="Baxie Roseblade"
                                            data-toggle="tooltip">
                                        <span class="avatar-title bg-secondary rounded-pill">A</span>
                                    </figure>
                                    <figure class="avatar" title="Jo Hugill"
                                            data-toggle="tooltip">
                                        <img src="../../assets/media/image/user/man_avatar1.jpg"
                                             class="rounded-circle"
                                             alt="image">
                                    </figure>
                                    <figure class="avatar" title="Cullie Philcott"
                                            data-toggle="tooltip">
                                        <img src="../../assets/media/image/user/women_avatar5.jpg"
                                             class="rounded-circle"
                                             alt="image">
                                    </figure>
                                    <figure class="avatar" title="Cullie Philcott"
                                            data-toggle="tooltip">
                                        <span class="avatar-title bg-warning rounded-pill">Z</span>
                                    </figure>
                                </div>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div>
                                <figure class="avatar mr-3">
                                    <span class="avatar-title bg-warning rounded-circle">M</span>
                                </figure>
                            </div>
                            <div>
                                <h6 class="d-md-flex justify-content-between mb-3">
                    <span class="d-block">
                        <a href="#" class="link-1">Marc Hugill</a> uploaded new files
                    </span>
                                    <span class="text-muted font-weight-normal">Tue 8:17pm</span>
                                </h6>
                                <div class="card card-body mb-3 d-flex justify-content-between flex-row">
                                    <div>
                                        <a href="#">
                                            <i class="fa fa-file-pdf-o mr-2"></i> test-file-1.pdf
                                        </a>
                                        <span class="ml-3 small">70 KB</span>
                                    </div>
                                    <div>
                                        <a href="#" title="View file">
                                            <i class="ti-eye"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="card card-body mb-3 d-flex justify-content-between flex-row">
                                    <div>
                                        <a href="#">
                                            <i class="fa fa-file-excel-o mr-2"></i> test-file-2.xlsx
                                        </a>
                                        <span class="ml-3 small">17 KB</span>
                                    </div>
                                    <div>
                                        <a href="#" title="View file">
                                            <i class="ti-eye"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="card card-body mb-3 d-flex justify-content-between flex-row">
                                    <div>
                                        <a href="#">
                                            <i class="fa fa-file-text-o mr-2"></i> test-file-3.txt
                                        </a>
                                        <span class="ml-3 small">152 KB</span>
                                    </div>
                                    <div>
                                        <a href="#" title="View file">
                                            <i class="ti-eye"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div>
                                <figure class="avatar mr-3">
                                    <img src="../../assets/media/image/user/women_avatar5.jpg" class="rounded-circle" alt="avatar">
                                </figure>
                            </div>
                            <div>
                                <h6 class="d-md-flex justify-content-between mb-3">
                    <span class="d-block">
                        <a href="#" class="link-1">Cullie Philcott</a> uploaded a picture
                    </span>
                                    <span class="text-muted font-weight-normal">Tue 8:17pm</span>
                                </h6>
                                <div class="row row-xs">
                                    <div class="col-xl-2 col-lg-3 col-md-4 col-sx-6">
                                        <figure>
                                            <img src="../../assets/media/image/portfolio-five.jpg"
                                                 class="w-100 border-radius-1" alt="image">
                                        </figure>
                                    </div>
                                    <div class="col-xl-2 col-lg-3 col-md-4 col-sx-6">
                                        <figure>
                                            <img src="../../assets/media/image/portfolio-one.jpg"
                                                 class="w-100 border-radius-1" alt="image">
                                        </figure>
                                    </div>
                                    <div class="col-xl-2 col-lg-3 col-md-4 col-sx-6">
                                        <figure>
                                            <img src="../../assets/media/image/portfolio-three.jpg"
                                                 class="w-100 border-radius-1" alt="image">
                                        </figure>
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
@endsection
