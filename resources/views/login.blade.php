@extends('layouts.front')

@section('title', 'Sign In — Himalayan Atelier')

@section('content')
  <!-- Login Main Content -->
  <main class="flex-grow-1 d-flex align-items-center py-5">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8 col-lg-5">
          <div class="card border-warm shadow-card p-4 p-md-5 bg-card">

            <div class="text-center mb-4">
              <div class="brand-monogram mb-3 mx-auto" style="width: 48px; height: 48px; font-size: 1.4rem;">H</div>
              <h3 class="font-serif mb-1">Welcome Back</h3>
              <p class="text-muted small">Sign in to your artisanal jewelry account</p>
            </div>

            <!-- Login Form (Connected to Laravel Auth) -->
            <form id="loginForm" action="{{ route('login.post') }}" method="POST" class="needs-validation" novalidate onsubmit="handleLoginSubmit(event)">
              @csrf

              @if($errors->any())
                <div class="alert alert-danger py-2 px-3 small mb-3 border-0">
                  <i class="bi bi-exclamation-circle me-1"></i> {{ $errors->first() }}
                </div>
              @endif

              <!-- Email / Phone field -->
              <div class="mb-3">
                <label for="loginIdentifier" class="form-label">Email or Mobile Number <span class="text-danger">*</span></label>
                <div class="input-group">
                  <span class="input-group-text bg-transparent border-warm text-muted"><i class="bi bi-person"></i></span>
                  <input type="text" class="form-control @error('loginIdentifier') is-invalid @enderror" id="loginIdentifier" name="loginIdentifier"
                    placeholder="priya.sharma@himalayan.demo or 9876543210" value="{{ old('loginIdentifier') }}" required>
                  <div class="invalid-feedback">Please enter your registered email or phone number.</div>
                </div>
              </div>

              <!-- Password field -->
              <div class="mb-3">
                <div class="d-flex justify-content-between align-items-center mb-1">
                  <label for="loginPassword" class="form-label mb-0">Password <span class="text-danger">*</span></label>
                  <a href="javascript:void(0)" onclick="openForgotModal()"
                    class="small text-gold-accent text-decoration-none">Forgot Password?</a>
                </div>
                <div class="input-group">
                  <span class="input-group-text bg-transparent border-warm text-muted"><i class="bi bi-lock"></i></span>
                  <input type="password" class="form-control" id="loginPassword" name="password" placeholder="••••••••" required>
                  <button class="btn btn-outline-secondary border-warm" type="button"
                    onclick="togglePasswordVisibility('loginPassword', this)">
                    <i class="bi bi-eye"></i>
                  </button>
                  <div class="invalid-feedback">Please enter your password.</div>
                </div>
              </div>

              <!-- Remember Me Checkbox -->
              <div class="mb-4 d-flex justify-content-between align-items-center">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="rememberMeCheck" name="remember" value="1" checked>
                  <label class="form-check-label small text-muted" for="rememberMeCheck">
                    Remember me on this device
                  </label>
                </div>
              </div>

              <!-- Submit Button -->
              <button type="submit" class="btn btn-gold w-100 py-2 fw-semibold mb-3">
                <i class="bi bi-box-arrow-in-right me-1"></i> Sign In
              </button>

              <!-- Quick Demo Access Buttons -->
              <div class="row g-2 mb-3">
                <div class="col-6">
                  <button type="button" class="btn btn-outline-dark w-100 py-2 small" onclick="fillDemoAccount('customer')">
                    <i class="bi bi-person me-1 text-gold-accent"></i> Demo Collector
                  </button>
                </div>
                <div class="col-6">
                  <button type="button" class="btn btn-outline-dark w-100 py-2 small" onclick="fillDemoAccount('admin')">
                    <i class="bi bi-shield-lock me-1 text-gold-accent"></i> Demo Admin
                  </button>
                </div>
              </div>

              <!-- Quick Admin Dashboard Access Link -->
              <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary w-100 py-2 small mb-4">
                <i class="bi bi-speedometer2 me-1 text-gold-accent"></i> Atelier Admin Dashboard
              </a>
            </form>

            <div class="text-center pt-3 border-top border-warm small">
              <span class="text-muted">New to Himalayan Jewels?</span>
              <a href="{{ route('register') }}" class="text-gold-accent fw-semibold text-decoration-none ms-1">Create an Account</a>
            </div>

          </div>
        </div>
      </div>
    </div>
  </main>

  <!-- Forgot Password Simulated Modal -->
  <div class="modal fade" id="forgotPasswordModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content border-warm">
        <div class="modal-header border-warm">
          <h5 class="modal-title font-serif">Reset Password</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body p-4">
          <p class="small text-muted mb-3">
            Enter your registered email address or phone number. We will send a secure recovery link.
          </p>
          <div class="mb-3">
            <label class="form-label small">Email or Mobile Number</label>
            <input type="text" id="forgotInput" class="form-control" placeholder="name@example.com">
          </div>
          <button type="button" class="btn btn-gold w-100 py-2" onclick="handleForgotSubmit()">
            Send Reset Instructions
          </button>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('js')
  <script>
    function togglePasswordVisibility(inputId, btn) {
      const input = document.getElementById(inputId);
      const icon = btn.querySelector("i");
      if (input.type === "password") {
        input.type = "text";
        icon.className = "bi bi-eye-slash";
      } else {
        input.type = "password";
        icon.className = "bi bi-eye";
      }
    }

    function fillDemoAccount(role) {
      if (role === 'admin') {
        document.getElementById("loginIdentifier").value = "admin@himalayan.com";
        document.getElementById("loginPassword").value = "Bespoke123!";
        showToast("Demo Loaded", "Admin credentials filled. Click 'Sign In' to proceed.", "info");
      } else {
        document.getElementById("loginIdentifier").value = "priya.sharma@himalayan.demo";
        document.getElementById("loginPassword").value = "Bespoke123!";
        showToast("Demo Loaded", "Collector credentials filled. Click 'Sign In' to proceed.", "info");
      }
    }

    function handleLoginSubmit(event) {
      const form = document.getElementById("loginForm");
      if (!form.checkValidity()) {
        event.preventDefault();
        event.stopPropagation();
        form.classList.add("was-validated");
        return;
      }
      // Form submits to {{ route('login.post') }} with real backend authentication
    }

    function openForgotModal() {
      const modal = new bootstrap.Modal(document.getElementById("forgotPasswordModal"));
      modal.show();
    }

    function handleForgotSubmit() {
      const val = document.getElementById("forgotInput").value.trim();
      if (!val) {
        alert("Please enter an email or phone number.");
        return;
      }
      bootstrap.Modal.getInstance(document.getElementById("forgotPasswordModal")).hide();
      showToast("Reset Link Sent", `A password reset link has been dispatched to ${val}.`, "info");
    }
  </script>
@endsection