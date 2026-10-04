// Himalayan Handcrafted Fine Jewelry - Cart & State Management System
const CART_STORAGE_KEY = "Himalayan_cart_v1";
const WISHLIST_STORAGE_KEY = "Himalayan_wishlist_v1";
const COUPON_STORAGE_KEY = "Himalayan_active_coupon";
const GIFT_WRAP_STORAGE_KEY = "Himalayan_gift_wrap";

// Active valid promo codes
const PROMO_CODES = {
  "HANDMADE10": { type: "percent", value: 10, label: "10% Off Handcrafted Special" },
  "FIRSTBUY": { type: "flat", value: 200, label: "₹200 Off Welcome Gift" },
  "HimalayanVIP": { type: "percent", value: 15, label: "15% VIP Collector Discount", minSpend: 3000 }
};

// Retrieve cart from localStorage
function getCart() {
  try {
    const raw = localStorage.getItem(CART_STORAGE_KEY);
    return raw ? JSON.parse(raw) : [];
  } catch (e) {
    console.error("Error reading cart from localStorage", e);
    return [];
  }
}

// Save cart to localStorage
function saveCart(cart) {
  try {
    localStorage.setItem(CART_STORAGE_KEY, JSON.stringify(cart));
    updateCartBadges();
    window.dispatchEvent(new CustomEvent("cartUpdated", { detail: { cart } }));
  } catch (e) {
    console.error("Error saving cart to localStorage", e);
  }
}

// Add item to cart
function addToCart(product, metal, size, quantity = 1) {
  const cart = getCart();
  const chosenMetal = metal || product.metal || (product.availableMetals && product.availableMetals[0]) || "Standard";
  const chosenSize = size || (product.sizes && product.sizes[0]) || "Standard";
  const cartItemId = `${product.id}__${chosenMetal.replace(/\s+/g, '_')}__${chosenSize.replace(/\s+/g, '_')}`;

  const existingIndex = cart.findIndex(item => item.cartItemId === cartItemId);

  if (existingIndex > -1) {
    cart[existingIndex].quantity += Number(quantity);
  } else {
    cart.push({
      cartItemId: cartItemId,
      productId: product.id,
      name: product.name,
      category: product.category,
      price: product.price,
      metal: chosenMetal,
      size: chosenSize,
      image: product.image,
      quantity: Number(quantity)
    });
  }

  saveCart(cart);
  showToast("Added to Jewelry Box", `${product.name} (${chosenMetal}, ${chosenSize}) added!`, "success");

  // If offcanvas drawer is present, re-render it and open it optionally
  renderOffcanvasCart();
  const cartDrawerEl = document.getElementById("cartDrawer");
  if (cartDrawerEl && typeof bootstrap !== "undefined") {
    const bsOffcanvas = bootstrap.Offcanvas.getOrCreateInstance(cartDrawerEl);
    bsOffcanvas.show();
  }
}

// Update item quantity
function updateCartItemQuantity(cartItemId, newQty) {
  let cart = getCart();
  newQty = parseInt(newQty, 10);
  if (isNaN(newQty) || newQty <= 0) {
    removeFromCart(cartItemId);
    return;
  }
  const item = cart.find(i => i.cartItemId === cartItemId);
  if (item) {
    item.quantity = newQty;
    saveCart(cart);
    renderOffcanvasCart();
    if (typeof renderCartPage === "function") renderCartPage();
    if (typeof renderCheckoutSummary === "function") renderCheckoutSummary();
  }
}

// Remove item from cart
function removeFromCart(cartItemId) {
  let cart = getCart();
  const removedItem = cart.find(i => i.cartItemId === cartItemId);
  cart = cart.filter(i => i.cartItemId !== cartItemId);
  saveCart(cart);
  renderOffcanvasCart();
  if (typeof renderCartPage === "function") renderCartPage();
  if (typeof renderCheckoutSummary === "function") renderCheckoutSummary();
  if (removedItem) {
    showToast("Item Removed", `${removedItem.name} removed from your cart.`, "info");
  }
}

// Clear cart completely
function clearCart() {
  saveCart([]);
  localStorage.removeItem(COUPON_STORAGE_KEY);
  renderOffcanvasCart();
  if (typeof renderCartPage === "function") renderCartPage();
}

