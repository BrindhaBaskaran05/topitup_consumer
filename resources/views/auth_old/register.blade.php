<form method="POST" action="{{ route('register.submit') }}">
    @csrf

    <div>
        <label>First Name</label>
        <input
            type="text"
            name="first_name"
            value="{{ old('first_name') }}"
            required
        >

        @error('first_name')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label>Last Name</label>
        <input
            type="text"
            name="last_name"
            value="{{ old('last_name') }}"
            required
        >

        @error('last_name')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label>Email</label>
        <input
            type="email"
            name="email"
            value="{{ old('email') }}"
            required
        >

        @error('email')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label>Mobile</label>
        <input
            type="text"
            name="mobile"
            value="{{ old('mobile') }}"
            required
        >

        @error('mobile')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label>Password</label>
        <input
            type="password"
            name="password"
            required
        >

        @error('password')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label>Confirm Password</label>
        <input
            type="password"
            name="password_confirmation"
            required
        >
    </div>

    <button type="submit">
        Register
    </button>
</form>