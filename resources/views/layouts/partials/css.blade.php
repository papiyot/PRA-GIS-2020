<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>BOP | @yield('title')</title>
    <meta name="author" content="deni">
    <meta name="robots" content="noindex, nofollow">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Stylesheets -->
    <!-- Fonts and Codebase framework -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,400i,600,700&display=swap">
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/codebase.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/select2/css/select2.min.css') }}">
    <!-- END Stylesheets -->
    @yield('css')
    <style>
        .select2-container {
            background: transparent;
        }

        .select2-container .select2-selection {
            border: none;
            height: 35px;
            background: transparent;
            color: white;
        }

        #select2-beli_supplier_id-container {
            color: #e9e3e3;
            line-height: 28px;
        }

        .select2-search input:first-child {
            background: transparent;
        }
    </style>
</head>
