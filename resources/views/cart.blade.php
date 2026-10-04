@extends('layouts.front')

@section('content')
<!-- Page Header -->
  <header class="py-4 bg-warm-secondary border-bottom border-warm">
    <div class="container text-center">
      <h1 class="display-6 font-serif mb-1">Your Jewelry Box</h1>
      <p class="text-muted small mb-0">Review your selected artisanal pieces before completing your order.</p>
    </div>
  </header>

  <!-- Main Cart Section -->
  <main class="py-5">
    <div class="container">
      <!-- Active Cart Items View -->
      <div id="cartContentContainer" class="row g-5">
        <!-- Cart Items List (Left Column) -->
        <div class="col-lg-8">
          <!-- Free delivery banner -->
          <div id="cartFreeShippingBanner" class="mb-4"></div>

          <div class="card border-warm shadow-subtle p-0 overflow-hidden bg-card mb-4">
            <div class="table-responsive">
              <table class="table align-middle mb-0">
                <thead class="bg-warm-secondary border-bottom border-warm">
                  <tr>
                    <th scope="col" class="py-3 ps-4 text-muted small fw-semibold text-uppercase letter-spacing-wide">
                      Creations</th>
                    <th scope="col" class="py-3 text-muted small fw-semibold text-uppercase letter-spacing-wide">Price
                    </th>
                    <th scope="col"
                      class="py-3 text-muted small fw-semibold text-uppercase letter-spacing-wide text-center">Quantity
                    </th>
                    <th scope="col"
                      class="py-3 text-muted small fw-semibold text-uppercase letter-spacing-wide text-end pe-4">Total
                    </th>
                  </tr>
                </thead>
                <tbody id="cartTableBody">
                  <!-- Rendered dynamically by JS -->
                </tbody>
              </table>
            </div>

            <div
              class="p-3 bg-warm-secondary border-top border-warm d-flex justify-content-between align-items-center flex-wrap gap-2">
              <a href="{{ route('products.index') }}" class="btn btn-sm btn-outline-dark">
                <i class="bi bi-arrow-left me-1"></i> Continue Shopping
              </a>
              <button type="button" class="btn btn-sm text-danger"
                onclick="if(confirm('Clear all jewelry from your cart?')) clearCart();">
                <i class="bi bi-trash3 me-1"></i> Empty Jewelry Box
              </button>
            </div>
          </div>

          <!-- Artisanal Packaging Option -->
          <div class="card border-warm shadow-subtle p-4 bg-card">
            <div class="d-flex align-items-start gap-3">
              <div class="form-check mt-1">
                <input class="form-check-input" type="checkbox" id="giftWrapCheckbox"
                  onchange="toggleGiftWrap(this.checked)">
              </div>
              <div class="flex-grow-1">
                <label for="giftWrapCheckbox" class="fw-semibold text-ink cursor-pointer mb-1 d-block">
                  Add Artisanal Heirloom Gift Packaging (+₹100)
                </label>
                <p class="text-muted small mb-0">
                  Includes a hand-stitched velvet drawstring pouch, wax-sealed authenticity certificate signed by the
                  artisan, and an anti-tarnish polishing cloth.
                </p>
              </div>
            </div>
          </div>
        </div>

        <!-- Order Summary & Checkout CTA (Right Column) -->
        <div class="col-lg-4">
          <div class="card border-warm shadow-subtle p-4 bg-card sticky-top" style="top: 90px;">
            <h5 class="font-serif mb-3 border-bottom pb-2">Order Summary</h5>

            <div class="d-flex justify-content-between mb-2 small">
              <span class="text-muted">Subtotal (<span id="summaryItemCount">0</span> items)</span>
              <span class="fw-semibold" id="summarySubtotal">₹0</span>
            </div>

            <div id="summaryDiscountRow" class="d-flex justify-content-between mb-2 small text-success d-none">
              <span id="summaryDiscountLabel">Discount</span>
              <span id="summaryDiscountValue">-₹0</span>
            </div>

            <div class="d-flex justify-content-between mb-2 small">
              <span class="text-muted">Estimated Delivery</span>
              <span id="summaryShipping">FREE</span>
            </div>

            <div id="summaryGiftWrapRow" class="d-flex justify-content-between mb-2 small text-muted d-none">
              <span>Artisanal Gift Packaging</span>
              <span>₹100</span>
            </div>

            <hr class="my-3">

            <div class="d-flex justify-content-between align-items-baseline mb-4">
              <span class="fw-bold">Total</span>
              <span class="fs-4 fw-bold text-gold-accent" id="summaryTotal">₹0</span>
            </div>

            <!-- Coupon Code Form -->
            <div class="mb-4">
              <label class="form-label small fw-semibold text-muted">Promo or Gift Voucher:</label>
              <div class="input-group">
                <input type="text" id="couponCodeInput" class="form-control form-control-sm text-uppercase"
                  placeholder="HANDMADE10">
                <button class="btn btn-sm btn-outline-gold" type="button" onclick="handleApplyCoupon()">Apply</button>
              </div>
              <div id="couponFeedback" class="small mt-1"></div>
            </div>

            <!-- Checkout Primary Button -->
            <a href="{{ route('checkout.index') }}" class="btn btn-gold w-100 py-3 fw-semibold mb-3">
              <i class="bi bi-shield-lock me-1"></i> Proceed to Checkout
            </a>

            <!-- Assurance Badges -->
            <div class="border-top pt-3">
              <div class="d-flex align-items-center gap-2 small text-muted mb-2">
                <i class="bi bi-cash-coin text-gold-accent fs-5"></i>
                <span>Cash on Delivery (COD) Available</span>
              </div>
              <div class="d-flex align-items-center gap-2 small text-muted mb-2">
                <i class="bi bi-box-seam text-gold-accent fs-5"></i>
                <span>Dispatched within 24-48 hours</span>
              </div>
              <div class="d-flex align-items-center gap-2 small text-muted">
                <i class="bi bi-patch-check text-gold-accent fs-5"></i>
                <span>Pure Handmade Guarantee</span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Empty Cart State -->
      <div id="cartEmptyState" class="text-center py-5 d-none">
        <div class="mb-3">
          <i class="bi bi-bag-x fs-1 text-gold-accent opacity-50"></i>
        </div>
        <h3 class="font-serif mb-2">Your Jewelry Box is Empty</h3>
        <p class="text-muted mx-auto mb-4" style="max-width: 480px;">
          You haven't added any rings or hand bangles yet. Explore our handcrafted collections forged in noble metals.
        </p>
        <div class="d-flex justify-content-center gap-3">
          <a href="{{ route('products.index', ['cat' => 'rings']) }}" class="btn btn-outline-gold px-4 py-2">
            Explore Rings
          </a>
          <a href="{{ route('products.index', ['cat' => 'bangles']) }}" class="btn btn-gold px-4 py-2">
            Explore Bangles
          </a>
        </div>
      </div>
    </div>
  </main>
