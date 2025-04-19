@extends('layouts.master')
@section('title','Home | GroceryHub')
@push('styles')
  <link rel="stylesheet" href="{{ asset('assets/css/hero.css') }}">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css">

@endpush
@section('content')
<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
    <defs>
        <symbol xmlns="http://www.w3.org/2000/svg" id="cart" viewBox="0 0 24 24">
          <path fill="currentColor" d="M8.5 19a1.5 1.5 0 1 0 1.5 1.5A1.5 1.5 0 0 0 8.5 19ZM19 16H7a1 1 0 0 1 0-2h8.491a3.013 3.013 0 0 0 2.885-2.176l1.585-5.55A1 1 0 0 0 19 5H6.74a3.007 3.007 0 0 0-2.82-2H3a1 1 0 0 0 0 2h.921a1.005 1.005 0 0 1 .962.725l.155.545v.005l1.641 5.742A3 3 0 0 0 7 18h12a1 1 0 0 0 0-2Zm-1.326-9l-1.22 4.274a1.005 1.005 0 0 1-.963.726H8.754l-.255-.892L7.326 7ZM16.5 19a1.5 1.5 0 1 0 1.5 1.5a1.5 1.5 0 0 0-1.5-1.5Z"/>
        </symbol>
        <symbol id="arrow-right" viewBox="0 0 24 24" fill="currentColor">
          <path d="M13 5l7 7-7 7M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </symbol>
        <symbol xmlns="http://www.w3.org/2000/svg" id="star-solid" viewBox="0 0 15 15">
          <path fill="currentColor" d="M7.953 3.788a.5.5 0 0 0-.906 0L6.08 5.85l-2.154.33a.5.5 0 0 0-.283.843l1.574 1.613l-.373 2.284a.5.5 0 0 0 .736.518l1.92-1.063l1.921 1.063a.5.5 0 0 0 .736-.519l-.373-2.283l1.574-1.613a.5.5 0 0 0-.283-.844L8.921 5.85l-.968-2.062Z"/>
        </symbol>
    </defs>
</svg>
<div class="hero-section">
    <!-- First Row (Left side) -->
    <div class="left-side">
      <div class="text-image-container">
        <div class="text-content">
          <h1 class="bold-title">Fresh Lemon Juice</h1>
          <p class="light-description">
            Refreshing and natural, perfect for any occasion. Our lemon juice is freshly squeezed from the finest lemons
          </p>
        </div>
        <div class="image-content">
          <img id='bottle' src="{{asset('assets/img/hero/illustration-plastic-glass-bottle-with-lid-picture-lemon.png')}}" alt="hero img">
        </div>
      </div>
    </div>

    <!-- Second and Third Rows (Right side, stacked) -->
    <div class="right-side">
      <div class="rowss soft-pink-bg">
        <div class="text-content">
          <h2 class="bold-title">Berry Delight</h2>
          <p class="light-description">
            A burst of flavor in every sip. Our Berry Delight is made from a blend of the freshest berries
          </p>
        </div>
        <div class="image-content">
          <img id='veges' src="{{asset('assets/img/hero/Blackberries_milk_splash_floating_-12-removebg-preview.png')}}" alt="hero img">
        </div>
      </div>
      <div class="rowss soft-yellow-bg">
        <div class="text-content">
          <h2 class="bold-title">Artisan Bread</h2>
          <p class="light-description">
            Crafted with care for the perfect crunch. Our Artisan Bread is baked using traditional methods
          </p>
        </div>
        <div class="image-content">
          <img id='bread' src="{{asset('assets/img/hero/variety-crusty-bread-stone-surface-removebg-preview.png')}}" alt="hero img">
        </div>
      </div>
    </div>
</div>
<div class="features-container">
        <div class="feature">
            <div class="feature-icon">
                <i class="fas fa-truck"></i>
            </div>
            <div class="feature-title">Free Shipping</div>
            <div class="feature-description">Free on order over $100</div>
        </div>
        
        <div class="feature">
            <div class="feature-icon">
                <i class="fas fa-lock"></i>
            </div>
            <div class="feature-title">Cash on Delievry</div>
            <div class="feature-description">100% security payment</div>
        </div>
        
        <div class="feature">
            <div class="feature-icon">
                <i class="fas fa-exchange-alt"></i>
            </div>
            <div class="feature-title">30 Day Return</div>
            <div class="feature-description">30 day money guarantee</div>
        </div>
        
        <div class="feature">
            <div class="feature-icon">
                <i class="fas fa-headset"></i>
            </div>
            <div class="feature-title">24/7 Support</div>
            <div class="feature-description">Support every time fast</div>
        </div>
    </div>
