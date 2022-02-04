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
                        Dashboard
                    </a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="{{route("logout")}}" class="btn-rotate">
                                <i class="ti-settings"></i>
                                <p class="hidden-md hidden-lg">
                                    Logout
                                </p>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

    <div class="content">
        <div class="container-fluid">

            <div class="row mb-5">
                <div class="col-md-12">
                    <div class="card">
                        <form class="form-horizontal" method="GET">
                            <div class="card-content">
                                <div class="row">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-2" style="padding-top: 10px">
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
            </div>
            <div class="row">
                <div class="col-lg-4 col-sm-6">
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
                                        <p>Total Members</p>
                                        {{number_format($users)}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <hr/>
                            <div class="stats">
                                <i class="ti-info-alt"></i> Total members registered
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
                                        <i class="ti-money"></i>
                                    </div>
                                </div>
                                <div class="col-xs-7">
                                    <div class="numbers">
                                        <p>Total Members Collections</p>
                                        Ksh {{number_format($total_reg_payments,2)}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <hr/>
                            <div class="stats">
                                <i class="ti-info-alt"></i> Total members registration collections
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
                                        <i class="ti-share"></i>
                                    </div>
                                </div>
                                <div class="col-xs-7">
                                    <div class="numbers">
                                        <p>Total members withdraws</p>
                                      Ksh {{number_format($total_withdrawals,2)}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <hr/>
                            <div class="stats">
                                <i class="ti-info-alt"></i> Total members withdraws
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
                                        <i class="ti-wallet"></i>
                                    </div>
                                </div>
                                <div class="col-xs-7">
                                    <div class="numbers">
                                        <p>Total Members Funds</p>
                                        Ksh {{number_format($total_customer_float,2)}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <hr/>
                            <div class="stats">
                                <i class="ti-info-alt"></i> Total members funds in wallet
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
                                        <i class="ti-wallet"></i>
                                    </div>
                                </div>
                                <div class="col-xs-7">
                                    <div class="numbers">
                                        <p>Total Airtime float
                                        </p>
                                       Ksh {{number_format($fep_airtime_float,2)}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <hr/>
                            <div class="stats">
                                <i class="ti-info-alt"></i> Airtime float
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
            </div>
            <div class="row">
                <div class="col-lg-4 col-sm-6">
                    <div class="card ">
                        <div class="card-header">
                            <h4 class="card-title">Registration last 6 month</h4>
                        </div>
                        <div class="card-content">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                            <th>Month</th>
                                            <th>Count</th>
                                            </thead>
                                            <tbody>

                                            @if(!empty($line_chart_data))

                                                @foreach($line_chart_data['label'] as $key =>$value)
                                                    <tr>
                                                        <td>{{$value}}</td>
                                                        <td class="text-left">
                                                            {{$line_chart_data['data'][0][$key]}}
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
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card ">
                        <div class="card-header">
                            <h4 class="card-title">Analytics</h4>
                        </div>
                        <div class="card-content">
                            <div id="chartActivity" class="ct-chart"></div>
                        </div>
                        <div class="card-footer">
                            <div class="chart-legend">
                                <i class="fa fa-circle " style="color: #d70306;"></i> Registration
                            </div>

                        </div>
                    </div>
                </div>

            </div>


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
                        <a href="#">
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
    </div>
    <!-- Paper Dashboard PRO Core javascript and methods for Demo purpose -->
{{--    <script  src="{{url("js/paper-dashboard.js")}}"></script>--}}

    <script>
        $(document).ready(function(){
          let chart_data=@json($line_chart_data??[]);
            var data = {
                labels:chart_data.label ,
                series: chart_data.data
            };

            var options = {
                seriesBarDistance: 10,
                axisX: {
                    showGrid: false
                },
                height: "245px"
            };

            var responsiveOptions = [
                ['screen and (max-width: 640px)', {
                    seriesBarDistance: 5,
                    axisX: {
                        labelInterpolationFnc: function (value) {
                            return value[0];
                        }
                    }
                }]
            ];

            Chartist.Line('#chartActivity', data, options, responsiveOptions);

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
