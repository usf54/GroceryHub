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
    </defs>
</svg>
<main>
    <div class="product-page d-flex flex-column flex-md-row">
        <!-- Filters Section (Left Side) -->
        <form method="GET" action="{{ route('products.list') }}">
            <div class="filters bg-white p-4 rounded shadow-sm mb-4 mb-md-0" style="width: 250px; flex-shrink: 0;">
                <h3 class="mb-4">Filters</h3>
                <ul class="list-unstyled">
                    <li class="mb-3">
                        <label for="category" class="form-label">Category</label>
                        <select id="category" name="category" class="form-select">
                            <option value="">All Categories</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </li>
                    <li class="mb-3">
                        <label for="price" class="form-label">Price Range</label>
                        <input type="range" id="price" name="price" class="form-range" min="0" max="100" value="{{ request('price', 100) }}" step="10">
                        <span id="price-value" class="d-block text-center">${{ request('price', 100) }}</span>
                    </li>
                </ul>
                <button type="submit" class="btn btn-primary w-100">Apply Filters</button>
            </div>
        </form>


        <!-- Products Section (Right Side) -->
        <div class="products flex-grow-1 ms-md-4">
            <section class="py-5">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="bootstrap-tabs product-tabs">
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="nav-all" role="tabpanel" aria-labelledby="nav-all-tab">
                                        <div class="product-grid row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4">
                                            @foreach ($products as $product)
                                                <div class="col mb-4">
                                                    <div class="product-item">
                                                        <figure>
                                                            <a href="{{ route('product.show', $product->id) }}" title="{{ $product->name }}">
                                                                <img src="{{ asset('storage/' . $product->img) }}" class="tab-image img-fluid" alt="{{ $product->name }}">
                                                            </a>
                                                        </figure>
                                                        <h3>{{ $product->name }}</h3>
                                                        <span class="qty">1 Unit</span>
                                                        <span class="rating">
                                                            <svg width="24" height="24" class="text-primary"><use xlink:href="#star-solid"></use></svg> | Stock :{{$product->stock}}
                                                        </span>
                                                        <span class="price">${{ number_format($product->price, 2) }}</span>
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            
                                                            <a href="#" class="nav-link">Add to Cart <iconify-icon icon="uil:shopping-cart"></iconify-icon></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <div class="d-flex justify-content-center mt-4">
                {{ $products->appends(request()->query())->links('vendor.pagination.bootstrap-4') }}
            </div>

        </div>
    </div>
</main>
<script>
    // Update price display dynamically
    document.getElementById('price').addEventListener('input', function () {
    document.getElementById('price-value').innerText = '$' + this.value;
    });
</script>
@endsection
