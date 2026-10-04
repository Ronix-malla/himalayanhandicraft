@extends('layouts.front')

@section('title', 'Artisanal Rings & Hand Bangles Collection — Himalayan')

@section('content')
  <!-- Page Header / Breadcrumbs -->
  <header class="py-5 bg-warm-secondary border-bottom border-warm">
    <div class="container text-center">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb justify-content-center small mb-2">
          <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-muted text-decoration-none">Home</a></li>
          <li class="breadcrumb-item active text-gold-accent" aria-current="page">Shop Collection</li>
        </ol>
      </nav>
      <h1 class="display-5 font-serif mb-2" id="catalogHeaderTitle">Shop the Collection</h1>
      <p class="text-muted mx-auto mb-0" style="max-width: 580px;">
        Each creation is individually forged, textured, and finished at our home studio. Discover timeless rings and
        sculptural wrist bangles.
      </p>
    </div>
  </header>

  <!-- Filter & Sort Bar Section -->
  <section class="py-4 border-bottom border-warm bg-card">
    <div class="container">
      <!-- Category Tabs (All, Rings, Bangles) -->
      <div class="d-flex flex-wrap align-items-center justify-content-center gap-2 mb-4" id="categoryFilterTabs">
        <button type="button" class="filter-pill {{ ($activeCategory ?? 'all') === 'all' ? 'active' : '' }}" data-category="all">
          <i class="bi bi-grid me-1"></i> All Creations
        </button>
        <button type="button" class="filter-pill {{ ($activeCategory ?? '') === 'rings' ? 'active' : '' }}" data-category="rings">
          <i class="bi bi-circle me-1"></i> Artisanal Rings
        </button>
        <button type="button" class="filter-pill {{ ($activeCategory ?? '') === 'bangles' ? 'active' : '' }}" data-category="bangles">
          <i class="bi bi-record-circle me-1"></i> Hand Bangles & Cuffs
        </button>
      </div>

      <!-- Secondary Filters & Sort Controls -->
      <div class="row g-3 align-items-center justify-content-between pt-2">
        <!-- Metal Filter dropdown pills -->
        <div class="col-lg-6">
          <div class="d-flex align-items-center flex-wrap gap-2">
            <span class="small fw-semibold text-muted me-1">Metal:</span>
            <select class="form-select form-select-sm border-warm" id="metalFilterSelect" style="max-width: 200px;">
              <option value="all" {{ ($activeMetal ?? 'all') === 'all' ? 'selected' : '' }}>All Noble Metals</option>
              <option value="gold" {{ ($activeMetal ?? '') === 'gold' ? 'selected' : '' }}>18K Gold Vermeil</option>
              <option value="silver" {{ ($activeMetal ?? '') === 'silver' ? 'selected' : '' }}>925 Sterling Silver</option>
              <option value="brass" {{ ($activeMetal ?? '') === 'brass' ? 'selected' : '' }}>Raw Jewelers Brass</option>
              <option value="rosegold" {{ ($activeMetal ?? '') === 'rosegold' ? 'selected' : '' }}>Rose Gold</option>
              <option value="oxidized" {{ ($activeMetal ?? '') === 'oxidized' ? 'selected' : '' }}>Oxidized Silver</option>
            </select>

            <!-- Search input on page -->
            <div class="input-group input-group-sm ms-sm-2" style="max-width: 220px;">
              <input type="text" id="inlineSearchInput" class="form-control border-warm" placeholder="Search pieces..." value="{{ $searchQuery ?? '' }}">
              <button class="btn btn-outline-secondary border-warm" type="button" id="clearInlineSearchBtn"><i
                  class="bi bi-x"></i></button>
            </div>
          </div>
        </div>

        <!-- Sort dropdown & counter -->
        <div class="col-lg-6 d-flex align-items-center justify-content-lg-end gap-3">
          <div class="small text-muted" id="resultsCount">
            Showing all handcrafted pieces
          </div>
          <div class="d-flex align-items-center gap-2">
            <label for="sortBySelect" class="small fw-semibold text-muted text-nowrap mb-0">Sort By:</label>
            <select class="form-select form-select-sm border-warm" id="sortBySelect" style="width: 170px;">
              <option value="featured" {{ ($currentSort ?? 'featured') === 'featured' ? 'selected' : '' }}>Featured First</option>
              <option value="price-asc" {{ ($currentSort ?? '') === 'price-asc' ? 'selected' : '' }}>Price: Low to High</option>
              <option value="price-desc" {{ ($currentSort ?? '') === 'price-desc' ? 'selected' : '' }}>Price: High to Low</option>
              <option value="rating" {{ ($currentSort ?? '') === 'rating' ? 'selected' : '' }}>Highest Rated</option>
            </select>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Products Grid Section -->
  <main class="py-5">
    <div class="container">
      <div class="row g-4" id="productsGridContainer">
        <!-- Rendered dynamically by Javascript using live backend products -->
      </div>

      <!-- Empty Filter State -->
      <div id="noProductsFoundState" class="text-center py-5 d-none">
        <div class="mb-3">
          <i class="bi bi-gem fs-1 text-muted opacity-50"></i>
        </div>
        <h4 class="font-serif">No Jewelry Found</h4>
        <p class="text-muted small mb-4">No pieces matched your selected filter criteria. Try resetting your filters to
          explore everything.</p>
        <button type="button" class="btn btn-outline-gold" onclick="resetAllFilters()">
          Reset All Filters
        </button>
      </div>
    </div>
  </main>

  <!-- Artisanal Standards Banner -->
  <section class="py-5 bg-warm-secondary border-top border-warm text-center">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <span class="text-gold-accent letter-spacing-wide small fw-semibold">Personalized Crafting</span>
          <h3 class="font-serif mt-1 mb-3">Looking for a Custom Ring Size or Heirloom Bangle?</h3>
          <p class="text-muted mb-4">
            Because every single piece is shaped by hand in our studio, we can accommodate non-standard ring sizes (half
            sizes, quarter sizes) or customized wrist circumferences at no extra charge.
          </p>
          <a href="https://wa.me/919876543210?text=Hi%20Himalayan%2C%20I%20would%20like%20to%20inquire%20about%20a%20custom%20ring%20size%20or%20bangle%20measurement"
            target="_blank" class="btn btn-gold">
            <i class="bi bi-whatsapp me-2"></i> Inquire with the Jeweler
          </a>
        </div>
      </div>
    </div>
  </section>
