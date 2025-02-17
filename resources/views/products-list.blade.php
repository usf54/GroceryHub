@extends('layouts.master')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/products-list.css') }}">
@endpush

@section('title', 'Products List')

@section('content')
<section class="products-list">
    <div class="products-container">
        <!-- Filters Section -->
        <div class="filters">
            <div class="filter-group">
                <label for="category">Category</label>
                <form method="GET" action="" id="categoryFilterForm">
                    <select id="category" name="category" onchange="this.form.submit()">
                        <option value="">Select a Category</option>
                        <option value="fruits">Fruits</option>
                        <option value="vegetables">Vegetables</option>
                        <option value="meat">Meat</option>
                        <option value="dairy">Dairy</option>
                        <option value="bakery">Bakery</option>
                    </select>
                </form>
            </div>

            <div class="filter-group">
                <label for="price">Price Range</label>
                <form method="GET" action="" id="priceFilterForm">
                    <input type="range" id="price" name="price" min="0" max="100" step="1" onchange="this.form.submit()">
                    <span id="price-value">$0 - $100</span>
                </form>
            </div>

            <div class="filter-group">
                <label for="availability">Availability</label>
                <form method="GET" action="" id="availabilityFilterForm">
                    <select id="availability" name="availability" onchange="this.form.submit()">
                        <option value="">Select Availability</option>
                        <option value="in-stock">In Stock</option>
                        <option value="out-of-stock">Out of Stock</option>
                    </select>
                </form>
            </div>
        </div>

        <!-- Products List Section -->
        <div class="product-list-container">
            <!-- Hardcoded Products List -->
            <div class="product-item">
                <img src="https://via.placeholder.com/150" alt="Apple">
                <h3>Apple</h3>
                <p>Fresh, red apples perfect for snacking or baking.</p>
                <p><strong>Price: $2.99</strong></p>
                <a href="#" class="view-details">View Details</a>
            </div>
            <div class="product-item">
                <img src="https://via.placeholder.com/150" alt="Carrot">
                <h3>Carrot</h3>
                <p>Crisp and crunchy carrots, great for salads and snacks.</p>
                <p><strong>Price: $1.49</strong></p>
                <a href="#" class="view-details">View Details</a>
            </div>
            <div class="product-item">
                <img src="https://via.placeholder.com/150" alt="Chicken Breast">
                <h3>Chicken Breast</h3>
                <p>Lean, boneless chicken breast for grilling or baking.</p>
                <p><strong>Price: $5.99</strong></p>
                <a href="#" class="view-details">View Details</a>
            </div>
            <div class="product-item">
                <img src="https://via.placeholder.com/150" alt="Cheddar Cheese">
                <h3>Cheddar Cheese</h3>
                <p>Sharp, flavorful cheddar cheese, perfect for sandwiches.</p>
                <p><strong>Price: $3.99</strong></p>
                <a href="#" class="view-details">View Details</a>
            </div>
            <div class="product-item">
                <img src="https://via.placeholder.com/150" alt="Bread">
                <h3>Bread</h3>
                <p>Freshly baked bread with a soft, fluffy texture.</p>
                <p><strong>Price: $2.49</strong></p>
                <a href="#" class="view-details">View Details</a>
            </div>
        </div>
    </div>
</section>
@endsection
