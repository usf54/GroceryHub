@extends('layouts.master')
@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/packs.css') }}">
@endpush
@section('title', 'Available Packs')
@section('content')
<div class="container">
    <h1 class="mb-4">Available Packs</h1>

    <div class="row">
        @foreach ($packs as $pack)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm product-item">
                    <div class="card-body">
                        <img src="{{ asset('storage/' . $pack->img) }}" class="tab-image img-fluid" alt="{{ $pack->name }}">
                        <h5 class="card-title">{{ $pack->name }}</h5>
                        <p class="card-text">{{ $pack->description ?? 'No description available.' }}</p>
                        <p><strong>Price:</strong> ${{ number_format($pack->price, 2) }}</p>
                        <p><strong>Stock:</strong> {{ $pack->stock }}</p>
                        <p><strong>Category:</strong> {{ $pack->category->name ?? 'Uncategorized' }}</p>

                        <h6>Products in this Pack:</h6>
                        <ul class="list-unstyled">
                            @foreach ($pack->products as $product)
                                <li>{{ $product->name }}</li>
                            @endforeach
                        </ul>

                        <form action="{{ route('order.addPack', $pack->id) }}" method="POST">
                            @csrf
                            <input type="number" name="quantity" value="1" min="1" max="{{ $pack->stock }}" class="form-control mb-2">
                            <button type="submit" class="btn btn-primary w-100 mb-2">Order Now</button>
                        </form>
                        <a href="{{ route('packs.show', $pack->id) }}" class="btn btn-outline-primary w-100">Show Details</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection 