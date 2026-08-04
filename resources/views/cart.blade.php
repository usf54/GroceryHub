@extends('layouts.master')
@section('title','Cart | GroceryHub')
@section('content')
<div class="cart-page">
    <div class="container">

        {{-- Alerts --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show alert-custom alert-success" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show alert-custom alert-danger" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- Page Title --}}
        <h2 class="cart-title">Shopping Cart</h2>

        @if(session('cart') && count(session('cart')) > 0)
            <div class="row">
                {{-- Cart Items --}}
                <div class="col-lg-8">
                    <div class="cart-items-wrapper">
                        @php $total = 0; @endphp
                        @foreach(session('cart') as $id => $item)
                            @php 
                                $total += $item['subtotal'];
                            @endphp
                            @php 
                                $imageParts = explode('-', $item['img']);
                                $imageUrl = ($imageParts[0] === 'demo') 
                                    ? asset('assets/img/demo/products/' .$item['img']) 
                                    : asset('storage/' .$item['img']);
                            @endphp
                            <div class="cart-item d-flex flex-column flex-md-row align-items-center justify-content-between">
                                {{-- Product Info --}}
                                <div class="d-flex align-items-center mb-3 mb-md-0">
                                    <img src="{{ $imageUrl }}" alt="{{ $item['name'] }}" class="product-image me-3">
                                    <div>
                                        <div class="product-name">{{ $item['name'] }}</div>
                                        <div class="product-price">Price: <strong>{{ number_format($item['price'], 2) }} MAD</strong></div>
                                    </div>
                                </div>

                                {{-- Quantity & Subtotal --}}
                                <div class="d-flex align-items-center gap-3">
                                    <span class="quantity-badge">Qty: <strong>{{ $item['quantity'] }}</strong></span>
                                    <span class="item-subtotal">{{ number_format($item['subtotal'], 2) }} MAD</span>
                                    <form action="{{ route('cart.remove', $id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="remove-btn">
                                            <svg class="me-1" width="12" height="12" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                            </svg>
                                            Remove
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Checkout Summary --}}
                <div class="col-lg-4">
                    <div class="summary-card">
                        <h4 class="summary-title">Order Summary</h4>
                        <div class="summary-row">
                            <span class="label">Subtotal</span>
                            <span class="value">{{ number_format($total, 2) }} MAD</span>
                        </div>
                        <div class="summary-row">
                            <span class="label">Shipping</span>
                            <span class="value" style="color: #b2bec3; font-weight: 400;">Calculated at checkout</span>
                        </div>
                        <div class="summary-row total">
                            <span class="label">Total</span>
                            <span class="value">{{ number_format($total, 2) }} MAD</span>
                        </div>
                        <form action="{{ route('checkout.form') }}" method="GET">
                            @csrf
                            <button type="submit" class="checkout-btn">
                                <svg class="me-2" width="18" height="18" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
                                </svg>
                                Proceed to Checkout
                            </button>
                        </form>
                        <a href="{{ route('products.list') }}" class="continue-btn">
                            <svg class="me-1" width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"/>
                            </svg>
                            Continue Shopping
                        </a>
                    </div>
                </div>
            </div>

            {{-- You Might Also Like --}}
            @if($recommendedProducts->count())
            <div class="recommended-section">
                <div class="section-header">
                    <h3>You Might Also Like</h3>
                    <a href="{{ route('products.list') }}">View All →</a>
                </div>
                <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4">
                    @foreach($recommendedProducts as $product)
                        @php
                            $imageParts = explode('-', $product->img);
                            $imageUrl = ($imageParts[0] === 'demo') 
                                ? asset('assets/img/demo/products/' . $product->img) 
                                : asset('storage/' . $product->img);
                        @endphp
                        <div class="col">
                            <div class="product-card">
                                <div class="image-wrapper">
                                    <a href="{{ route('product.show', $product->id) }}">
                                        <img src="{{ $imageUrl }}" alt="{{ $product->name }}">
                                    </a>
                                </div>
                                <div class="card-body">
                                    <div class="name">{{ $product->name }}</div>
                                    <span class="stock-badge {{ $product->stock > 0 ? 'bg-success bg-opacity-10 text-success' : 'bg-danger bg-opacity-10 text-danger' }}">
                                        {{ $product->stock > 0 ? '✓ Available' : '✗ Not available' }} ({{$product->stock}})
                                    </span>
                                    <span class="price">{{ number_format($product->price, 2) }} MAD</span>
                                    <a href="{{ route('product.show', $product->id) }}" class="view-btn">
                                        <svg width="14" height="14" class="me-1"><use xlink:href="#cart"></use></svg>
                                        View Product
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif
        @else
            {{-- Empty Cart --}}
            <div class="empty-cart">
                <span class="icon">🛒</span>
                <h4>Your cart is empty</h4>
                <p>Browse our products and add your favorites to the cart.</p>
                <a href="{{ route('products.list') }}" class="shop-btn">
                    <svg class="me-2" width="18" height="18" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M4 3a1 1 0 011-1h10a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V3zM3 7a1 1 0 011-1h12a1 1 0 011 1v10a1 1 0 01-1 1H4a1 1 0 01-1-1V7z"/>
                    </svg>
                    Continue Shopping
                </a>
            </div>
        @endif
    </div>
</div>
@endsection