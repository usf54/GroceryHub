@extends('layouts.master')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Checkout</h2>

    @if(session('cart') && count(session('cart')) > 0)
        <form action="{{ route('checkout.submit') }}" method="POST">
            @csrf
            <div class="row">
                <!-- Shipping Info -->
                <div class="col-md-8">
                    <div class="card mb-4">
                        <div class="card-header bg-white">
                            <h4>Shipping Information</h4>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" name="address" required>
                            </div>
                            <div class="mb-3">
                                <label for="city" class="form-label">City</label>
                                <input type="text" class="form-control" id="city" name="city" required>
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="text" class="form-control" id="phone" name="phone" required>
                            </div>

                            <!-- Hidden Fields to Pass Totals -->
                            <input type="hidden" name="total" value="{{ $total }}">
                            <input type="hidden" name="discount" value="{{ $discount }}">
                            <input type="hidden" name="shipping" value="{{ $shipping }}">
                            <input type="hidden" name="final_total" value="{{ $finalTotal }}">
                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header bg-white">
                            <h4>Order Summary</h4>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                @foreach(session('cart') as $id => $item)
                                    <li class="list-group-item d-flex justify-content-between">
                                        <span>{{ $item['name'] }} × {{ $item['quantity'] }}</span>
                                        <span>{{ number_format($item['subtotal'], 2) }}mad</span>
                                    </li>
                                @endforeach

                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Subtotal</span>
                                    <span>{{ number_format($total, 2) }}mad</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between text-success">
                                    <span>Discount</span>
                                    <span>– {{ number_format($discount, 2) }}mad</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between text-muted">
                                    <span>Shipping</span>
                                    <span>{{ number_format($shipping, 2) }}mad</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between fw-bold">
                                    <span>Total</span>
                                    <span>{{ number_format($finalTotal, 2) }}mad</span>
                                </li>
                            </ul>
                        </div>
                        <div class="card-footer bg-white">
                            <button type="submit" class="btn btn-primary w-100">Place Order</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    @else
        <div class="alert alert-info">
            Your cart is empty.
            <a href="{{ route('products.list') }}" class="alert-link">Continue shopping</a>
        </div>
    @endif
</div>
@endsection