@endsection

@section('js')
<script>
    function renderCartPage() {
      const cart = getCart();
      const totals = getCartTotals();
      const contentContainer = document.getElementById("cartContentContainer");
      const emptyState = document.getElementById("cartEmptyState");
      const tableBody = document.getElementById("cartTableBody");
      const banner = document.getElementById("cartFreeShippingBanner");

      if (!contentContainer || !emptyState || !tableBody) return;

      if (cart.length === 0) {
        contentContainer.classList.add("d-none");
        emptyState.classList.remove("d-none");
        return;
      }

      contentContainer.classList.remove("d-none");
      emptyState.classList.add("d-none");

      // Free shipping banner
      if (totals.amountToFreeShipping > 0) {
        const pct = Math.min(100, Math.round((totals.subtotal / totals.freeShippingThreshold) * 100));
        banner.innerHTML = `
          <div class="alert alert-warning border-warm py-3 px-4 d-flex align-items-center justify-content-between flex-wrap gap-2">
            <div>
              <i class="bi bi-truck text-gold-accent fs-5 me-2 align-middle"></i>
              <span>Add <strong>${formatPrice(totals.amountToFreeShipping)}</strong> more to unlock <strong>Free Express Delivery</strong>!</span>
            </div>
            <a href="{{ route('products.index') }}" class="btn btn-sm btn-outline-dark">Add More Jewelry</a>
          </div>
        `;
      } else {
        banner.innerHTML = `
          <div class="alert alert-success py-3 px-4 d-flex align-items-center">
            <i class="bi bi-check-circle-fill text-success fs-5 me-2"></i>
            <span><strong>Free Express Delivery Unlocked!</strong> Handcrafted velvet packaging included.</span>
          </div>
        `;
      }

      // Render table rows
      let rowsHtml = "";
      cart.forEach(item => {
        rowsHtml += `
          <tr class="cart-table-row">
            <td class="ps-4 py-3">
              <div class="d-flex align-items-center gap-3">
                <img src="${item.image}" alt="${item.name}" class="rounded object-fit-cover shadow-sm" width="70" height="70" onerror="this.src='assets/images/prod-solitaire-ring.jpg'">
                <div>
                  <h6 class="mb-1 fw-semibold font-serif">${item.name}</h6>
                  <div class="small text-muted">
                    <span class="badge bg-warm-secondary text-ink border border-warm me-1">${item.metal}</span>
                    <span class="badge bg-warm-secondary text-ink border border-warm">${item.size}</span>
                  </div>
                  <button type="button" class="btn btn-link p-0 text-danger small text-decoration-none mt-1 hover-danger" onclick="removeFromCart('${item.cartItemId}')">
                    <i class="bi bi-trash3 me-1"></i> Remove
                  </button>
                </div>
              </div>
            </td>
            <td class="text-muted fw-medium">${formatPrice(item.price)}</td>
            <td class="text-center">
              <div class="qty-stepper d-inline-flex align-items-center">
                <button type="button" onclick="updateCartItemQuantity('${item.cartItemId}', ${item.quantity - 1})">-</button>
                <input type="text" class="border-0 text-center fw-semibold" value="${item.quantity}" readonly style="width: 36px; background: transparent;">
                <button type="button" onclick="updateCartItemQuantity('${item.cartItemId}', ${item.quantity + 1})">+</button>
              </div>
            </td>
            <td class="text-end pe-4 fw-bold text-gold-accent">${formatPrice(item.price * item.quantity)}</td>
          </tr>
        `;
      });
      tableBody.innerHTML = rowsHtml;

      // Update right summary
      document.getElementById("summaryItemCount").textContent = totals.itemsCount;
      document.getElementById("summarySubtotal").textContent = formatPrice(totals.subtotal);

      const discountRow = document.getElementById("summaryDiscountRow");
      if (totals.discount > 0 && totals.couponInfo) {
        discountRow.classList.remove("d-none");
        document.getElementById("summaryDiscountLabel").textContent = `Discount (${totals.couponInfo.code})`;
        document.getElementById("summaryDiscountValue").textContent = `-${formatPrice(totals.discount)}`;
      } else {
        discountRow.classList.add("d-none");
      }

      document.getElementById("summaryShipping").innerHTML = totals.shipping === 0 ? '<span class="text-success fw-bold">FREE</span>' : formatPrice(totals.shipping);

      const giftRow = document.getElementById("summaryGiftWrapRow");
      const giftBox = document.getElementById("giftWrapCheckbox");
      if (giftBox) giftBox.checked = totals.hasGiftWrap;
      if (totals.hasGiftWrap) {
        giftRow.classList.remove("d-none");
      } else {
        giftRow.classList.add("d-none");
      }

      document.getElementById("summaryTotal").textContent = formatPrice(totals.total);
    }

    function handleApplyCoupon() {
      const input = document.getElementById("couponCodeInput");
      const feedback = document.getElementById("couponFeedback");
      if (!input || !feedback) return;

      const res = applyCouponCode(input.value);
      if (res.success) {
        feedback.innerHTML = `<span class="text-success"><i class="bi bi-check-circle me-1"></i> ${res.message}</span>`;
      } else {
        feedback.innerHTML = `<span class="text-danger"><i class="bi bi-exclamation-circle me-1"></i> ${res.message}</span>`;
      }
      renderCartPage();
    }

    document.addEventListener("DOMContentLoaded", () => {
      renderCartPage();
      window.addEventListener("cartUpdated", () => {
        renderCartPage();
      });
    });
  </script>
@endsection