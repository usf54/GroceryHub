@extends('layouts.master')
@section('title','Home | GroceryHub')
@push('styles')
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css">
  <link rel="stylesheet" href="{{ asset('assets/css/hero.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendor.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
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

        <symbol xmlns="http://www.w3.org/2000/svg" id="star-full" viewBox="0 0 24 24">
          <path fill="currentColor" d="m3.1 11.3l3.6 3.3l-1 4.6c-.1.6.1 1.2.6 1.5c.2.2.5.3.8.3c.2 0 .4 0 .6-.1c0 0 .1 0 .1-.1l4.1-2.3l4.1 2.3s.1 0 .1.1c.5.2 1.1.2 1.5-.1c.5-.3.7-.9.6-1.5l-1-4.6c.4-.3 1-.9 1.6-1.5l1.9-1.7l.1-.1c.4-.4.5-1 .3-1.5s-.6-.9-1.2-1h-.1l-4.7-.5l-1.9-4.3s0-.1-.1-.1c-.1-.7-.6-1-1.1-1c-.5 0-1 .3-1.3.8c0 0 0 .1-.1.1L8.7 8.2L4 8.7h-.1c-.5.1-1 .5-1.2 1c-.1.6 0 1.2.4 1.6"/>
        </symbol>
        <symbol xmlns="http://www.w3.org/2000/svg" id="star-half" viewBox="0 0 24 24">
          <path fill="currentColor" d="m3.1 11.3l3.6 3.3l-1 4.6c-.1.6.1 1.2.6 1.5c.2.2.5.3.8.3c.2 0 .4 0 .6-.1c0 0 .1 0 .1-.1l4.1-2.3l4.1 2.3s.1 0 .1.1c.5.2 1.1.2 1.5-.1c.5-.3.7-.9.6-1.5l-1-4.6c.4-.3 1-.9 1.6-1.5l1.9-1.7l.1-.1c.4-.4.5-1 .3-1.5s-.6-.9-1.2-1h-.1l-4.7-.5l-1.9-4.3s0-.1-.1-.1c-.1-.7-.6-1-1.1-1c-.5 0-1 .3-1.3.8c0 0 0 .1-.1.1L8.7 8.2L4 8.7h-.1c-.5.1-1 .5-1.2 1c-.1.6 0 1.2.4 1.6m8.9 5V5.8l1.7 3.8c.1.3.5.5.8.6l4.2.5l-3.1 2.8c-.3.2-.4.6-.3 1c0 .2.5 2.2.8 4.1l-3.6-2.1c-.2-.2-.3-.2-.5-.2"/>
        </symbol>

        <symbol xmlns="http://www.w3.org/2000/svg" id="package" viewBox="0 0 48 48">
          <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="m24 13.264l7.288 4.21L24 21.681l-7.288-4.209Z"/>
          <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M16.712 17.473v8.418L24 30.101l7.288-4.21v-8.418M24 30.1v-8.418"/>
          <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M40.905 21.405a16.905 16.905 0 1 0-23.389 15.611L24 43.5l6.484-6.484a16.906 16.906 0 0 0 10.42-15.611"/>
        </symbol>
        <symbol xmlns="http://www.w3.org/2000/svg" id="secure" viewBox="0 0 48 48">
          <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M14.134 36V20.11h19.732M19.279 36h14.587V25.45"/>
          <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="m19.246 26.606l4.135 4.135l5.373-5.372m-8.934-9.282a4.087 4.087 0 1 1 8.174 0m0 0v4.023m-8.172-4.108v4.108"/>
          <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M30.288 44.566a21.516 21.516 0 1 1 9.69-6.18"/>
        </symbol>
        <symbol xmlns="http://www.w3.org/2000/svg" id="quality" viewBox="0 0 48 48">
          <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="m30.59 13.45l4.77 2.94L24 34.68l-10.33-7l3.11-4.6l5.52 3.71l8.26-13.38Z"/>
          <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M24 4.5s-11.26 2-15.25 2v20a11.16 11.16 0 0 0 .8 4.1a15 15 0 0 0 2 3.61a22 22 0 0 0 2.81 3.07a34.47 34.47 0 0 0 3 2.48a34 34 0 0 0 2.89 1.86c1 .59 1.71 1 2.13 1.19l1 .49a1.44 1.44 0 0 0 1.24 0l1-.49c.42-.2 1.13-.6 2.13-1.19a34 34 0 0 0 2.89-1.86a34.47 34.47 0 0 0 3-2.48a22 22 0 0 0 2.81-3.07a15 15 0 0 0 2-3.61a11.16 11.16 0 0 0 .8-4.1v-20c-3.99.03-15.25-2-15.25-2"/>
        </symbol>
        <symbol xmlns="http://www.w3.org/2000/svg" id="savings" viewBox="0 0 48 48">
          <circle cx="24" cy="24" r="21.5" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
          <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M12.5 23.684a3.298 3.298 0 0 1 5.63-2.332l3.212 3.212h0l8.53-8.53a3.298 3.298 0 0 1 5.628 2.333h0c0 .875-.348 1.714-.966 2.333L22.983 32.25a2.321 2.321 0 0 1-3.283 0l-6.234-6.233a3.298 3.298 0 0 1-.966-2.333"/>
        </symbol>
        <symbol xmlns="http://www.w3.org/2000/svg" id="offers" viewBox="0 0 48 48">
          <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="m41.556 39.297l-22.022 3.11a1.097 1.097 0 0 1-1.245-.97l-2.352-22.311a1.097 1.097 0 0 1 1.08-1.213l24.238-.229a1.097 1.097 0 0 1 1.108 1.09l.137 19.429c.004.55-.4 1.017-.944 1.094M26.1 25.258v2.579m8.494-2.731v2.175"/>
          <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M34.343 32.346c-1.437.828-1.926 1.198-2.774 1.988c-1.19-.457-2.284-1.228-3.797-1.456m-15.953 8.721l-3.49-1.6a1.12 1.12 0 0 1-.643-.863L5.511 23.593c-.056-.4.108-.8.43-1.046l3.15-2.406a1.257 1.257 0 0 1 2.014.874l1.966 19.69a.887.887 0 0 1-1.252.894m11.989-28.112c.214-.456.964-1.716 2.76-3.618c3.108-3.323 4.26-4.288 4.26-4.288s1.42.75 3.27 3.109c1.876 2.358 1.93 3.832 1.93 3.832s.67-.08-4.797 1.688c-3.055.991-4.368 1.152-4.931 1.152"/>
          <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M26.97 17.828v-.054c0-.884-.241-1.715-.67-2.412c-.563-.91-1.447-1.608-2.492-1.876a3.58 3.58 0 0 0-1.072-.16c-.429 0-.858.053-1.233.214c-1.152.348-2.063 1.18-2.573 2.278a4.747 4.747 0 0 0-.428 1.956v.134"/>
          <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M18.93 15.818c-.562-.107-1.5-.349-3.135-.884c-2.304-.75-3.43-1.528-3.43-1.528s-.456-1.393 1.045-3.296s2.653-2.52 2.653-2.52s.911.778 3.43 3.485c1.26 1.313 1.796 2.09 2.01 2.465h.027"/>
        </symbol>
        
      </defs>
