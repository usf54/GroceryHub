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

                        <a href="#" class="btn btn-primary">Order Now</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection 