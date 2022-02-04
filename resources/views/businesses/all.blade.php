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
                    <a class="navbar-brand" href="{{route('businesses-view')}}">
                        Businesses
                    </a>
                </div>
            </div>
        </nav>
        <div class="content">
            <div class="container-fluid">

                @ability('admin', 'view-businesses')
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Businesses Account </h5>
                            </div>
                            <div class="card-content">
                                <table id="datatables" class="table table-striped table-no-bordered table-hover"
                                       cellspacing="0" width="100%" style="width:100%">
                                    <thead>
                                    <th data-field="id" data-sortable="true">ID</th>
                                    <th data-field="date" data-sortable="true">Date</th>
                                    <th data-field="code" data-sortable="true">Code</th>
                                    <th data-field="name" data-sortable="true"> Name</th>
                                    <th data-field="balance" data-sortable="true">Balance</th>
                                    <th data-field="amount" data-sortable="true">Amount</th>
                                    <th data-field="action" data-sortable="true">Actions</th>
                                    </thead>
                                    <tbody>
                                    @if($outlets)
                                        @foreach($outlets as $outlet)
                                            <tr>
                                                <td>{{$outlet->id}}</td>
                                                <td>{{$outlet->created_at}}</td>
                                                <td>{{$outlet->outlet_code??"_"}}</td>
                                                <td>{{$outlet->name??"_"}}</td>

                                                <td>Ksh {{number_format($outlet->float->balance,2)??"_"}}</td>
                                                <td>@if($outlet->status==1)<label class="label label-success">Active</label>@else <label class="label label-warning">Inactive</label> @endif</td>
                                                <td>
                                                    <div class="dropup">
                                                        <a href="#" class="btn btn-outline-secondary btn-sm dropdown-toggle" data-toggle="dropdown">
                                                            actions
                                                            <b class="caret"></b>
                                                        </a>
                                                        <ul class="dropdown-menu">
                                                            <li><a href="#" >Transactions</a></li>
                                                            <li><a href="#" >Debit</a></li>
                                                            <li><a href="#" >Credit</a></li>
                                                        </ul>
                                                    </div>

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
                $.post("{{route("resend-airtime")}}", {id:airtimeID})
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
