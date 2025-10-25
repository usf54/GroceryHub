@extends('layouts.master')
@section('title', 'All Orders || GroceryHub')
@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/profile.css') }}">
@endpush
@section('content')
<div class="container py-4">
    <h3 class="mb-4">All Your Orders</h3>

    @forelse ($orders as $order)
        <div class="card mb-3">
            <div class="card-header d-flex justify-content-between align-items-center">
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
            <div class="card-body">
                <p><strong>Total:</strong> {{ $order->final_total }} MAD</p>
                <p><strong>Shipping:</strong> {{ $order->shipping }} MAD</p>
                <p><strong>Address:</strong> {{ $order->address ?? 'N/A' }}</p>
            </div>
        </div>
    @empty
        <p class="text-muted">You haven’t placed any orders yet.</p>
    @endforelse
</div>
@endsection
