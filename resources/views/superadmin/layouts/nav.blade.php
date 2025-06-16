<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container-fluid">
        <!-- Add Sidebar Toggle Button -->
        <button id="sidebarToggle" class="sidebar-toggle me-2">
            <i class="fas fa-bars"></i>
        </button>

        <a class="navbar-brand" href="{{ route("dashboard_SuperAdmin") }}">UMS</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fas fa-user"></i> Profile</a>
                </li>
                <li class="nav-item">
                    <form id="logout-form" action="{{ route('logout_super_admin') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </li>

            </ul>
        </div>
    </div>
</nav>
