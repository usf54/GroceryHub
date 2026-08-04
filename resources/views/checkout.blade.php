@extends('layouts.master')
@section('title','Checkout | GroceryHub')
@section('content')
<style>
    .checkout-page {
        background: #f8f9fa;
        padding: 40px 0;
    }
    
    .checkout-title {
        font-size: 2rem;
        font-weight: 600;
        color: #2d3436;
        margin-bottom: 30px;
        position: relative;
        display: inline-block;
    }
    .checkout-title::after {
        content: '';
        position: absolute;
        bottom: -8px;
        left: 0;
        width: 60px;
        height: 3px;
        background: #00b894;
        border-radius: 2px;
    }
    
    /* Card Styles - Match Website */
    .checkout-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.06);
        border: none;
        overflow: hidden;
    }
    
    .checkout-card .card-header {
        background: white;
        padding: 20px 24px;
        border-bottom: 2px solid #f0f0f0;
    }
    .checkout-card .card-header h4 {
        font-weight: 600;
        color: #2d3436;
        font-size: 1.1rem;
        margin: 0;
    }
    
    .checkout-card .card-body {
        padding: 24px;
    }
    
    .checkout-card .card-footer {
        background: white;
        padding: 20px 24px;
        border-top: 2px solid #f0f0f0;
    }
    
    /* Form Styles */
    .form-label {
        font-weight: 500;
        color: #2d3436;
        font-size: 0.9rem;
        margin-bottom: 6px;
    }
    
    .form-control {
        border-radius: 8px;
        border: 1px solid #dfe6e9;
        padding: 10px 14px;
        font-size: 0.95rem;
        transition: all 0.2s ease;
        background: #fafbfc;
    }
    .form-control:focus {
        border-color: #00b894;
        box-shadow: 0 0 0 3px rgba(0, 184, 148, 0.1);
        background: white;
    }
    .form-control::placeholder {
        color: #b2bec3;
    }
    
    /* Summary Styles */
    .summary-item {
        display: flex;
        justify-content: space-between;
        padding: 10px 0;
        border-bottom: 1px solid #f0f0f0;
        font-size: 0.95rem;
    }
    .summary-item:last-child {
        border-bottom: none;
    }
    .summary-item .label {
        color: #636e72;
    }
    .summary-item .value {
        color: #2d3436;
        font-weight: 500;
    }
    .summary-item.discount .value {
        color: #00b894;
    }
    .summary-item.shipping .value {
        color: #636e72;
    }
    .summary-item.total {
        padding-top: 14px;
        margin-top: 8px;
        border-top: 2px solid #f0f0f0;
        font-size: 1.05rem;
    }
    .summary-item.total .label {
        font-weight: 600;
        color: #2d3436;
    }
    .summary-item.total .value {
        font-weight: 700;
        color: #00b894;
        font-size: 1.2rem;
    }
    
    .product-item {
        display: flex;
        justify-content: space-between;
        padding: 8px 0;
        font-size: 0.9rem;
        border-bottom: 1px solid #f8f9fa;
    }
    .product-item:last-child {
        border-bottom: none;
    }
    .product-item .name {
        color: #2d3436;
        font-weight: 500;
    }
    .product-item .qty {
        color: #636e72;
        margin: 0 4px;
    }
    .product-item .price {
        color: #2d3436;
        font-weight: 500;
    }
    
    /* Button Styles - Match Website */
    .place-order-btn {
        background: #00b894;
        border: none;
        border-radius: 8px;
        padding: 14px;
        font-weight: 600;
        font-size: 1rem;
        color: white;
        width: 100%;
        transition: all 0.2s ease;
    }
    .place-order-btn:hover {
        background: #00a381;
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0, 184, 148, 0.3);
        color: white;
    }
    
    .continue-btn {
        background: none;
        border: 1px solid #dfe6e9;
        border-radius: 8px;
        padding: 12px;
        font-weight: 500;
        color: #636e72;
        width: 100%;
        transition: all 0.2s ease;
        margin-top: 10px;
        text-align: center;
        display: block;
        text-decoration: none;
    }
    .continue-btn:hover {
        background: #f8f9fa;
        border-color: #b2bec3;
        color: #2d3436;
        text-decoration: none;
    }
    
    /* Badge for section */
    .section-badge {
        display: inline-block;
        background: #00b894;
        color: white;
        font-size: 0.7rem;
        padding: 2px 10px;
        border-radius: 20px;
        font-weight: 500;
        margin-left: 8px;
        vertical-align: middle;
    }
    
    /* Empty Cart - Match Website */
    .empty-checkout {
        text-align: center;
        padding: 60px 20px;
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.04);
    }
    .empty-checkout .icon {
        font-size: 64px;
        color: #dfe6e9;
        margin-bottom: 20px;
        display: block;
    }
    .empty-checkout h4 {
        font-weight: 600;
        color: #2d3436;
        margin-bottom: 12px;
    }
    .empty-checkout p {
        color: #636e72;
        margin-bottom: 24px;
    }
    .empty-checkout .shop-btn {
        background: #00b894;
        color: white;
        border: none;
        border-radius: 8px;
        padding: 12px 40px;
        font-weight: 600;
        transition: all 0.2s ease;
        display: inline-block;
        text-decoration: none;
    }
    .empty-checkout .shop-btn:hover {
        background: #00a381;
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0, 184, 148, 0.3);
        color: white;
        text-decoration: none;
    }
    
    /* Sticky Summary */
    .summary-sticky {
        position: sticky;
        top: 100px;
    }
    
    /* Mobile Responsive */
    @media (max-width: 768px) {
        .checkout-page {
            padding: 20px 0;
        }
        .checkout-title {
            font-size: 1.5rem;
        }
        .checkout-card .card-header {
            padding: 16px 20px;
        }
        .checkout-card .card-body {
            padding: 16px 20px;
        }
        .checkout-card .card-footer {
            padding: 16px 20px;
        }
        .summary-sticky {
            position: relative;
            top: 0;
            margin-top: 20px;
        }
        .form-control {
            font-size: 0.9rem;
            padding: 8px 12px;
        }
    }
    
    /* Animation */
    .fade-in {
        animation: fadeIn 0.5s ease;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<div class="checkout-page fade-in">
    <div class="container">

        {{-- Page Title --}}
        <h2 class="checkout-title">Checkout</h2>

            <form action="{{ route('payment.create') }}" method="POST">
                @csrf
                <div class="row g-4">
                    {{-- Shipping Info --}}
                    <div class="col-lg-8">
                        <div class="checkout-card">
                            <div class="card-header">
                                <h4>
                                    <svg class="me-2" width="18" height="18" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                    </svg>
                                    Shipping Information
                                    <span class="section-badge">Required</span>
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="address" class="form-label">
                                        <svg class="me-1" width="14" height="14" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                        </svg>
                                        Address
                                    </label>
                                    <input type="text" class="form-control" id="address" name="address" placeholder="123 Main Street, Building Name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="city" class="form-label">
                                        <svg class="me-1" width="14" height="14" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                                        </svg>
                                        City
                                    </label>
                                    <input type="text" class="form-control" id="city" name="city" placeholder="Casablanca, Rabat, Marrakech" required>
                                </div>
                                <div class="mb-0">
                                    <label for="phone" class="form-label">
                                        <svg class="me-1" width="14" height="14" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                                        </svg>
                                        Phone Number
                                    </label>
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
                        <div class="checkout-card summary-sticky">
                            <div class="card-header">
                                <h4>
                                    <svg class="me-2" width="18" height="18" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M4 3a1 1 0 011-1h10a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V3zM3 7a1 1 0 011-1h12a1 1 0 011 1v10a1 1 0 01-1 1H4a1 1 0 01-1-1V7z"/>
                                    </svg>
                                    Order Summary
                                    <span class="section-badge">{{ count(session('cart')) }} items</span>
                                </h4>
                            </div>
                            <div class="card-body">
                                {{-- Product Items --}}
                                @foreach(session('cart') as $id => $item)
                                    <div class="product-item">
                                        <span class="name">
                                            {{ $item['name'] }}
                                            <span class="qty">× {{ $item['quantity'] }}</span>
                                        </span>
                                        <span class="price">{{ number_format($item['subtotal'], 2) }} MAD</span>
                                    </div>
                                @endforeach

                                <div style="border-top: 1px solid #f0f0f0; margin: 12px 0;"></div>

                                {{-- Totals --}}
                                <div class="summary-item">
                                    <span class="label">Subtotal</span>
                                    <span class="value">{{ number_format($total, 2) }} MAD</span>
                                </div>
                                <div class="summary-item discount">
                                    <span class="label">Discount</span>
                                    <span class="value">– {{ number_format($discount, 2) }} MAD</span>
                                </div>
                                <div class="summary-item shipping">
                                    <span class="label">Shipping</span>
                                    <span class="value">{{ number_format($shipping, 2) }} MAD</span>
                                </div>
                                <div class="summary-item total">
                                    <span class="label">Total</span>
                                    <span class="value">{{ number_format($finalTotal, 2) }} MAD</span>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="place-order-btn">
                                    <svg class="me-2" width="18" height="18" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd"/>
                                    </svg>
                                    Place Order
                                </button>
                                <a href="{{ route('products.list') }}" class="continue-btn">
                                    <svg class="me-1" width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"/>
                                    </svg>
                                    Continue Shopping
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
    </div>
</div>
@endsection