<section class="py-5 overflow-hidden category-section">
  <div class="container-lg">
    <div class="row">
      <div class="col-md-12">
        <div class="section-header d-flex flex-wrap justify-content-between mb-5">
          <h2 class="section-title">Category</h2>
          <div class="d-flex align-items-center">
            <div class="swiper-buttons">
              <button class="swiper-prev category-carousel-prev btn btn-yellow">❮</button>
              <button class="swiper-next category-carousel-next btn btn-yellow">❯</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="category-carousel swiper">
          <div class="swiper-wrapper">
            @foreach ($categories as $category)
                <a href="{{ route('products.list', ['category' => $category->id]) }}" class="nav-link swiper-slide text-center">
                    <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}"  class="rounded-circle" width="150" height='150'>
                    <h4 class="fs-6 mt-3 fw-normal category-title">{{ $category->name }}</h4>
                </a>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="py-5 centered-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="bootstrap-tabs product-tabs">
                    <div class="tabs-header d-flex justify-content-between border-bottom my-5">
                        <h2  class="section-title">Trending Products</h2>
                        <a href="{{ route('products.list')}}" class="btn d-flex align-items-center" id="show-all-btn" style="border-color: #ff9800; color: #ff9800;">
                            Show All <svg width="20" height="20" class="ms-1"><use xlink:href="#arrow-right"></use></svg>
                        </a>
                    </div>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-all" role="tabpanel" aria-labelledby="nav-all-tab">
                            <div class="product-grid row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5">
                                @foreach ($products as $product)

                                    <div class="col">
                                      <div class="product-item">
                                        <figure>
                                          <a href="{{ route('product.show', $product->id) }}" title="{{ $product->name }}">
                                            <img src="{{ asset('storage/' . $product->img) }}" alt="{{ $product->name }}" class="tab-image">
                                          </a>
                                        </figure>
                                        <div class="d-flex flex-column text-center">
                                          <h3 class="fs-6 fw-normal">{{ $product->name }}</h3>
                                          <span class="badge {{ $product->stock > 0 ? 'text-success' : 'text-danger' }}">
                                              {{ $product->stock > 0 ? 'Available' : 'Not available' }}
                                          </span>
                                          <div class="d-flex justify-content-center align-items-center gap-2">
                                            <span class="text-dark fw-bold">{{ number_format($product->price, 2) }} mad</span>
                                          </div>
                                          <div class="button-area p-3 pt-0">
                                            <div class="d-flex justify-content-center">
                                              <div class="row g-1 mt-2">
                                                <div class="col-7" id="btn-cart">
                                                  <a href="{{ route('product.show', $product->id) }}" class="btn btn-warning rounded-1 p-2 fs-7 btn-cart">
                                                    <svg width="18" height="18"><use xlink:href="#cart"></use></svg> View More
                                                  </a>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
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

<div id="carouselExampleControls" class="carousel slide custom-carousel" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="{{asset('assets/img/banners/banner1.jpg')}}" alt="First slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="{{asset('assets/img/banners/banner2.jpg')}}" alt="Second slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="{{asset('assets/img/banners/banner3.jpg')}}" alt="Third slide">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

