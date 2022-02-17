<div class="navigation">
    <div class="logo">
        <a href={{route("admin.dashboard")}}>
            <img src="{{asset("assets/media/image/logo_light.png")}}" height="20" alt="logo">
        </a>
    </div>
    <ul>
        <li>
            <a  href="{{route("admin.dashboard")}}">
                <i class="nav-link-icon ti-pie-chart"></i>
                <span class="nav-link-label">Dashboard</span>

            </a>
        </li>
        <li>
            <a  href="{{route("admin.project")}}">
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
            <a  href="{{route("admin.users")}}">
                <i class="nav-link-icon ti-user"></i>
                <span class="nav-link-label">Users</span>
            </a>
        </li>
        <li>
            <a  href="settings.html">
                <i class="nav-link-icon ti-settings"></i>
                <span class="nav-link-label">Configurations</span>
            </a>
        </li>
    </ul>
</div>
