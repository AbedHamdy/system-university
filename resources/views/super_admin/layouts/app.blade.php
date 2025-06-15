<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Header -->
        @include('super_admin.layouts.header')
    </head>
    <body>
        <!-- Navbar -->
        @include('super_admin.layouts.nav')

        <!-- Sidebar -->
        @include('super_admin.layouts.sidebar')

        <!-- Main Content -->
        <div class="main-content">
            @yield('content')
        </div>

        <!-- Footer -->
        @include('super_admin.layouts.footer')


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('js/sidebar.js') }}"></script>
    </body>
</html>