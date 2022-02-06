@extends('layouts.v1.app')

@section('content')
    @include('layouts.v1.sidebar')
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
                       Edit Role
                    </a>
                </div>
            </div>
        </nav>
        <div class="content">
            <div class="container-fluid">
                @ability('admin', 'create-roles,view-roles,update-roles,delete-roles')
                <div style="margin-bottom: 30px">
                    <a href="{{route("role-permission-view")}}" class="btn btn-outline-secondary"><i class="fa fa-backward"></i> Back</a>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Edit Role</h5>
                            </div>
                            <div class="card-content">
                                <form id="edit-role" method="POST" action="{{route("edit-role")}}" >
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="display-name">Display Name</label>
                                                <input type="text" name="display_name" id="display-name" class="form-control border-input" placeholder="Display Name" value="{{$role->display_name}}"  >
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" name="name" id="name" class="form-control border-input"  placeholder="Name" value="{{$role->name}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="description">Description</label>
                                                    <textarea name="description" id="description" class="form-control border-input" placeholder="Description" >{{$role->description}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="role-permissions">Roles Permission</label>
                                                <select multiple title="Select permissions" id="role-permissions" name="permissions[]" class="selectpicker" data-style="btn-info btn-fill btn-block" data-size="7">
                                                    @if($permissions)
                                                        @foreach($permissions as $permission)
                                                            <option @if($role->permissions)
                                                                    @foreach($role->permissions as $permission_)
                                                                        @if($permission->id==$permission_->id) selected @endif
                                                                    @endforeach
                                                                    @endif value="{{$permission->id}}">{{$permission->display_name}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-fill btn-wd btn-submit ">Save Role</button>
                                        <input type="hidden" value="{{$role->id}}" name="id">
                                    </div>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
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

            $( document ).on('submit','#edit-role',function(e) {
                e.preventDefault();
                $('.btn-submit').text('');
                $('.btn-submit').append('<div class="circle"></div>');
                var url=$('#edit-role').attr('action');
                $.post( url, $("#edit-role" ).serialize())
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
                                $('.btn-submit').text('Save');
                                location.reload();
                            }, 1000);
                        };
                    })
                    .fail(function(data) {
                        $('.btn-submit').text('Save');
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
            });

        </script>
@endsection
