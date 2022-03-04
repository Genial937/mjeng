<div class="navigation">
    <div class="logo">
        <a href={{route("admin.dashboard")}}>
            <img src="{{asset("assets/media/image/logo_light.png")}}" height="20" alt="logo">
        </a>
    </div>
    <ul>

        @if(count(App\User::where('id',Auth::id())->with('businesses')->first()->businesses))
        <li>
            <a class="{{ Request::is('vendor/dashboard') ? 'active' : ''}}" href="{{route("vendor.dashboard")}}">
                <i class="nav-link-icon ti-pie-chart"></i>
                <span class="nav-link-label">Dashboard</span>

            </a>
        </li>
        <li>
            <a class=" {{ Request::is('vendor/projects/*') ? 'active' : ''}}" href="{{route("vendor.project")}}">
                <i class="nav-link-icon ti-folder"></i>
                <span class="nav-link-label">Projects</span>
            </a>
        </li>
          <li>
                <a  href="{{route("vendor.inventory.equipment")}}">
                    <i class="nav-link-icon ti-pie-chart"></i>
                    <span class="nav-link-label">Inventory</span>

                </a>
        </li>
        @endif
        <li>
            <a class="{{ Request::is('vendor/business/*') ? 'active' : ''}}" href="{{route("vendor.businesses")}}">
                <i class="nav-link-icon ti-briefcase"></i>
                <span class="nav-link-label">Businesses</span>
            </a>
        </li>

        <li>
            <a class="{{ Request::is('vendor/users') ? 'active' : ''}}" href="{{route("vendor.users")}}">
                <i class="nav-link-icon ti-user"></i>
                <span class="nav-link-label">Users</span>
            </a>
        </li>

    </ul>
</div>
