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
                        Edit User
                    </a>
                </div>
            </div>
        </nav>
        <div class="content">
            <div class="container-fluid">
                @ability('admin', 'create-users,view-users,update-users,delete-users')
                <div style="margin-bottom: 30px">
                    <a href="{{route("users-view")}}" class="btn btn-outline-secondary"><i class="fa fa-backward"></i> Back to users</a>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Edit User</h4>
                            </div>
                            <div class="card-content">
                                <form id="update-user" method="POST" action="{{route("update-user")}}" >
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>First Name</label>
                                                <input type="text" name="firstname" class="form-control border-input" placeholder="firstname"  value="{{$user->firstname}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Last Name</label>
                                                <input type="text" name="surname" class="form-control border-input"  placeholder="Last Name" value="{{$user->surname}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="email">Email address</label>
                                                <input type="email" id="email" name="email" class="form-control border-input" placeholder="Email" value="{{$user->email}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="phone">Phone</label>
                                                <input type="tel" name="phone" id="phone" class="form-control border-input" placeholder="Phone" value="{{$user->phone}}" >
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="phone">Status</label>
                                                <select class="selectpicker" data-style="btn btn-secondary btn-block" title="Choose status" name="status" data-size="7">
                                                    <option disabled>Select status</option>
                                                    <option @if($user->status==1) selected @endif value="1">Active</option>
                                                    <option @if($user->status==0) selected @endif value="0">Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="role-permissions">Roles</label>
                                                <select multiple title="Select roles" id="roles" name="roles[]" class="selectpicker" data-style="btn-info btn-fill btn-block" data-size="10">
                                                    @if($roles)
                                                        @foreach($roles as $role)
                                                            <option  @foreach($user->roles as $role_) @if($role->id===$role_->id) selected  @endif   @endforeach value="{{$role->id}}">{{$role->display_name}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-fill btn-wd btn-submit ">Save User</button>
                                        <input type="hidden" value="{{auth()->id()}}" name="id">
                                    </div>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Change password</h4>
                                </div>
                                <div class="card-content">
                                    <form id="user-update-password" method="POST" action="{{route("user-update-password",$user->id)}}" >
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Password</label>
                                                    <input type="text" name="password" class="form-control border-input" placeholder="password" >
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Confirm Password</label>
                                                    <input type="text" name="password_confirmation" class="form-control border-input" placeholder="confirmation password" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-fill btn-wd btn-submit-p ">Save changes</button>
                                            <input type="hidden" value="{{auth()->id()}}" name="id">
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

            $( document ).on('submit','#update-user',function(e) {
                e.preventDefault();
                $('.btn-submit').text('');
                $('.btn-submit').append('<div class="circle"></div>');
                var url=$('#update-user').attr('action');
                $.post( url, $("#update-user" ).serialize())
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
            $( document ).on('submit','#user-update-password',function(e) {
                e.preventDefault();
                $('.btn-submit-p').text('');
                $('.btn-submit-p').append('<div class="circle"></div>');
                var url=$('#user-update-password').attr('action');
                $.post( url, $("#user-update-password" ).serialize())
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
                                $('.btn-submit-p').text('Save changes');
                                location.reload();
                            }, 1000);
                        };
                    })
                    .fail(function(data) {
                        $('.btn-submit-p').text('Save changes');
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
