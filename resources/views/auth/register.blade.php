@extends('layouts.master')

@section('title', 'Register')

@section('content')
<div class="container d-flex justify-content-center align-items-center min-vh-100" style=' font-size:16px;'>
    <div class="row w-100 justify-content-center">
        <div class="col-md-8 col-lg-6"> <!-- Increased form width -->
            <div class="card border-1 rounded-4">
                <div class="card-body p-5"> <!-- Better spacing -->
                    <!-- Header -->
                    <h2 class="text-center fw-bold mb-3">Create an Account</h2>
                    <p class="text-center text-muted">Join us today!</p>

                    <!-- Session Status -->
                    @if(session('status'))
                        <div class="alert alert-success text-center py-2">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- Registration Form -->
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold" style='font-size: 16px;'>Full Name</label>
                            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                                class="form-control form-control-lg @error('name') is-invalid @enderror" style='font-size: 16px;'>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Address -->
                        <div class="mb-3">
                            <label for="address" class="form-label fw-semibold" style='font-size: 16px;'>Address</label>
                            <input id="address" type="text" name="address" value="{{ old('address') }}" required
                                class="form-control form-control-lg @error('address') is-invalid @enderror" style='font-size: 16px;'>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Phone -->
                        <div class="mb-3">
                            <label for="phone" class="form-label fw-semibold" style='font-size: 16px;'>Phone Number</label>
                            <input id="phone" type="text" name="phone" value="{{ old('phone') }}" required
                                class="form-control form-control-lg @error('phone') is-invalid @enderror" style='font-size: 16px;'>
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email Address -->
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold" style='font-size: 16px;'>Email Address</label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required
                                class="form-control form-control-lg @error('email') is-invalid @enderror" style='font-size: 16px;'>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold" style='font-size: 16px;'>Password</label>
                            <input id="password" type="password" name="password" required
                                class="form-control form-control-lg @error('password') is-invalid @enderror" style='font-size: 16px;'>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label fw-semibold" style='font-size: 16px;'>Confirm Password</label>
                            <input id="password_confirmation" type="password" name="password_confirmation" required
                                class="form-control form-control-lg" style='font-size: 16px;'>
                        </div>

                        <!-- Register Button -->
                        <button type="submit" class="btn btn-primary w-100 py-3 fw-semibold" style="border:none; background-color: #ff9800;">Register</button>

                        <!-- Already Registered Link -->
                        <div class="text-center mt-4">
                            <span class="text-muted">Already have an account?</span>
                            <a href="{{ route('login') }}" class="text-decoration-none fw-semibold">Log in here</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
