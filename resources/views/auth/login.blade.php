
    <div class="container">
        <h2>Login</h2>
        <form action="{{ route('auth.login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
                @error('email') <div class="alert alert-danger">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control" required>
                @error('password') <div class="alert alert-danger">{{ $message }}</div> @enderror
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
