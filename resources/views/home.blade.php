@extends('layouts.master')

@section('title','Home | GroceryHub')

@push('styles')
  <link rel="stylesheet" href="{{ asset('assets/css/hero.css') }}">
@endpush
@section('content')
<div class="pictures-container">
  <div class="left-pic">
    <img src="{{asset('assets/img/hero1.webp')}}" alt="hero img">
  </div>
  <div class="right-pic">
    <div class="top-pic">
      <img src="{{asset('assets/img/hero2.jpg')}}" alt="hero img">
    </div>
    <div class="bottom-pic">
      <img src="{{asset('assets/img/hero3.jpg')}}" alt="hero img">
    </div>
  </div>
</div>

<div class="latest-products">
  <div class="section-title">
    <h2>Latest Products</h2>
  </div>
  <div class="swiper mySwiper">
    <div class="swiper-wrapper">
      
        <!-- Product 2 -->
        <div class="swiper-slide">
            <div class="product-card">
              <img src="{{asset('assets/img/products/bannanas.avif')}}" alt="Bananas">
                <h3>Organic Bananas</h3>
                <p>$1.49 / kg</p>
                <button>Add to Cart</button>
              </div>
            </div>
        <!-- Product 2 -->
        <div class="swiper-slide">
            <div class="product-card">
              <img src="{{asset('assets/img/products/bannanas.avif')}}" alt="Bananas">
                <h3>Organic Bananas</h3>
                <p>$1.49 / kg</p>
                <button>Add to Cart</button>
              </div>
            </div>

        <!-- Product 3 -->
        <div class="swiper-slide">
            <div class="product-card">
              <img src="{{asset('assets/img/products/carrots.avif')}}" alt="Carrots">
              <h3>Fresh Carrots</h3>
              <p>$0.99 / kg</p>
              <button>Add to Cart</button>
            </div>
          </div>

          <!-- Product 4 -->
        <div class="swiper-slide">
            <div class="product-card">
                <img src="{{asset('assets/img/products/tomatos.jpg')}}" alt="Tomatoes">
                <h3>Ripe Tomatoes</h3>
                <p>$3.49 / kg</p>
                <button>Add to Cart</button>
            </div>
          </div>
        </div>

    <!-- Navigation Arrows -->
    <div class="swiper-button-next" id='btn'></div>
    <div class="swiper-button-prev" id='btn'></div>
  
    <div class="more-container">
    <button class="more-btn">More</button>
  </div>
  </div>
</div>
<div class="best-products">
  <div class="section-title">
    <h2>Best Selling Products</h2>
  </div>
  <div class="swiper mySwiper">
    <div class="swiper-wrapper">
      
        <!-- Product 2 -->
        <div class="swiper-slide">
            <div class="product-card">
              <img src="{{asset('assets/img/products/bannanas.avif')}}" alt="Bananas">
                <h3>Organic Bananas</h3>
                <p>$1.49 / kg</p>
                <button>Add to Cart</button>
              </div>
            </div>
        <!-- Product 2 -->
        <div class="swiper-slide">
            <div class="product-card">
              <img src="{{asset('assets/img/products/bannanas.avif')}}" alt="Bananas">
                <h3>Organic Bananas</h3>
                <p>$1.49 / kg</p>
                <button>Add to Cart</button>
              </div>
            </div>

        <!-- Product 3 -->
        <div class="swiper-slide">
            <div class="product-card">
              <img src="{{asset('assets/img/products/carrots.avif')}}" alt="Carrots">
              <h3>Fresh Carrots</h3>
              <p>$0.99 / kg</p>
              <button>Add to Cart</button>
            </div>
          </div>

          <!-- Product 4 -->
        <div class="swiper-slide">
            <div class="product-card">
                <img src="{{asset('assets/img/products/tomatos.jpg')}}" alt="Tomatoes">
                <h3>Ripe Tomatoes</h3>
                <p>$3.49 / kg</p>
                <button>Add to Cart</button>
            </div>
          </div>
        </div>

    <!-- Navigation Arrows -->
    <div class="swiper-button-next" id='btn'></div>
    <div class="swiper-button-prev" id='btn'></div>
    
    <div class="more-container">
    <button class="more-btn">More</button>
  </div>
  </div>
</div>

<div class="banners">
  <div class="banner1">
    <img src="{{asset('assets/img/banners/banner1.jpg')}}" alt="banner">
  </div>
  <div class="banner2">
    <img src="{{asset('assets/img/banners/banner2.jpg')}}" alt="banner">
  </div>
</div>
<div class="section-title">
  <h2>Lifestyle Preferences</h2>
</div>

<!-- Preferences Section -->
<div class="preferences">
  <div class="preference-item">Gluten-Free</div>
  <div class="preference-item">Vegan</div>
  <div class="preference-item">Vegetarian</div>
  <div class="preference-item">Pescatarians </div>
</div>

<div class="section-title">
  <h2>Categories</h2>
</div>

<!-- Categories Section -->
<div class="categories">
  <div class="category-item">Drinks</div>
  <div class="category-item">Coffee and tea</div>
  <div class="category-item">Snacks</div>
  <div class="category-item">Pastries </div>
</div>

@endsection