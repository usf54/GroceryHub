@extends('layouts.master')
@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/products-list.css') }}">
@endpush
@section('title', 'Products List')
@section('content')
<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
    <defs>
        <symbol id="arrow-right" viewBox="0 0 24 24" fill="currentColor">
            <path d="M13 5l7 7-7 7M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </symbol>
        <symbol xmlns="http://www.w3.org/2000/svg" id="star-solid" viewBox="0 0 15 15">
            <path fill="currentColor" d="M7.953 3.788a.5.5 0 0 0-.906 0L6.08 5.85l-2.154.33a.5.5 0 0 0-.283.843l1.574 1.613l-.373 2.284a.5.5 0 0 0 .736.518l1.92-1.063l1.921 1.063a.5.5 0 0 0 .736-.519l-.373-2.283l1.574-1.613a.5.5 0 0 0-.283-.844L8.921 5.85l-.968-2.062Z"/>
        </symbol>
        <symbol id="cart-plus" viewBox="0 0 24 24" fill="currentColor">
            <path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.5 8h15M19 16a2 2 0 11-4 0 2 2 0 014 0zM9 16a2 2 0 11-4 0 2 2 0 014 0z"/>
        </symbol>
    </defs>
</svg>
<main class="products-page">
    <div class="container">
        <div class="d-flex flex-column flex-md-row align-items-start gap-4">

            <!-- Filters Section (Left Side) -->
            <form method="GET" action="{{ route('products.list') }}" class="filters-wrapper">
                <h3>Filters</h3>
                
                <div class="filter-group">
                    <label for="category">Category</label>
                    <select id="category" name="category" class="form-select">
                        <option value="">All Categories</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="filter-group">
                    <label for="price">Price Range</label>
                    <input type="range" id="price" name="price" class="form-range" min="0" max="1000" value="{{ request('price', 1000) }}" step="10">
                    <div class="price-display">
                        <span id="price-value">{{ request('price', 1000) }}</span> MAD
                    </div>
                </div>
                
                <button type="submit" class="apply-filters-btn">
                    Apply Filters
                </button>
                
                @if(request()->anyFilled(['category', 'price']))
                    <a href="{{ route('products.list') }}" class="clear-filters-btn">
                        Clear Filters
                    </a>
                @endif
            </form>

            <!-- Products Section (Right Side) -->
            <div class="product-grid-wrapper">
                <div class="product-grid-header">
                    <span class="results-count">
                        Showing <strong>{{ $products->firstItem() ?? 0 }}</strong> - <strong>{{ $products->lastItem() ?? 0 }}</strong> of <strong>{{ $products->total() }}</strong> products
                    </span>
                </div>

                {{-- Alerts --}}
                @if (session('success'))
                    <div class="alert alert-custom alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-custom alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <!-- Product Grid -->
                @if($products->count() > 0)
                    <div class="product-grid">
                        @foreach ($products as $product)
                            @php
                                $imageParts = explode('-', $product->img);
                                $imageUrl = ($imageParts[0] === 'demo') 
                                    ? asset('assets/img/demo/products/' . $product->img) 
                                    : asset('storage/' . $product->img);
                                
                                $stockClass = $product->stock > 10 ? 'in-stock' : ($product->stock > 0 ? 'low-stock' : 'out-of-stock');
                                $stockLabel = $product->stock > 10 ? 'In Stock' : ($product->stock > 0 ? 'Low Stock' : 'Out of Stock');
                            @endphp
                            <div class="product-item">
                                <figure>
                                    <a href="{{ route('product.show', $product->id) }}" title="{{ $product->name }}">
                                        <img src="{{ $imageUrl }}" class="img-fluid" alt="{{ $product->name }}" loading="lazy">
                                    </a>
                                </figure>
                                <div class="product-body">
                                    <h3>{{ $product->name }}</h3>
                                    <div class="product-meta">
                                        <span class="qty">1 Unit</span>
                                        <span class="rating">
                                            <svg><use xlink:href="#star-solid"></use></svg> 4.5
                                        </span>
                                        <span class="stock {{ $stockClass }}">{{ $stockLabel }}</span>
                                    </div>
                                    <span class="price">{{ number_format($product->price, 2) }} MAD</span>
                                    <div class="product-actions">
                                        <a href="{{ route('product.show', $product->id) }}" class="view-btn">
                                            View Details
                                        </a>
                                        <form action="{{ route('order.add', ['type' => 'product', 'id' => $product->id]) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="add-cart-btn" title="Add to Cart" {{ $product->stock <= 0 ? 'disabled' : '' }}>
                                                <svg><use xlink:href="#cart-plus"></use></svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    <!-- Pagination -->
                    <div class="pagination-wrapper">
                        {{ $products->appends(request()->query())->links('vendor.pagination.bootstrap-4') }}
                    </div>
                @else
                    <!-- No Products Found -->
                    <div class="no-products">
                        <svg width="64" height="64" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path d="M20 7h-4a3 3 0 01-3-3V2M9 12v2M12 12v2M15 12v2M3 7h18v12a2 2 0 01-2 2H5a2 2 0 01-2-2V7z"/>
                            <path d="M9 5h6"/>
                        </svg>
                        <h5>No Products Found</h5>
                        <p>Try adjusting your filters or search criteria.</p>
                        <a href="{{ route('products.list') }}" class="reset-btn">
                            Reset Filters
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</main>

<script>
    // Update price display dynamically
    document.getElementById('price').addEventListener('input', function () {
        document.getElementById('price-value').innerText = this.value;
    });
</script>
@endsection