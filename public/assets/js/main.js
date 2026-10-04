// Himalayan Handcrafted Fine Jewelry - Main Interactive Scripts

const AUTH_USER_KEY = "Himalayan_auth_user";
const THEME_KEY = "Himalayan_theme_pref";

// Initialize Theme
function initTheme() {
  const saved = localStorage.getItem(THEME_KEY);
  if (saved) {
    document.documentElement.setAttribute("data-bs-theme", saved);
  } else if (window.matchMedia && window.matchMedia("(prefers-color-scheme: dark)").matches) {
    document.documentElement.setAttribute("data-bs-theme", "dark");
  }
  updateThemeIcon();
}

function toggleTheme() {
  const current = document.documentElement.getAttribute("data-bs-theme") || "light";
  const next = current === "dark" ? "light" : "dark";
  document.documentElement.setAttribute("data-bs-theme", next);
  localStorage.setItem(THEME_KEY, next);
  updateThemeIcon();
}

function updateThemeIcon() {
  const current = document.documentElement.getAttribute("data-bs-theme");
  const icons = document.querySelectorAll(".theme-toggle-icon");
  icons.forEach(icon => {
    if (current === "dark") {
      icon.className = "bi bi-sun-fill text-warning theme-toggle-icon";
    } else {
      icon.className = "bi bi-moon-stars theme-toggle-icon";
    }
  });
}

// User Authentication Simulation
function getCurrentUser() {
  try {
    const raw = localStorage.getItem(AUTH_USER_KEY);
    return raw ? JSON.parse(raw) : null;
  } catch (e) {
    return null;
  }
}

function setCurrentUser(user) {
  if (user) {
    localStorage.setItem(AUTH_USER_KEY, JSON.stringify(user));
  } else {
    localStorage.removeItem(AUTH_USER_KEY);
  }
  updateAuthUI();
}

function updateAuthUI() {
  const user = getCurrentUser();
  const authLinks = document.querySelectorAll(".auth-nav-link");
  const userDropdowns = document.querySelectorAll(".auth-user-dropdown");
  const userNames = document.querySelectorAll(".auth-user-name");

  if (user) {
    authLinks.forEach(el => el.classList.add("d-none"));
    userDropdowns.forEach(el => el.classList.remove("d-none"));
    userNames.forEach(el => el.textContent = user.name.split(" ")[0]);
  } else {
    authLinks.forEach(el => el.classList.remove("d-none"));
    userDropdowns.forEach(el => el.classList.add("d-none"));
  }
}

function logoutUser() {
  setCurrentUser(null);
  showToast("Signed Out", "You have been signed out safely.", "info");
  setTimeout(() => {
    if (window.location.pathname.includes("checkout.html") || window.location.pathname.includes("login.html")) {
      window.location.href = "index.html";
    }
  }, 800);
}

// Quick View Modal
let currentQuickViewProduct = null;
let selectedQuickViewMetal = null;
let selectedQuickViewSize = null;

