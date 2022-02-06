<div class="wrapper">
    <div class="sidebar" data-background-color="brown" data-active-color="danger">
        <!--
            Tip 1: you can change the color of the sidebar's background using: data-background-color="white | brown"
            Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
        -->
        <div class="logo">
            <a href="#" class="simple-text logo-mini">
              FEP
            </a>

            <a href="#" class="simple-text logo-normal">
                FEP
            </a>
        </div>
        <div class="sidebar-wrapper">
            <div class="user">
                <div class="info">
                    <div class="photo">
                        <img src="https://freesvg.org/img/1389952697.png" />
                    </div>

                    <a data-toggle="collapse" href="#collapseExample" class="collapsed">
	                        <span>
								{{auth()->user()->firstname}} {{auth()->user()->surname}}
		                        <b class="caret"></b>
							</span>
                    </a>
                    <div class="clearfix"></div>

                    <div class="collapse" id="collapseExample">
                        <ul class="nav">
                            <li>
                                <a href="{{route("profile")}}">
                                    <span class="sidebar-mini">Mp</span>
                                    <span class="sidebar-normal">My Profile</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route("logout")}}">
                                    <span class="sidebar-mini">LA</span>
                                    <span class="sidebar-normal">Logout</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <ul class="nav">
                <li>
                    <a href="{{route('dashboard')}}">
                        <i class="ti-bar-chart-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                @ability('admin', 'create-businesses,view-businesses,update-businesses,delete-businesses')
                <li>
                    <a data-toggle="collapse" href="#businesses">
                        <i class="ti-server"></i>
                        <p>Business
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse" id="businesses">
                        <ul class="nav">
                            <li>
                                <a href="{{route("businesses-view")}}">
                                    <span class="sidebar-mini">VM</span>
                                    <span class="sidebar-normal">View Businesses</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>
                @endability
                @ability('admin', 'create-members,view-members,update-members,delete-members')
                <li>
                    <a data-toggle="collapse" href="#members">
                        <i class="ti-user"></i>
                        <p>Members
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse" id="members">
                        <ul class="nav">
                            <li>
                                <a href="{{route("members-view")}}">
                                    <span class="sidebar-mini">VM</span>
                                    <span class="sidebar-normal">View Members</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>
                @endability
                @ability('admin', 'create-airtime,view-airtime,update-airtime,delete-airtime')
                <li>
                    <a data-toggle="collapse" href="#airtime">
                        <i class="ti-ticket"></i>
                        <p>Airtime
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse" id="airtime">
                        <ul class="nav">
                            <li>
                                <a href="{{route("airtime-view")}}">
                                    <span class="sidebar-mini">VA</span>
                                    <span class="sidebar-normal">View Airtime</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endability
                @ability('admin', 'create-payments,view-payments,update-payments,delete-payments')
                <li>
                    <a data-toggle="collapse" href="#payments">
                        <i class="ti-money"></i>
                        <p>Payments
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse" id="payments">
                        <ul class="nav">
                            <li>
                                <a href="{{route("payments-view")}}">
                                    <span class="sidebar-mini">VA</span>
                                    <span class="sidebar-normal">View Payments</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endability
                @ability('admin', 'create-withdrawals,view-withdrawals,update-withdrawals,delete-withdrawals')
                <li>
                    <a data-toggle="collapse" href="#withdrawals">
                        <i class="ti-share"></i>
                        <p>Withdrawals
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse" id="withdrawals">
                        <ul class="nav">
                            <li>
                                <a href="{{route("withdrawals-view")}}">
                                    <span class="sidebar-mini">VA</span>
                                    <span class="sidebar-normal">View Withdrawals</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endability
                @ability('admin', 'create-users,view-users,update-users,delete-users')
                <li>
                    <a data-toggle="collapse" href="#settings">
                        <i class="ti-settings"></i>
                        <p>Settings
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse" id="settings">
                        <ul class="nav">
                            @ability('admin', 'create-roles,view-roles,update-roles,delete-roles')
                            <li>
                                <a href="{{route("role-permission-view")}}">
                                    <span class="sidebar-mini">SRP</span>
                                    <span class="sidebar-normal">Roles/Permission</span>
                                </a>
                            </li>
                            @endability
                            @ability('admin', 'create-users,view-users,update-users,delete-users')
                            <li>
                                <a href="{{route("users-view")}}">
                                    <span class="sidebar-mini">SU</span>
                                    <span class="sidebar-normal">Users</span>
                                </a>
                            </li>
                            @endability
                            <li>
                                <a href="{{route("logout")}}">
                                    <span class="sidebar-mini">LA</span>
                                    <span class="sidebar-normal">Logout</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endability
            </ul>
        </div>
    </div>
