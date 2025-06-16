<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Header -->
        @include('superadmin.layouts.header')
    </head>
    <body>
        <!-- Navbar -->
        @include('superadmin.layouts.nav')

        <!-- Sidebar -->
        @include('superadmin.layouts.sidebar')

        <!-- Main Content -->
        <div class="main-content">
            @yield('content')
        </div>

        <!-- Footer -->
        @include('superadmin.layouts.footer')

        <!-- Script -->
        @include('superadmin.layouts.script')
    </body>
</html>