function openQuickView(productId) {
  const product = getProductById(productId);
  if (!product) return;

  currentQuickViewProduct = product;
  selectedQuickViewMetal = product.metal;
  selectedQuickViewSize = product.sizes ? product.sizes[0] : "Standard";

  const modalEl = document.getElementById("quickViewModal");
  if (!modalEl) return;

  // Populate data
  document.getElementById("qvModalTitle").textContent = product.name;
  document.getElementById("qvModalCategory").textContent = product.categoryLabel + " · " + product.metal;
  document.getElementById("qvModalPrice").textContent = formatPrice(product.price);
  document.getElementById("qvModalOriginalPrice").textContent = formatPrice(product.originalPrice);
  document.getElementById("qvModalImage").src = product.image;
  document.getElementById("qvModalImage").alt = product.name;
  document.getElementById("qvModalDescription").textContent = product.description;
  document.getElementById("qvModalNotes").textContent = product.artisanNotes;
  document.getElementById("qvModalQty").value = 1;

  // In Stock badge
  const stockEl = document.getElementById("qvModalStock");
  if (stockEl) {
    stockEl.innerHTML = `<i class="bi bi-patch-check-fill text-success me-1"></i> In Stock (${product.inStock} handcrafted pieces available)`;
  }

  // Metals Selector
  const metalsContainer = document.getElementById("qvModalMetals");
  if (metalsContainer) {
    let metalsHtml = "";
    product.availableMetals.forEach((m, idx) => {
      const activeClass = m === selectedQuickViewMetal ? "active" : "";
      metalsHtml += `<button type="button" class="metal-selector-btn ${activeClass}" onclick="selectQuickViewMetal('${m}', this)">${m}</button>`;
    });
    metalsContainer.innerHTML = metalsHtml;
  }

  // Sizes Selector
  const sizesContainer = document.getElementById("qvModalSizes");
  if (sizesContainer) {
    let sizesHtml = "";
    product.sizes.forEach((s, idx) => {
      const activeClass = s === selectedQuickViewSize ? "active" : "";
      sizesHtml += `<button type="button" class="size-selector-btn ${activeClass}" onclick="selectQuickViewSize('${s}', this)">${s}</button>`;
    });
    sizesContainer.innerHTML = sizesHtml;
  }

  const bsModal = bootstrap.Modal.getOrCreateInstance(modalEl);
  bsModal.show();
}

function selectQuickViewMetal(metal, btn) {
  selectedQuickViewMetal = metal;
  document.querySelectorAll("#qvModalMetals .metal-selector-btn").forEach(b => b.classList.remove("active"));
  btn.classList.add("active");
}

function selectQuickViewSize(size, btn) {
  selectedQuickViewSize = size;
  document.querySelectorAll("#qvModalSizes .size-selector-btn").forEach(b => b.classList.remove("active"));
  btn.classList.add("active");
}

function adjustQuickViewQty(delta) {
  const input = document.getElementById("qvModalQty");
  if (!input) return;
  let val = parseInt(input.value, 10) || 1;
  val = Math.max(1, Math.min(val + delta, (currentQuickViewProduct ? currentQuickViewProduct.inStock : 10)));
  input.value = val;
}

function addQuickViewToCart() {
  if (!currentQuickViewProduct) return;
  const qty = parseInt(document.getElementById("qvModalQty").value, 10) || 1;
  addToCart(currentQuickViewProduct, selectedQuickViewMetal, selectedQuickViewSize, qty);
  const modalEl = document.getElementById("quickViewModal");
  if (modalEl) {
    const bsModal = bootstrap.Modal.getInstance(modalEl);
    if (bsModal) bsModal.hide();
  }
}

function buyNowQuickView() {
  if (!currentQuickViewProduct) return;
  const qty = parseInt(document.getElementById("qvModalQty").value, 10) || 1;
  addToCart(currentQuickViewProduct, selectedQuickViewMetal, selectedQuickViewSize, qty);
  window.location.href = "checkout.html";
}

