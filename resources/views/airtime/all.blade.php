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
                    <a class="navbar-brand" href="{{route('airtime-view')}}">
                        Airtime
                    </a>
                </div>
            </div>
        </nav>
        <div class="content">
            <div class="container-fluid">
                <div class="row mb-5">
                    <div class="col-lg-4 col-sm-6">
                        <div class="card">
                            <div class="card-content">
                                <div class="row">
                                    <div class="col-xs-5">
                                        <div class="icon-big icon-success text-center">
                                            <i class="ti-ticket"></i>
                                        </div>
                                    </div>
                                    <div class="col-xs-7">
                                        <div class="numbers">
                                            <p>Total Airtime Sold
                                            </p>
                                            Ksh {{number_format($total_airtime_payments,2)}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <hr/>
                                <div class="stats">
                                    <i class="ti-info-alt"></i> Total value of airtime sold and successfully delivered
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="card">
                            <div class="card-content">
                                <div class="row">
                                    <div class="col-xs-5">
                                        <div class="icon-big icon-success text-center">
                                            <i class="ti-close"></i>
                                        </div>
                                    </div>
                                    <div class="col-xs-7">
                                        <div class="numbers">
                                            <p>Total Airtime Pending
                                            </p>
                                            Ksh {{number_format($total_airtime_payments_pending)}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <hr/>
                                <div class="stats">
                                    <i class="ti-info-alt"></i> Total value of airtime pending
                                    payment
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="card">
                            <div class="card-content">
                                <div class="row">
                                    <div class="col-xs-5">
                                        <div class="icon-big icon-success text-center">
                                            <i class="ti-arrow-circle-down"></i>
                                        </div>
                                    </div>
                                    <div class="col-xs-7">
                                        <div class="numbers">
                                            <p>Total Airtime Failed
                                            </p>
                                            Ksh {{number_format($total_airtime_payments_failed)}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <hr/>
                                <div class="stats">
                                    <i class="ti-info-alt"></i> Total value of airtime paid but
                                    failed
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-md-12">
                        <div class="card">
                            <form class="form-horizontal" method="GET">
                                <div class="card-content">

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label>Select Date Range</label>
                                                    <input type="text" name="filter_by_date"
                                                           class="form-control reportrange"
                                                           placeholder="Date Picker"
                                                           value="{{Request::get('filter_by_date')}}"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label>Status</label>
                                                    <select class="selectpicker"
                                                            data-style="btn btn-secondary btn-block"
                                                            title="Choose status" name="status" data-size="7">
                                                        <option disabled>Select type payment</option>
                                                        <option selected @if(Request::get('status')=="SUCCESS") selected
                                                                @endif value="SUCCESS">SUCCESS
                                                        </option>
                                                        <option @if(Request::get('status')=="PENDING") selected
                                                                @endif value="PENDING">PENDING
                                                        </option>
                                                        <option @if(Request::get('status')=="FAILED") selected
                                                                @endif value="FAILED">FAILED
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group" style="margin-top: 25px">
                                                <button type="submit" class="btn btn-info btn-fill btn-wd">Filter
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @ability('admin', 'view-airtime')
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                {{--                                <a href="{{route("members-view")}}" class="btn btn-secondary pull-right">Create New--}}
                                {{--                                    User</a>--}}
                                <h5>Airtime ({{count($airtimes)}})</h5>
                            </div>
                            <div class="card-content">
                                <table id="datatables" class="table table-striped table-no-bordered table-hover"
                                       cellspacing="0" width="100%" style="width:100%">
                                    <thead>
                                    <th data-field="id" data-sortable="true">ID</th>
                                    <th data-field="date" data-sortable="true">Date</th>
                                    <th data-field="tras_id" data-sortable="true">Membership no</th>
                                    <th data-field="tras_id" data-sortable="true">Transaction ID</th>
                                    <th data-field="phone" data-sortable="true">Phone</th>
                                    <th data-field="recipient" data-sortable="true">Recipient</th>
                                    <th data-field="amount" data-sortable="true">Amount</th>
                                    <th data-field="method" data-sortable="true">Method</th>
                                    <th data-field="status" data-sortable="true">Status</th>
                                    <th data-field="req_id" data-sortable="true">RequestID</th>
                                    <th data-field="description" data-sortable="true">Status Description</th>
                                    <th data-field="action" data-sortable="true">Actions</th>


                                    </thead>
                                    <tbody>
                                    @if($airtimes)
                                        @foreach($airtimes as $airtime)
                                            <tr>
                                                <td>{{$airtime->id}}</td>
                                                <td>{{$airtime->created_at}}</td>
                                                <td>{{$airtime->payment->user->id??"_"}}</td>
                                                <td>{{$airtime->payment->receipt}}</td>
                                                <td>{{$airtime->phone??"_"}}</td>
                                                <td>{{$airtime->recipient??"_"}}</td>
                                                <td>{{$airtime->amount??"_"}}</td>
                                                <td>{{$airtime->payment->method??"_"}}</td>
                                                <td>@if($airtime->status!="SUCCESS")<label
                                                        class="label label-danger">{{$airtime->status??"_"}}</label>@else
                                                        <label
                                                            class="label label-success">{{$airtime->status??"_"}}</label> @endif
                                                </td>
                                                <td>{{$airtime->request_id??"_"}}</td>
                                                <td>@if($airtime->status!="SUCCESS")<label
                                                        class="label label-danger">{{$airtime->status_description??"_"}}</label>@else
                                                        <label
                                                            class="label label-success">{{$airtime->status_description??"_"}}</label> @endif
                                                </td>

                                                <td>
                                                    @ability('admin', 'create-airtime,update-airtime,delete-airtime')
                                                    @if($airtime->status!="SUCCESS"&&isset($airtime->payment->receipt))
                                                        <div class="dropup">
                                                            <a href="#"
                                                               class="btn btn-outline-secondary btn-sm dropdown-toggle"
                                                               data-toggle="dropdown">
                                                                actions
                                                                <b class="caret"></b>
                                                            </a>
                                                            <ul class="dropdown-menu">
                                                                <li><a href="#"
                                                                       onclick="resendAirtime({{$airtime->id}})">Resend</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    @else
                                                        _
                                                    @endif
                                                    @endability
                                                </td>
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

            function resendAirtime(airtimeID) {
                $.post("{{route("resend-airtime")}}", {id: airtimeID})
                    .done(function (data) {
                        console.log(data)
                        if (data['success']) {
                            GrowlNotification.notify({
                                title: '',
                                description: data['message'],
                                type: 'success',
                                position: 'top-center',
                                showProgress: true,
                                closeTimeout: 10000
                            });
                            setTimeout(function () {
                                location.reload();
                            }, 1000);
                        }
                        ;
                    })
                    .fail(function (data) {
                        var errors = data.responseJSON;
                        $.each(errors.errors, function (key, value) {
                            GrowlNotification.notify({
                                title: '',
                                description: value[0],
                                type: 'warning',
                                position: 'top-center',
                                showProgress: true,
                                closeTimeout: 30000
                            });
                        });
                    })
            }

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
        </script>
        <script type="text/javascript">
            @if(!Request::get('filter_by_date'))
            $(function () {

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
