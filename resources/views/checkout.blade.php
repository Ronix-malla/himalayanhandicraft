@extends('layouts.front')

@section('content')
<main class="py-5">
    <div class="container">
      <!-- Checkout Stepper Progress (PRD Card 08) -->
      <div class="checkout-stepper mb-5">
        <div class="step-item active" id="stepperStep1">
          <div class="step-circle" id="stepperCircle1">1</div>
          <span class="d-none d-sm-inline">Delivery Details</span>
        </div>
        <div class="step-line" id="stepperLine1"></div>
        <div class="step-item" id="stepperStep2">
          <div class="step-circle" id="stepperCircle2">2</div>
          <span class="d-none d-sm-inline">Payment Method</span>
        </div>
        <div class="step-line" id="stepperLine2"></div>
        <div class="step-item" id="stepperStep3">
          <div class="step-circle" id="stepperCircle3">3</div>
          <span class="d-none d-sm-inline">Order Confirmed</span>
        </div>
      </div>

      <!-- Main Layout: Forms (Left) & Order Summary (Right) -->
      <div class="row g-5" id="checkoutMainRow">
        <!-- Forms Column -->
        <div class="col-lg-8">

          <!-- STEP 1: Details Form (PRD Section 08) -->
          <div id="step1DetailsSection" class="checkout-step-pane">
            <div class="card border-warm shadow-subtle p-4 p-md-5 bg-card">
              <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom border-warm">
                <div>
                  <h4 class="font-serif mb-1">Delivery Address & Recipient</h4>
                  <p class="text-muted small mb-0">Please specify where your handcrafted jewelry should be delivered.
                  </p>
                </div>
                <span class="badge bg-warm-secondary text-ink border border-warm px-3 py-2 small">Step 1 of 2</span>
              </div>

              <form id="deliveryDetailsForm" class="needs-validation" novalidate
                onsubmit="handleProceedToPayment(event)">
                <div class="row g-3">
                  <!-- Full Name -->
                  <div class="col-md-6">
                    <label for="fullName" class="form-label">Full Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="fullName" placeholder="e.g. Priya Sharma" value="{{ Auth::check() ? Auth::user()->name : '' }}" required>
                    <div class="invalid-feedback">Please enter the recipient's full name.</div>
                  </div>

                  <!-- Phone Number -->
                  <div class="col-md-6">
                    <label for="phoneNumber" class="form-label">Phone Number (For Delivery & OTP) <span
                        class="text-danger">*</span></label>
                    <input type="tel" class="form-control" id="phoneNumber" placeholder="e.g. 9876543210"
                      pattern="[0-9]{10}" value="{{ Auth::check() ? Auth::user()->phone : '' }}" required>
                    <div class="invalid-feedback">Please enter a valid 10-digit mobile number.</div>
                  </div>

                  <!-- Email Address -->
                  <div class="col-md-12">
                    <label for="emailAddress" class="form-label">Email Address (For Order Receipt) <span
                        class="text-danger">*</span></label>
                    <input type="email" class="form-control" id="emailAddress" placeholder="e.g. priya@example.com"
                      value="{{ Auth::check() ? Auth::user()->email : '' }}" required>
                    <div class="invalid-feedback">Please enter a valid email address.</div>
                  </div>

                  <!-- Street Address -->
                  <div class="col-12">
                    <label for="streetAddress" class="form-label">House / Flat No., Building & Street <span
                        class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="streetAddress"
                      placeholder="e.g. Flat 402, Lotus Orchid, MG Road" required>
                    <div class="invalid-feedback">Please enter your complete street address.</div>
                  </div>

                  <!-- Landmark -->
                  <div class="col-md-6">
                    <label for="landmark" class="form-label">Landmark (Optional)</label>
                    <input type="text" class="form-control" id="landmark"
                      placeholder="e.g. Near HDFC Bank / Metro Pillar 24">
                  </div>

                  <!-- City -->
                  <div class="col-md-6">
                    <label for="city" class="form-label">City <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="city" placeholder="e.g. Jaipur" required>
                    <div class="invalid-feedback">Please enter your city.</div>
                  </div>

                  <!-- State -->
                  <div class="col-md-6">
                    <label for="stateSelect" class="form-label">State <span class="text-danger">*</span></label>
                    <select class="form-select" id="stateSelect" required>
                      <option value="">Select State</option>
                      <option value="Rajasthan" selected>Rajasthan</option>
                      <option value="Maharashtra">Maharashtra</option>
                      <option value="Delhi">Delhi NCR</option>
                      <option value="Karnataka">Karnataka</option>
                      <option value="Tamil Nadu">Tamil Nadu</option>
                      <option value="Gujarat">Gujarat</option>
                      <option value="Telangana">Telangana</option>
                      <option value="West Bengal">West Bengal</option>
                      <option value="Uttar Pradesh">Uttar Pradesh</option>
                      <option value="Other">Other States</option>
                    </select>
                    <div class="invalid-feedback">Please select your state.</div>
                  </div>

                  <!-- PIN Code -->
                  <div class="col-md-6">
                    <label for="pinCode" class="form-label">Postal / PIN Code <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="pinCode" placeholder="e.g. 302001" pattern="[0-9]{6}"
                      required>
                    <div class="invalid-feedback">Please enter a 6-digit postal PIN code.</div>
                  </div>

                  <!-- Sizing Notes & Delivery Instructions -->
                  <div class="col-12">
                    <label for="deliveryNotes" class="form-label">Custom Ring/Bangle Sizing Notes & Special Instructions
                      (Optional)</label>
                    <textarea class="form-control" id="deliveryNotes" rows="2"
                      placeholder="e.g. 'Please size the Aethel ring to US 6.5 if possible' or 'Call before delivery'"></textarea>
                    <div class="form-text x-small text-muted">Because each piece is made at home, our jeweler can adapt
                      the fit to your exact request.</div>
                  </div>

                  <div class="col-12">
                    <div class="form-check mt-2">
                      <input class="form-check-input" type="checkbox" id="saveInfoCheck" checked>
                      <label class="form-check-label small text-muted" for="saveInfoCheck">
                        Save this delivery information for future orders
                      </label>
                    </div>
                  </div>
                </div>

                <div class="mt-4 pt-3 border-top border-warm d-flex justify-content-between align-items-center">
                  <a href="{{ route('cart.index') }}" class="btn btn-outline-dark">
                    <i class="bi bi-arrow-left me-1"></i> Back to Cart
                  </a>
                  <button type="submit" class="btn btn-gold px-4 py-2">
                    Continue to Payment <i class="bi bi-arrow-right ms-1"></i>
                  </button>
                </div>
              </form>
            </div>
          </div>

          <!-- STEP 2: Payment Method (PRD Section 08) -->
          <div id="step2PaymentSection" class="checkout-step-pane d-none">
            <div class="card border-warm shadow-subtle p-4 p-md-5 bg-card">
              <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom border-warm">
                <div>
                  <h4 class="font-serif mb-1">Select Payment Method</h4>
                  <p class="text-muted small mb-0">Choose how you would like to complete your order.</p>
                </div>
                <button type="button" class="btn btn-sm btn-link text-gold-accent text-decoration-none"
                  onclick="goToStep(1)">
                  <i class="bi bi-pencil me-1"></i> Edit Address
                </button>
              </div>

              <!-- Address Recap Box -->
              <div class="p-3 bg-warm-secondary rounded border border-warm mb-4 small">
                <div class="d-flex justify-content-between align-items-center mb-1">
                  <span class="text-muted">Delivering to:</span>
                  <strong class="text-ink" id="recapRecipientName">Priya Sharma</strong>
                </div>
                <div class="text-muted" id="recapAddressLine">Flat 402, Lotus Orchid, MG Road, Jaipur 302001</div>
                <div class="text-muted" id="recapContactLine">Phone: 9876543210 · Email: priya@example.com</div>
              </div>

              <!-- Payment Options (PRD Card 08: COD default/primary, plus UPI/QR & card) -->
              <div class="d-flex flex-column gap-3 mb-4">

                <!-- Option 1: Cash on Delivery (COD) - PRD PRIMARY -->
                <div class="payment-method-card selected" id="methodCod" onclick="selectPaymentMethod('cod')">
                  <div class="d-flex align-items-start gap-3">
                    <input class="form-check-input mt-1" type="radio" name="paymentOption" id="radioCod" checked>
                    <div class="flex-grow-1">
                      <div class="d-flex justify-content-between align-items-center">
                        <label for="radioCod" class="fw-semibold text-ink cursor-pointer mb-0">
                          Cash on Delivery (COD)
                        </label>
                        <span class="badge bg-gold text-white px-2 py-1 small">Primary Choice</span>
                      </div>
                      <p class="text-muted small mb-2 mt-1">
                        Pay with cash or scan the delivery agent's UPI QR upon receiving your sealed jewelry package.
                      </p>
                      <div class="p-2 bg-warm-light rounded border border-light-subtle x-small text-muted">
                        <i class="bi bi-patch-check-fill text-gold-accent me-1"></i> Zero advance fee required.
                        Packaging is tamper-evident with our wax seal.
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Option 2: UPI / QR Code (Simulated) -->
                <div class="payment-method-card" id="methodUpi" onclick="selectPaymentMethod('upi')">
                  <div class="d-flex align-items-start gap-3">
                    <input class="form-check-input mt-1" type="radio" name="paymentOption" id="radioUpi">
                    <div class="flex-grow-1">
                      <div class="d-flex justify-content-between align-items-center">
                        <label for="radioUpi" class="fw-semibold text-ink cursor-pointer mb-0">
                          Instant UPI / QR Code (Simulated)
                        </label>
                        <span class="badge bg-warm-secondary text-ink border border-warm">GPay · PhonePe · Paytm</span>
                      </div>
                      <p class="text-muted small mb-0 mt-1">
                        Pay instantly via any UPI app or scan the studio dynamic QR code.
                      </p>
                    </div>
                  </div>

                  <!-- Collapsible UPI Sub-panel -->
                  <div id="upiDetailsPanel" class="mt-3 pt-3 border-top border-warm d-none">
                    <div class="row align-items-center g-3">
                      <div class="col-sm-5 text-center">
                        <div class="p-2 bg-white border rounded d-inline-block shadow-sm">
                          <!-- Simulated QR Code SVG -->
                          <svg width="130" height="130" viewBox="0 0 100 100" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <rect width="100" height="100" fill="#ffffff" />
                            <rect x="10" y="10" width="30" height="30" fill="#1b1917" />
                            <rect x="15" y="15" width="20" height="20" fill="#ffffff" />
                            <rect x="20" y="20" width="10" height="10" fill="#b6892f" />
                            <rect x="60" y="10" width="30" height="30" fill="#1b1917" />
                            <rect x="65" y="15" width="20" height="20" fill="#ffffff" />
                            <rect x="70" y="20" width="10" height="10" fill="#b6892f" />
                            <rect x="10" y="60" width="30" height="30" fill="#1b1917" />
                            <rect x="15" y="65" width="20" height="20" fill="#ffffff" />
                            <rect x="20" y="70" width="10" height="10" fill="#b6892f" />
                            <rect x="50" y="50" width="12" height="12" fill="#1b1917" />
                            <rect x="70" y="50" width="8" height="18" fill="#1b1917" />
                            <rect x="50" y="70" width="18" height="8" fill="#1b1917" />
                            <rect x="75" y="75" width="15" height="15" fill="#b6892f" />
                          </svg>
                        </div>
                        <div class="x-small text-muted mt-1">UPI ID: <strong>Himalayanjewels@icici</strong></div>
                      </div>
                      <div class="col-sm-7">
                        <label class="form-label x-small fw-semibold text-muted">Or enter your VPA / UPI ID:</label>
                        <div class="input-group input-group-sm mb-2">
                          <input type="text" class="form-control" placeholder="yourname@okhdfcbank"
                            value="collector@oksbi">
                          <button class="btn btn-outline-gold" type="button"
                            onclick="showToast('UPI Request Simulated', 'A simulated collect request was sent to your app.', 'info')">Verify</button>
                        </div>
                        <div class="x-small text-muted">A payment notification will pop up on your UPI application.
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Option 3: Credit / Debit Card (Simulated) -->
                <div class="payment-method-card" id="methodCard" onclick="selectPaymentMethod('card')">
                  <div class="d-flex align-items-start gap-3">
                    <input class="form-check-input mt-1" type="radio" name="paymentOption" id="radioCard">
                    <div class="flex-grow-1">
                      <div class="d-flex justify-content-between align-items-center">
                        <label for="radioCard" class="fw-semibold text-ink cursor-pointer mb-0">
                          Credit / Debit Card (Simulated)
                        </label>
                        <span class="small text-muted"><i class="bi bi-credit-card-2-front fs-5"></i></span>
                      </div>
                      <p class="text-muted small mb-0 mt-1">
                        Visa, MasterCard, RuPay or American Express.
                      </p>
                    </div>
                  </div>

                  <!-- Collapsible Card Sub-panel -->
                  <div id="cardDetailsPanel" class="mt-3 pt-3 border-top border-warm d-none">
                    <div class="row g-2">
                      <div class="col-12">
                        <label class="form-label x-small">Card Number</label>
                        <input type="text" class="form-control form-control-sm" placeholder="4242 •••• •••• 4242"
                          value="4242 8899 1234 5678">
                      </div>
                      <div class="col-6">
                        <label class="form-label x-small">Expiry Date</label>
                        <input type="text" class="form-control form-control-sm" placeholder="MM/YY" value="08/28">
                      </div>
                      <div class="col-6">
                        <label class="form-label x-small">CVV</label>
                        <input type="password" class="form-control form-control-sm" placeholder="•••" value="123">
                      </div>
                    </div>
                  </div>
                </div>

              </div>

              <!-- Action buttons -->
              <div class="pt-3 border-top border-warm d-flex justify-content-between align-items-center">
                <button type="button" class="btn btn-outline-dark" onclick="goToStep(1)">
                  <i class="bi bi-arrow-left me-1"></i> Back to Address
                </button>
                <button type="button" class="btn btn-gold px-4 py-2 fw-semibold" id="confirmOrderBtn"
                  onclick="handleConfirmOrder()">
                  <i class="bi bi-shield-check me-1"></i> Confirm Order (<span class="btn-live-total">₹0</span>)
                </button>
              </div>
            </div>
          </div>

          <!-- STEP 3: Order Confirmed Screen (PRD Card 08) -->
          <div id="step3SuccessSection" class="checkout-step-pane d-none">
            <div class="card border-warm shadow-card p-4 p-md-5 bg-card text-center">
              <div class="success-icon-wrap mb-3 mx-auto"
                style="width: 72px; height: 72px; border-radius: 50%; background: var(--color-gold-light); border: 2px solid var(--color-gold); display: flex; align-items: center; justify-content: center;">
                <i class="bi bi-check2 text-gold-accent fs-1"></i>
              </div>

              <span class="text-gold-accent letter-spacing-wide small fw-semibold">Order Placed Successfully</span>
              <h2 class="font-serif mt-1 mb-2">Thank You for Supporting Handcrafted Art</h2>
              <p class="text-muted mx-auto mb-4" style="max-width: 520px;">
                Your order has been recorded in our home studio workbench queue. Each piece will now be hand-textured,
                sized, and polished before dispatch.
              </p>

              <!-- Order Summary Receipt Box -->
              <div class="card border-warm bg-warm-secondary p-4 text-start mb-4 mx-auto" style="max-width: 620px;">
                <div class="d-flex justify-content-between align-items-center border-bottom border-warm pb-3 mb-3">
                  <div>
                    <span class="text-muted x-small text-uppercase letter-spacing-wide">Order Identifier</span>
                    <h5 class="font-serif mb-0 text-gold-accent" id="orderSuccessId">#AUR-84920</h5>
                  </div>
                  <div class="text-end">
                    <span class="text-muted x-small text-uppercase letter-spacing-wide">Est. Delivery</span>
                    <div class="fw-semibold small" id="orderEstDelivery">3–5 Business Days</div>
                  </div>
                </div>

                <div class="mb-3">
                  <h6 class="small fw-bold text-uppercase letter-spacing-wide text-muted mb-2">Jewelry Ordered:</h6>
                  <div id="orderSuccessItemsList" class="small">
                    <!-- Javascript populates purchased items -->
                  </div>
                </div>

                <div class="border-top border-warm pt-3 mb-3">
                  <div class="d-flex justify-content-between small text-muted mb-1">
                    <span>Payment Method:</span>
                    <strong class="text-ink" id="orderSuccessPaymentMethod">Cash on Delivery (COD)</strong>
                  </div>
                  <div class="d-flex justify-content-between small text-muted mb-1">
                    <span>Delivery Address:</span>
                    <span class="text-end text-ink" id="orderSuccessAddress">Jaipur, Rajasthan</span>
                  </div>
                  <div class="d-flex justify-content-between fw-bold pt-2 border-top border-warm">
                    <span>Amount Payable:</span>
                    <span class="text-gold-accent fs-6" id="orderSuccessTotal">₹0</span>
                  </div>
                </div>

                <div class="p-2 bg-white rounded border border-warm x-small text-muted">
                  <i class="bi bi-info-circle text-gold-accent me-1"></i> Front-End Order Simulation: No actual
                  financial charge occurred. Your cart has been reset.
                </div>
              </div>

              <!-- Action CTAs -->
              <div class="d-flex flex-wrap justify-content-center gap-3">
                <a href="#" id="orderWhatsAppShareBtn" target="_blank" class="btn btn-outline-gold">
                  <i class="bi bi-whatsapp me-2 text-success"></i> Send Order to WhatsApp
                </a>
                <button type="button" class="btn btn-outline-dark" onclick="window.print()">
                  <i class="bi bi-printer me-2"></i> Print Order Receipt
                </button>
                <a href="{{ route('products.index') }}" class="btn btn-gold">
                  Continue Shopping <i class="bi bi-arrow-right ms-1"></i>
                </a>
              </div>
            </div>
          </div>

        </div>

        <!-- Right Column: Live Order Summary Recap -->
        <div class="col-lg-4" id="checkoutSidebarCol">
          <div class="card border-warm shadow-subtle p-4 bg-card sticky-top" style="top: 90px;">
            <div class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-2">
              <h5 class="font-serif mb-0">Order Summary</h5>
              <a href="{{ route('cart.index') }}" class="small text-muted hover-gold text-decoration-none">Edit</a>
            </div>

            <!-- Mini Cart Items Preview -->
            <div id="checkoutMiniCartList" class="mb-3" style="max-height: 240px; overflow-y: auto;">
              <!-- Javascript populates -->
            </div>

            <div class="border-top pt-3">
              <div class="d-flex justify-content-between mb-2 small">
                <span class="text-muted">Subtotal</span>
                <span class="fw-semibold" id="checkoutSummarySubtotal">₹0</span>
              </div>

              <div id="checkoutSummaryDiscountRow"
                class="d-flex justify-content-between mb-2 small text-success d-none">
                <span id="checkoutSummaryDiscountLabel">Discount</span>
                <span id="checkoutSummaryDiscountValue">-₹0</span>
              </div>

              <div class="d-flex justify-content-between mb-2 small">
                <span class="text-muted">Delivery</span>
                <span id="checkoutSummaryShipping">FREE</span>
              </div>

              <div id="checkoutSummaryGiftRow" class="d-flex justify-content-between mb-2 small text-muted d-none">
                <span>Gift Packaging</span>
                <span>₹100</span>
              </div>

              <hr class="my-3">

              <div class="d-flex justify-content-between align-items-baseline mb-3">
                <span class="fw-bold">Total Amount</span>
                <span class="fs-4 fw-bold text-gold-accent" id="checkoutSummaryTotal">₹0</span>
              </div>

              <div class="p-3 bg-warm-light rounded border border-light-subtle small text-muted">
                <i class="bi bi-shield-lock-fill text-gold-accent me-1"></i>
                <span>All pieces are inspected, boxed in velvet, and dispatched with an artisan guarantee.</span>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </main>
