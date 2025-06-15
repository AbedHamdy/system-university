// filepath: d:\projects\Graduate\me\university-management-system\resources\views\super_admin\layouts\sidebar.blade.php
<div class="sidebar" id="sidebar">
    <!-- Doctor Dropdown -->
    <div class="sidebar-item">
        <a href="#doctorSubmenu" data-bs-toggle="collapse" class="dropdown-toggle">
            <i class="fas fa-chalkboard-teacher"></i> Doctor
            <i class="fas fa-chevron-down ms-auto"></i>
        </a>
        <div class="collapse" id="doctorSubmenu">
            <div class="submenu">
                <a href="#">
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
        <a href="#adminSubmenu" data-bs-toggle="collapse" class="dropdown-toggle">
            <i class="fas fa-user-shield"></i> Admin
            <i class="fas fa-chevron-down ms-auto"></i>
        </a>
        <div class="collapse" id="adminSubmenu">
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