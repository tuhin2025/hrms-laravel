<!DOCTYPE html>
<html>
<head>
    <title>HRMS Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { margin: 0; }

        .sidebar {
            width: 230px;
            height: 100vh;
            position: fixed;
            background: #2c3e50;
            color: white;
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
        }

        .header {
            background: #f8f9fa;
            padding: 10px 20px;
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
            flex: 1;   /* pushes footer down */
            padding: 20px;
        }

        .footer {
            background: #f8f9fa;
            text-align: center;
            padding: 10px;
            border-top: 1px solid #ddd;
        }
    </style>
</head>
<body>

@include('partials.sidebar')

<div class="main">

    @include('partials.header')

    <div class="content-wrapper">
        @yield('content')
    </div>

    @include('partials.footer')

</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
