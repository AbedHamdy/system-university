<div class="sidebar" id="sidebar">
    <a href="{{ route("dashboard_Admin") }}"><i class="fas fa-home"></i> Dashboard</a>

    <div class="dropdown">
        <a href="#" onclick="toggleDropdown('students')">
            <i class="fas fa-users"></i> Students
            <i class="fas fa-chevron-down chevron" style="float: right;"></i>
        </a>
        <div class="dropdown-content" id="students">
            <a href="{{ route("create_student") }}"><i class="fas fa-plus"></i> Add Student</a>
            <a href=""><i class="fas fa-edit"></i> Edit Student</a>
        </div>
    </div>

    <div class="dropdown">
        <a href="#" onclick="toggleDropdown('tables')">
            <i class="fas fa-table"></i> Tables
            <i class="fas fa-chevron-down chevron" style="float: right;"></i>
        </a>
        <div class="dropdown-content" id="tables">
            <a href="#"><i class="fas fa-plus"></i> Add Table</a>
            <a href="#"><i class="fas fa-edit"></i> Edit Table</a>
        </div>
    </div>
</div>
