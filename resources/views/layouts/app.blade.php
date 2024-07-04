<!DOCTYPE html>


<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ekash : Personal Finance Management Admin Dashboard HTML Template</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon.png') }}">
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/toastr/toastr.min.css') }}">
    @livewireStyles
</head>

<body class="dashboard">
    {{-- <div id="preloader" class="preloader-wrapper">
        <div class="loader">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div> --}}


    @if (Route::currentRouteName() != 'login' && Route::currentRouteName() != 'register')
        @include('layouts.partials.header')
        @include('layouts.partials.sidebar')
    @endif

    @yield('content')

    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('vendor/toastr/toastr-init.js') }}"></script>
    <script src="{{ asset('vendor/circle-progress/circle-progress.min.js') }}"></script>
    <script src="{{ asset('vendor/circle-progress/circle-progress-init.js') }}"></script>
    <script src="{{ asset('vendor/chartjs/chartjs.js') }}"></script>
    <script src="{{ asset('js/plugins/chartjs-bar-income-vs-expense.js') }}"></script>
    <script src="{{ asset('js/plugins/chartjs-bar-weekly-expense.js') }}"></script>
    <script src="{{ asset('js/plugins/chartjs-profile-wallet.js') }}"></script>
    <script src="{{ asset('js/plugins/chartjs-profile-wallet2.js') }}"></script>
    <script src="{{ asset('js/plugins/chartjs-profile-wallet3.js') }}"></script>
    <script src="{{ asset('js/plugins/chartjs-profile-wallet4.js') }}"></script>
    <!--  -->
    <!--  -->
    <script src="{{ asset('vendor/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('js/plugins/perfect-scrollbar-init.js') }}"></script>
    <script src="{{ asset('vendor/circle-progress/circle-progress.min.js') }}"></script>
    <script src="{{ asset('js/plugins/circle-progress-init.js') }}"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
    @livewireScripts
</body>


</html>
