<!DOCTYPE html>


<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ekash : Personal Finance Management Admin Dashboard HTML Template</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="vendor/toastr/toastr.min.css">
    {{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" /> --}}
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
        @include('layout.partials.header')
        @include('layout.partials.sidebar')
    @endif

    @yield('content')

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/toastr/toastr.min.js"></script>
    <script src="vendor/toastr/toastr-init.js"></script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/circle-progress/circle-progress-init.js"></script>
    <script src="vendor/chartjs/chartjs.js"></script>
    <script src="js/plugins/chartjs-bar-income-vs-expense.js"></script>
    <script src="js/plugins/chartjs-bar-weekly-expense.js"></script>
    <script src="js/plugins/chartjs-profile-wallet.js"></script>
    <script src="js/plugins/chartjs-profile-wallet2.js"></script>
    <script src="js/plugins/chartjs-profile-wallet3.js"></script>
    <script src="js/plugins/chartjs-profile-wallet4.js"></script>
    <!--  -->
    <!--  -->
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="js/plugins/perfect-scrollbar-init.js"></script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="js/plugins/circle-progress-init.js"></script>
    <script src="js/scripts.js"></script>
</body>


</html>