// Generate Product Card HTML
function createProductCardHtml(product) {
  const wishlist = getWishlist();
  const isWishlisted = wishlist.includes(product.id);

  return `
    <div class="col-12 col-sm-6 col-lg-4 col-xl-3 mb-4 animate-fade-in" data-product-category="${product.category}" data-product-metal="${product.metalKey}">
      <div class="product-card">
        <div class="product-img-wrap">
          <img src="${product.image}" alt="${product.name}" class="product-img" loading="lazy" onerror="this.src='assets/images/prod-solitaire-ring.jpg'">
          
          <div class="product-badge-wrap">
            ${product.badge ? `<span class="product-badge">${product.badge}</span>` : ''}
          </div>

          <button type="button" class="wishlist-btn ${isWishlisted ? 'active' : ''}" data-wishlist-id="${product.id}" onclick="toggleWishlist('${product.id}')" title="Save to wishlist" aria-label="Save to wishlist">
            <i class="bi ${isWishlisted ? 'bi-heart-fill text-danger' : 'bi-heart'}"></i>
          </button>

          <div class="product-quick-view-overlay">
            <button type="button" class="btn btn-sm btn-dark w-100 py-2 shadow-sm" onclick="openQuickView('${product.id}')">
              <i class="bi bi-eye me-1"></i> Quick View
            </button>
          </div>
        </div>

        <div class="product-body">
          <div class="product-metal-tag">${product.metal}</div>
          <h3 class="product-title">
            <a href="javascript:void(0)" onclick="openQuickView('${product.id}')">${product.name}</a>
          </h3>
          <div class="product-rating">
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-half"></i>
            <span class="review-count">(${product.reviewsCount})</span>
          </div>
          <div class="product-price-row">
            <span class="product-price">${formatPrice(product.price)}</span>
            ${product.originalPrice ? `<span class="product-price-original">${formatPrice(product.originalPrice)}</span>` : ''}
          </div>
          <button type="button" class="btn btn-outline-gold w-100 py-2 mt-2" onclick="addToCart(getProductById('${product.id}'))">
            <i class="bi bi-bag-plus me-1"></i> Add to Cart
          </button>
        </div>
      </div>
    </div>
  `;
}

// Render Featured Products (Used on index.html)
function renderFeaturedProducts(containerId = "featuredProductsContainer") {
  const container = document.getElementById(containerId);
  if (!container) return;

  const featured = getProducts().filter(p => p.isFeatured).slice(0, 4);
  let html = "";
  featured.forEach(product => {
    html += createProductCardHtml(product);
  });
  container.innerHTML = html;
}

// Search Modal Functionality
function initSearchModal() {
  const searchInput = document.getElementById("globalSearchInput");
  const searchResults = document.getElementById("globalSearchResults");
  if (!searchInput || !searchResults) return;

  searchInput.addEventListener("input", (e) => {
    const query = e.target.value.trim().toLowerCase();
    if (!query) {
      searchResults.innerHTML = `<div class="text-center text-muted py-4 small">Start typing to search rings, bangles, or metals...</div>`;
      return;
    }

    const matches = getProducts().filter(p =>
      p.name.toLowerCase().includes(query) ||
      p.description.toLowerCase().includes(query) ||
      p.metal.toLowerCase().includes(query) ||
      p.category.toLowerCase().includes(query)
    );

    if (matches.length === 0) {
      searchResults.innerHTML = `
        <div class="text-center py-4">
          <i class="bi bi-search fs-3 text-muted mb-2"></i>
          <p class="text-muted small mb-0">No jewelry found matching "<strong>${query}</strong>".</p>
        </div>
      `;
      return;
    }

    let html = `<div class="list-group list-group-flush">`;
    matches.forEach(item => {
      html += `
        <a href="javascript:void(0)" onclick="openQuickView('${item.id}'); bootstrap.Modal.getInstance(document.getElementById('searchModal')).hide();" class="list-group-item list-group-item-action d-flex align-items-center gap-3 py-2 px-0">
          <img src="${item.image}" alt="${item.name}" class="rounded object-fit-cover" width="48" height="48">
          <div class="flex-grow-1 min-w-0">
            <div class="fw-semibold text-truncate small">${item.name}</div>
            <div class="x-small text-muted">${item.metal} · ${item.categoryLabel}</div>
          </div>
          <div class="fw-bold text-gold-accent small">${formatPrice(item.price)}</div>
        </a>
      `;
    });
    html += `</div>`;
    searchResults.innerHTML = html;
  });
}

// Global initialization
document.addEventListener("DOMContentLoaded", () => {
  initTheme();
  updateAuthUI();
  initSearchModal();

  // Sticky Navbar Scroll listener
  const navbar = document.querySelector(".luxury-navbar");
  if (navbar) {
    window.addEventListener("scroll", () => {
      if (window.scrollY > 40) {
        navbar.classList.add("scrolled");
      } else {
        navbar.classList.remove("scrolled");
      }
    });
  }
});
