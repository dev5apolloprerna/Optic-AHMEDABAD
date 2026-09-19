<!doctype html>
<html lang="en" data-layout="horizontal" data-layout-style="default" data-layout-position="fixed" data-topbar="light"
    data-sidebar="dark" data-sidebar-size="sm-hover" data-layout-width="fluid">

{{-- Include Head --}}
@include('common.exhibitor_login.userhead')

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">

        <!-- Topbar -->
        @include('common.exhibitor_login.userheader')
        <!-- End of Topbar -->

        <!-- Sidebar -->
        @include('common.exhibitor_login.usersidebar')
        <!-- End of Sidebar -->

        @yield('content')

        @include('common.exhibitor_login.userfooter')

    </div>

    @include('common.exhibitor_login.userfooterjs')

    @yield('scripts')

</body>

</html>