// Calculate totals (Subtotal, Discount, Shipping, Total)
function getCartTotals() {
  const cart = getCart();
  const subtotal = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
  const itemsCount = cart.reduce((sum, item) => sum + item.quantity, 0);

  // Free delivery threshold: ₹1,999
  const freeShippingThreshold = 1999;
  let shipping = 0;
  if (subtotal > 0 && subtotal < freeShippingThreshold) {
    shipping = 150;
  }

  // Active coupon
  const activeCouponKey = localStorage.getItem(COUPON_STORAGE_KEY);
  let discount = 0;
  let couponInfo = null;

  if (activeCouponKey && PROMO_CODES[activeCouponKey]) {
    const promo = PROMO_CODES[activeCouponKey];
    if (!promo.minSpend || subtotal >= promo.minSpend) {
      if (promo.type === "percent") {
        discount = Math.round((subtotal * promo.value) / 100);
      } else if (promo.type === "flat") {
        discount = Math.min(promo.value, subtotal);
      }
      couponInfo = { code: activeCouponKey, ...promo, discountAmount: discount };
    }
  }

  // Optional Gift Packaging
  const hasGiftWrap = localStorage.getItem(GIFT_WRAP_STORAGE_KEY) === "true";
  const giftWrapFee = hasGiftWrap ? 100 : 0;

  const total = Math.max(0, subtotal - discount + shipping + giftWrapFee);

  return {
    itemsCount,
    subtotal,
    shipping,
    discount,
    couponInfo,
    freeShippingThreshold,
    amountToFreeShipping: Math.max(0, freeShippingThreshold - subtotal),
    hasGiftWrap,
    giftWrapFee,
    total
  };
}

// Apply coupon code
function applyCouponCode(code) {
  if (!code) return { success: false, message: "Please enter a coupon code." };
  const cleanCode = code.trim().toUpperCase();
  const promo = PROMO_CODES[cleanCode];

  if (!promo) {
    return { success: false, message: "Invalid code. Try HANDMADE10 or FIRSTBUY." };
  }

  const { subtotal } = getCartTotals();
  if (promo.minSpend && subtotal < promo.minSpend) {
    return { success: false, message: `Minimum order of ₹${promo.minSpend} required for this code.` };
  }

  localStorage.setItem(COUPON_STORAGE_KEY, cleanCode);
  window.dispatchEvent(new CustomEvent("cartUpdated"));
  return { success: true, message: `Coupon ${cleanCode} applied! (${promo.label})` };
}

// Remove coupon code
function removeCouponCode() {
  localStorage.removeItem(COUPON_STORAGE_KEY);
  window.dispatchEvent(new CustomEvent("cartUpdated"));
  return { success: true, message: "Coupon removed." };
}

// Toggle Gift Wrap
function toggleGiftWrap(enabled) {
  localStorage.setItem(GIFT_WRAP_STORAGE_KEY, enabled ? "true" : "false");
  window.dispatchEvent(new CustomEvent("cartUpdated"));
}

// Update all cart count badges in the page
function updateCartBadges() {
  const totals = getCartTotals();
  const badges = document.querySelectorAll(".cart-count-badge");
  badges.forEach(badge => {
    badge.textContent = totals.itemsCount;
    if (totals.itemsCount > 0) {
      badge.classList.remove("d-none");
    } else {
      badge.classList.add("d-none");
    }
  });

  const subtotalElements = document.querySelectorAll(".cart-live-subtotal");
  subtotalElements.forEach(el => {
    el.textContent = formatPrice(totals.subtotal);
  });
}

