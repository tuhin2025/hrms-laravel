<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title> Login</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="D:\hrms-laravel\rag-dolls-one-blue.jpg">

    <style>
        body {
            background: url("{{ asset('rag-dolls-one-blue.jpg') }}") no-repeat center center fixed;
            {{--background: url("{{ asset('business-meeting-about-employment.jpg') }}") no-repeat center center fixed;--}}
            background-size: 100% 100%;
            width: 100%;
            height: 100vh;
            margin: 0;

            display: flex;
            align-items: center;

            /* Left Side */
            justify-content: flex-start;

            padding-left: 80px;
        }

        .login-box {
            width: 420px;

            background: rgb(17 35 40 / 28%);
            padding: 24px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(13, 15, 14, 0.2);
        }


        /*.login-box{*/
        /*    width: 420px;*/
        /*    padding: 35px;*/

        /*    !* Move Left *!*/
        /*    margin-left: 80px;*/

        /*    background: rgba(255,255,255,0.20);*/
        /*    backdrop-filter: blur(10px);*/

        /*    border-radius: 20px;*/
        /*    box-shadow: 0 8px 25px rgba(0,0,0,0.25);*/
        /*}*/

        .brand {
            text-align: center;
            margin-bottom: 20px;
        }

        .brand h2 {
            font-weight: bold;
            color: #0d6efd;
        }

        .form-control {
            height: 45px;
        }

        .btn-login {
            height: 45px;
            font-weight: 600;
        }

        .text-muted {
            color: #fff !important;
        }

        .brand h2 {
            font-weight: bold;
            color: #fff !important;
        }

        .small-text {
            font-size: 13px;
            text-align: center;
            margin-top: 15px;
            color: #ffffff;
        }


    </style>
</head>

<body>

<div class="login-box">

    <!-- Brand -->
    <div class="brand">
        <h2>HRMS</h2>
        <p class="text-muted mb-0">Human Resource Management System</p>
    </div>

    <!-- Error Message -->
    @if(session('error'))
        <div class="alert alert-danger py-2">
            {{ session('error') }}
        </div>
    @endif

    <!-- Login Form -->
    <form method="POST" action="{{ route('auth.login.submit') }}">
        @csrf

        <!-- Username -->
        <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text"
                   name="username"
                   class="form-control"
                   placeholder="Enter username"
                   required>
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label class="form-label ">Password</label>
            <input type="password"
                   name="password"
                   class="form-control"
                   placeholder="Enter password"
                   required>
        </div>

        <!-- Remember -->
        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="remember">
            <label class="form-check-label">Remember me</label>
        </div>

        <!-- Button -->
        <button type="submit" class="btn btn-primary w-100 btn-login">
            Login
        </button>
        <!-- Register Link -->
        <div class="text-center  mt-3">
            <small class="text-muted">
                <span class="small-text">Don’t have an account?</span>
                <a href="{{ route('auth.register') }}" class="text-decoration-none">
                    <span class="small-text">Create Account</span>
                </a>
            </small>
        </div>
    </form>

    <div class="small-text">
        © {{ date('Y') }} HRMS System
    </div>

</div>

</body>
</html>
