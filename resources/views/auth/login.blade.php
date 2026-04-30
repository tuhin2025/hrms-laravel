<form method="POST" action="{{ route('auth.login.submit') }}">
    @csrf

    <input type="text" name="username" placeholder="Username" class="form-control mb-2">
    <input type="password" name="password" placeholder="Password" class="form-control mb-3">

    <button class="btn btn-primary w-100">Login</button>
</form>
