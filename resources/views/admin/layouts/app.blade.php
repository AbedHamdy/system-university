<!DOCTYPE html>
<html lang="en">

    <head>
        @include('admin.layouts.header')
    </head>

    <body>
        <!-- Navbar -->
        @include('admin.layouts.nav')

        <!-- Sidebar -->
        @include('admin.layouts.sidebar')

        <!-- Main Content -->
        <div class="main-content">
            @yield('content')
        </div>

        <!-- Footer -->
        @include('admin.layouts.footer')

        <!-- JS: Sidebar Toggle & Dropdown -->
        @include('admin.layouts.script')
    </body>

</html>
