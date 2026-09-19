<!DOCTYPE html>
<html lang="en">

{{-- Head Before AUTH --}}
@include('auth.includes.head')

<body>

    {{-- <div class="container" id="wrapper"> --}}
    <div class="auth-page-wrapper" style="overflow: hidden;">

        {{-- Content Goes Here FOR Before AUTH --}}
        @yield('content')

    </div>

    {{-- Scripts Before AUTH --}}
    @include('auth.includes.scripts')

</body>

</html>