</svg>


<!-- START HERO SECTION -->
<section style="background-image: url('assets/img/banners/banner-1.jpg');background-repeat: no-repeat;background-size: cover;">
  <div class="container-lg">
    <div class="row">
      <div class="col-lg-6 pt-5 mt-5">
        <h2 class="display-1 ls-1"><span class="fw-bold text-primary">Organic</span> Foods at your <span class="fw-bold">Doorsteps</span></h2>
        <p class="fs-4">Dignissim massa diam elementum.</p>
        <div class="d-flex gap-3 mb-5">
          <a href=" {{ route('products.list') }} " class="cta-btn">START SHOPPING</a>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- END HERO SECTION -->


<!-- START CATEGORY SECTION -->
<section class="py-5 overflow-hidden">
  <div class="container-lg">
    <div class="row">
      <div class="col-md-12">
        <div class="section-header d-flex flex-wrap justify-content-between mb-5">
          <h2 class="section-title">Category</h2>
          <div class="d-flex align-items-center">
            <a href=" {{ route('products.list') }} " class="cta-btn">View All</a>
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
<!-- END CATEGORY SECTION -->


<!-- START PRODUCTS SECTION -->
<section class="pb-5">
  <div class="container-lg">
    <div class="row">
      <div class="col-md-12">
        <div class="section-header d-flex flex-wrap justify-content-between my-4">
          <h2 class="section-title">Trending products</h2>
          <div class="d-flex align-items-center">
            <a href=" {{ route('products.list') }} " class="cta-btn">View All</a>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="product-grid row 
                    row-cols-2 
                    row-cols-sm-2 
                    row-cols-md-3 
                    row-cols-lg-4 
                    row-cols-xl-5 
                    row-cols-xxl-6 
                    g-3">
          @foreach ($products as $product)
            <div class="col">
              <div class="card h-100 border-0 shadow-sm p-2 d-flex flex-column">
                <!-- Product Image -->
                <figure class="ratio ratio-4x3 m-2">
                  <a href="{{ route('product.show', $product->id) }}">
                    <img src="{{ asset('storage/' . $product->img) }}"
                        class="img-fluid object-fit-cover"
                        alt="{{ $product->name }}">
                  </a>
                </figure>
                <!-- Card Body -->
                <div class="card-body text-center d-flex flex-column pt-5">
                  <h3 class="fs-6 fw-normal mb-1">
                    {{ $product->name }}
                  </h3>
                  <div class="mb-1">
                    <div>
                      <span class="badge {{ $product->stock > 0 ? 'bg-success' : 'bg-danger' }}">
                        {{ $product->stock > 0 ? 'Available' : 'Not available' }} ({{$product->stock}})
                      </span>
                    </div>
                  </div>
                  <span class="text-dark fw-bold fs-6 mb-2">
                    {{ number_format($product->price, 2) }} MAD
                  </span>
                  <div class="mt-auto">
                    <a href="{{ route('product.show', $product->id) }}"
                      class="btn btn-warning btn-sm w-100 fw-semibold">
                      <svg width="18" height="18"><use xlink:href="#cart"></use></svg> View Product
                    </a>
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>
<!-- END PRODUCTS SECTION -->


