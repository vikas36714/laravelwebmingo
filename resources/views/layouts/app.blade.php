<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>SERVIINGO - Admin</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap-4.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div id="app">
        @include('layouts.header')
        <main >
            @yield('content')
        </main>
        @include('layouts.footer')
        <script src="{{ asset('js/jquery.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/poppers.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/bootstrap-4.js') }}" type="text/javascript"></script>
        <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
        <script src="{{ asset('js/custom.js') }}" type="text/javascript"></script>

        <!-- Ajax Codes Page Load-->
        @include('admin.ajax')
        <!-- Ajax Codes Page End Load-->
        <script type="text/javascript">
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        </script>

        @stack('scripts')

    </div>
</body>
</html>
