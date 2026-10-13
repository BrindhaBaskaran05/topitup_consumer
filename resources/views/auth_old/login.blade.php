<form method="POST" action="{{ route('login.submit') }}">
    @csrf

    <input
        type="email"
        name="email"
        value="{{ old('email') }}"
        required
    >

    <input
        type="password"
        name="password"
        required
    >

    <button type="submit">
        Login
    </button>
</form>