<!-- START BANNERS SECTION -->
<section class="py-3">
  <div class="container-lg">
    <div class="row">
      <div class="col-md-12">
        <div class="banner-blocks">
          <div class="banner-ad d-flex align-items-center large bg-info block-1" style="background: url('assets/img/banners/banner-ad-1.jpg') no-repeat; background-size: cover;">
            <div class="banner-content p-5">
              <div class="content-wrapper text-light">
                <h3 class="banner-title text-light">Items on SALE</h3>
                <p>Veritatis eos magni ex, error inventore quo? Fugit voluptatem aliquid exer</p>
              </div>
            </div>
          </div>
          <div class="banner-ad bg-success-subtle block-2" style="background:url('assets/img/banners/banner-ad-2.jpg') no-repeat;background-size: cover">
            <div class="banner-content align-items-center p-5">
              <div class="content-wrapper text-light">
                <h3 class="banner-title text-light">Combo offers</h3>
                <p>Veritatis eos magni ex, error inventore quo? Fugit voluptatem aliquid exer</p>
              </div>
            </div>
          </div>
          <div class="banner-ad bg-danger block-3" style="background:url('assets/img/banners/banner-ad-3.jpg') no-repeat;background-size: cover">
            <div class="banner-content align-items-center p-5">
              <div class="content-wrapper text-light">
                <h3 class="banner-title text-light">Discount Coupons</h3>
                <p>Lores eos magni ex, error inventore quo? Fugit voluptatem aliquid exer</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- END BANNERS SECTION -->


<!-- START FEATURED PRODUCTS SECTION -->
<section id="featured-products" class="products-carousel">
  <div class="container-lg overflow-hidden py-5">
    <div class="row">
      <div class="col-md-12">
        <div class="section-header d-flex flex-wrap justify-content-between my-4">
          <h2 class="section-title">Featured</h2>
          <div class="d-flex align-items-center">
            <a href="{{ route('products.list') }}" class="cta-btn">View All</a>
            <div class="swiper-buttons">
              <button class="swiper-prev products-carousel-prev btn btn-yellow">❮</button>
              <button class="swiper-next products-carousel-next btn btn-yellow">❯</button>
            </div>  
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
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
                    <div class="mb-1">
                      <span>
                        <svg width="16" height="16" class="text-warning"><use xlink:href="#star-full"></use></svg>
                        <svg width="16" height="16" class="text-warning"><use xlink:href="#star-full"></use></svg>
                        <svg width="16" height="16" class="text-warning"><use xlink:href="#star-full"></use></svg>
                        <svg width="16" height="16" class="text-warning"><use xlink:href="#star-full"></use></svg>
                        <svg width="16" height="16" class="text-warning"><use xlink:href="#star-half"></use></svg>
                      </span>
                      <div>
                        <span class="badge {{ $product->stock > 0 ? 'bg-success' : 'bg-danger' }}">
                          {{ $product->stock > 0 ? 'Available' : 'Not available' }} ({{$product->stock}})
                        </span>
                      </div>
                    </div>
                  </div>
                  <div class="d-flex justify-content-center align-items-center gap-2">
                    <span class="text-dark fw-semibold">{{ number_format($rproduct->price, 2) }} mad</span>
                  </div>
                  <div class="button-area p-3 pt-0">
                    <div class="row g-1 mt-2" style="display: flex;justify-content: center;">
                      <div class="col-7" id="btn-cart">
                        <a href="{{ route('product.show', $rproduct->id) }}" class="btn btn-warning rounded-1 p-2 fs-7 btn-cart">
                          <svg width="18" height="18"><use xlink:href="#cart"></use></svg> View Product
                        </a>
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
</section>
<!-- END FEATURED PRODUCTS SECTION -->


