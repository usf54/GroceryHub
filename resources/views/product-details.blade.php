@extends('layouts.master')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <img style="width:100%;" src="{{ asset('storage/' . $product->img) }}" class="tab-image" alt="{{ $product->name }}">
        </div>
        <div class="col-md-6">
            <h2>{{ $product->name }}</h2>
            <p><strong>Description:</strong> {{ $product->description }}</p>
            <p><strong>Price:</strong> {{ number_format($product->price, 2) }}mad</p>
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
                    If your order subtotal is over 100mad, you qualify for free shipping! Otherwise, a 10mad shipping fee will apply.
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
                        <div class="input-group-append">
                            <button class="btn btn-warning" type="submit">Add to Cart</button>
                        </div>
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
                    <div class="col d-flex"> <!-- Added d-flex -->
                        <div class="product-item d-flex flex-column w-100"> <!-- Added flex classes -->
                            <figure class="flex-grow-0" style="height: 200px; overflow: hidden;"> <!-- Fixed height -->
                                <a href="{{ route('products.show', $recommended->id) }}" title="{{ $recommended->name }}">
                                    <img src="{{ asset('storage/' . $recommended->img) }}" 
                                        alt="{{ $recommended->name }}" 
                                        class="w-100 h-100 object-fit-cover"> <!-- Ensures consistent image sizing -->
                                </a>
                            </figure>
                            <div class="d-flex flex-column text-center flex-grow-1 p-3"> <!-- Added padding and flex-grow -->
                                <h3 class="fs-6 fw-normal mb-2">{{ Str::limit($recommended->name, 50) }}</h3> <!-- Added character limit -->
                                <span class="text-muted small mb-2">({{ $recommended->stock }} available)</span>        
                                <div class="d-flex justify-content-center align-items-center gap-2 mb-3">
                                    <span class="text-dark fw-bold">{{ number_format($recommended->price, 2) }} mad</span>
                                </div>
                                <div class="mt-auto p-2"> <!-- Pushes button to bottom -->
                                    <a href="{{ route('products.show', $recommended->id) }}" 
                                       class="btn btn-warning rounded-1 px-3 py-2 fs-7 w-100"> <!-- Full width button -->
                                        <svg width="18" height="18" class="me-1"><use xlink:href="#cart"></use></svg> 
                                        View More
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