@endsection

@section('js')
<script>
    let currentStep = 1;
    let selectedPayment = "cod";
    let customerDetails = {};

    function goToStep(step) {
      currentStep = step;
      const step1 = document.getElementById("step1DetailsSection");
      const step2 = document.getElementById("step2PaymentSection");
      const step3 = document.getElementById("step3SuccessSection");
      const sidebarCol = document.getElementById("checkoutSidebarCol");

      const s1 = document.getElementById("stepperStep1");
      const s2 = document.getElementById("stepperStep2");
      const s3 = document.getElementById("stepperStep3");
      const l1 = document.getElementById("stepperLine1");
      const l2 = document.getElementById("stepperLine2");

      if (step === 1) {
        step1.classList.remove("d-none");
        step2.classList.add("d-none");
        step3.classList.add("d-none");
        if (sidebarCol) sidebarCol.classList.remove("d-none");

        s1.className = "step-item active";
        s2.className = "step-item";
        s3.className = "step-item";
        l1.className = "step-line";
        l2.className = "step-line";
      } else if (step === 2) {
        step1.classList.add("d-none");
        step2.classList.remove("d-none");
        step3.classList.add("d-none");
        if (sidebarCol) sidebarCol.classList.remove("d-none");

        s1.className = "step-item completed";
        s2.className = "step-item active";
        s3.className = "step-item";
        l1.className = "step-line active";
        l2.className = "step-line";

        // Update recap
        document.getElementById("recapRecipientName").textContent = customerDetails.fullName;
        document.getElementById("recapAddressLine").textContent = `${customerDetails.streetAddress}, ${customerDetails.city}, ${customerDetails.state} - ${customerDetails.pinCode}`;
        document.getElementById("recapContactLine").textContent = `Phone: ${customerDetails.phoneNumber} · Email: ${customerDetails.emailAddress}`;
      } else if (step === 3) {
        step1.classList.add("d-none");
        step2.classList.add("d-none");
        step3.classList.remove("d-none");
        if (sidebarCol) sidebarCol.classList.add("d-none");

        s1.className = "step-item completed";
        s2.className = "step-item completed";
        s3.className = "step-item completed";
        l1.className = "step-line active";
        l2.className = "step-line active";
      }

      window.scrollTo({ top: 0, behavior: "smooth" });
    }

    function handleProceedToPayment(event) {
      event.preventDefault();
      const form = document.getElementById("deliveryDetailsForm");
      if (!form.checkValidity()) {
        event.stopPropagation();
        form.classList.add("was-validated");
        showToast("Incomplete Form", "Please fill in all required delivery fields.", "danger");
        return;
      }

      customerDetails = {
        fullName: document.getElementById("fullName").value.trim(),
        phoneNumber: document.getElementById("phoneNumber").value.trim(),
        emailAddress: document.getElementById("emailAddress").value.trim(),
        streetAddress: document.getElementById("streetAddress").value.trim(),
        landmark: document.getElementById("landmark").value.trim(),
        city: document.getElementById("city").value.trim(),
        state: document.getElementById("stateSelect").value,
        pinCode: document.getElementById("pinCode").value.trim(),
        deliveryNotes: document.getElementById("deliveryNotes").value.trim()
      };

      if (document.getElementById("saveInfoCheck").checked) {
        localStorage.setItem("Himalayan_saved_address", JSON.stringify(customerDetails));
      }

      goToStep(2);
    }

    function selectPaymentMethod(method) {
      selectedPayment = method;
      document.querySelectorAll(".payment-method-card").forEach(c => c.classList.remove("selected"));

      const codCard = document.getElementById("methodCod");
      const upiCard = document.getElementById("methodUpi");
      const cardCard = document.getElementById("methodCard");

      const upiPanel = document.getElementById("upiDetailsPanel");
      const cardPanel = document.getElementById("cardDetailsPanel");

      if (method === "cod") {
        codCard.classList.add("selected");
        document.getElementById("radioCod").checked = true;
        upiPanel.classList.add("d-none");
        cardPanel.classList.add("d-none");
      } else if (method === "upi") {
        upiCard.classList.add("selected");
        document.getElementById("radioUpi").checked = true;
        upiPanel.classList.remove("d-none");
        cardPanel.classList.add("d-none");
      } else if (method === "card") {
        cardCard.classList.add("selected");
        document.getElementById("radioCard").checked = true;
        upiPanel.classList.add("d-none");
        cardPanel.classList.remove("d-none");
      }
    }

    async function handleConfirmOrder() {
      const cart = getCart();
      if (cart.length === 0) {
        showToast("Empty Cart", "Your cart is empty. Please add items before placing an order.", "danger");
        return;
      }

      const totals = getCartTotals();
      const methodLabel = selectedPayment === "cod" ? "Cash on Delivery (COD)" : selectedPayment === "upi" ? "Instant UPI" : "Credit/Debit Card";

      try {
        const payload = {
          fullName: customerDetails.fullName,
          phoneNumber: customerDetails.phoneNumber,
          emailAddress: customerDetails.emailAddress,
          streetAddress: customerDetails.streetAddress,
          landmark: customerDetails.landmark,
          city: customerDetails.city,
          state: customerDetails.state,
          pincode: customerDetails.pinCode,
          deliveryNotes: customerDetails.deliveryNotes,
          paymentMethod: selectedPayment,
          items: cart,
          subtotal: totals.subtotal,
          discountAmount: totals.discount,
          couponCode: totals.couponInfo ? totals.couponInfo.code : null,
          shippingAmount: totals.shipping,
          giftWrapAmount: totals.hasGiftWrap ? 100 : 0,
          totalAmount: totals.total,
        };

        const csrfToken = document.querySelector('meta[name="csrf-token"]') ? document.querySelector('meta[name="csrf-token"]').getAttribute('content') : '';

        const res = await fetch("{{ route('checkout.store') }}", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
            "Accept": "application/json",
            "X-CSRF-TOKEN": csrfToken
          },
          body: JSON.stringify(payload)
        });

        const data = await res.json();
        const orderId = (data && data.success && data.order_number) ? data.order_number : ("#HIM-" + Math.floor(10000 + Math.random() * 90000));

        // Populate Success screen
        document.getElementById("orderSuccessId").textContent = orderId;
        document.getElementById("orderSuccessPaymentMethod").textContent = methodLabel;
        document.getElementById("orderSuccessAddress").textContent = `${customerDetails.city}, ${customerDetails.state} (${customerDetails.pinCode})`;
        document.getElementById("orderSuccessTotal").textContent = formatPrice(totals.total);

        // Populate items list
        let itemsHtml = "";
        cart.forEach(item => {
          itemsHtml += `
            <div class="d-flex justify-content-between py-1 border-bottom border-light-subtle">
              <span>${item.name} (${item.metal}, ${item.size}) × ${item.quantity}</span>
              <span class="fw-semibold text-ink">${formatPrice(item.price * item.quantity)}</span>
            </div>
          `;
        });
        document.getElementById("orderSuccessItemsList").innerHTML = itemsHtml;

        // WhatsApp link preparation
        const waText = encodeURIComponent(`Hi Himalayan Atelier! I just placed order ${orderId} for ${customerDetails.fullName}.\nTotal: ${formatPrice(totals.total)} (${methodLabel}).\nAddress: ${customerDetails.streetAddress}, ${customerDetails.city} ${customerDetails.pinCode}.\nPlease confirm crafting status.`);
        document.getElementById("orderWhatsAppShareBtn").href = `https://wa.me/919876543210?text=${waText}`;

        // Clear the cart now
        clearCart();

        // Show success step
        goToStep(3);
        showToast("Order Confirmed!", `Order ${orderId} placed and confirmed. Thank you!`, "success");
      } catch (err) {
        console.error("Order submission error:", err);
        goToStep(3);
      }
    }

    function renderCheckoutSummary() {
      const cart = getCart();
      const totals = getCartTotals();

      // If cart is empty and not on step 3, redirect to cart
      if (cart.length === 0 && currentStep !== 3) {
        // alert or redirect
      }

      const miniList = document.getElementById("checkoutMiniCartList");
      if (miniList) {
        let html = "";
        cart.forEach(item => {
          html += `
            <div class="d-flex align-items-center gap-2 mb-2 pb-2 border-bottom border-light-subtle small">
              <img src="${item.image}" alt="${item.name}" class="rounded object-fit-cover" width="40" height="40" onerror="this.src='assets/images/prod-solitaire-ring.jpg'">
              <div class="flex-grow-1 min-w-0">
                <div class="fw-semibold text-truncate">${item.name}</div>
                <div class="x-small text-muted">${item.metal} · ${item.size} × ${item.quantity}</div>
              </div>
              <div class="fw-bold text-ink">${formatPrice(item.price * item.quantity)}</div>
            </div>
          `;
        });
        miniList.innerHTML = html;
      }

      document.getElementById("checkoutSummarySubtotal").textContent = formatPrice(totals.subtotal);

      const discountRow = document.getElementById("checkoutSummaryDiscountRow");
      if (totals.discount > 0 && totals.couponInfo) {
        discountRow.classList.remove("d-none");
        document.getElementById("checkoutSummaryDiscountLabel").textContent = `Discount (${totals.couponInfo.code})`;
        document.getElementById("checkoutSummaryDiscountValue").textContent = `-${formatPrice(totals.discount)}`;
      } else {
        discountRow.classList.add("d-none");
      }

      document.getElementById("checkoutSummaryShipping").innerHTML = totals.shipping === 0 ? '<span class="text-success fw-bold">FREE</span>' : formatPrice(totals.shipping);

      const giftRow = document.getElementById("checkoutSummaryGiftRow");
      if (totals.hasGiftWrap) {
        giftRow.classList.remove("d-none");
      } else {
        giftRow.classList.add("d-none");
      }

      document.getElementById("checkoutSummaryTotal").textContent = formatPrice(totals.total);
      document.querySelectorAll(".btn-live-total").forEach(el => el.textContent = formatPrice(totals.total));
    }

    // Load saved address if present
    function loadSavedAddress() {
      try {
        const saved = localStorage.getItem("Himalayan_saved_address");
        if (saved) {
          const data = JSON.parse(saved);
          if (data.fullName) document.getElementById("fullName").value = data.fullName;
          if (data.phoneNumber) document.getElementById("phoneNumber").value = data.phoneNumber;
          if (data.emailAddress) document.getElementById("emailAddress").value = data.emailAddress;
          if (data.streetAddress) document.getElementById("streetAddress").value = data.streetAddress;
          if (data.landmark) document.getElementById("landmark").value = data.landmark;
          if (data.city) document.getElementById("city").value = data.city;
          if (data.state) document.getElementById("stateSelect").value = data.state;
          if (data.pinCode) document.getElementById("pinCode").value = data.pinCode;
        } else {
          // If logged in, prefill user info
          const user = getCurrentUser();
          if (user) {
            if (user.name) document.getElementById("fullName").value = user.name;
            if (user.email) document.getElementById("emailAddress").value = user.email;
            if (user.phone) document.getElementById("phoneNumber").value = user.phone;
          }
        }
      } catch (e) { }
    }

    document.addEventListener("DOMContentLoaded", () => {
      renderCheckoutSummary();
      loadSavedAddress();
    });
  </script>
@endsection