// Render Offcanvas Drawer (Present on every page)
function renderOffcanvasCart() {
  const container = document.getElementById("offcanvasCartItems");
  const footerContainer = document.getElementById("offcanvasCartFooter");
  if (!container) return;

  const cart = getCart();
  const totals = getCartTotals();

  if (cart.length === 0) {
    container.innerHTML = `
      <div class="text-center py-5">
        <div class="empty-cart-icon mb-3">
          <i class="bi bi-gem fs-1 text-gold-accent opacity-50"></i>
        </div>
        <h5 class="font-serif mb-2">Your Jewelry Box is Empty</h5>
        <p class="text-muted small px-4 mb-4">Discover our hand-hammered rings and sculpted bangles forged with artisanal care.</p>
        <a href="products.html" class="btn btn-gold px-4 py-2" data-bs-dismiss="offcanvas">
          <i class="bi bi-arrow-right-short me-1"></i> Browse Collection
        </a>
      </div>
    `;
    if (footerContainer) footerContainer.classList.add("d-none");
    return;
  }

  if (footerContainer) footerContainer.classList.remove("d-none");

  // Free shipping progress bar
  let freeShippingHtml = "";
  if (totals.amountToFreeShipping > 0) {
    const percent = Math.min(100, Math.round((totals.subtotal / totals.freeShippingThreshold) * 100));
    freeShippingHtml = `
      <div class="free-shipping-progress p-2 mb-3 bg-warm-light rounded border border-light-subtle">
        <div class="d-flex justify-content-between small mb-1">
          <span class="text-secondary"><i class="bi bi-truck me-1 text-gold-accent"></i> Add <strong>${formatPrice(totals.amountToFreeShipping)}</strong> for Free Delivery</span>
          <span class="fw-semibold text-gold-accent">${percent}%</span>
        </div>
        <div class="progress" style="height: 6px;">
          <div class="progress-bar bg-gold" role="progressbar" style="width: ${percent}%;"></div>
        </div>
      </div>
    `;
  } else {
    freeShippingHtml = `
      <div class="alert alert-success py-2 px-3 mb-3 small d-flex align-items-center">
        <i class="bi bi-check-circle-fill text-success me-2 fs-6"></i>
        <span><strong>Congratulations!</strong> You qualify for <strong>Free Express Delivery</strong>.</span>
      </div>
    `;
  }

  let itemsHtml = freeShippingHtml + `<div class="cart-items-list">`;

  cart.forEach(item => {
    itemsHtml += `
      <div class="cart-drawer-item d-flex align-items-start gap-3 py-3 border-bottom position-relative">
        <a href="products.html" class="cart-thumb-link flex-shrink-0">
          <img src="${item.image}" alt="${item.name}" class="rounded object-fit-cover shadow-sm" width="70" height="70" onerror="this.src='assets/images/prod-solitaire-ring.jpg'">
        </a>
        <div class="flex-grow-1 min-w-0">
          <div class="d-flex justify-content-between align-items-start">
            <h6 class="cart-item-title mb-1 text-truncate pe-2">
              <a href="products.html" class="text-decoration-none text-ink hover-gold">${item.name}</a>
            </h6>
            <button type="button" class="btn btn-sm text-muted p-0 hover-danger" onclick="removeFromCart('${item.cartItemId}')" title="Remove item">
              <i class="bi bi-trash3"></i>
            </button>
          </div>
          <div class="cart-item-meta small text-muted mb-2">
            <span class="badge bg-warm-light text-ink border border-light-subtle py-1 px-2 me-1">${item.metal}</span>
            <span class="badge bg-warm-light text-ink border border-light-subtle py-1 px-2">${item.size}</span>
          </div>
          <div class="d-flex justify-content-between align-items-center">
            <div class="qty-stepper d-inline-flex align-items-center border rounded">
              <button type="button" class="btn btn-sm px-2 py-0" onclick="updateCartItemQuantity('${item.cartItemId}', ${item.quantity - 1})">-</button>
              <span class="px-2 small fw-semibold">${item.quantity}</span>
              <button type="button" class="btn btn-sm px-2 py-0" onclick="updateCartItemQuantity('${item.cartItemId}', ${item.quantity + 1})">+</button>
            </div>
            <span class="fw-semibold text-gold-accent">${formatPrice(item.price * item.quantity)}</span>
          </div>
        </div>
      </div>
    `;
  });

  itemsHtml += `</div>`;
  container.innerHTML = itemsHtml;

  // Render Footer totals
  if (footerContainer) {
    footerContainer.innerHTML = `
      <div class="border-top pt-3">
        <div class="d-flex justify-content-between mb-1 small text-muted">
          <span>Subtotal (${totals.itemsCount} items)</span>
          <span class="fw-medium text-ink">${formatPrice(totals.subtotal)}</span>
        </div>
        ${totals.discount > 0 ? `
          <div class="d-flex justify-content-between mb-1 small text-success">
            <span>Discount (${totals.couponInfo.code})</span>
            <span>-${formatPrice(totals.discount)}</span>
          </div>
        ` : ''}
        <div class="d-flex justify-content-between mb-2 small text-muted">
          <span>Delivery</span>
          <span>${totals.shipping === 0 ? '<span class="text-success fw-medium">FREE</span>' : formatPrice(totals.shipping)}</span>
        </div>
        <div class="d-flex justify-content-between mb-3 pt-2 border-top">
          <span class="fw-semibold">Estimated Total</span>
          <span class="fs-5 fw-bold text-gold-accent">${formatPrice(totals.total)}</span>
        </div>
        <div class="d-grid gap-2">
          <a href="checkout.html" class="btn btn-gold py-2 fw-semibold">
            <i class="bi bi-shield-lock me-1"></i> Proceed to Checkout
          </a>
          <a href="cart.html" class="btn btn-outline-dark py-2">
            View Full Cart & Details
          </a>
        </div>
        <p class="text-center text-muted x-small mt-2 mb-0">
          <i class="bi bi-shield-check me-1 text-gold-accent"></i> 100% Secure Simulated Checkout · Cash on Delivery Available
        </p>
      </div>
    `;
  }
}

