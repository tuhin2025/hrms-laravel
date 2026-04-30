<form method="POST" action="{{ route('auth.register.submit') }}">
    @csrf

    <input type="text" name="username" placeholder="Username" class="form-control mb-2">
    <input type="email" name="email" placeholder="Email" class="form-control mb-2">
    <input type="password" name="password" placeholder="Password" class="form-control mb-3">

    <button class="btn btn-success w-100">Register</button>
</form>
