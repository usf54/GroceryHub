@extends('layouts.master') <!-- Assuming you have a base layout -->

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <img src="{{ asset('assets/img/products/thumb-biscuits.png') }}" class="tab-image" alt="{{ $product->name }}">
        </div>
        <div class="col-md-6">
            <h2>{{ $product->name }}</h2>
            <p><strong>Description:</strong> {{ $product->description }}</p>
            <p><strong>Price:</strong> ${{ number_format($product->price, 2) }}</p>
            <p><strong>Stock:</strong> {{ $product->stock }} units</p>
            
            <form action="" method="POST">
                @csrf
                <div class="input-group mb-3">
                    <input type="number" class="form-control" name="quantity" value="1" min="1" max="{{ $product->stock }}">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Add to Cart</button>
                    </div>
                </div>
            </form>

            <a href="{{ route('products.list') }}" class="btn btn-secondary">Back to Products</a>
        </div>
    </div>
</div>
@endsection
