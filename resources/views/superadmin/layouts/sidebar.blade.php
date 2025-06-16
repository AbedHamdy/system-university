<div class="sidebar" id="sidebar">
    <!-- Dashboard Dropdown -->
    <div class="sidebar-item">
        <a href="#dashboardSubmenu" data-bs-toggle="collapse" class="dropdown-toggle" aria-expanded="false">
            <i class="fas fa-tachometer-alt"></i> Dashboard
            <i class="fas fa-chevron-down ms-auto"></i>
        </a>
        <div class="collapse" id="dashboardSubmenu" data-bs-parent="#sidebar">
            <div class="submenu">
                <a href="{{ route('dashboard_SuperAdmin') }}">
                    <i class="fas fa-home"></i> Main Dashboard
                </a>
            </div>
        </div>
    </div>

    <!-- Category Dropdown -->
    <div class="sidebar-item">
        <a href="#categorySubmenu" data-bs-toggle="collapse" class="dropdown-toggle" aria-expanded="false">
            <i class="fas fa-th-list"></i> Category
            <i class="fas fa-chevron-down ms-auto"></i>
        </a>
        <div class="collapse" id="categorySubmenu" data-bs-parent="#sidebar">
            <div class="submenu">
                <a href="{{ route('all_categories') }}">
                    <i class="fas fa-list"></i> All Categories
                </a>
                <a href="{{ route('create_category') }}">
                    <i class="fas fa-plus"></i> Create Category
                </a>
                <a href="{{ route("my_categories") }}">
                    <i class="fas fa-edit"></i> Manage Categories
                </a>
            </div>
        </div>
    </div>

    <!-- Level Dropdown  -->
    <div class="sidebar-item">
        <a href="#levelSubmenu" data-bs-toggle="collapse" class="dropdown-toggle" aria-expanded="false">
            <i class="fas fa-layer-group"></i> Level
            <i class="fas fa-chevron-down ms-auto"></i>
        </a>
        <div class="collapse" id="levelSubmenu" data-bs-parent="#sidebar">
            <div class="submenu">
                <a href="#">
                    <i class="fas fa-list"></i> All Levels
                </a>
                <a href="#">
                    <i class="fas fa-plus"></i> Create Level
                </a>
                <a href="#">
                    <i class="fas fa-edit"></i> Manage Levels
                </a>
            </div>
        </div>
    </div>

    <!-- Doctor Dropdown -->
    <div class="sidebar-item">
        <a href="#doctorSubmenu" data-bs-toggle="collapse" class="dropdown-toggle" aria-expanded="false">
            <i class="fas fa-user-md"></i> Doctor
            <i class="fas fa-chevron-down ms-auto"></i>
        </a>
        <div class="collapse" id="doctorSubmenu" data-bs-parent="#sidebar">
            <div class="submenu">
                <a href="{{ route('create_doctor') }}">
                    <i class="fas fa-plus"></i> Create Doctor
                </a>
                <a href="#">
                    <i class="fas fa-edit"></i> Manage Doctors
                </a>
            </div>
        </div>
    </div>

    <!-- Admin Dropdown -->
    <div class="sidebar-item">
        <a href="#adminSubmenu" data-bs-toggle="collapse" class="dropdown-toggle" aria-expanded="false">
            <i class="fas fa-user-shield"></i> Admin
            <i class="fas fa-chevron-down ms-auto"></i>
        </a>
        <div class="collapse" id="adminSubmenu" data-bs-parent="#sidebar">
            <div class="submenu">
                <a href="#">
                    <i class="fas fa-plus"></i> Create Admin
                </a>
                <a href="#">
                    <i class="fas fa-edit"></i> Manage Admins
                </a>
            </div>
        </div>
    </div>

    <!-- Statistics Link -->
    <a href="#">
        <i class="fas fa-chart-bar"></i> Statistics
    </a>
</div>
