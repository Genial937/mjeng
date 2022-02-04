@extends('layouts.app')

@section('content')
    @include('layouts.sidebar')

    <div class="main-panel">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-minimize">
                    <button id="minimizeSidebar" class="btn btn-fill btn-icon"><i class="ti-more-alt"></i></button>
                </div>
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar bar1"></span>
                        <span class="icon-bar bar2"></span>
                        <span class="icon-bar bar3"></span>
                    </button>
                    <a class="navbar-brand" href="#Dashboard">
                        Roles & Permissions
                    </a>
                </div>
            </div>
        </nav>
        <div class="content">
            <div class="container-fluid">
                @ability('admin', 'create-roles,view-roles,update-roles,delete-roles')
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <a href="{{route("create-role-view")}}" class="btn btn-secondary pull-right">Create New Role</a>
                                <h5>Roles ({{count($roles)}})</h5>
                            </div>
                            <div class="card-content">
                                <table id="roles-table" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                    <thead>
                                    <th data-field="description" data-sortable="true">Description</th>
                                    <th data-field="title" data-sortable="true">Title</th>
                                    <th data-field="users" data-sortable="true">Users</th>
                                    <th data-field="permissions" data-sortable="true">Permissions</th>
                                    <th data-field="action" data-sortable="true">Action</th>
                                    </thead>
                                    <tbody>
                                    @if($roles)
                                        @foreach($roles as $role)
                                            <tr>
                                                <td>{{$role->description}}</td>
                                                <td>{{$role->display_name}}</td>
                                                <td>
                                                    <a data-toggle="collapse" href="#collapse-users-{{$role->id}}"><span class="label label-info">users ({{count($role->users)}}) <i class="fa fa-angle-double-down"></i> </span></a>
                                                </td>
                                                <td>
                                                    <a data-toggle="collapse" href="#collapse-permission-{{$role->id}}"><span class="label label-info">permissions ({{count($role->permissions)}}) <i class="fa fa-angle-double-down"></i></span></a>
                                                </td>
                                                <td>
                                                    <div class="dropup">
                                                        <a href="#" class="btn btn-outline-secondary btn-sm dropdown-toggle" data-toggle="dropdown">
                                                            actions
                                                            <b class="caret"></b>
                                                        </a>
                                                        <ul class="dropdown-menu">
                                                            <li><a href="{{route("edit-role-view",$role->id)}}">Edit</a></li>
                                                            <li><a href="#" onclick="deleteRole({{$role->id}})">Delete</a></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                              </tr>
                                              <tr id="collapse-users-{{$role->id}}" class="panel-collapse collapse">
                                                <td class="panel-body" colspan="5">
                                                    <table  class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                                        <thead>
                                                        <th data-field="amount" data-sortable="true">Name</th>
                                                        <th data-field="product" data-sortable="true">Email</th>
                                                        </thead>
                                                        <tbody>
                                                        @if(count($role->users)>0)
                                                            @foreach($role->users as $user)
                                                                <tr>
                                                                    <td>{{$user->firstname}}</td>
                                                                    <td>{{$user->email}}</td>
                                                                </tr>
                                                            @endforeach
                                                        @endif
                                                        </tbody>
                                                    </table>

                                                </td>
                                            </tr>
                                                <tr id="collapse-permission-{{$role->id}}" class="panel-collapse collapse">
                                                <td class="panel-body" colspan="5">
                                                    <table  class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                                        <thead>
                                                        <th data-field="amount" data-sortable="true">Description</th>
                                                        <th data-field="product" data-sortable="true">Title</th>
                                                        </thead>
                                                        <tbody>
                                                        @if(count($role->permissions)>0)
                                                            @foreach($role->permissions as $permission)
                                                                <tr>
                                                                    <td>{{$permission->description}}</td>
                                                                    <td>{{$permission->display_name}}</td>
                                                                </tr>
                                                            @endforeach
                                                        @endif
                                                        </tbody>
                                                    </table>

                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div><!--  end card  -->
                    </div> <!-- end col-md-12 -->
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <a href="{{route("create-permission-view")}}" class="btn btn-secondary btn-fill pull-right  mr-2">Create Permissions</a>
                                <h5>Permissions({{count($permissions)}})</h5>
                            </div>
                            <div class="card-content">
                                <table  id="permissions-table" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                    <thead>
                                    <th data-field="description" data-sortable="true">Description</th>
                                    <th data-field="title" data-sortable="true">Title</th>
                                    <th data-field="roles" data-sortable="true">Roles</th>
                                    </thead>
                                    <tbody>
                                    @if($permissions)
                                        @foreach($permissions as $permission)
                                            <tr>
                                                <td>{{$permission->description}}</td>
                                                <td>{{$permission->display_name}}</td>
                                                <td><span class="label label-info">roles({{count($permission->roles)}})</span></td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div><!--  end card  -->
                    </div> <!-- end col-md-12 -->
                </div> <!-- end row -->
                @endability
            </div>
        </div>
        <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul>
                        <li>
                            <a href="#">
                                Home
                            </a>
                        </li>
                        <li>
                            <a href="{{route("logout")}}">
                                Logout
                            </a>
                        </li>

                    </ul>
                </nav>
                <div class="copyright pull-right">
                    &copy;
                    <script>document.write(new Date().getFullYear())</script>
                </div>
            </div>
        </footer>
        <!--  Bootstrap Table Plugin    -->
        <script src="{{url("js/bootstrap-table.js")}}"></script>
        <!--  Plugin for DataTables.net  -->
        <script src="{{url("js/jquery.datatables.js")}}"></script>
        <script type="text/javascript">
            function deleteRole(roleID) {
                $.post("{{route("delete-role")}}", {id:roleID})
                    .done(function( data ) {
                        console.log(data)
                        if (data['success']) {
                            GrowlNotification.notify({
                                title: '',
                                description: data['message'],
                                type: 'success',
                                position: 'top-center',
                                showProgress:true,
                                closeTimeout: 10000
                            });
                            setTimeout(function(){
                                location.reload();
                            }, 1000);
                        };
                    })
                    .fail(function(data) {
                        var errors = data.responseJSON;
                        $.each(errors.errors, function( key, value ) {
                            GrowlNotification.notify({
                                title: '',
                                description: value[0] ,
                                type: 'warning',
                                position: 'top-center',
                                showProgress:true,
                                closeTimeout: 30000
                            });
                        });
                    })
            }
            $(document).ready(function() {

                $('#permissions-table').DataTable({
                    "pagingType": "full_numbers",
                    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                    responsive: true,
                    language: {
                        search: "_INPUT_",
                        searchPlaceholder: "Search records",
                    }
                });


                var table = $('#permissions-table').DataTable();
                // Edit record
                table.on( 'click', '.edit', function () {
                    $tr = $(this).closest('tr');

                    var data = table.row($tr).data();
                    alert( 'You press on Row: ' + data[0] + ' ' + data[1] + ' ' + data[2] + '\'s row.' );
                } );

                // Delete a record
                table.on( 'click', '.remove', function (e) {
                    $tr = $(this).closest('tr');
                    table.row($tr).remove().draw();
                    e.preventDefault();
                } );

                //Like record
                table.on( 'click', '.like', function () {
                    alert('You clicked on Like button');
                });
                $('#roles-table').DataTable({
                    "pagingType": "full_numbers",
                    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                    responsive: true,
                    language: {
                        search: "_INPUT_",
                        searchPlaceholder: "Search records",
                    }
                });


                var table = $('#roles-table').DataTable();
                // Edit record
                table.on( 'click', '.edit', function () {
                    $tr = $(this).closest('tr');

                    var data = table.row($tr).data();
                    alert( 'You press on Row: ' + data[0] + ' ' + data[1] + ' ' + data[2] + '\'s row.' );
                } );

                // Delete a record
                table.on( 'click', '.remove', function (e) {
                    $tr = $(this).closest('tr');
                    table.row($tr).remove().draw();
                    e.preventDefault();
                } );

                //Like record
                table.on( 'click', '.like', function () {
                    alert('You clicked on Like button');
                });

            });
        </script>
        <script type="text/javascript">
            $(function() {

                var start = moment().subtract(29, 'days');
                var end = moment();

                function cb(start, end) {
                    $('.reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                }

                $('.reportrange').daterangepicker({
                    startDate: start,
                    endDate: end,
                    ranges: {
                        'Today': [moment(), moment()],
                        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                        'This Month': [moment().startOf('month'), moment().endOf('month')],
                        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                    }
                }, cb);

                cb(start, end);

            });
        </script>
@endsection
