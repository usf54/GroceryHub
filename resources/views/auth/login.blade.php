@extends('layouts.master')

@section('title', 'Login')

@section('content')
<div class="container d-flex justify-content-center align-items-center min-vh-100" style='font-size: 16px;'>
    <div class="row w-100 justify-content-center">
        <div class="col-md-8 col-lg-6"> <!-- Increased form width -->
            <div class="card  border-1 rounded-4">
                <div class="card-body p-5"> <!-- Increased padding for better spacing -->
                    <!-- Header -->
                    <h2 class="text-center fw-bold mb-3">Welcome Back</h2>
                    <p class="text-center text-muted">Sign in to continue</p>

                    <!-- Session Status -->
                    @if(session('status'))
                        <div class="alert alert-success text-center py-2">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- Login Form -->
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email Address -->
                        <div class="mb-4">
                            <label for="email" class="form-label fw-semibold" style='font-size: 16px;'>Email Address</label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                                class="form-control form-control-lg @error('email') is-invalid @enderror" style='font-size: 16px;'>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-4">
                            <label for="password" class="form-label fw-semibold" style='font-size: 16px;'>Password</label>
                            <input id="password" type="password" name="password" required
                                class="form-control form-control-lg @error('password') is-invalid @enderror" style='font-size: 16px;'>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Remember Me & Forgot Password -->
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input type="checkbox" name="remember" class="form-check-input" id="remember">
                                <label class="form-check-label" for="remember" style='font-size: 16px;'>Remember Me</label>
                            </div>
                            <a href="{{ route('password.request') }}" class="text-decoration-none text-primary">
                                Forgot password?
                            </a>
                        </div>

                        <!-- Login Button -->
                        <button type="submit" class="btn btn-primary w-100 py-3 fw-semibold" style="border:none; background-color: #ff9800;font-size: 16px;">Log In</button>

                        <!-- Divider -->
                        <div class="text-center my-4">
                            <span class="text-muted">OR</span>
                        </div>

                        <!-- Google Login (Optional) -->
                        <a href="#" class="btn btn-outline-dark w-100 py-3" style='font-size: 16px;'>
                            <i class="bi bi-google"></i> Sign in with Google
                        </a>

                        <!-- Register Link -->
                        <div class="text-center mt-4">
                            <span class="text-muted" style='font-size: 16px;'>Don't have an account?</span>
                            <a href="{{ route('register') }}" class="text-decoration-none fw-semibold">Register here</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection