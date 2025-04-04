<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- SEO Meta Tags -->
    <meta name="description" content="@yield('description', 'Your Best Grocery Store')">
    <meta name="keywords" content="grocery, vegetables, fruits, dairy, bakery, fresh food, grocery store, online shopping">
    <meta name="author" content="GroceryHub">
    
    <!-- Open Graph Tags for social media sharing -->
    <meta property="og:title" content="@yield('title')">
    <meta property="og:description" content="@yield('description', 'Your Best Grocery Store')">
    <meta property="og:image" content="{{ asset('assets/img/logo.png') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
    
    <link rel="shortcut icon" href="{{ asset('assets/img/logo.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/css/master.css') }}">
    @stack('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <title>@yield('title')</title>
</head>
<body>
    <header>
      <div class="search-container">
        <div class="logo">
          <a href="/">
            <img src="{{ asset('assets/img/logo1.png') }}" alt="logo">
          </a>
        </div>
        <div class="search-bar">
          <input type="text" placeholder='Search (Vegetables, Fruits.. etc.)'>
          <i class="fa-solid fa-magnifying-glass"></i>
        </div>
        <div class="header-icons">
          <!-- Mobile Menu Toggle -->
          <!-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <i class="fa-solid fa-bars"></i>
          </button> -->
          @if (!Auth::user())
            <div class="icon"><a href="{{route('profile.edit')}}"><i class="fa-regular fa-user"></i></a></div>
          @else
          <div class="icon position-relative me-3">
            <a href="{{ route('cart.view') }}" class="text-dark text-decoration-none">
                <i class="fa-solid fa-cart-shopping fs-5"></i>
                <span id="cart-count" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    {{ session('cart') ? count(session('cart')) : 0 }}
                </span>
            </a>
        </div>

        <div class="dropdown">
            <button class="btn btn-light dropdown-toggle d-flex align-items-center" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="me-2">{{ Auth::user()->name }}</span>
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="dropdown-item" type="submit">Log Out</button>
                    </form>
                </li>
            </ul>
        </div>

          @endif
      </div>
    </header>
   
    <main>
      @yield('content')
    </main>
    <footer class="text-white text-center text-lg-start" style="background-color:rgb(0, 0, 0);">
        <div class="container p-4">
          <div class="row mt-4">
            <div class="col-lg-4 col-md-12 mb-4 mb-md-0">
              <h5 class="text-uppercase mb-4">About company</h5>
              <p>
                At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium
                voluptatum deleniti atque corrupti.
              </p>
              <p>
                Blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas
                molestias.
              </p>
              <div class="mt-4">
                <a type="button" class="btn btn-floating btn-warning btn-lg"><i class="fab fa-facebook-f"></i></a>
                <a type="button" class="btn btn-floating btn-warning btn-lg"><i class="fab fa-twitter"></i></a>
                <a type="button" class="btn btn-floating btn-warning btn-lg"><i class="fab fa-google-plus-g"></i></a>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
              <h5 class="text-uppercase mb-4 pb-1">Find Us</h5>
              <ul class="fa-ul" style="margin-left: 1.65em;">
                <li class="mb-3">
                  <span class="fa-li"><i class="fas fa-home"></i></span><span class="ms-2">Casablanca, bv 10012, MR</span>
                </li>
                <li class="mb-3">
                  <span class="fa-li"><i class="fas fa-envelope"></i></span><span class="ms-2">info@grocery-hub.com</span>
                </li>
                <li class="mb-3">
                  <span class="fa-li"><i class="fas fa-phone"></i></span><span class="ms-2">+ 01 234 567 88</span>
                </li>
                <li class="mb-3">
                  <span class="fa-li"><i class="fas fa-print"></i></span><span class="ms-2">+ 01 234 567 89</span>
                </li>
              </ul>
            </div>
            <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
              <h5 class="text-uppercase mb-4">Opening hours</h5>
              <table class="table text-center text-white">
                <tbody class="font-weight-normal">
                  <tr>
                    <td>Mon - Thu:</td>
                    <td>8am - 9pm</td>
                  </tr>
                  <tr>
                    <td>Fri - Sat:</td>
                    <td>8am - 1am</td>
                  </tr>
                  <tr>
                    <td>Sunday:</td>
                    <td>9am - 10pm</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
          © 2020 Copyright:
          <a class="text-white" href="#">GroceryHub</a>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
