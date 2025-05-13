@extends('layouts.master')

@section('title', 'Login')

@section('content')
<div class="container d-flex justify-content-center align-items-center min-vh-100" style='font-size: 16px;'>
    <div class="row w-100 justify-content-center">
        <div class="col-12 col-md-10 d-flex flex-column flex-md-row">
            <!-- Left Side (Logo) -->
            <div class="col-12 col-md-4 d-flex flex-column justify-content-center align-items-center bg-light rounded-start-4 p-4 mb-4 mb-md-0" style="background-color: #f8f9fa;">
                <img src="{{ asset('assets/img/logo1.png') }}" alt="Website Logo" class="img-fluid mb-3" style="max-width: 250px;">
            </div>
            <!-- Right Side (Form) -->
            <div class="col-12 col-md-8">
                <div class="card border-1 rounded-end-4">
                    <div class="card-body p-5">
                        <h2 class="text-center fw-bold mb-3">Welcome Back</h2>
                        <p class="text-center text-muted">Sign in to continue</p>
                        @if(session('status'))
                            <div class="alert alert-success text-center py-2">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <!-- Email Address -->
                            <div class="mb-4">
                                <label for="email" class="form-label fw-semibold" style='font-size: 16px;'>Email Address</label>
                                <input id="email" type="email" name="email" placeholder="azerty@aze.rty" value="{{ old('email') }}" required autofocus
                                    class="form-control form-control-lg @error('email') is-invalid @enderror" style='font-size: 16px;'>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- Password -->
                            <div class="mb-4">
                                <label for="password" class="form-label fw-semibold" style='font-size: 16px;'>Password</label>
                                <input id="password" type="password" name="password" required placeholder="password"
                                    class="form-control form-control-lg @error('password') is-invalid @enderror" style='font-size: 16px;'>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- Login Button -->
                            <button type="submit" class="btn btn-primary w-100 py-3 fw-semibold" style="border:none; background-color: #ff9800;font-size: 16px;">Log In</button>
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
</div>
@endsection