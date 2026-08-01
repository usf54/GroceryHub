@extends('layouts.master')
@section('title','Product | GroceryHub')
@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <!-- 🧪 DEMO MODE - For testing only -->
            @php
                $imageParts = explode('-', $product->img);
                $imageUrl = ($imageParts[0] === 'demo') 
                    ? asset('assets/img/demo/products/' . $product->img) 
                    : asset('storage/' . $product->img);
            @endphp
            <div class="product-image-wrapper" style="width: 100%; height: 400px; overflow: hidden; border-radius: 8px; background: #f8f9fa;">
                <img src="{{ $imageUrl }}" 
                     alt="{{ $product->name }}" 
                     style="width: 100%; height: 100%; object-fit: cover;">
            </div>
        </div>
        <div class="col-md-6">
            <h2>{{ $product->name }}</h2>
            <p><strong>Description:</strong> {{ $product->description }}</p>
            <p><strong>Price:</strong> {{ number_format($product->price, 2) }} MAD</p>
            <p><strong>Stock:</strong> {{ $product->stock }} units</p>

            <!-- Inform about discounts and shipping -->
            @auth
                <div class="alert alert-info">
                    <strong>Special Offer:</strong> 
                    @php
                        $completedOrders = Auth::user()->orders->where('status', 'completed')->count();
                        if ($completedOrders >= 5) {
                            echo "You are eligible for a 10% loyalty discount on your purchase!";
                        } else {
                            echo "You can earn a 10% discount on your next purchase after completing 5 orders!";
                        }
                    @endphp
                </div>
                <div class="alert alert-info">
                    <strong>Free Shipping:</strong>
                    If your order subtotal is over 100 MAD, you qualify for free shipping! Otherwise, a 10 MAD shipping fee will apply.
                </div>

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <form action="{{ route('order.add', ['type' => 'product', 'id' => $product->id]) }}" method="POST">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="number" class="form-control" name="quantity" value="1" min="1" max="{{ $product->stock }}">
                        <button class="btn btn-warning" type="submit">Add to Cart</button>
                    </div>
                </form>
            @else
                <p class="text-danger">You must be logged in to add items to the cart.</p>
                <a href="{{ route('login') }}" class="btn btn-warning">Login to Continue</a>
            @endauth

            <a href="{{ route('products.list') }}" class="btn btn-dark">Back to Products</a>
        </div>
    </div>

    <!-- Recommended Products Section -->
    @if($recommendedProducts->count())
    <div class="row mt-5">
        <div class="col-12">
            <h3 class="mb-4">You Might Also Like</h3>
            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4">
                @foreach($recommendedProducts as $recommended)
                    @php
                        $imageParts = explode('-', $recommended->img);
                        $imageUrl = ($imageParts[0] === 'demo') 
                            ? asset('assets/img/demo/products/' . $recommended->img) 
                            : asset('storage/' . $recommended->img);
                    @endphp
                    <div class="col">
                        <div class="card h-100 border-0 shadow-sm p-2 d-flex flex-column">
                            <!-- Product Image - Fixed size -->
                            <div class="product-image-wrapper" style="width: 100%; height: 200px; overflow: hidden; border-radius: 8px;">
                                <a href="{{ route('product.show', $recommended->id) }}" class="d-block w-100 h-100">
                                    <img src="{{ $imageUrl }}" 
                                         alt="{{ $recommended->name }}" 
                                         class="img-fluid w-100 h-100"
                                         style="object-fit: cover;">
                                </a>
                            </div>
                            <!-- Card Body -->
                            <div class="card-body text-center d-flex flex-column pt-3">
                                <h3 class="fs-6 fw-normal mb-1" style="min-height: 40px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                    {{ $recommended->name }}
                                </h3>
                                <div class="mb-1">
                                    <span class="badge {{ $recommended->stock > 0 ? 'bg-success' : 'bg-danger' }}">
                                        {{ $recommended->stock > 0 ? 'Available' : 'Not available' }} ({{$recommended->stock}})
                                    </span>
                                </div>
                                <span class="text-dark fw-bold fs-6 mb-2">
                                    {{ number_format($recommended->price, 2) }} MAD
                                </span>
                                <div class="mt-auto">
                                    <a href="{{ route('product.show', $recommended->id) }}"
                                       class="btn btn-warning btn-sm w-100 fw-semibold">
                                        <svg width="18" height="18"><use xlink:href="#cart"></use></svg> View Product
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif
</div>
@endsection