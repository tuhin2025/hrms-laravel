<!DOCTYPE html>
<html>
<head>
    <title>HRMS Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
        }

        .sidebar {
            width: 230px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: #2c3e50;
        }

        .sidebar a {
            display: block;
            padding: 12px;
            color: #ccc;
            text-decoration: none;
        }

        .sidebar a:hover {
            background: #34495e;
            color: white;
        }

        .main {
            margin-left: 230px;
            padding-top: 40px; /* header height */
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .header {
            position: fixed;
            top: 0;
            left: 230px; /* sidebar width */
            right: 0;
            height: 45px;
            z-index: 1000;
            background: #f8f9fa;
            border-bottom: 1px solid #ddd;
        }

        .content {
            padding: 20px;
        }
        .footer {
            background: #f8f9fa;
            text-align: center;
            padding: 10px;
            border-top: 1px solid #ddd;

            position: fixed;
            bottom: 0;
            left: 230px; /* sidebar width */
            right: 0;
            z-index: 999;
        }

        html, body {
            height: 100%;
        }

        .main {
            margin-left: 230px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .content-wrapper {
            flex: 1;
            padding: 20px;
        }

        .content-wrapper {
            flex: 1;
            padding: 20px;
            overflow-y: auto;
        }
    </style>
</head>
<body>

@include('partials.sidebar')

<div class="main">


    @include('partials.header')
    <div class="bg-light px-3 py-2 border-bottom">
        @yield('breadcrumb')
    </div>

    <div class="content-wrapper">
        @yield('content')
    </div>


    @include('partials.footer')

</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@stack('scripts')
@if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: '{{ session('success') }}',
            timer: 2000,
            showConfirmButton: false
        });
    </script>

@endif
</body>
</html>
