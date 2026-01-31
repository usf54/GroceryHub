@extends('layouts.master')
@section('title','Checkout | GroceryHub')
@section('content')
<div class="container my-5">

    {{-- Page Title --}}
    <h2 class="mb-4 fw-bold text-center">Checkout</h2>

    @if(session('cart') && count(session('cart')) > 0)
        <form action="{{ route('payment.create') }}" method="POST">
            @csrf
            <div class="row g-4">
                {{-- Shipping Info --}}
                <div class="col-lg-8">
                    <div class="card shadow-sm border">
                        <div class="card-header bg-white">
                            <h4 class="mb-0 fw-bold">Shipping Information</h4>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="address" class="form-label fw-semibold">Address</label>
                                <input type="text" class="form-control" id="address" name="address" placeholder="123 Main Street" required>
                            </div>
                            <div class="mb-3">
                                <label for="city" class="form-label fw-semibold">City</label>
                                <input type="text" class="form-control" id="city" name="city" placeholder="Casablanca" required>
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label fw-semibold">Phone Number</label>
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="+212 6 12 34 56 78" required>
                            </div>

                            {{-- Hidden fields to pass totals --}}
                            <input type="hidden" name="total" value="{{ $total }}">
                            <input type="hidden" name="discount" value="{{ $discount }}">
                            <input type="hidden" name="shipping" value="{{ $shipping }}">
                            <input type="hidden" name="final_total" value="{{ $finalTotal }}">
                        </div>
                    </div>
                </div>

                {{-- Order Summary --}}
                <div class="col-lg-4">
                    <div class="card shadow-sm border sticky-top" style="top:100px;">
                        <div class="card-header bg-white">
                            <h4 class="mb-0 fw-bold">Order Summary</h4>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush mb-3">
                                @foreach(session('cart') as $id => $item)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span>{{ $item['name'] }} × {{ $item['quantity'] }}</span>
                                        <span>{{ number_format($item['subtotal'], 2) }} MAD</span>
                                    </li>
                                @endforeach

                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Subtotal</span>
                                    <span>{{ number_format($total, 2) }} MAD</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between text-success">
                                    <span>Discount</span>
                                    <span>– {{ number_format($discount, 2) }} MAD</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between text-muted">
                                    <span>Shipping</span>
                                    <span>{{ number_format($shipping, 2) }} MAD</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between fw-bold">
                                    <span>Total</span>
                                    <span>{{ number_format($finalTotal, 2) }} MAD</span>
                                </li>
                            </ul>
                        </div>
                        <div class="card-footer bg-white">
                            <button type="submit" class="btn btn-primary w-100 btn-lg">Place Order</button>
                            <a href="{{ route('products.list') }}" class="btn btn-outline-secondary w-100 mt-2">Continue Shopping</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    @else
        {{-- Empty Cart --}}
        <div class="text-center py-5">
            <h4 class="mb-3 fw-bold">Your cart is empty</h4>
            <p class="mb-4 text-muted">Browse our products and add your favorites to complete your order.</p>
            <a href="{{ route('products.list') }}" class="btn btn-primary btn-lg">Continue Shopping</a>
        </div>
    @endif
</div>
@endsection
