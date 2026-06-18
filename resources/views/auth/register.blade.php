<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
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

    <!-- Error Alert (optional fallback) -->
    @if(session('error'))
        <div class="alert alert-danger py-2">
            {{ session('error') }}
        </div>
@endif

<!-- Register Form -->
    <form id="registerForm" method="POST" action="{{ route('auth.register.submit') }}" autocomplete="off">
        @csrf

        <div class="mb-3">
            <label>Username</label>
            <input type="text" name="username" class="form-control" autocomplete="off" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" autocomplete="off" required>
        </div>

        <div class="mb-3">
            <label>Password</label>

            <div class="input-group">
                <input type="password"
                       id="password"
                       name="password"
                       class="form-control"
                       autocomplete="new-password"
                       required>

                <button class="btn btn-outline-secondary" type="button"
                        onclick="togglePassword('password', this)">
                    👁️
                </button>
            </div>
        </div>


        <div class="mb-3">
            <label>Confirm Password</label>

            <div class="input-group">
                <input type="password"
                       id="password_confirmation"
                       name="password_confirmation"
                       class="form-control"
                       autocomplete="new-password"
                       required>

                <button class="btn btn-outline-secondary" type="button"
                        onclick="togglePassword('password_confirmation', this)">
                    👁️
                </button>
            </div>
        </div>

        <button type="submit" class="btn btn-success w-100 btn-register">
            Register
        </button>
    </form>

    <div class="small-text">
        Already have an account?
        <a href="{{ route('auth.login') }}">Login here</a>
    </div>

</div>

<!-- SweetAlert CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: "{{ session('success') }}",
            timer: 2500,
            showConfirmButton: false
        });
    </script>
@endif

@if(session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: "{{ session('error') }}"
        });
    </script>
@endif

<!-- VALIDATION ERROR -->
@if ($errors->any())
    <script>
        Swal.fire({
            icon: 'warning',
            title: 'Validation Error',
            html: `{!! implode('<br>', $errors->all()) !!}`
        });
    </script>
@endif


<script>

    function togglePassword(id, btn) {
        let input = document.getElementById(id);

        if (input.type === "password") {
            input.type = "text";
            btn.innerHTML = "👁️";
        } else {
            input.type = "password";
            btn.innerHTML = "👁️";
        }
    }
</script>
</body>
</html>
