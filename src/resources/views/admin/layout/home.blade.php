<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', '')</title>
    @include('admin.layout.styles')
</head>
<body>  
    <div class="app-wrapper">
        <!--begin::Header-->
       @include('admin.layout.header')
         <!--end::Header-->
        <!--begin::Sidebar-->
        {{-- @include('admin.layout.sidebar') --}}
         <!--end::Sidebar-->
        <!--begin::Content-->
       @yield('content')
            <!--end::Content-->
        <!--begin::Footer-->
        @include('admin.layout.footer')
         <!--end::Footer-->    
        @include('admin.layout.scripts')
    </div>
</body>
</html>