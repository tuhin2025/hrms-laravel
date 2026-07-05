<!DOCTYPE html>
<html>
<head>
    <title>HRMS Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">


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

    /*    Nofification*/
        .header{
            height:60px;
            background:#fff;
            position:fixed;
            top:0;
            left:230px;
            right:0;
            z-index:1000;
        }

        .notification-btn{
            position:relative;
            text-decoration:none;
            color:#495057;
            font-size:22px;
            transition:.3s;
        }

        .notification-btn:hover{
            color:#0d6efd;
        }

        .notification-btn:hover i{
            transform:rotate(15deg);
        }

        .notification-count{
            position:absolute;
            top:-8px;
            right:-10px;
            background:#dc3545;
            color:#fff;
            font-size:10px;
            min-width:18px;
            height:18px;
            border-radius:50px;
            display:flex;
            justify-content:center;
            align-items:center;
            font-weight:600;
        }

        .notification-dropdown{
            width:380px;
            border:none;
            border-radius:15px;
            overflow:hidden;
            box-shadow:0 10px 30px rgba(0,0,0,.15);
        }

        .notification-header{
            display:flex;
            justify-content:space-between;
            align-items:center;
            padding:15px 20px;
            border-bottom:1px solid #eee;
        }

        .notification-body{
            max-height:420px;
            overflow-y:auto;
        }

        .notification-item{
            display:flex;
            align-items:flex-start;
            padding:15px;
            text-decoration:none;
            color:#333;
            transition:.25s;
            border-bottom:1px solid #f3f3f3;
        }

        .notification-item:hover{
            background:#f8f9fa;
        }

        .notification-icon{
            width:45px;
            height:45px;
            border-radius:50%;
            background:#0d6efd;
            color:#fff;
            display:flex;
            align-items:center;
            justify-content:center;
            flex-shrink:0;
        }

        .notification-content{
            flex:1;
            margin-left:15px;
        }

        .notification-content small{
            color:#6c757d;
        }

        .notification-dot{
            width:10px;
            height:10px;
            border-radius:50%;
            background:#0d6efd;
            margin-top:8px;
        }

        .notification-footer{
            padding:12px;
            text-align:center;
            border-top:1px solid #eee;
        }

        .notification-footer a{
            text-decoration:none;
            font-weight:600;
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://www.gstatic.com/charts/loader.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.5.0"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
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