@endsection

@section('js')
  <script>
    let activeCategory = "{{ $activeCategory ?? 'all' }}";
    let activeMetal = "{{ $activeMetal ?? 'all' }}";
    let currentSort = "{{ $currentSort ?? 'featured' }}";
    let searchQuery = "{{ $searchQuery ?? '' }}";
    let isWishlistView = false;

    // Initialize products from backend database
    @if(isset($products) && count($products) > 0)
      window.PRODUCTS_DATA = @json($products);
      if (typeof syncProductsDataArray === 'function') {
        syncProductsDataArray(window.PRODUCTS_DATA);
      }
    @endif

    function parseUrlParams() {
      const params = new URLSearchParams(window.location.search);
      if (params.has("cat")) {
        activeCategory = params.get("cat");
      }
      if (params.has("metal")) {
        activeMetal = params.get("metal");
        const select = document.getElementById("metalFilterSelect");
        if (select) select.value = activeMetal;
      }
      if (params.has("wishlist")) {
        isWishlistView = true;
        const titleEl = document.getElementById("catalogHeaderTitle");
        if (titleEl) titleEl.textContent = "My Saved Wishlist";
      }
      if (params.has("q")) {
        searchQuery = params.get("q");
        const sInput = document.getElementById("inlineSearchInput");
        if (sInput) sInput.value = searchQuery;
      }
    }

    function renderProductsCatalog() {
      const container = document.getElementById("productsGridContainer");
      const emptyState = document.getElementById("noProductsFoundState");
      const countEl = document.getElementById("resultsCount");
      if (!container) return;

      let list = [...getProducts()];

      // Wishlist filter mode
      if (isWishlistView) {
        const savedIds = getWishlist();
        list = list.filter(p => savedIds.includes(p.id) || savedIds.includes(p.code));
      }

      // Category filter
      if (activeCategory !== "all") {
        list = list.filter(p => p.category === activeCategory);
      }

      // Metal filter
      if (activeMetal !== "all") {
        list = list.filter(p => p.metalKey === activeMetal || p.metal_key === activeMetal);
      }

      // Search filter
      if (searchQuery.trim()) {
        const q = searchQuery.toLowerCase().trim();
        list = list.filter(p =>
          (p.name && p.name.toLowerCase().includes(q)) ||
          (p.description && p.description.toLowerCase().includes(q)) ||
          (p.metal && p.metal.toLowerCase().includes(q))
        );
      }

      // Sorting
      if (currentSort === "price-asc") {
        list.sort((a, b) => Number(a.price) - Number(b.price));
      } else if (currentSort === "price-desc") {
        list.sort((a, b) => Number(b.price) - Number(a.price));
      } else if (currentSort === "rating") {
        list.sort((a, b) => Number(b.rating) - Number(a.rating));
      }

      // Update counter
      if (countEl) {
        countEl.textContent = `Showing ${list.length} handcrafted pieces`;
      }

      // Render cards or empty state
      if (list.length === 0) {
        container.innerHTML = "";
        emptyState.classList.remove("d-none");
      } else {
        emptyState.classList.add("d-none");
        let html = "";
        list.forEach(prod => {
          html += createProductCardHtml(prod);
        });
        container.innerHTML = html;
      }

      // Update category tab active state
      document.querySelectorAll("#categoryFilterTabs .filter-pill").forEach(tab => {
        if (tab.getAttribute("data-category") === activeCategory) {
          tab.classList.add("active");
        } else {
          tab.classList.remove("active");
        }
      });
    }

    function resetAllFilters() {
      activeCategory = "all";
      activeMetal = "all";
      searchQuery = "";
      isWishlistView = false;
      document.getElementById("metalFilterSelect").value = "all";
      document.getElementById("inlineSearchInput").value = "";
      document.getElementById("sortBySelect").value = "featured";
      const titleEl = document.getElementById("catalogHeaderTitle");
      if (titleEl) titleEl.textContent = "Shop the Collection";
      renderProductsCatalog();
    }

    document.addEventListener("DOMContentLoaded", () => {
      parseUrlParams();

      // Category tab click listeners
      document.querySelectorAll("#categoryFilterTabs .filter-pill").forEach(pill => {
        pill.addEventListener("click", () => {
          activeCategory = pill.getAttribute("data-category");
          isWishlistView = false;
          renderProductsCatalog();
        });
      });

      // Metal select listener
      const metalSelect = document.getElementById("metalFilterSelect");
      if (metalSelect) {
        metalSelect.addEventListener("change", (e) => {
          activeMetal = e.target.value;
          renderProductsCatalog();
        });
      }

      // Sort select listener
      const sortSelect = document.getElementById("sortBySelect");
      if (sortSelect) {
        sortSelect.addEventListener("change", (e) => {
          currentSort = e.target.value;
          renderProductsCatalog();
        });
      }

      // Search input listener
      const searchInput = document.getElementById("inlineSearchInput");
      if (searchInput) {
        searchInput.addEventListener("input", (e) => {
          searchQuery = e.target.value;
          renderProductsCatalog();
        });
      }

      // Clear search button
      const clearBtn = document.getElementById("clearInlineSearchBtn");
      if (clearBtn) {
        clearBtn.addEventListener("click", () => {
          if (searchInput) searchInput.value = "";
          searchQuery = "";
          renderProductsCatalog();
        });
      }

      renderProductsCatalog();
    });
  </script>
@endsection