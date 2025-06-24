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
                <a href="{{ route('my_categories') }}">
                    <i class="fas fa-edit"></i> Manage Categories
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
                <a href="{{ route('all_doctors') }}">
                    <i class="fas fa-list"></i> All Doctors
                </a>
                <a href="{{ route('create_doctor') }}">
                    <i class="fas fa-plus"></i> Create Doctor
                </a>
            </div>
        </div>
    </div>

    <!-- Course Dropdown -->
    <div class="sidebar-item">
        <a href="#courseSubmenu" data-bs-toggle="collapse" class="dropdown-toggle" aria-expanded="false">
            <i class="fas fa-book"></i> Course
            <i class="fas fa-chevron-down ms-auto"></i>
        </a>
        <div class="collapse" id="courseSubmenu" data-bs-parent="#sidebar">
            <div class="submenu">
                <a href="{{ route('all_courses') }}">
                    <i class="fas fa-list"></i> All Courses
                </a>
                <a href="{{ route('create_course') }}">
                    <i class="fas fa-plus"></i> Create Course
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
                <a href="{{ route('all_admins') }}">
                    <i class="fas fa-list"></i> All Admins
                </a>
                <a href="{{ route('create_admin') }}">
                    <i class="fas fa-plus"></i> Create Admin
                </a>
            </div>
        </div>
    </div>

    <!-- Semester Dropdown -->
    <div class="sidebar-item">
        <a href="#semesterSubmenu" data-bs-toggle="collapse" class="dropdown-toggle" aria-expanded="false">
            <i class="fas fa-calendar-alt"></i> Semester
            <i class="fas fa-chevron-down ms-auto"></i>
        </a>
        <div class="collapse" id="semesterSubmenu" data-bs-parent="#sidebar">
            <div class="submenu">
                <a href="{{ route('active_semester') }}">
                    <i class="fas fa-toggle-on"></i> Set Active Semester
                </a>
            </div>
        </div>
    </div>

    <!-- Assign Courses -->
    <div class="sidebar-item">
        <a href="{{ route('select_category') }}" class="d-flex align-items-center">
            <i class="fas fa-layer-group me-2"></i>
            <span>Assign Courses</span>
        </a>
    </div>

    <!-- Assign Courses to Semester -->
    <div class="sidebar-item">
        <a href="{{ route('choose_category_to_choose_level') }}" class="d-flex align-items-center">
            <i class="fas fa-layer-group me-2"></i>
            <span>Assign Courses To Semester</span>
        </a>
    </div>

    <!-- Statistics -->
    <a href="#">
        <i class="fas fa-chart-bar"></i> Statistics
    </a>
</div>