// Toast notification helper
function showToast(title, message, type = "info") {
  const toastContainer = document.getElementById("toastContainer");
  if (!toastContainer) return;

  const toastId = "toast_" + Date.now();
  const bgClass = type === "success" ? "bg-dark text-white border-gold" : "bg-dark text-white";
  const icon = type === "success" ? "bi-check2-circle text-gold-accent" : type === "danger" ? "bi-exclamation-triangle text-danger" : "bi-info-circle text-gold-accent";

  const toastHtml = `
    <div id="${toastId}" class="toast align-items-center ${bgClass} border shadow-lg" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="d-flex">
        <div class="toast-body d-flex align-items-start gap-2 py-2">
          <i class="bi ${icon} fs-5 mt-1 flex-shrink-0"></i>
          <div>
            <div class="fw-semibold small">${title}</div>
            <div class="x-small text-light opacity-75">${message}</div>
          </div>
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
    </div>
  `;

  toastContainer.insertAdjacentHTML("beforeend", toastHtml);
  const toastEl = document.getElementById(toastId);
  if (toastEl && typeof bootstrap !== "undefined") {
    const toast = new bootstrap.Toast(toastEl, { delay: 3500 });
    toast.show();
    toastEl.addEventListener("hidden.bs.toast", () => toastEl.remove());
  }
}

// Wishlist Helpers
function getWishlist() {
  try {
    const raw = localStorage.getItem(WISHLIST_STORAGE_KEY);
    return raw ? JSON.parse(raw) : [];
  } catch (e) {
    return [];
  }
}

function toggleWishlist(productId) {
  let list = getWishlist();
  const index = list.indexOf(productId);
  let isAdded = false;
  if (index > -1) {
    list.splice(index, 1);
  } else {
    list.push(productId);
    isAdded = true;
  }
  localStorage.setItem(WISHLIST_STORAGE_KEY, JSON.stringify(list));
  updateWishlistBadges();
  showToast(isAdded ? "Saved to Wishlist" : "Removed from Wishlist", isAdded ? "Item added to your personal collection." : "Item removed from wishlist.", isAdded ? "success" : "info");
  return isAdded;
}

function updateWishlistBadges() {
  const count = getWishlist().length;
  const badges = document.querySelectorAll(".wishlist-count-badge");
  badges.forEach(b => {
    b.textContent = count;
    if (count > 0) b.classList.remove("d-none");
    else b.classList.add("d-none");
  });

  // Update heart buttons
  const list = getWishlist();
  document.querySelectorAll("[data-wishlist-id]").forEach(btn => {
    const id = btn.getAttribute("data-wishlist-id");
    const icon = btn.querySelector("i");
    if (list.includes(id)) {
      btn.classList.add("active");
      if (icon) icon.className = "bi bi-heart-fill text-danger";
    } else {
      btn.classList.remove("active");
      if (icon) icon.className = "bi bi-heart";
    }
  });
}

// Initialize on DOM load
document.addEventListener("DOMContentLoaded", () => {
  updateCartBadges();
  renderOffcanvasCart();
  updateWishlistBadges();

  window.addEventListener("cartUpdated", () => {
    updateCartBadges();
  });
});
