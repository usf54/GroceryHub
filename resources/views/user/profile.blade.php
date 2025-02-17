@extends('layouts.master')
@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/user-profile.css') }}">
@endpush
@section('title', 'Profile')
@section('content')
<section >
    <div class="profile-container"> 
      
        <div class="profile-card">
            <div class="profile-info">
                <h2>Personal Information</h2>
                <p><strong>Full Name:</strong> </p>
                <p><strong>Email:</strong></p>
            </div>

            <div class="profile-actions">
                <form action="" method="POST">
                    @csrf
                    <button class="action-btn" type="submit">Logout</button>
                </form>
            </div>
        </div>
        
        <div class="profile-form">
            <h2>Update Your Profile</h2>
          
            <form action="" method="POST">
                @csrf
                @method('PUT')
                
                <label for="firstName">First Name</label>
                <input type="text" name="firstName" value="" required><br>
                
                <label for="lastName">Last Name</label>
                <input type="text" name="lastName" value="" required><br>
                
                <label for="phone">Phone</label>
                <input type="text" name="phone" value="" required><br>
                
                <label for="adresse">Address</label>
                <input type="text" name="adresse" value="" required><br>
                
                <button type="submit" class="action-btn">Update Profile</button>
            </form>
            <form action="" method="POST">
                @csrf
                
                <label for="firstName">First Name</label>
                <input type="text" name="firstName" required><br>
                
                <label for="lastName">Last Name</label>
                <input type="text" name="lastName" required><br>

                <label for="phone">Phone</label>
                <input type="text" name="phone" required><br>

                <label for="adresse">Address</label>
                <input type="text" name="adresse" required><br>

                <button type="submit" class="action-btn">Create Profile</button>
            </form>
        </div>
    </div>
        
    
</section>

@endsection