<section id="featured-products" class="products-carousel">
  <div class="container-lg overflow-hidden py-3">
    <div class="row">
      <div class="col-md-12">
        <div class="section-header d-flex flex-wrap justify-content-between my-4">
          <h2 class="section-title">Featured products</h2>
          <div class="d-flex align-items-center">
            <div class="swiper-buttons">
              <button class="swiper-prev category-carousel-prev btn btn-yellow">❮</button>
              <button class="swiper-next category-carousel-next btn btn-yellow">❯</button>
            </div>  
          </div>
        </div>
        <div class="swiper">
          <div class="swiper-wrapper">
            @foreach ($randomProducts as $rproduct)
              <div class="product-item swiper-slide">
                <figure>
                  <a href="{{ route('product.show', $rproduct->id) }}" title="{{ $rproduct->name }}">
                    <img src="{{ asset('storage/' . $rproduct->img) }}" alt="{{ $rproduct->name }}" class="tab-image">
                  </a>
                </figure>
                <div class="d-flex flex-column text-center">
                  <h3 class="fs-6 fw-normal">{{ $rproduct->name }}</h3>
                  <div>
                    <span class="badge {{ $rproduct->stock > 0 ? 'text-success' : 'text-danger' }}">
                        {{ $rproduct->stock > 0 ? 'Available' : 'Not available' }}
                    </span>
                  </div>
                  <div class="d-flex justify-content-center align-items-center gap-2">
                    <span class="text-dark fw-semibold">{{ number_format($rproduct->price, 2) }} mad</span>
                  </div>
                  <div class="button-area p-3 pt-0">
                    <div class="row g-1 mt-2" style="display: flex;justify-content: center;">
                      <div class="col-7" id="btn-cart"><a href="{{ route('product.show', $rproduct->id) }}" class="btn btn-warning rounded-1 p-2 fs-7 btn-cart"><svg width="18" height="18"><use xlink:href="#cart"></use></svg> View Product</a></div>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<section id="featured-products" class="products-carousel">
  <div class="container-lg overflow-hidden py-3">
    <div class="row">
      <div class="col-md-12">
        <div class="section-header d-flex flex-wrap justify-content-between my-4">
          <h2 class="section-title">Just arrived</h2>
          <div class="d-flex align-items-center">
            <div class="swiper-buttons">
              <button class="swiper-prev category-carousel-prev btn btn-yellow">❮</button>
              <button class="swiper-next category-carousel-next btn btn-yellow">❯</button>
            </div>  
          </div>
        </div>
        <div class="swiper">
          <div class="swiper-wrapper">
            @foreach ($latestProducts as $lproduct)
              <div class="product-item swiper-slide">
                <figure>
                  <a href="{{ route('product.show', $lproduct->id) }}" title="{{ $lproduct->name }}">
                    <img src="{{ asset('storage/' . $lproduct->img) }}" alt="{{ $lproduct->name }}" class="tab-image">
                  </a>
                </figure>
                <div class="d-flex flex-column text-center">
                  <h3 class="fs-6 fw-normal">{{ $lproduct->name }}</h3>
                  <div>
                    <span class="badge {{ $lproduct->stock > 0 ? 'text-success' : 'text-danger' }}">
                        {{ $lproduct->stock > 0 ? 'Available' : 'Not available' }}
                    </span>
                  </div>
                  <div class="d-flex justify-content-center align-items-center gap-2">
                    <span class="text-dark fw-semibold">{{ number_format($lproduct->price, 2) }} mad</span>
                    <span class="badge border border-dark-subtle rounded-0 fw-normal px-1 fs-7 lh-1 text-body-tertiary">10% OFF</span>
                  </div>
                  <div class="button-area p-3 pt-0">
                    <div class="row g-1 mt-2" style="display: flex;justify-content: center;">
                      <div class="col-7" id="btn-cart"><a href="{{ route('product.show', $lproduct->id) }}" class="btn btn-warning rounded-1 p-2 fs-7 btn-cart"><svg width="18" height="18"><use xlink:href="#cart"></use></svg> View Product</a></div>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- <div class="section-title">
    <h2>Lifestyle Preferences</h2>
</div> -->
<!-- Preferences Section -->
<!-- <div class="preferences">
    <div class="preference-item">
      <img src="{{ asset('assets/img/lifestyle/gluten.png')}}" alt="">
    </div>
    <div class="preference-item">
      <img src="{{ asset('assets/img/lifestyle/pescatarian.png')}}" alt="">
    </div>
    <div class="preference-item">
      <img src="{{ asset('assets/img/lifestyle/vegan.jpg')}}" alt="">
    </div>
    <div class="preference-item">
      <img src="{{ asset('assets/img/lifestyle/vegetarian.jpeg')}}" alt="">
    </div>
</div> -->
<!-- Coming Soon -->
<section class="py-5 my-5">
  <div class="container-fluid">
    <div class="bg-warning py-5 rounded-5" style="background-image: url({{ asset('assets/img/bg-pattern-2.png')}}) no-repeat;">
      <div class="container">
        <div class="row">
          
          <div class="col-md-8">
            <h2 class="my-5"><strong>Coming Soon!! :</strong> Shop faster with GroceryHub App</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sagittis sed ptibus liberolectus nonet psryroin. Amet sed lorem posuere sit iaculis amet, ac urna. Adipiscing fames semper erat ac in suspendisse iaculis. Amet blandit tortor praesent ante vitae. A, enim pretiummi senectus magna. Sagittis sed ptibus liberolectus non et psryroin.</p>
            <div class="d-flex gap-2 flex-wrap">
              <img src="{{ asset('assets/img/app-store.jpg')}}" alt="app-store">
              <img src="{{ asset('assets/img/google-play.jpg')}}" alt="google-play">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<script>
  // First Swiper
  const categorySwiper = new Swiper('.category-carousel', {
    slidesPerView: 4,
    spaceBetween: 30,
    navigation: {
      nextEl: '.category-carousel-next',
      prevEl: '.category-carousel-prev',
      }}
    );
  
  // Second Swiper
  const swiper = new Swiper('.swiper', {
    slidesPerView: 1,
    spaceBetween: 20,
    loop: true,
    navigation: {
      nextEl: '.category-carousel-next',
      prevEl: '.category-carousel-prev',
  }}
);

</script>
@endsection