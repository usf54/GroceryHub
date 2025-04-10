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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
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
          <input type="text" id="live-search" placeholder="Search (Vegetables, Fruits.. etc.)" autocomplete="off">
          <div id="search-results" class="live-results"></div>
        </div>


        <div class="header-icons">
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
                @if ( Auth::user()->role === 'admin')
                  <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                @endif
                <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Edit Profile</a></li>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
