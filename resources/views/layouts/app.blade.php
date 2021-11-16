<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset("panel/images/favicon.png")}}" />

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset("panel/vendors/mdi/css/materialdesignicons.min.css")}}">
    <link rel="stylesheet" href="{{ asset("panel/vendors/css/vendor.bundle.base.css")}}">
    <link rel="stylesheet" href="{{ asset('panel/css/style.css')}}">
    {{-- <link rel="stylesheet" href="{{ asset('css/app.css')}}"> --}}
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- CDN -->
    <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/my-style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font.css') }}">

    <link rel="stylesheet" href="{{ asset('panel/vendors/datepicker/css/tempusdominus-bootstrap-4.min.css') }}">
    
    <!-- Scripts -->
    <script src="{{ asset('js/jquery-3.5.1.min.js')}}"></script>
    <script src="{{ asset('js/jquery.slim.min.js') }}"></script>

    @stack('styles')
</head>
<body>
    <div class="container-scroller">
        {{-- @dd($contents) --}}
        {{-- @php
            print_r($contents)
        @endphp --}}
        @auth
            @include('includes.navbar')
        @endauth
        <div class="container-fluid page-body-wrapper px-0" style="">
            @auth
                @include('includes.sidebar')
            @endauth
            @yield('content')
        </div>
    </div>
    <!-- Plugin js for this page -->
    <script src="{{ asset("panel/vendors/chart.js/Chart.min.js")}}"></script>
    <script src="{{ asset("panel/vendors/js/vendor.bundle.base.js")}}"></script>
    <script src="{{ asset("panel/js/off-canvas.js")}}"></script>
    <script src="{{ asset("panel/js/hoverable-collapse.js")}}"></script>
    <script src="{{ asset("panel/js/misc.js")}}"></script>
    {{-- <script src="{{ asset("panel/js/dashboard.js")}}"></script> --}}
    {{-- <script src="{{ asset("panel/js/todolist.js")}}"></script> --}}

    <!-- CDN -->
    <script src="{{ asset('js/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('js/jquery.validate.min.js')}}"></script>
    <!-- Include library Datatables -->
    <script src="{{ asset('js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{ asset('js/dataTables.responsive.min.js')}}"></script>
    <script src="{{ asset('js/responsive.bootstrap4.min.js')}}"></script>

    <!-- Include library Datepicker -->
    <script src="{{ asset("panel/vendors/moment/moment.min.js")}}"></script>
    <script src="{{ asset("panel/vendors/datepicker/js/custom.js")}}"></script>
    <script src="{{ asset("panel/vendors/datepicker/js/tempusdominus-bootstrap-4.min.js")}}"></script>
    
    <!-- Include library CKEditor -->
    {{-- <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script> --}}
    <script src="{{ asset('panel/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('panel/ckeditor/adapters/jquery.js') }}"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script> --}}

    @stack('scripts')

</body>
</html>
