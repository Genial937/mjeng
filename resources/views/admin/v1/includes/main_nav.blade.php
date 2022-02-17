<div class="navigation">
    <div class="logo">
        <a href={{route("admin.dashboard")}}>
            <img src="{{asset("assets/media/image/logo_light.png")}}" height="20" alt="logo">
        </a>
    </div>
    <ul>

        <li>
            <a class="{{ Request::is('admin/') ? 'active' : ''}}" href="{{route("admin.dashboard")}}">
                <i class="nav-link-icon ti-pie-chart"></i>
                <span class="nav-link-label">Dashboard</span>

            </a>
        </li>
        <li>
            <a class="{{ Request::is('admin/projects') ? 'active' : ''}}" href="{{route("admin.project")}}">
                <i class="nav-link-icon ti-folder"></i>
                <span class="nav-link-label">Projects</span>
            </a>
        </li>
        <li>
            <a  href="#">
                <i class="nav-link-icon ti-pie-chart"></i>
                <span class="nav-link-label">Inventory</span>

            </a>
        </li>
        <li>
            <a class="{{ Request::is('admin/users') ? 'active' : ''}}" href="{{route("admin.users")}}">
                <i class="nav-link-icon ti-user"></i>
                <span class="nav-link-label">Users</span>
            </a>
        </li>
        <li>
            <a class="{{Request::is('admin/config/counties') ? 'active' : ''||Request::is('admin/config/subcounties') ? 'active' : ''}}" href="{{route("admin.counties")}}">
                <i class="nav-link-icon ti-settings"></i>
                <span class="nav-link-label">Config</span>
            </a>
        </li>
    </ul>
</div>
