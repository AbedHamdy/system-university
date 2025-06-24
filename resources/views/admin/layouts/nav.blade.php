<div class="navbar d-flex justify-content-between align-items-center px-4 py-2 shadow" style="background: linear-gradient(to right, #c0392b, #000000); color: white;">
    <!-- زر القائمة الجانبية -->
    <div class="toggle-btn" onclick="toggleSidebar()" style="cursor: pointer;">
        <i class="fas fa-bars fa-lg"></i>
    </div>

    <!-- زر تسجيل الخروج -->
    <div>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
        <a href="#" class="text-white text-decoration-none" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt"></i> Logout
        </a>
    </div>
</div>
