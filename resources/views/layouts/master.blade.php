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
    
    @stack('styles')
    <link rel="shortcut icon" href="{{ asset('assets/img/logo.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/css/master.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    
    <title>@yield('title')</title>
</head>
<body>
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
      <defs>
        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
          <defs>
            <symbol xmlns="http://www.w3.org/2000/svg" id="user" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="9" r="3"/><circle cx="12" cy="12" r="10"/><path stroke-linecap="round" d="M17.97 20c-.16-2.892-1.045-5-5.97-5s-5.81 2.108-5.97 5"/></g></symbol>
            <symbol xmlns="http://www.w3.org/2000/svg" id="shopping-bag" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-width="1.5"><path d="M3.864 16.455c-.858-3.432-1.287-5.147-.386-6.301C4.378 9 6.148 9 9.685 9h4.63c3.538 0 5.306 0 6.207 1.154c.901 1.153.472 2.87-.386 6.301c-.546 2.183-.818 3.274-1.632 3.91c-.814.635-1.939.635-4.189.635h-4.63c-2.25 0-3.375 0-4.189-.635c-.814-.636-1.087-1.727-1.632-3.91Z"/><path d="m19.5 9.5l-.71-2.605c-.274-1.005-.411-1.507-.692-1.886A2.5 2.5 0 0 0 17 4.172C16.56 4 16.04 4 15 4M4.5 9.5l.71-2.605c.274-1.005.411-1.507.692-1.886A2.5 2.5 0 0 1 7 4.172C7.44 4 7.96 4 9 4"/><path d="M9 4a1 1 0 0 1 1-1h4a1 1 0 1 1 0 2h-4a1 1 0 0 1-1-1Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M8 13v4m8-4v4m-4-4v4"/></g></symbol>
          </defs>
        </svg>
      </defs>
    </svg>

    <header class="bg-white shadow-sm">
      <div class="container-fluid">
        <div class="row align-items-center py-3">

          <!-- Logo -->
          <div class="col-6 col-sm-4 col-lg-2 d-flex justify-content-start align-items-center">
            <a href="/">
              <img src="{{ asset('assets/img/logo1.png') }}" alt="logo" class="img-fluid" style="max-height:50px;">
            </a>
          </div>

          <!-- Search Bar (hidden on xs, full width on sm+) -->
          <div class="col-12 col-sm-6 col-lg-4 my-2 my-lg-0 order-3 order-sm-2">
            <div class="input-group rounded-pill bg-light overflow-hidden">
              <input type="text" id="live-search" class="form-control border-0 bg-transparent px-3" placeholder="Search">
              <button class="btn btn-light border-0 px-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                  <path fill="currentColor" d="M21.71 20.29L18 16.61A9 9 0 1 0 16.61 18l3.68 3.68a1 1 0 0 0 1.42 0a1 1 0 0 0 0-1.39ZM11 18a7 7 0 1 1 7-7a7 7 0 0 1-7 7Z"/>
                </svg>
              </button>
            </div>
            <div id="search-results" class="live-results position-absolute bg-white shadow rounded mt-1 w-100"></div>
          </div>

          <!-- Navbar Links -->
          <div class="col-12 col-lg-4 d-flex justify-content-center justify-content-lg-start my-2 my-lg-0 order-2 order-lg-3">
            <ul class="navbar-nav d-flex flex-row flex-wrap gap-2 gap-lg-4 align-items-center mb-0 text-uppercase fw-bold">

              <li class="nav-item">
                <a href="/" class="nav-link px-2">Home</a>
              </li>

              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle px-2" href="#" id="pagesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Pages
                </a>
                <ul class="dropdown-menu border-0 shadow p-2 rounded-2" aria-labelledby="pagesDropdown">
                  <li><a class="dropdown-item" href="{{ route('checkout.form') }}">Checkout</a></li>
                  <li><a class="dropdown-item" href="{{ route('packs.index') }}">Check our packs</a></li>
                  <li><a class="dropdown-item" href="{{ route('home') }}">About Us</a></li>
                  <li><a class="dropdown-item" href="{{ route('home') }}">Contact</a></li>
                </ul>
              </li>

            </ul>
          </div>

          <!-- Auth & Cart -->
          <div class="col-6 col-sm-2 col-lg-2 d-flex justify-content-end align-items-center gap-2 gap-lg-3 order-1 order-sm-3">

            <!-- Guest -->
            @guest
              <a href="{{ route('login') }}" class="text-dark p-2">
                <svg width="24" height="24"><use xlink:href="#user"></use></svg>
              </a>
            @endguest

            <!-- Authenticated -->
            @auth
              <div class="d-flex align-items-center gap-2 gap-lg-3 flex-wrap">

                <!-- Dashboard / Profile -->
                @if(Auth::user()->role === 'admin')
                  <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-outline-primary">Dashboard</a>
                @elseif(Auth::user()->role === 'client')
                  <a href="{{ route('dashboard') }}" class="btn btn-sm btn-outline-primary">Profile</a>
                @endif

                <a href="{{ route('profile.edit') }}" class="btn btn-sm btn-outline-secondary">Edit Profile</a>

                <!-- Cart -->
                <a href="{{ route('cart.view') }}" class="position-relative text-dark" data-bs-toggle="offcanvas" data-bs-target="#offcanvasCart" aria-controls="offcanvasCart">
                  <svg width="24" height="24"><use xlink:href="#shopping-bag"></use></svg>
                  <span id="cart-count" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    {{ session('cart') ? count(session('cart')) : 0 }}
                  </span>
                </a>

                <!-- Logout -->
                <form method="POST" action="{{ route('logout') }}" class="m-0">
                  @csrf
                  <button type="submit" class="btn btn-sm btn-outline-danger">Log Out</button>
                </form>

              </div>
            @endauth

          </div>

        </div>
      </div>
    </header>

    <main>
      @yield('content')
    </main>

    <footer class="text-center text-lg-start" style="background-color:rgb(255, 255, 255);color: black;border: 1px solid #d7d4d4;">
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
        <div class="text-center p-3" style="background-color: rgb(255, 255, 255);">
          © 2026 Copyright:
          <a class="text-dark" href="#">GroceryHub</a>
        </div>
    </footer>
    
    <!-- Return to Top Button -->
    <div class="return-to-top" id="returnToTop">
        <i class="fas fa-arrow-up"></i>
    </div>

    <script>
      document.addEventListener('DOMContentLoaded', function () {
          const searchInput = document.getElementById('live-search');
          const resultsBox = document.getElementById('search-results');

          searchInput.addEventListener('input', function () {
              const query = this.value.trim();

              if (query.length < 2) {
                  resultsBox.style.display = 'none';
                  resultsBox.innerHTML = '';
                  return;
              }
              
              //encodeURIComponent = C’est une fonction JavaScript intégrée qui encode une chaîne de texte (string)
              //  pour qu’elle puisse être sûrement utilisée dans une URL.
              fetch(`/live-search?query=${encodeURIComponent(query)}`)
                  .then(res => res.json())
                  .then(data => {
                      resultsBox.innerHTML = '';
                      if (data.length > 0) {
                          data.forEach(product => {
                              const item = document.createElement('a');
                              item.href = `/products/${product.id}`;
                              item.classList.add('search-result-item');
                              item.innerHTML = `
                                  <div class="d-flex align-items-center gap-2 p-2">
                                      <img src="/storage/${product.img}" alt="${product.name}" style="width: 40px; height: 40px; object-fit: cover; border-radius: 6px;">
                                      <span>${product.name}</span>
                                  </div>
                              `;
                              resultsBox.appendChild(item);
                          });

                          resultsBox.style.display = 'block';
                      } else {
                          resultsBox.innerHTML = '<div class="p-2 text-muted">No results found.</div>';
                          resultsBox.style.display = 'block';
                      }
                  });
          });

          document.addEventListener('click', (e) => {
              if (!searchInput.contains(e.target) && !resultsBox.contains(e.target)) {
                  resultsBox.style.display = 'none';
              }
          });
      });
      const returnToTopButton = document.getElementById('returnToTop');
          
          // Show/hide button based on scroll position
          window.addEventListener('scroll', function() {
              if (window.pageYOffset > 300) {
                  returnToTopButton.classList.add('show');
              } else {
                  returnToTopButton.classList.remove('show');
              }
          });
          
          // Smooth scroll to top when clicked
          returnToTopButton.addEventListener('click', function() {
              window.scrollTo({
                  top: 0,
                  behavior: 'smooth'
              });
          });
          
    </script>
    
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    @stack('js')
</body>
</html>
