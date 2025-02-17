@extends('layouts.master')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/products-list.css') }}">
@endpush

@section('title', 'Products List')

@section('content')
<svg style="display:none;">
        <!-- Your SVG icons go here -->
        <symbol id="heart" viewBox="0 0 24 24">
            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"></path>
        </symbol>
        <symbol id="star-solid" viewBox="0 0 24 24">
            <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"></path>
        </symbol>
</svg>
<main>
    <div class="product-page">
            <!-- Filters Section (Left Side) -->
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

            <!-- Product List Section (Right Side) -->
            <div class="product-list">
                <!-- Product Item -->
                <div class="col">
                    <div class="product-item">
                        <span class="badge bg-success position-absolute m-3">-30%</span>
                        <a href="#" class="btn-wishlist">
                            <svg width="24" height="24">
                                <use xlink:href="#heart"></use>
                            </svg>
                        </a>
                        <figure>
                            <a href="index.html" title="Product Title">
                                <img src="{{ asset('assets/img/products/thumb-bananas.png') }}" class="tab-image" alt="Product Image">
                            </a>
                        </figure>
                        <h3>Sunstar Fresh Melon Juice</h3>
                        <span class="qty">1 Unit</span>
                        <span class="rating">
                            <svg width="24" height="24" class="text-primary">
                                <use xlink:href="#star-solid"></use>
                            </svg> 4.5
                        </span>
                        <span class="price">$18.00</span>
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="input-group product-qty">
                                <button type="button" class="quantity-left-minus btn btn-danger btn-number" data-type="minus">
                                    <svg width="16" height="16"><use xlink:href="#minus"></use></svg>
                                </button>
                                <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1">
                                <button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus">
                                    <svg width="16" height="16"><use xlink:href="#plus"></use></svg>
                                </button>
                            </div>
                            <a href="#" class="nav-link">Add to Cart</a>
                        </div>
                    </div>
                </div>
                <!-- Repeat Product Items as Needed -->
                <!-- Example Product Item 2 -->
                <div class="col">
                    <div class="product-item">
                        <span class="badge bg-danger position-absolute m-3">-15%</span>
                        <a href="#" class="btn-wishlist">
                            <svg width="24" height="24">
                                <use xlink:href="#heart"></use>
                            </svg>
                        </a>
                        <figure>
                            <a href="index.html" title="Product Title">
                                <img src="{{ asset('assets/img/products/thumb-mango.png') }}" class="tab-image" alt="Product Image">
                            </a>
                        </figure>
                        <h3>Mango Tango Juice</h3>
                        <span class="qty">1 Unit</span>
                        <span class="rating">
                            <svg width="24" height="24" class="text-primary">
                                <use xlink:href="#star-solid"></use>
                            </svg> 4.0
                        </span>
                        <span class="price">$12.00</span>
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="input-group product-qty">
                                <button type="button" class="quantity-left-minus btn btn-danger btn-number" data-type="minus">
                                    <svg width="16" height="16"><use xlink:href="#minus"></use></svg>
                                </button>
                                <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1">
                                <button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus">
                                    <svg width="16" height="16"><use xlink:href="#plus"></use></svg>
                                </button>
                            </div>
                            <a href="#" class="nav-link">Add to Cart</a>
                        </div>
                    </div>
                </div>
                <!-- Add more product items as needed -->
            </div>
    </div>
</main>
@endsection
