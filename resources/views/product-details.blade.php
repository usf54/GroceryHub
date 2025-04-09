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
            <p><strong>Price:</strong> ${{ number_format($product->price, 2) }}</p>
            <p><strong>Stock:</strong> {{ $product->stock }} units</p>

            <!-- Inform about discounts and shipping -->
            @auth
                <div class="alert alert-info">
                    <strong>Special Offer:</strong> 
                    @php
                        $completedOrders = Auth::user()->orders->where('status', 'completed')->count();
                        if ($completedOrders >= 3) {
                            echo "You are eligible for a 5% loyalty discount on your purchase!";
                        } else {
                            echo "You can earn a 5% discount on your next purchase after completing 3 orders!";
                        }
                    @endphp
                </div>
                <div class="alert alert-info">
                    <strong>Free Shipping:</strong>
                    If your order subtotal is over $100, you qualify for free shipping! Otherwise, a $10 shipping fee will apply.
                </div>

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <form action="{{ route('order.add', $product->id) }}" method="POST">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="number" class="form-control" name="quantity" value="1" min="1" max="{{ $product->stock }}">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">Add to Cart</button>
                        </div>
                    </div>
                </form>
            @else
                <p class="text-danger">You must be logged in to add items to the cart.</p>
                <a href="{{ route('login') }}" class="btn btn-primary">Login to Continue</a>
            @endauth

            <a href="{{ route('products.list') }}" class="btn btn-secondary">Back to Products</a>
        </div>
    </div>
</div>
@endsection
