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
                        Edit View Member (MEMBERSHIP NO : {{$member->referral_code}})
                    </a>
                </div>
            </div>
        </nav>
        <div class="content">
            <div class="container-fluid">
                @ability('admin', 'update-members')
                <div style="margin-bottom: 30px">
                    <a href="{{route("members-view")}}" class="btn btn-outline-secondary"><i class="fa fa-backward"></i> Back to members</a>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Member Details</h4>
                            </div>
                            <div class="card-content">
                                <form id="update-member" method="POST" action="{{route("update-member")}}" >
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>First Name</label>
                                                <input type="text" name="firstname" class="form-control border-input" placeholder="firstname"  value="{{$member->firstname}}">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Middle Name</label>
                                                <input type="text" name="middlename" class="form-control border-input"  placeholder="Middle Name" value="{{$member->middlename}}">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Last Name</label>
                                                <input type="text" name="surname" class="form-control border-input"  placeholder="Last Name" value="{{$member->surname}}">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="email">Email address</label>
                                                <input type="email" id="email" name="email" class="form-control border-input" placeholder="Email" value="{{$member->email}}">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="phone">Phone</label>
                                                <input type="tel" name="phone" id="phone" class="form-control border-input" placeholder="Phone" value="{{$member->phone}}" >
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="county_id">Document type</label>
                                                <select class="selectpicker" data-style="btn btn-secondary btn-block" title="Choose status" name="doc_type" data-size="7">
                                                    <option disabled>Select document type</option>
                                                    <option @if("ID"==$member->doc_type) selected @endif value="ID">ID</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="doc_no">Document Number</label>
                                                <input type="tel" name="doc_no" id="doc_no" class="form-control border-input" placeholder="Document no" value="{{$member->doc_no}}" >
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="county_id">County</label>
                                                <select class="selectpicker" data-style="btn btn-secondary btn-block" title="Choose status" name="county_id" data-size="7">
                                                    <option disabled>Select status</option>
                                                    @foreach($counties as $county)
                                                    <option @if($county->id==$member->subcounty->county->id) selected @endif value="{{$county->id}}">{{$county->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="subcounty_id">Sub County</label>
                                                <select class="selectpicker" data-style="btn btn-secondary btn-block" title="Choose status" name="subcounty_id" data-size="7">
                                                    <option disabled>Select status</option>
                                                    @foreach($subcounties as $subcounty)
                                                        <option @if($subcounty->id==$member->subcounty->id) selected @endif value="{{$subcounty->id}}">{{$subcounty->name}}</option>
                                                        @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="Ward">Village/Ward</label>
                                                <input type="text" name="village" id="village" class="form-control border-input" placeholder="village/Ward" value="{{$member->village}}" >
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="phone">Status</label>
                                                <select class="selectpicker" data-style="btn btn-secondary btn-block" title="Choose status" name="status" data-size="7">
                                                    <option disabled>Select status</option>
                                                    <option @if($member->status==1) selected @endif value="1">Active</option>
                                                    <option @if($member->status==0) selected @endif value="0">Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    @ability('admin', 'create-members,update-members')
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-fill btn-wd btn-submit ">Update Members</button>
                                        <input type="hidden" value="{{$member->id}}" name="id">
                                    </div>
                                    @endability
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-8">
                        <div class="col-lg-6 col-sm-6">
                            <div class="card">
                                <div class="card-content">
                                    <div class="row">
                                        <div class="col-xs-5">
                                            <div class="icon-big icon-success text-center">
                                                <i class="ti-user"></i>
                                            </div>
                                        </div>
                                        <div class="col-xs-7">
                                            <div class="numbers">
                                                <p>Wallet Balance</p>
                                                Ksh {{number_format($balance??0,2)}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <hr/>
                                    <div class="stats">
                                        <i class="ti-info-alt"></i> Total referral and other earnings
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6">
                            <div class="card">
                                <div class="card-content">
                                    <div class="row">
                                        <div class="col-xs-5">
                                            <div class="icon-big icon-success text-center">
                                                <i class="ti-user"></i>
                                            </div>
                                        </div>
                                        <div class="col-xs-7">
                                            <div class="numbers">
                                                <p>Total Withdrawal</p>
                                               Ksh {{number_format($total_withdrawals,2)}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <hr/>
                                    <div class="stats">
                                        <i class="ti-info-alt"></i> Total withdrawal
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <form class="form-horizontal" method="GET">
                                        <div class="card-content">
                                            <div class="row">
                                                <div class="col-md-4" style="padding-top: 10px">
                                                    <label>Select Date Range</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <input type="text" name="filter_by_date" class="form-control reportrange"
                                                                   placeholder="Date Picker" value="{{Request::get('filter_by_date')}}"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <button type="submit" class="btn btn-info btn-fill btn-wd">Filter</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                                </div>
                            <div class="card">
                                <div class="card-header">
                                    <div class="nav-tabs-navigation">
                                        <div class="nav-tabs-wrapper">
                                            <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
                                                <li class="active"><a href="#history" data-toggle="tab">History({{count($history)}})</a></li>
                                                <li><a href="#levels" data-toggle="tab">Referrals Levels</a></li>

                                            </ul>
                                        </div>
                                    </div>
                                    <div id="my-tab-content" class="tab-content text-center">
                                        <div class="tab-pane active" id="history">
                                            <table id="datatables" class="table table-striped table-no-bordered table-hover"
                                                   cellspacing="0" width="100%" style="width:100%">
                                                <thead>
                                                <th data-field="date" data-sortable="true">Date</th>
                                                <th data-field="description" data-sortable="true">Description</th>
                                                <th data-field="transaction_id" data-sortable="true">Transaction</th>
                                                <th data-field="amount" data-sortable="true">Amount</th>
                                                <th data-field="amount" data-sortable="true">Balance</th>
                                                </thead>
                                                <tbody>
                                                @if($history)
                                                    @foreach($history as $history_)
                                                        <tr>
                                                            <td>{{$history_->created_at}}</td>
                                                            <td>{{$history_->transaction->description??"_"}}</td>
                                                            <td>{{$history_->transaction->reference_no??"_"}}</td>
                                                            <td>{{$history_->amount??"_"}}</td>
                                                            <td>{{$history_->balance??"_"}}</td>
                                                        </tr>

                                                    @endforeach
                                                @endif
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="tab-pane" id="levels">
                                            <table id="" class="table " cellspacing="0" width="100%" style="width:100%">
                                                <thead>
                                                <th data-field="level" data-sortable="true">Level</th>
                                                <th data-field="referrals" data-sortable="true">Referrals</th>
                                                </thead>
                                                <tbody>
                                                @foreach($levels as $key=>$value)
                                                <tr>
                                                    <td class="text-left">{{$key}}</td>
                                                    <td class="text-left">{{$value}}</td>
                                                </tr>
                                                 @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div><!--  end card  -->
                        </div> <!-- end col-md-12 -->
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

            $( document ).on('submit','#update-member',function(e) {
                e.preventDefault();
                $('.btn-submit').text('');
                $('.btn-submit').append('<div class="circle"></div>');
                var url=$('#update-member').attr('action');
                $.post( url, $("#update-member" ).serialize())
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
            $(document).ready(function () {

                $('#datatables').DataTable({
                    "pagingType": "full_numbers",
                    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                    responsive: true,
                    language: {
                        search: "_INPUT_",
                        searchPlaceholder: "Search records",
                    }
                });


                var table = $('#datatables').DataTable();
                // Edit record
                table.on('click', '.edit', function () {
                    $tr = $(this).closest('tr');

                    var data = table.row($tr).data();
                    alert('You press on Row: ' + data[0] + ' ' + data[1] + ' ' + data[2] + '\'s row.');
                });

                // Delete a record
                table.on('click', '.remove', function (e) {
                    $tr = $(this).closest('tr');
                    table.row($tr).remove().draw();
                    e.preventDefault();
                });

                //Like record
                table.on('click', '.like', function () {
                    alert('You clicked on Like button');
                });
            });
            $(document).ready(function () {

                $('#datatables_levels').DataTable({
                    "pagingType": "full_numbers",
                    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                    responsive: true,
                    language: {
                        search: "_INPUT_",
                        searchPlaceholder: "Search records",
                    }
                });


                var table = $('#datatables_levels').DataTable();
                // Edit record
                table.on('click', '.edit', function () {
                    $tr = $(this).closest('tr');

                    var data = table.row($tr).data();
                    alert('You press on Row: ' + data[0] + ' ' + data[1] + ' ' + data[2] + '\'s row.');
                });

                // Delete a record
                table.on('click', '.remove', function (e) {
                    $tr = $(this).closest('tr');
                    table.row($tr).remove().draw();
                    e.preventDefault();
                });

                //Like record
                table.on('click', '.like', function () {
                    alert('You clicked on Like button');
                });
            });
            @if(!Request::get('filter_by_date'))
            $(function() {

                var start = moment();
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
            @else
            $('.reportrange').daterangepicker()
            @endif
        </script>
@endsection
