@extends('layouts.front')

@section('title', 'Himalayan — Handcrafted Fine Jewelry | Rings & Hand Bangles')

@section('content')
  <!-- Full-Width Hero Section -->
  <section class="hero-section">
    <div class="hero-bg-wrapper">
      <img src="{{ asset('assets/images/hero-banner.jpg') }}" alt="Himalayan Handcrafted Fine Jewelry Lookbook" class="hero-bg-img"
        fetchpriority="high">
    </div>
    <div class="hero-overlay"></div>
    <div class="container hero-content">
      <div class="row align-items-center">
        <div class="col-lg-8 col-xl-7">
          <span class="hero-kicker">Home-Forged · Ethically Sourced</span>
          <h1 class="hero-title">Elegance Forged by Hand, Worn with Soul.</h1>
          <p class="hero-desc">
            Handcrafted rings and bangles, individually hammered and shaped in our jewelry workshop. Made from brass,
            copper, and white metal, each piece carries unique textures and timeless craftsmanship.
          </p>
          <div class="d-flex flex-wrap gap-3">
            <a href="{{ route('products.index') }}" class="btn btn-gold">
              <i class="bi bi-gem me-2"></i> Explore Collection
            </a>
            <a href="{{ route('contact.index') }}" class="btn btn-outline-light-custom">
              Our Craft Story
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Trust & Artisanal Standards Bar -->
  <section class="trust-bar">
    <div class="container">
      <div class="row g-4">
        <div class="col-6 col-md-3">
          <div class="trust-item">
            <div class="trust-icon">
              <i class="bi bi-hammer"></i>
            </div>
            <div>
              <h6 class="mb-0 fw-semibold text-ink">100% Handcrafted</h6>
              <span class="x-small text-muted">Forged piece-by-piece at home</span>
            </div>
          </div>
        </div>
        <div class="col-6 col-md-3">
          <div class="trust-item">
            <div class="trust-icon">
              <i class="bi bi-shield-check"></i>
            </div>
            <div>
              <h6 class="mb-0 fw-semibold text-ink">Noble Metals</h6>
              <span class="x-small text-muted">Brass, Copper, White-Metal</span>
            </div>
          </div>
        </div>
        <div class="col-6 col-md-3">
          <div class="trust-item">
            <div class="trust-icon">
              <i class="bi bi-rulers"></i>
            </div>
            <div>
              <h6 class="mb-0 fw-semibold text-ink">Custom Sizing</h6>
              <span class="x-small text-muted">Tailored to your wrist and hand</span>
            </div>
          </div>
        </div>
        <div class="col-6 col-md-3">
          <div class="trust-item">
            <div class="trust-icon">
              <i class="bi bi-truck"></i>
            </div>
            <div>
              <h6 class="mb-0 fw-semibold text-ink">Careful Delivery</h6>
              <span class="x-small text-muted">Velvet pouches & COD option</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Category Visual Shortcuts (Rings / Bangles) -->
  <section class="py-5 bg-warm-secondary">
    <div class="container py-4">
      <div class="text-center mb-5">
        <span class="text-gold-accent letter-spacing-wide small fw-semibold">Signature Disciplines</span>
        <h2 class="display-6 font-serif mt-1">Curated by Craft</h2>
        <p class="text-muted mx-auto" style="max-width: 520px;">Discover handcrafted rings and bangles crafted from
          brass, copper, and white metal, shaped with traditional tools and timeless craftsmanship.</p>
      </div>

      <div class="row g-4">
        <!-- Rings Category Tile -->
        <div class="col-md-6">
          <a href="{{ route('products.index', ['cat' => 'rings']) }}" class="text-decoration-none">
            <div class="category-card">
              <img src="{{ asset('assets/images/cat-rings.jpg') }}" alt="Artisanal Handcrafted Rings" class="category-card-img"
                loading="lazy">
              <div class="category-card-overlay">
                <span class="badge bg-gold text-white align-self-start mb-2 px-3 py-1">Hand-Forged</span>
                <h3 class="font-serif text-white mb-2 fs-2">Artisanal Rings</h3>
                <p class="small text-light opacity-90 mb-3">Hand-hammered rings, sculpted bands, floral-inspired
                  designs, and timeless pieces, crafted by hand in gold, silver, brass, and copper.</p>
                <div class="d-inline-flex align-items-center text-white fw-semibold small">
                  Shop Rings <i class="bi bi-arrow-right ms-2 text-gold-accent"></i>
                </div>
              </div>
            </div>
          </a>
        </div>

        <!-- Bangles Category Tile -->
        <div class="col-md-6">
          <a href="{{ route('products.index', ['cat' => 'bangles']) }}" class="text-decoration-none">
            <div class="category-card">
              <img src="{{ asset('assets/images/cat-bangles.jpg') }}" alt="Hand-Sculpted Bangles & Cuffs" class="category-card-img"
                loading="lazy">
              <div class="category-card-overlay">
                <span class="badge bg-gold text-white align-self-start mb-2 px-3 py-1">Heritage Craft</span>
                <h3 class="font-serif text-white mb-2 fs-2">Hand Bangles & Cuffs</h3>
                <p class="small text-light opacity-90 mb-3">Handcrafted bangles and cuffs in noble metals, forged individually or stacked to create unique textures and patterns.
                </p>
                <div class="d-inline-flex align-items-center text-white fw-semibold small">
                  Shop Bangles <i class="bi bi-arrow-right ms-2 text-gold-accent"></i>
                </div>
              </div>
            </div>
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- Featured Products Strip -->
  <section class="py-5">
    <div class="container py-4">
      <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-4">
        <div>
          <span class="text-gold-accent letter-spacing-wide small fw-semibold">From the Artisan Bench</span>
          <h2 class="display-6 font-serif mt-1 mb-2">Featured Creations</h2>
          <p class="text-muted mb-0">Our most celebrated home-crafted rings and wrist bangles.</p>
        </div>
        <div class="mt-3 mt-md-0">
          <a href="{{ route('products.index') }}" class="btn btn-outline-gold">
            View All Collection <i class="bi bi-arrow-right ms-1"></i>
          </a>
        </div>
      </div>

      <!-- Container dynamically populated by main.js with real products -->
      <div class="row g-4" id="featuredProductsContainer">
        <!-- Rendered dynamically -->
      </div>
    </div>
  </section>

  <!-- Artisanal Craft Story Spotlight -->
  <section class="py-5 bg-warm-secondary border-top border-bottom border-warm">
    <div class="container py-4">
      <div class="row align-items-center g-5">
        <div class="col-lg-6">
          <div class="artisan-story-img-wrap">
            <img src="{{ asset('assets/images/artisan-story.jpg') }}" alt="Artisan shaping jewelry at home workbench"
              class="img-fluid w-100" loading="lazy">
            <div class="artisan-story-badge">
              <div class="fw-bold text-gold-accent small">Bespoke Workshop</div>
              <div class="x-small">Handmade in small batches with personal care</div>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <span class="text-gold-accent letter-spacing-wide small fw-semibold">The Home Studio Philosophy</span>
          <h2 class="display-6 font-serif mt-2 mb-4">Why Handcrafted Jewelry Has a Soul</h2>
          <p class="text-muted mb-3">
            At Himalayan Handicrafts, every piece begins with skilled hands and traditional metalworking techniques. Our
            rings and bangles are carefully hammered, shaped, and finished by hand using brass, copper, and white metal.
          </p>
          <p class="text-muted mb-4">
            We also use specialized tools where they help refine the craft—thinning and shaping the metal, combining
            two or three metals into a single strand, and polishing each piece to bring out its natural luster. The final
            shaping, detailing, and finishing are done with care, giving every ring and bangle its own character.
          </p>
          <div class="row g-3 mb-4">
            <div class="col-sm-6">
              <div class="p-3 bg-card border rounded border-warm">
                <i class="bi bi-fire text-gold-accent fs-4 mb-2 d-block"></i>
                <h6 class="fw-semibold mb-1">Cold-Forged Strength</h6>
                <p class="x-small text-muted mb-0">Work-hardened metal ensures durability without brittle solder seams.
                </p>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="p-3 bg-card border rounded border-warm">
                <i class="bi bi-feather text-gold-accent fs-4 mb-2 d-block"></i>
                <h6 class="fw-semibold mb-1">Comfort-Fit Contours</h6>
                <p class="x-small text-muted mb-0">Hand-beveled interior rims that glide effortlessly on skin.</p>
              </div>
            </div>
          </div>
          <a href="{{ route('contact.index') }}" class="btn btn-gold">
            Read Our Full Story <i class="bi bi-chevron-right ms-1"></i>
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- Collector Reviews & Testimonials -->
  <section class="py-5">
    <div class="container py-4">
      <div class="text-center mb-5">
        <span class="text-gold-accent letter-spacing-wide small fw-semibold">Voices of Admiration</span>
        <h2 class="display-6 font-serif mt-1">Beloved by Jewelry Lovers</h2>
        <p class="text-muted mx-auto" style="max-width: 520px;">Words from clients who cherish our handcrafted jewelry
          pieces every single day.</p>
      </div>

      <div class="row g-4">
        <div class="col-md-4">
          <div class="card h-100 p-4 border-warm shadow-subtle bg-card">
            <div class="text-warning mb-3">
              <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
            </div>
            <p class="font-accent fst-italic text-ink fs-5 mb-4">
              "The Aethel hammered gold ring feels like an antique heirloom. The organic hammer marks reflect
              candlelight so warmly. You immediately feel the artisan's care."
            </p>
            <div class="mt-auto d-flex align-items-center gap-3">
              <div
                class="rounded-circle bg-warm-light d-flex align-items-center justify-content-center fw-bold text-gold-accent"
                style="width:40px;height:40px;">
                AM
              </div>
              <div>
                <h6 class="mb-0 fw-semibold small">Ananya M.</h6>
                <span class="x-small text-muted">Mumbai · Verified Collector</span>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card h-100 p-4 border-warm shadow-subtle bg-card">
            <div class="text-warning mb-3">
              <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
            </div>
            <p class="font-accent fst-italic text-ink fs-5 mb-4">
              "I purchased the Sunburst gold cuff bangle for my sister's engagement. The weight is substantial, not
              flimsy like commercial store jewelry. The packaging was lovely!"
            </p>
            <div class="mt-auto d-flex align-items-center gap-3">
              <div
                class="rounded-circle bg-warm-light d-flex align-items-center justify-content-center fw-bold text-gold-accent"
                style="width:40px;height:40px;">
                PR
              </div>
              <div>
                <h6 class="mb-0 fw-semibold small">Pooja R.</h6>
                <span class="x-small text-muted">Bengaluru · Verified Collector</span>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card h-100 p-4 border-warm shadow-subtle bg-card">
            <div class="text-warning mb-3">
              <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
            </div>
            <p class="font-accent fst-italic text-ink fs-5 mb-4">
              "The Twisted Helix 925 silver ring is my everyday staple. The 925 stamp is crisp and it hasn't tarnished
              after months of continuous wear. 10/10 craftsmanship!"
            </p>
            <div class="mt-auto d-flex align-items-center gap-3">
              <div
                class="rounded-circle bg-warm-light d-flex align-items-center justify-content-center fw-bold text-gold-accent"
                style="width:40px;height:40px;">
                DK
              </div>
              <div>
                <h6 class="mb-0 fw-semibold small">Devika K.</h6>
                <span class="x-small text-muted">Jaipur · Verified Collector</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Newsletter / Collector Invitation -->
  <section class="py-5 bg-warm-secondary border-top border-warm">
    <div class="container py-4 text-center">
      <div class="mx-auto" style="max-width: 600px;">
        <span class="text-gold-accent letter-spacing-wide small fw-semibold">The Himalayan Society</span>
        <h2 class="font-serif display-6 mt-1 mb-3">Receive First Access to Small Batches</h2>
        <p class="text-muted mb-4">
          Because we handcraft in very limited quantities, each new batch of rings and bangles sells out quickly.
          Subscribe for private release previews and receive ₹200 off your first piece with coupon <strong>FIRSTBUY</strong>.
        </p>
        <form class="d-flex flex-column flex-sm-row gap-2 justify-content-center"
          onsubmit="event.preventDefault(); showToast('Subscribed!', 'Welcome to the Himalayan Society. Use coupon FIRSTBUY at checkout.', 'success'); this.reset();">
          <input type="email" class="form-control" placeholder="Enter your email address..." required
            style="max-width: 380px;">
          <button type="submit" class="btn btn-gold text-nowrap">
            Join the Society
          </button>
        </form>
        <div class="x-small text-muted mt-2">No spam. Only handcrafted releases and private invitations.</div>
      </div>
    </div>
  </section>
@endsection

@section('js')
  <script>
    document.addEventListener("DOMContentLoaded", () => {
      if (typeof renderFeaturedProducts === "function") {
        renderFeaturedProducts("featuredProductsContainer");
      }
    });
  </script>
@endsection