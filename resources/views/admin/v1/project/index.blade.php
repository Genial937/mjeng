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
                                    <a href="" class="btn btn-primary btn-uppercase btn-link text-white">Create a project</a>
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
                                <div id="file-actions" class="d-none">
                                    <ul class="list-inline">
                                        <li class="list-inline-item mb-0">
                                            <a href="#" class="btn btn-outline-light" data-toggle="tooltip" title="Move">
                                                <i class="ti-arrow-top-right"></i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item mb-0">
                                            <a href="#" class="btn btn-outline-light" data-toggle="tooltip" title="Download">
                                                <i class="ti-download"></i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item mb-0">
                                            <a href="#" class="btn btn-outline-danger" data-toggle="tooltip" title="Delete">
                                                <i class="ti-trash"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
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
                                        <th>End Date</th>
                                        <th>Label</th>
                                        <th>Contractor</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
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
                                    <span class="text-primary">Design Thinking Project</span>
                                    <span class="small font-italic">550 KB</span>
                                </span>
                                            </a>
                                        </td>
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
                                        <td></td>
                                        <td>
                                            <a href="#" class="d-flex align-items-center">
                                                <figure class="avatar avatar-sm mr-3">
                                    <span class="avatar-title bg-warning text-black-50 rounded-pill">
                                        <i class="ti-folder"></i>
                                    </span>
                                                </figure>
                                                <span class="d-flex flex-column">
                                    <span class="text-primary">User Research</span>
                                    <span class="small font-italic">250 KB</span>
                                </span>
                                            </a>
                                        </td>
                                        <td>3/9/19, 2:40PM</td>
                                        <td>
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
                                                    <a href="#" class="dropdown-item" data-sidebar-target="#view-detail">View
                                                        Details</a>
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
                                        <td></td>
                                        <td>
                                            <a href="#" class="d-flex align-items-center">
                                                <figure class="avatar avatar-sm mr-3">
                                    <span class="avatar-title bg-warning text-black-50 rounded-pill">
                                        <i class="ti-folder"></i>
                                    </span>
                                                </figure>
                                                <span class="d-flex flex-column">
                                    <span class="text-primary">Important Documents</span>
                                    <span class="small font-italic">590 KB</span>
                                </span>
                                            </a>
                                        </td>
                                        <td>3/9/19, 2:40PM</td>
                                        <td>
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
                                                    <a href="#" class="dropdown-item" data-sidebar-target="#view-detail">View
                                                        Details</a>
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
                                        <td></td>
                                        <td>
                                            <a href="#" class="d-flex align-items-center">
                                                <figure class="avatar avatar-sm mr-3">
                                    <span class="avatar-title rounded-pill">
                                        <i class="ti-file"></i>
                                    </span>
                                                </figure>
                                                <span class="d-flex flex-column">
                                    <span class="text-primary">Meeting-notes.doc</span>
                                    <span class="small font-italic">139KB</span>
                                </span>
                                            </a>
                                        </td>
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
                                                    <a href="#" class="dropdown-item" data-sidebar-target="#view-detail">View
                                                        Details</a>
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
                                        <td></td>
                                        <td>
                                            <a href="#" class="d-flex align-items-center">
                                                <figure class="avatar avatar-sm mr-3">
                                            <span class="avatar-title rounded-pill">
                                                <i class="ti-file"></i>
                                            </span>
                                                </figure>
                                                <span class="d-flex flex-column">
                                    <span class="text-primary">composer.json</span>
                                    <span class="small font-italic">55 KB</span>
                                </span>
                                            </a>
                                        </td>
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
                                                    <a href="#" class="dropdown-item" data-sidebar-target="#view-detail">View
                                                        Details</a>
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
                                        <td></td>
                                        <td>
                                            <a href="#" class="d-flex align-items-center">
                                                <figure class="avatar avatar-sm mr-3">
                                            <span class="avatar-title rounded-pill">
                                                <i class="ti-folder"></i>
                                            </span>
                                                </figure>
                                                <span class="d-flex flex-column">
                                    <span class="text-primary">error_log.txt</span>
                                    <span class="small font-italic">2MB</span>
                                </span>
                                            </a>
                                        </td>
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
                                                    <a href="#" class="dropdown-item" data-sidebar-target="#view-detail">View
                                                        Details</a>
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
                                        <td></td>
                                        <td>
                                            <a href="#" class="d-flex align-items-center">
                                                <figure class="avatar avatar-sm mr-3">
                                            <span class="avatar-title rounded-pill">
                                                <i class="ti-folder"></i>
                                            </span>
                                                </figure>
                                                <span class="d-flex flex-column">
                                    <span class="text-primary">package.json</span>
                                    <span class="small font-italic">5 KB</span>
                                </span>
                                            </a>
                                        </td>
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
                                                    <a href="#" class="dropdown-item" data-sidebar-target="#view-detail">View
                                                        Details</a>
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
                                        <td></td>
                                        <td>
                                            <a href="#" class="d-flex align-items-center">
                                                <figure class="avatar avatar-sm mr-3">
                                            <span class="avatar-title rounded-pill">
                                                <i class="ti-image"></i>
                                            </span>
                                                </figure>
                                                <span class="d-flex flex-column">
                                            <span class="text-primary">Sitemap.png</span>
                                            <span class="small font-italic">810KB</span>
                                        </span>
                                            </a>
                                        </td>
                                        <td>3/9/19, 2:40PM</td>
                                        <td>
                                            <div class="badge bg-success-bright text-success">Social Media</div>
                                        </td>
                                        <td>
                                        </td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a href="#" class="btn btn-floating" data-toggle="dropdown">
                                                    <i class="ti-more-alt"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a href="#" class="dropdown-item" data-sidebar-target="#view-detail">View
                                                        Details</a>
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
                                        <td></td>
                                        <td>
                                            <a href="#" class="d-flex align-items-center">
                                                <figure class="avatar avatar-sm mr-3">
                                            <span class="avatar-title rounded-pill">
                                                <i class="ti-file"></i>
                                            </span>
                                                </figure>
                                                <span class="d-flex flex-column">
                                            <span class="text-primary">Analytics.pdf</span>
                                            <span class="small font-italic">10KB</span>
                                        </span>
                                            </a>
                                        </td>
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
                                                    <a href="#" class="dropdown-item" data-sidebar-target="#view-detail">View
                                                        Details</a>
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
                                        <td></td>
                                        <td>
                                            <a href="#" class="d-flex align-items-center">
                                                <figure class="avatar avatar-sm mr-3">
                                            <span class="avatar-title rounded-pill">
                                                <i class="ti-file"></i>
                                            </span>
                                                </figure>
                                                <span class="d-flex flex-column">
                                            <span class="text-primary">Task-list.txt</span>
                                            <span class="small font-italic">12 KB</span>
                                        </span>
                                            </a>
                                        </td>
                                        <td>3/9/19, 2:40PM</td>
                                        <td>
                                            <div class="badge bg-info-bright text-info">Design</div>
                                        </td>
                                        <td>
                                        </td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a href="#" class="btn btn-floating" data-toggle="dropdown">
                                                    <i class="ti-more-alt"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a href="#" class="dropdown-item" data-sidebar-target="#view-detail">View
                                                        Details</a>
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
