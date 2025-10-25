@extends('layouts.master')
@section('title','Profile | GroceryHub')
@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/profile.css') }}">
@endpush

@section('content')
<div class="container py-4">
    <div class="profile-header">
        <h2>Hello, {{ $user->name }}</h2>
        <p class="mb-0">Here’s an overview of your profile and recent orders.</p>
    </div>

    <div class="profile-info mb-4">
        <h4 class="mb-3">Your Information</h4>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Phone:</strong> {{ $user->phone ?? 'Not provided' }}</p>
        <p><strong>Address:</strong> {{ $user->address ?? 'Not provided' }}</p>
    </div>

    <hr>

    <div class="orders-section">
        <h4 class="mb-3">Recent Orders</h4>

        @forelse($user->orders as $order)
            <div class="order-card mb-3">
                <div class="order-header d-flex justify-content-between align-items-center">
                    <div>
                        <span>Order #{{ $order->id }}</span>
                        @php
                            $statusClass = match($order->status) {
                                'completed' => 'status-completed',
                                'shipped' => 'status-shipped',
                                default => 'status-pending'
                            };
                        @endphp
                        <span class="status-badge {{ $statusClass }}">{{ ucfirst($order->status) }}</span>
                    </div>
                    <span class="text-muted small">{{ $order->order_date }}</span>
                </div>
                <div class="order-body">
                    <p><strong>Total:</strong> {{ $order->final_total }} MAD</p>
                    <p><strong>Shipping:</strong> {{ $order->shipping }} MAD</p>

                    @if($order->orderDetails->count())
                        <h6 class="mt-3">Products:</h6>
                        <ul>
                            @foreach($order->orderDetails as $detail)
                                <li>{{ $detail->product->name }} × {{ $detail->quantity }} ({{ $detail->subtotal }} MAD)</li>
                            @endforeach
                        </ul>
                    @endif

                    @if($order->orderPackDetails->count())
                        <h6 class="mt-3">Packs:</h6>
                        <ul>
                            @foreach($order->orderPackDetails as $pack)
                                <li>{{ $pack->pack->name }} × {{ $pack->quantity }} ({{ $pack->subtotal }} MAD)</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        @empty
            <p class="text-muted">You haven’t placed any orders yet.</p>
        @endforelse

        <div class="text-center mt-4">
            <a href="{{ route('orders.history') }}" class="view-all-btn">View All Orders</a>
        </div>
    </div>
</div>
@endsection
