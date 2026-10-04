@extends('layouts.front')

@section('title', 'Create Collector Account — Himalayan Atelier')

@section('content')
  <main class="flex-grow-1 d-flex align-items-center py-5">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-9 col-lg-6">
          <div class="card border-warm shadow-card p-4 p-md-5 bg-card">

            <div class="text-center mb-4">
              <div class="brand-monogram mb-3 mx-auto" style="width: 48px; height: 48px; font-size: 1.4rem;">H</div>
              <h3 class="font-serif mb-1">Create Your Account</h3>
              <p class="text-muted small">Join our boutique circle for bespoke sizing and preview access</p>
            </div>

            <!-- Registration Form (Connected to Laravel Auth) -->
            <form id="registerForm" action="{{ route('register.post') }}" method="POST" class="needs-validation" novalidate onsubmit="handleRegisterSubmit(event)">
              @csrf

              @if($errors->any())
                <div class="alert alert-danger py-2 px-3 small mb-3 border-0">
                  <ul class="mb-0 ps-3">
                    @foreach($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
              @endif

              <div class="row g-3">
                <!-- Full Name -->
                <div class="col-12">
                  <label for="regName" class="form-label">Full Name <span class="text-danger">*</span></label>
                  <input type="text" class="form-control @error('name') is-invalid @enderror" id="regName" name="name"
                    value="{{ old('name') }}" placeholder="e.g. Ananya Mehra" required>
                  <div class="invalid-feedback">Please enter your full name.</div>
                </div>

                <!-- Email Address -->
                <div class="col-md-6">
                  <label for="regEmail" class="form-label">Email Address <span class="text-danger">*</span></label>
                  <input type="email" class="form-control @error('email') is-invalid @enderror" id="regEmail" name="email"
                    value="{{ old('email') }}" placeholder="ananya@example.com" required>
                  <div class="invalid-feedback">Please enter a valid email address.</div>
                </div>

                <!-- Mobile Phone -->
                <div class="col-md-6">
                  <label for="regPhone" class="form-label">Mobile Number <span class="text-danger">*</span></label>
                  <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="regPhone" name="phone"
                    value="{{ old('phone') }}" placeholder="9876543210" pattern="[0-9]{10}" required>
                  <div class="invalid-feedback">Please enter a 10-digit mobile number.</div>
                </div>

                <!-- Password -->
                <div class="col-md-6">
                  <label for="regPassword" class="form-label">Password <span class="text-danger">*</span></label>
                  <input type="password" class="form-control @error('password') is-invalid @enderror" id="regPassword" name="password"
                    placeholder="••••••••" minlength="6" required oninput="checkPasswordMatch()">
                  <div class="invalid-feedback">Password must be at least 6 characters.</div>
                </div>

                <!-- Confirm Password -->
                <div class="col-md-6">
                  <label for="regConfirmPassword" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                  <input type="password" class="form-control" id="regConfirmPassword" name="password_confirmation"
                    placeholder="••••••••" required oninput="checkPasswordMatch()">
                  <div class="invalid-feedback" id="confirmFeedback">Passwords must match.</div>
                </div>

                <!-- Newsletter & Terms -->
                <div class="col-12 mt-3">
                  <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" id="termsCheck" required>
                    <label class="form-check-label small text-muted" for="termsCheck">
                      I agree to the <a href="{{ route('contact.index') }}" class="text-gold-accent text-decoration-none">Terms of Service</a> & <a
                        href="{{ route('contact.index') }}" class="text-gold-accent text-decoration-none">Privacy Policy</a>
                    </label>
                    <div class="invalid-feedback">You must agree before continuing.</div>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="newsletterCheck" checked>
                    <label class="form-check-label small text-muted" for="newsletterCheck">
                      Send me invitations to small-batch jewelry releases and sizing guides
                    </label>
                  </div>
                </div>

                <!-- Submit Button -->
                <div class="col-12 mt-4">
                  <button type="submit" class="btn btn-gold w-100 py-2 fw-semibold">
                    <i class="bi bi-person-plus me-1"></i> Create Collector Account
                  </button>
                </div>
              </div>
            </form>

            <div class="text-center pt-4 border-top border-warm small mt-4">
              <span class="text-muted">Already have an account?</span>
              <a href="{{ route('login') }}" class="text-gold-accent fw-semibold text-decoration-none ms-1">Sign In</a>
            </div>

          </div>
        </div>
      </div>
    </div>
  </main>
@endsection

@section('js')
  <script>
    function checkPasswordMatch() {
      const p1 = document.getElementById("regPassword").value;
      const p2 = document.getElementById("regConfirmPassword").value;
      const confirmInput = document.getElementById("regConfirmPassword");

      if (p2.length > 0 && p1 !== p2) {
        confirmInput.setCustomValidity("Passwords do not match");
      } else {
        confirmInput.setCustomValidity("");
      }
    }

    function handleRegisterSubmit(event) {
      checkPasswordMatch();
      const form = document.getElementById("registerForm");

      if (!form.checkValidity()) {
        event.preventDefault();
        event.stopPropagation();
        form.classList.add("was-validated");
        return;
      }
      // Form submits to {{ route('register.post') }} with real backend registration
    }
  </script>
@endsection