<!-- START LATEST PRODUCTS SECTION -->
<section id="latest-products" class="products-carousel">
  <div class="container-lg overflow-hidden pb-5">
    <div class="row">
      <div class="col-md-12">
        <div class="section-header d-flex justify-content-between my-4">
          <h2 class="section-title">Just arrived</h2>
          <div class="d-flex align-items-center">
            <a href=" {{ route('products.list') }} " class="cta-btn">View All</a>
            <div class="swiper-buttons">
              <button class="swiper-prev products-carousel-prev btn btn-yellow">❮</button>
              <button class="swiper-next products-carousel-next btn btn-yellow">❯</button>
            </div>  
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
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
                    <div class="mb-1">
                      <span>
                        <svg width="16" height="16" class="text-warning"><use xlink:href="#star-full"></use></svg>
                        <svg width="16" height="16" class="text-warning"><use xlink:href="#star-full"></use></svg>
                        <svg width="16" height="16" class="text-warning"><use xlink:href="#star-full"></use></svg>
                        <svg width="16" height="16" class="text-warning"><use xlink:href="#star-full"></use></svg>
                        <svg width="16" height="16" class="text-warning"><use xlink:href="#star-half"></use></svg>
                      </span>

                      <div>
                        <span class="badge {{ $product->stock > 0 ? 'bg-success' : 'bg-danger' }}">
                          {{ $product->stock > 0 ? 'Available' : 'Not available' }} ({{$product->stock}})
                        </span>
                      </div>
                    </div>
                  </div>
                  <div class="d-flex justify-content-center align-items-center gap-2">
                    <span class="text-dark fw-semibold">{{ number_format($lproduct->price, 2) }} mad</span>
                  </div>
                  <div class="button-area p-3 pt-0">
                    <div class="row g-1 mt-2" style="display: flex;justify-content: center;">
                      <div class="col-7" id="btn-cart">
                        <a href="{{ route('product.show', $lproduct->id) }}" class="btn btn-warning rounded-1 p-2 fs-7 btn-cart">
                          <svg width="18" height="18"><use xlink:href="#cart"></use></svg> View Product
                        </a>
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
</section>
<!-- END LATEST PRODUCTS SECTION -->


<!-- START COMING SOON SECTION -->
<section class="pb-4 my-4">
  <div class="container-lg">
    <div class="bg-warning pt-5 rounded-5">
      <div class="container">
        <div class="row justify-content-center align-items-center">
          <div class="col-md-4">
            <h2 class="mt-5">Download GroceryHub App Soon</h2>
            <p>Online Orders made easy, fast and reliable</p>
            <div class="d-flex gap-2 flex-wrap mb-5">              
                  <img src="{{ asset('assets/img/app-store.jpg') }}" alt="app-store">
                  <img src="{{ asset('assets/img/google-play.jpg') }}" alt="google-play">
            </div>
          </div>
          <div class="col-md-5">
            <img src="{{ asset('assets/img/banner-onlineapp.png') }}" alt="phone" class="img-fluid">
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- END COMING SOON SECTION -->


<!-- START CARDS SECTION -->
<section class="py-5">
  <div class="container-lg">
    <div class="row row-cols-1 row-cols-sm-3 row-cols-lg-5">
      <div class="col">
        <div class="card mb-3 border border-dark-subtle p-3">
          <div class="text-dark mb-3">
            <svg width="32" height="32"><use xlink:href="#package"></use></svg>
          </div>
          <div class="card-body p-0">
            <h5>Free delivery</h5>
            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipi elit.</p>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card mb-3 border border-dark-subtle p-3">
          <div class="text-dark mb-3">
            <svg width="32" height="32"><use xlink:href="#secure"></use></svg>
          </div>
          <div class="card-body p-0">
            <h5>100% secure payment</h5>
            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipi elit.</p>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card mb-3 border border-dark-subtle p-3">
          <div class="text-dark mb-3">
            <svg width="32" height="32"><use xlink:href="#quality"></use></svg>
          </div>
          <div class="card-body p-0">
            <h5>Quality guarantee</h5>
            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipi elit.</p>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card mb-3 border border-dark-subtle p-3">
          <div class="text-dark mb-3">
            <svg width="32" height="32"><use xlink:href="#savings"></use></svg>
          </div>
          <div class="card-body p-0">
            <h5>guaranteed savings</h5>
            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipi elit.</p>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card mb-3 border border-dark-subtle p-3">
          <div class="text-dark mb-3">
            <svg width="32" height="32"><use xlink:href="#offers"></use></svg>
          </div>
          <div class="card-body p-0">
            <h5>Daily offers</h5>
            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipi elit.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- END CARDS SECTION -->

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/js/jquery-1.11.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins.js') }}"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>
@endpush
@endsection