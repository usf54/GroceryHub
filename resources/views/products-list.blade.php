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
        <symbol id="plus" viewBox="0 0 24 24">
            <path fill="currentColor" d="M19 11h-6V5a1 1 0 0 0-2 0v6H5a1 1 0 0 0 0 2h6v6a1 1 0 0 0 2 0v-6h6a1 1 0 0 0 0-2Z"/>
        </symbol>
        <symbol id="minus" viewBox="0 0 24 24">
            <path fill="currentColor" d="M19 11H5a1 1 0 0 0 0 2h14a1 1 0 0 0 0-2Z"/>
        </symbol>
        <symbol xmlns="http://www.w3.org/2000/svg" id="star-solid" viewBox="0 0 15 15">
            <path fill="currentColor" d="M7.953 3.788a.5.5 0 0 0-.906 0L6.08 5.85l-2.154.33a.5.5 0 0 0-.283.843l1.574 1.613l-.373 2.284a.5.5 0 0 0 .736.518l1.92-1.063l1.921 1.063a.5.5 0 0 0 .736-.519l-.373-2.283l1.574-1.613a.5.5 0 0 0-.283-.844L8.921 5.85l-.968-2.062Z"/>
        </symbol>
    </defs>
</svg>
<main>
    <div class="product-page">
            <div class="filters">
                <h3>Filters</h3>
                <ul>
                    <li>
                        <label for="category">Category</label>
                        <select id="category">
                            <option value="fruits">Fruits</option>
                            <option value="vegetables">Vegetables</option>
                            <option value="beverages">Beverages</option>
                        </select>
                    </li>
                    <li>
                        <label for="price">Price Range</label>
                        <input type="range" id="price" min="0" max="100" value="50">
                        <span id="price-value">$50</span>
                    </li>
                    <li>
                        <label for="rating">Rating</label>
                        <select id="rating">
                            <option value="5">5 Stars</option>
                            <option value="4">4 Stars</option>
                            <option value="3">3 Stars</option>
                        </select>
                    </li>
                </ul>
            </div>
            <section class="py-5">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="bootstrap-tabs product-tabs">
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="nav-all" role="tabpanel" aria-labelledby="nav-all-tab">
                                        <div class="product-grid row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5">
                                            @foreach ($products as $product)
                                                <div class="col">
                                                    <div class="product-item">
                                                        <figure>
                                                            <a href="{{ route('product.show', $product->id) }}" title="{{ $product->name }}">
                                                                <img src="{{ asset('storage/' . $product->img) }}" class="tab-image" alt="{{ $product->name }}">
                                                            </a>
                                                        </figure>
                                                        <h3>{{ $product->name }}</h3>
                                                        <span class="qty">1 Unit</span>
                                                        <span class="rating">
                                                            <svg width="24" height="24" class="text-primary"><use xlink:href="#star-solid"></use></svg> | Stock :{{$product->stock}}
                                                        </span>
                                                        <span class="price">${{ number_format($product->price, 2) }}</span>
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <div class="input-group product-qty">
                                                                <span class="input-group-btn">
                                                                    <button type="button" class="quantity-left-minus btn btn-danger btn-number" data-type="minus">
                                                                        <svg width="16" height="16"><use xlink:href="#minus"></use></svg>
                                                                    </button>
                                                                </span>
                                                                <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1">
                                                                <span class="input-group-btn">
                                                                    <button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus">
                                                                        <svg width="16" height="16"><use xlink:href="#plus"></use></svg>
                                                                    </button>
                                                                </span>
                                                            </div>
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
    </div>
</main>
@endsection
