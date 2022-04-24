<!DOCTYPE html>
<html>

@include('layouts.head')

<body class="bg-gray-50">

{{-- Message news --}}
@yield('message')

{{-- Header --}}
@yield('header')

{{-- Preview --}}
@yield('preview')

{{-- Main --}}
@yield('main')

{{-- Sub Main --}}
@yield('sub_main')

{{-- Footer --}}
@include('layouts.footer')

</body>

@stack('javascript')

</html>
