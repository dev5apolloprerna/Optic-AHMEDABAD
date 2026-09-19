<!DOCTYPE html>
<html lang="en">

{{-- Include Head --}}
@include('common.front.fronthead')

<body id="page-top">



    @include('common.front.frontheader')


    @yield('content')

    @include('common.front.frontfooter')



    @include('common.front.frontfooterjs')

    @yield('scripts')
</body>

</html>
