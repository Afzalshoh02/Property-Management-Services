<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link @if(Request::segment(2) == 'dashboard') @else collapsed @endif" href="{{ url('admin/dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="nav-heading">Pages</li>

        <li class="nav-item">
            <a class="nav-link @if(Request::segment(2) == 'vendor') @else collapsed @endif" href="{{ url('admin/vendor/list') }}">
                <i class="bi bi-person"></i>
                <span>Vendor List</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="">
                <i class="bi bi-person"></i>
                <span>User List</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="">
                <i class="bi bi-person"></i>
                <span>Service Request List</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="">
                <i class="bi bi-question-circle"></i>
                <span>Web-Portal Setting</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link @if(Request::segment(2) == 'service_type') @else collapsed @endif" href="{{ url('admin/service_type/list') }}">
                <i class="bi bi-person"></i>
                <span>Service Type</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link @if(Request::segment(2) == 'vendor_type') @else collapsed @endif" href="{{ url('admin/vendor_type/list') }}">
                <i class="bi bi-person"></i>
                <span>Vendor Type</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link @if(Request::segment(2) == 'category') @else collapsed @endif" href="{{ url('admin/category/list') }}">
                <i class="bi bi-envelope"></i>
                <span>Category List</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link @if(Request::segment(2) == 'sub_category') @else collapsed @endif" href="{{ url('admin/sub_category/list') }}">
                <i class="bi bi-envelope"></i>
                <span>Sub Category List</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link @if(Request::segment(2) == 'amc') @else collapsed @endif" href="{{ url('admin/amc/list') }}">
                <i class="bi bi-card-list"></i>
                <span>AMC List</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="">
                <i class="bi bi-box-arrow-in-right"></i>
                <span>Profile Update</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ url('logout') }}">
                <i class="bi bi-box-arrow-right"></i>
                <span>Logout</span>
            </a>
        </li>

    </ul>

</aside>
