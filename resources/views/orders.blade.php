@extends('layouts.master')

@section('content')
<div class="container mt-5">
    <h2>Order History</h2>

    @if($orders->count() > 0)
        @foreach($orders as $order)
            <div class="card mb-4">
                <div class="card-header">
                    <strong>Order #{{ $order->id }}</strong> - {{ $order->status }} | Date: {{ $order->order_date->format('d M Y') }}
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->orderDetails as $detail)
                                <tr>
                                    <td>{{ $detail->product->name }}</td>
                                    <td>{{ $detail->quantity }}</td>
                                    <td>${{ number_format($detail->subtotal, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <h5>Total: ${{ number_format($order->total, 2) }}</h5>
                </div>
            </div>
        @endforeach
    @else
        <p>You have no orders.</p>
        <a href="{{ route('products.list') }}" class="btn btn-primary">Shop Now</a>
    @endif
</div>
@endsection
