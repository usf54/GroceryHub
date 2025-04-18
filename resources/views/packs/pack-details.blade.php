@extends('layouts.master')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/packs.css') }}">
    <style>
        .pack-details-container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 30px 15px;
        }

        .pack-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0,0,0,0.05);
            overflow: hidden;
        }

        .pack-image {
            width: 100%;
            height: auto;
            max-height: 500px;
            object-fit: cover;
            border-radius: 12px 0 0 12px;
        }

        .pack-info {
            padding: 30px;
        }

        .pack-info h1 {
            font-weight: bold;
            margin-bottom: 20px;
        }

        .pack-info p {
            margin-bottom: 10px;
        }

        .product-list li {
            margin-bottom: 6px;
        }

        

        
        @media (max-width: 768px) {
            .pack-image {
                border-radius: 12px 12px 0 0;
            }

            .pack-card {
                flex-direction: column;
            }
        }
    </style>
@endpush

@section('title', $pack->name . ' Details')

@section('content')
<div class="pack-details-container">
    <div class="d-flex flex-md-row flex-column pack-card">
        <!-- Left: Image -->
        <div class="col-md-6 p-0">
            <img src="{{ asset('storage/' . $pack->img) }}" alt="{{ $pack->name }}" class="pack-image w-100 h-100">
        </div>

        <!-- Right: Info -->
        <div class="col-md-6 pack-info">
            <h1>{{ $pack->name }}</h1>
            <p><strong>Description:</strong> {{ $pack->description ?? 'No description available.' }}</p>
            <p><strong>Price:</strong> ${{ number_format($pack->price, 2) }}</p>
            <p><strong>Stock:</strong> {{ $pack->stock }}</p>
            <p><strong>Category:</strong> {{ $pack->category->name ?? 'Uncategorized' }}</p>

            <h5 class="mt-4">Products in this Pack:</h5>
            <ul class="product-list">
                @forelse ($pack->products as $product)
                    <li>{{ $product->name }}</li>
                @empty
                    <li>No products in this pack.</li>
                @endforelse
            </ul>

            <form action="{{ route('order.addPack', $pack->id) }}" method="POST" class="mt-4">
                @csrf
                <label for="quantity"><strong>Quantity:</strong></label>
                <input type="number" name="quantity" value="1" min="1" max="{{ $pack->stock }}" class="form-control w-50 mb-3">
                <button type="submit" class="btn btn-warning text-b w-100">Order Now</button>
            </form>

            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary mt-3">← Back</a>
        </div>
    </div>
</div>
@endsection
