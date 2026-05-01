<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title> Register</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            /*background: linear-gradient(135deg, #198754, #0dcaf0);*/
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .register-box {
            width: 100%;
            max-width: 450px;
            background: #fff;
            padding: 35px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .brand {
            text-align: center;
            margin-bottom: 20px;
        }

        .brand h2 {
            font-weight: bold;
            color: #198754;
        }

        .form-control {
            height: 45px;
        }

        .btn-register {
            height: 45px;
            font-weight: 600;
        }

        .small-text {
            font-size: 13px;
            text-align: center;
            margin-top: 15px;
            color: #777;
        }

        a {
            text-decoration: none;
        }
    </style>
</head>

<body>

<div class="register-box">

    <!-- Brand -->
    <div class="brand">
        <h2>HRMS</h2>
        <p class="text-muted mb-0">Create New Account</p>
    </div>

    <!-- Error Message -->
    @if(session('error'))
        <div class="alert alert-danger py-2">
            {{ session('error') }}
        </div>
    @endif

    <!-- Register Form -->
    <form method="POST" action="{{ route('auth.register.submit') }}">
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

        <!-- Email -->
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email"
                   name="email"
                   class="form-control"
                   placeholder="Enter email"
                   required>
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password"
                   name="password"
                   class="form-control"
                   placeholder="Enter password"
                   required>
        </div>

        <!-- Confirm Password (Recommended) -->
        <div class="mb-3">
            <label class="form-label">Confirm Password</label>
            <input type="password"
                   name="password_confirmation"
                   class="form-control"
                   placeholder="Confirm password"
                   required>
        </div>

        <!-- Button -->
        <button type="submit" class="btn btn-success w-100 btn-register">
            Register
        </button>
    </form>

    <!-- Footer -->
    <div class="small-text">
        Already have an account?
        <a href="{{ route('auth.login') }}">Login here</a>
    </div>

</div>

</body>

</html>

