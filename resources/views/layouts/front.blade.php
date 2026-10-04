<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'Himalayan — Handcrafted Fine Jewelry | Rings & Hand Bangles')</title>
  <meta name="description"
    content="Discover bespoke handcrafted rings and sculpted hand bangles forged with devotion in 18K gold vermeil, 925 sterling silver, and raw brass at our home studio.">

  <!-- Bootstrap 5.3 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <!-- Custom Design System -->
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  @yield('css')
</head>

<body>

  <!-- Top Promo Strip -->
  <div class="promo-strip text-center">
    <div class="container d-flex justify-content-center align-items-center flex-wrap gap-2">
      <span>✨ <strong>Handcrafted with Devotion:</strong> Free Delivery on orders over <span
          class="text-gold-accent discount-text">Rs.1,999</span> </span>
      <span class="d-none d-md-inline">·</span>
      <span>Use code <span class="badge bg-gold text-white px-2 py-1">HANDMADE10</span> for 10% off</span>
    </div>
  </div>

  <!-- Main Luxury Navbar with Dynamic Active Indicators -->
  <nav class="navbar navbar-expand-lg luxury-navbar sticky-top">
    <div class="container">
      <button class="navbar-toggler border-0 shadow-none ps-0" type="button" data-bs-toggle="collapse"
        data-bs-target="#navbarMain" aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
        <i class="bi bi-list fs-2 text-ink"></i>
      </button>

      <a class="navbar-brand d-flex align-items-center gap-2 me-lg-4" href="{{ route('home') }}">
        <img src="{{ asset('assets/images/main_logo_himalayan_handicraft_website.svg') }}" alt="Himalayan Logo"
          class="himalayan_logo brand-logo-img me-2">
        <div class="d-flex flex-column text-start">
          <span class="brand-text">Himalayan</span>
          <span class="brand-subtitle">Handcrafted Fine Jewellery</span>
        </div>
      </a>

      <div class="collapse navbar-collapse" id="navbarMain">
        <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->is('products*') ? 'active' : '' }}" href="{{ route('products.index') }}">Collection</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->is('contact*') ? 'active' : '' }}" href="{{ route('contact.index') }}">Our Studio & Story</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('contact.index') }}#contact-section">Contact Us</a>
          </li>
          @auth
            @if(Auth::user()->isAdmin())
              <li class="nav-item">
                <a class="nav-link {{ request()->is('admin*') ? 'active' : '' }} text-gold-accent fw-semibold" href="{{ route('admin.dashboard') }}">
                  <i class="bi bi-shield-lock me-1"></i>Atelier Admin
                </a>
              </li>
            @endif
          @endauth
        </ul>
      </div>

      <div class="d-flex align-items-center gap-2">
        <button type="button" class="nav-action-btn" data-bs-toggle="modal" data-bs-target="#searchModal"
          title="Search Jewelry">
          <i class="bi bi-search"></i>
        </button>
        <button type="button" class="nav-action-btn" onclick="toggleTheme()" title="Toggle Theme">
          <i class="bi bi-moon-stars theme-toggle-icon"></i>
        </button>
        <a href="{{ route('products.index', ['wishlist' => 'true']) }}" class="nav-action-btn position-relative" title="Wishlist">
          <i class="bi bi-heart"></i>
          <span
            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger wishlist-count-badge d-none">0</span>
        </a>

        @guest
          <div class="auth-nav-link">
            <a href="{{ route('login') }}" class="nav-action-btn {{ request()->is('login*') || request()->is('register*') ? 'border-gold' : '' }}" title="Sign In">
              <i class="bi bi-person"></i>
            </a>
          </div>
        @else
          <div class="dropdown auth-user-dropdown">
            <button class="nav-action-btn border-gold" type="button" data-bs-toggle="dropdown" aria-expanded="false" title="Account">
              <i class="bi bi-person-check-fill text-gold-accent"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end border-warm shadow-sm py-2">
              <li class="px-3 py-1 small text-muted">
                Signed in as <strong class="auth-user-name text-ink">{{ Auth::user()->name }}</strong>
                @if(Auth::user()->isAdmin())
                  <span class="badge bg-gold text-white ms-1">Admin</span>
                @endif
              </li>
              <li>
                <hr class="dropdown-divider my-1">
              </li>
              <li>
                <a class="dropdown-item py-2" href="{{ route('checkout.index') }}">
                  <i class="bi bi-bag-check me-2"></i>My Orders & Checkout
                </a>
              </li>
              @if(Auth::user()->isAdmin())
                <li>
                  <a class="dropdown-item py-2 text-gold-accent fw-semibold" href="{{ route('admin.dashboard') }}">
                    <i class="bi bi-shield-lock me-2"></i>Admin Dashboard
                  </a>
                </li>
              @endif
              <li>
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                  @csrf
                  <button type="submit" class="dropdown-item py-2 text-danger w-100 text-start bg-transparent border-0">
                    <i class="bi bi-box-arrow-right me-2"></i>Sign Out
                  </button>
                </form>
              </li>
            </ul>
          </div>
        @endguest

        <button type="button" class="nav-action-btn position-relative" data-bs-toggle="offcanvas"
          data-bs-target="#cartDrawer" title="Cart">
          <i class="bi bi-bag"></i>
          <span
            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-gold cart-count-badge d-none">0</span>
        </button>
      </div>
    </div>
  </nav>

  <!-- Global Flash Messages Notification Bar -->
  <div class="container mt-3">
    @if(session('success'))
      <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm d-flex align-items-center gap-2" role="alert">
        <i class="bi bi-check-circle-fill text-success fs-5"></i>
        <div>{{ session('success') }}</div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    @if(session('error'))
      <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm d-flex align-items-center gap-2" role="alert">
        <i class="bi bi-exclamation-triangle-fill text-danger fs-5"></i>
        <div>{{ session('error') }}</div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    @if(session('info'))
      <div class="alert alert-info alert-dismissible fade show border-0 shadow-sm d-flex align-items-center gap-2" role="alert">
        <i class="bi bi-info-circle-fill text-info fs-5"></i>
        <div>{{ session('info') }}</div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif
  </div>

  @yield('content')

  <!-- WhatsApp Bespoke Floating Button -->
  <a href="https://wa.me/919876543210?text=Hi%20Himalayan%20Jewelry%2C%20I%20have%20a%20question%20about%20your%20handcrafted%20rings%20and%20bangles"
    target="_blank" class="whatsapp-float" title="Chat on WhatsApp" aria-label="WhatsApp Chat">
    <i class="bi bi-whatsapp"></i>
  </a>

  <!-- Global Luxury Footer (Shared across all pages) -->
  <footer class="luxury-footer">
    <div class="container">
      <div class="row g-4 mb-5">
        <div class="col-lg-4">
          <div class="d-flex align-items-center gap-2 mb-3">
            <img src="{{ asset('assets/images/main_logo_himalayan_handicraft_website.svg') }}" alt="Himalayan Logo"
              class="himalayan_logo brand-logo-img me-2">
            <span class="brand-text text-white">Himalayan</span>
          </div>
          <p class="small pe-lg-4 mb-4">
            A home-based fine jewelry atelier dedicated to reviving slow, devotional metalcraft. Specializing in
            textured rings and hand bangles in gold vermeil, 925 sterling silver, and raw jewelers brass.
          </p>
          <div class="d-flex gap-2">
            <a href="https://instagram.com" target="_blank" class="footer-social-btn" aria-label="Instagram"><i
                class="bi bi-instagram"></i></a>
            <a href="https://facebook.com" target="_blank" class="footer-social-btn" aria-label="Facebook"><i
                class="bi bi-facebook"></i></a>
            <a href="https://pinterest.com" target="_blank" class="footer-social-btn" aria-label="Pinterest"><i
                class="bi bi-pinterest"></i></a>
            <a href="https://wa.me/919876543210?text=Hello%20Himalayan%20Jewelry" target="_blank"
              class="footer-social-btn" aria-label="WhatsApp"><i class="bi bi-whatsapp"></i></a>
          </div>
        </div>

        <div class="col-6 col-lg-2">
          <h6>Collections</h6>
          <ul class="list-unstyled small">
            <li class="mb-2"><a href="{{ route('products.index', ['cat' => 'rings']) }}">Artisanal Rings</a></li>
            <li class="mb-2"><a href="{{ route('products.index', ['cat' => 'bangles']) }}">Hand Bangles & Cuffs</a></li>
            <li class="mb-2"><a href="{{ route('products.index', ['metal' => 'gold']) }}">18K Gold Vermeil</a></li>
            <li class="mb-2"><a href="{{ route('products.index', ['metal' => 'silver']) }}">925 Sterling Silver</a></li>
            <li class="mb-2"><a href="{{ route('products.index', ['metal' => 'brass']) }}">Raw Jewelers Brass</a></li>
          </ul>
        </div>

        <div class="col-6 col-lg-2">
          <h6>Customer Care</h6>
          <ul class="list-unstyled small">
            <li class="mb-2"><a href="{{ route('contact.index') }}#sizing-guide">Ring & Bangle Sizing</a></li>
            <li class="mb-2"><a href="{{ route('contact.index') }}#faq-section">Jewelry Care Guide</a></li>
            <li class="mb-2"><a href="{{ route('cart.index') }}">Your Jewelry Box</a></li>
            <li class="mb-2"><a href="{{ route('checkout.index') }}">Secure Checkout</a></li>
            <li class="mb-2"><a href="{{ route('contact.index') }}#contact-section">Custom Inquiries</a></li>
          </ul>
        </div>

        <div class="col-lg-4">
          <h6>Home Studio Hours</h6>
          <p class="small mb-2"><i class="bi bi-geo-alt text-gold-accent me-2"></i> Artisanal Studio, Craft
            Lane, Civil Lines, Jaipur</p>
          <p class="small mb-2"><i class="bi bi-telephone text-gold-accent me-2"></i> +91 98765 43210
            (Mon–Sat, 10am – 7pm)</p>
          <p class="small mb-3"><i class="bi bi-envelope text-gold-accent me-2"></i>
            atelier@himalayanjewels.com</p>
          <div class="p-3 bg-dark rounded border border-secondary border-opacity-25 small">
            <div class="fw-semibold text-light mb-1">WhatsApp Bespoke Assistance</div>
            <div class="x-small mb-2">Speak directly with the bench jeweler for custom ring sizes or heirloom bridal stacks.</div>
            <a href="https://wa.me/919876543210?text=Hi%20Himalayan%2C%20I%20would%20like%20to%20inquire%20about%20custom%20jewelry"
              target="_blank" class="btn btn-sm btn-outline-gold w-100">
              <i class="bi bi-whatsapp me-1 text-success"></i> Chat on WhatsApp
            </a>
          </div>
        </div>
      </div>

      <div
        class="border-top border-secondary border-opacity-25 pt-4 d-flex flex-column flex-md-row justify-content-between align-items-center small text-white">
        <div>&copy; 2026 Himalayan Handcrafted Fine Jewelry. All rights reserved.</div>
        <div class="mt-2 mt-md-0 d-flex align-items-center gap-3">
          <span>Devotional Handcrafted Atelier</span>
          <span>·</span>
          <a href="{{ route('admin.dashboard') }}" class="text-gold-accent text-decoration-none fw-semibold">
            <i class="bi bi-shield-lock me-1"></i>Admin Dashboard
          </a>
        </div>
      </div>
    </div>
  </footer>

  <!-- Offcanvas Cart Drawer (Shared on all pages) -->
  <div class="offcanvas offcanvas-end offcanvas-cart" tabindex="-1" id="cartDrawer" aria-labelledby="cartDrawerLabel">
    <div class="offcanvas-header border-bottom border-warm">
      <h5 class="offcanvas-title font-serif" id="cartDrawerLabel">
        <i class="bi bi-bag me-2 text-gold-accent"></i> Your Jewelry Box
      </h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body d-flex flex-column p-4" id="offcanvasCartBody">
      <div id="offcanvasCartItems" class="flex-grow-1 overflow-auto">
        <!-- Rendered dynamically by cart.js -->
      </div>
      <div id="offcanvasCartFooter" class="d-none">
        <!-- Rendered dynamically by cart.js -->
      </div>
    </div>
  </div>

  <!-- Global Quick View Modal (Shared on all pages) -->
  <div class="modal fade" id="quickViewModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content border-warm">
        <div class="modal-header border-warm">
          <span class="x-small text-gold-accent fw-bold letter-spacing-wide" id="qvModalCategory"></span>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-4">
          <div class="row g-4">
            <div class="col-md-6">
              <div class="rounded overflow-hidden bg-warm-secondary border border-warm position-relative">
                <img id="qvModalImage" src="" alt="Jewelry Preview" class="img-fluid w-100 object-fit-cover"
                  style="aspect-ratio: 1/1;">
              </div>
            </div>
            <div class="col-md-6 d-flex flex-column">
              <h3 class="font-serif mb-2" id="qvModalTitle">Product Name</h3>
              <div class="d-flex align-items-baseline gap-2 mb-2">
                <span class="fs-4 fw-bold text-ink" id="qvModalPrice">₹0</span>
                <span class="text-decoration-line-through text-muted small" id="qvModalOriginalPrice"></span>
              </div>
              <div class="small text-muted mb-3" id="qvModalStock"></div>

              <p class="text-muted small mb-3" id="qvModalDescription"></p>

              <!-- Metal Selection -->
              <div class="mb-3">
                <label class="form-label d-block mb-1 small fw-semibold">Select Metal:</label>
                <div class="d-flex flex-wrap gap-2" id="qvModalMetals"></div>
              </div>

              <!-- Size Selection -->
              <div class="mb-3">
                <div class="d-flex justify-content-between align-items-center mb-1">
                  <label class="form-label mb-0 small fw-semibold">Select Size:</label>
                  <a href="{{ route('contact.index') }}#sizing-guide" class="x-small text-gold-accent text-decoration-underline"
                    target="_blank">Sizing Guide</a>
                </div>
                <div class="d-flex flex-wrap gap-2" id="qvModalSizes"></div>
              </div>

              <!-- Quantity Selector -->
              <div class="mb-4">
                <label class="form-label d-block mb-1 small fw-semibold">Quantity:</label>
                <div class="qty-stepper d-inline-flex align-items-center">
                  <button type="button" onclick="adjustQuickViewQty(-1)">-</button>
                  <input type="text" id="qvModalQty" class="border-0 text-center fw-semibold" value="1" readonly
                    style="width: 44px; background: transparent;">
                  <button type="button" onclick="adjustQuickViewQty(1)">+</button>
                </div>
              </div>

              <!-- Actions -->
              <div class="d-grid gap-2 mt-auto">
                <button type="button" class="btn btn-gold py-2" onclick="addQuickViewToCart()">
                  <i class="bi bi-bag-plus me-2"></i> Add to Jewelry Box
                </button>
                <button type="button" class="btn btn-outline-dark py-2" onclick="buyNowQuickView()">
                  Buy Now (Proceed to Checkout)
                </button>
              </div>

              <div class="mt-3 p-2 bg-warm-light rounded border border-light-subtle">
                <div class="x-small text-muted">
                  <i class="bi bi-info-circle text-gold-accent me-1"></i> <span id="qvModalNotes"></span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Global Search Modal (Shared on all pages) -->
  <div class="modal fade" id="searchModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content border-warm">
        <div class="modal-header border-bottom-0 pb-0">
          <h5 class="modal-title font-serif">Search Jewelry</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-4">
          <div class="input-group mb-3">
            <span class="input-group-text bg-transparent border-end-0 border-warm"><i
                class="bi bi-search text-gold-accent"></i></span>
            <input type="text" id="globalSearchInput" class="form-control border-start-0 border-warm ps-0"
              placeholder="Type e.g. hammered, silver, kada, rose gold...">
          </div>
          <div id="globalSearchResults" style="max-height: 320px; overflow-y: auto;">
            <div class="text-center text-muted py-4 small">Start typing to search rings, bangles, or noble metals...</div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Floating Toast Container -->
  <div id="toastContainer" class="toast-container"></div>

  <!-- Bootstrap 5.3 JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Pass Application Routes & Authenticated User to Frontend Scripts -->
  <script>
    window.APP_ROUTES = {
      home: "{{ route('home') }}",
      products: "{{ route('products.index') }}",
      cart: "{{ route('cart.index') }}",
      checkout: "{{ route('checkout.index') }}",
      checkoutStore: "{{ route('checkout.store') }}",
      contact: "{{ route('contact.index') }}",
      login: "{{ route('login') }}",
      register: "{{ route('register') }}",
      admin: "{{ route('admin.dashboard') }}",
      apiProducts: "{{ route('api.products') }}"
    };

    @auth
      window.CURRENT_USER = {
        id: "{{ Auth::id() }}",
        name: "{{ Auth::user()->name }}",
        email: "{{ Auth::user()->email }}",
        phone: "{{ Auth::user()->phone }}",
        role: "{{ Auth::user()->role }}"
      };
      try {
        localStorage.setItem("Himalayan_auth_user", JSON.stringify(window.CURRENT_USER));
      } catch(e) {}
    @else
      window.CURRENT_USER = null;
    @endauth

    @if(isset($allProducts))
      window.SERVER_PRODUCTS = @json($allProducts);
    @elseif(isset($products))
      window.SERVER_PRODUCTS = @json($products);
    @endif
  </script>

  <!-- Data & Logic Scripts -->
  <script src="{{ asset('assets/js/products-data.js') }}"></script>
  <script src="{{ asset('assets/js/cart.js') }}"></script>
  <script src="{{ asset('assets/js/main.js') }}"></script>

  @yield('js')
</body>

</html>