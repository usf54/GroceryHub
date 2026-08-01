@extends('layouts.master')
@section('title','Cart | GroceryHub')
@section('content')
<div class="container my-5">

    {{-- Alerts --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Page Title --}}
    <h2 class="mb-4 fw-bold text-center">Shopping Cart</h2>

    @if(session('cart') && count(session('cart')) > 0)
        <div class="row">
            {{-- Cart Items --}}
            <div class="col-lg-8 mb-4">
                <div class="list-group shadow-sm border">
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
                        <div class="list-group-item d-flex flex-column flex-md-row align-items-center justify-content-between py-3 border-bottom">
                            {{-- Product Info --}}
                            <div class="d-flex align-items-center mb-3 mb-md-0">
                                <img src="{{ $imageUrl }}" alt="{{ $item['name'] }}" class="rounded me-3" style="width:80px; height:80px; object-fit:cover;">
                                <div class="d-flex flex-column">
                                    <h5 class="mb-1">{{ $item['name'] }}</h5>
                                    <span class="text-muted">Price: <strong>{{ number_format($item['price'], 2) }} MAD</strong></span>
                                </div>
                            </div>

                            {{-- Quantity & Subtotal --}}
                            <div class="d-flex flex-column align-items-center">
                                <span class="mb-2">Qty: <strong>{{ $item['quantity'] }}</strong></span>
                                <span class="fs-5 fw-bold mb-2">{{ number_format($item['subtotal'], 2) }} MAD</span>
                                <form action="{{ route('cart.remove', $id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm">Remove</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Checkout Summary --}}
            <div class="col-lg-4">
                <div class="card border shadow-sm sticky-top" style="top:100px;">
                    <div class="card-body">
                        <h4 class="card-title fw-bold mb-3">Order Summary</h4>
                        <ul class="list-group list-group-flush mb-3">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Subtotal
                                <span class="fw-bold">{{ number_format($total, 2) }} MAD</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Shipping
                                <span class="text-muted">Calculated at checkout</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Total
                                <span class="fs-5 fw-bold">{{ number_format($total, 2) }} MAD</span>
                            </li>
                        </ul>
                        <form action="{{ route('checkout.form') }}" method="GET">
                            @csrf
                            <button type="submit" class="btn btn-success w-100 btn-lg">Proceed to Checkout</button>
                        </form>
                        <a href="{{ route('products.list') }}" class="btn btn-outline-secondary w-100 mt-2">Continue Shopping</a>
                    </div>
                </div>
            </div>
        </div>

        <h3>You Might Need These</h3>

        <div class="row">

        @foreach($recommendedProducts as $product)
                <!-- 🧪 DEMO MODE - For testing only -->
                @php
                    $imageParts = explode('-', $product->img);
                    $imageUrl = ($imageParts[0] === 'demo') 
                        ? asset('assets/img/demo/products/' . $product->img) 
                        : asset('storage/' . $product->img);
                @endphp
            <div class="col mb-4">
                <div class="product-item">
                    <figure>
                        <a href="{{ route('product.show', $product->id) }}" title="{{ $product->name }}">
                            <img src="{{ $imageUrl }}" class="tab-image img-fluid" alt="{{ $product->name }}">
                        </a>
                    </figure>
                    <h3>{{ $product->name }}</h3>
                    <span class="qty">1 Unit</span>
                    <span class="rating">
                        <svg width="24" height="24" class="text-primary"><use xlink:href="#star-solid"></use></svg> | Stock :{{$product->stock}}
                    </span>
                    <span class="price">{{ number_format($product->price, 2) }}mad</span>
                    <div class="d-flex align-items-center justify-content-between">
                        <a href="{{ route('product.show', $product->id) }}" class="nav-link text-warning">Show Details <iconify-icon icon="uil:shopping-cart"></iconify-icon></a>
                    </div>
                </div>
            </div>
        @endforeach
        </div>
    @else
        {{-- Empty Cart --}}
        <div class="text-center py-5">
            <h4 class="mb-3 fw-bold">Your cart is empty</h4>
            <p class="mb-4 text-muted">Browse our products and add your favorites to the cart.</p>
            <a href="{{ route('products.list') }}" class="btn btn-primary btn-lg">Continue Shopping</a>
        </div>
    @endif
</div>
@endsection
