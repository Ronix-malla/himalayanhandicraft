@extends('layouts.front')

@section('content')
<!-- Page Header -->
  <header class="py-5 bg-warm-secondary border-bottom border-warm">
    <div class="container text-center">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb justify-content-center small mb-2">
          <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-muted text-decoration-none">Home</a></li>
          <li class="breadcrumb-item active text-gold-accent" aria-current="page">Studio & Contact</li>
        </ol>
      </nav>
      <h1 class="display-5 font-serif mb-2">Our Story, Studio & Care</h1>
      <p class="text-muted mx-auto mb-0" style="max-width: 600px;">
        Every piece tells of patience and devotion. Connect with our bench jeweler for custom sizing, bridal orders, or
        care inquiries.
      </p>
    </div>
  </header>

  <!-- Main Content Sections -->
  <main class="py-5">
    <div class="container">

      <!-- Studio Story Section -->
      <section class="row align-items-center g-5 mb-5 pb-5 border-bottom border-warm">
        <div class="col-lg-6">
          <span class="text-gold-accent letter-spacing-wide small fw-semibold">The Himalayan Heritage</span>
          <h2 class="display-6 font-serif mt-1 mb-3">Slow Craft in a Fast World</h2>
          <p class="text-muted mb-3">
            Himalayan was born from a deep love for tactile, heirloom metalcraft. Founded at a sunlit wooden bench in
            Jaipur, Rajasthan, our focus has always been singular: to create rings and bangles that feel like an
            extension of your own skin.
          </p>
          <p class="text-muted mb-4">
            We work strictly with recycled 18K gold vermeil, sterling 925 silver, and solid nickel-free jeweler's brass.
            By maintaining our workshop in a home studio, we avoid corporate overhead, passing direct artisanal quality
            and genuine personal care to our patrons.
          </p>
          <div class="p-3 bg-warm-secondary rounded border border-warm">
            <div class="font-accent fst-italic text-ink fs-5 mb-1">
              "We don't manufacture jewelry. We hammer devotion into noble metals."
            </div>
            <div class="x-small text-gold-accent fw-bold">— Gayatri Sen, Founder & Bench Jeweler</div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="artisan-story-img-wrap">
            <img src="{{ asset('assets/images/artisan-story.jpg') }}" alt="Artisan forging jewelry" class="img-fluid w-100 rounded">
          </div>
        </div>
      </section>

      <!-- Sizing Guide Section (Crucial for rings & bangles) -->
      <section class="mb-5 pb-5 border-bottom border-warm" id="sizing-guide">
        <div class="text-center mb-5">
          <span class="text-gold-accent letter-spacing-wide small fw-semibold">Guaranteed Perfect Fit</span>
          <h2 class="display-6 font-serif mt-1">Ring & Bangle Sizing Guide</h2>
          <p class="text-muted mx-auto" style="max-width: 520px;">Use our home measurement tips to find your exact size
            before ordering.</p>
        </div>

        <div class="row g-4">
          <!-- Ring Size Chart -->
          <div class="col-lg-6">
            <div class="card border-warm shadow-subtle p-4 bg-card h-100">
              <h5 class="font-serif mb-3 d-flex align-items-center gap-2">
                <i class="bi bi-circle text-gold-accent"></i> Ring Size Reference
              </h5>
              <p class="small text-muted mb-3">Wrap a strip of paper around your finger base, mark the overlap point,
                and measure with a millimeter ruler:</p>
              <div class="table-responsive">
                <table class="table table-sm table-striped small align-middle mb-3">
                  <thead>
                    <tr>
                      <th class="text-gold-accent">US Size</th>
                      <th class="text-gold-accent">Inside Diameter</th>
                      <th class="text-gold-accent">Circumference</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>US 5</td>
                      <td>15.7 mm</td>
                      <td>49.3 mm</td>
                    </tr>
                    <tr>
                      <td>US 6</td>
                      <td>16.5 mm</td>
                      <td>51.9 mm</td>
                    </tr>
                    <tr>
                      <td>US 7</td>
                      <td>17.3 mm</td>
                      <td>54.4 mm</td>
                    </tr>
                    <tr>
                      <td>US 8</td>
                      <td>18.1 mm</td>
                      <td>57.0 mm</td>
                    </tr>
                    <tr>
                      <td>US 9</td>
                      <td>18.9 mm</td>
                      <td>59.5 mm</td>
                    </tr>
                    <tr>
                      <td>US 10</td>
                      <td>19.8 mm</td>
                      <td>62.1 mm</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="x-small text-muted mt-auto">
                <i class="bi bi-check-circle text-success me-1"></i> Custom half-sizes (e.g. US 6.5) can be requested in
                your checkout delivery notes.
              </div>
            </div>
          </div>

          <!-- Bangle Size Chart -->
          <div class="col-lg-6">
            <div class="card border-warm shadow-subtle p-4 bg-card h-100">
              <h5 class="font-serif mb-3 d-flex align-items-center gap-2">
                <i class="bi bi-record-circle text-gold-accent"></i> Bangle & Kada Sizing (Indian Standard)
              </h5>
              <p class="small text-muted mb-3">Touch your thumb and pinky finger together as if sliding a bangle on, and
                measure the widest knuckle line:</p>
              <div class="table-responsive">
                <table class="table table-sm table-striped small align-middle mb-3">
                  <thead>
                    <tr>
                      <th class="text-gold-accent">Bangle Size</th>
                      <th class="text-gold-accent">Inner Diameter</th>
                      <th class="text-gold-accent">Fit Type</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>2.4 (Small)</td>
                      <td>57.2 mm (2.25 in)</td>
                      <td>Petite wrists / Slim hands</td>
                    </tr>
                    <tr>
                      <td>2.6 (Medium)</td>
                      <td>60.3 mm (2.37 in)</td>
                      <td>Standard universal women's fit</td>
                    </tr>
                    <tr>
                      <td>2.8 (Large)</td>
                      <td>63.5 mm (2.50 in)</td>
                      <td>Comfort fit / Broader knuckles</td>
                    </tr>
                    <tr>
                      <td>Open Cuffs</td>
                      <td>Adjustable</td>
                      <td>Easily bends gently to wrist size</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="x-small text-muted mt-auto">
                <i class="bi bi-info-circle text-gold-accent me-1"></i> If uncertain, size <strong>2.6 (Medium)</strong>
                fits 75% of patrons.
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Contact Info Cards & Interactive Form -->
      <section class="mb-5 pb-5 border-bottom border-warm" id="contact-section">
        <div class="row g-5">
          <!-- Studio Contact Info (Left) -->
          <div class="col-lg-5">
            <span class="text-gold-accent letter-spacing-wide small fw-semibold">Direct Communication</span>
            <h3 class="font-serif mt-1 mb-3">Get in Touch with Our Studio</h3>
            <p class="text-muted small mb-4">
              Have a question about a particular ring, want custom engraving, or need help sizing? We respond warmly to
              every message.
            </p>

            <div class="d-flex align-items-start gap-3 mb-4">
              <div class="trust-icon"><i class="bi bi-whatsapp"></i></div>
              <div>
                <h6 class="mb-1 text-ink fw-semibold">WhatsApp Chat (Fastest Response)</h6>
                <p class="small text-muted mb-1">+91 98765 43210</p>
                <a href="https://wa.me/919876543210?text=Hi%20Himalayan%20Atelier%2C%20I%20have%20an%20inquiry%20regarding%20jewelry"
                  target="_blank" class="btn btn-sm btn-outline-gold">
                  <i class="bi bi-chat-dots me-1"></i> Start WhatsApp Chat
                </a>
              </div>
            </div>

            <div class="d-flex align-items-start gap-3 mb-4">
              <div class="trust-icon"><i class="bi bi-envelope"></i></div>
              <div>
                <h6 class="mb-1 text-ink fw-semibold">Studio Email</h6>
                <p class="small text-muted mb-0">atelier@Himalayanjewels.com</p>
                <span class="x-small text-muted">Replies within 12-24 hours</span>
              </div>
            </div>

            <div class="d-flex align-items-start gap-3 mb-4">
              <div class="trust-icon"><i class="bi bi-geo-alt"></i></div>
              <div>
                <h6 class="mb-1 text-ink fw-semibold">Jaipur Home Atelier</h6>
                <p class="small text-muted mb-0">14 Artisans Lane, Civil Lines, Jaipur, Rajasthan 302006</p>
                <span class="x-small text-muted">Visits by appointment only for bridal viewings</span>
              </div>
            </div>

            <div class="d-flex align-items-start gap-3">
              <div class="trust-icon"><i class="bi bi-clock"></i></div>
              <div>
                <h6 class="mb-1 text-ink fw-semibold">Working Hours</h6>
                <p class="small text-muted mb-0">Monday to Saturday: 10:00 AM – 7:00 PM IST</p>
                <span class="x-small text-muted">Sunday: Closed for bench metal tempering</span>
              </div>
            </div>
          </div>

          <!-- Contact & Bespoke Request Form (Right) -->
          <div class="col-lg-7">
            <div class="card border-warm shadow-card p-4 p-md-5 bg-card">
              <h4 class="font-serif mb-1">Send a Studio Message</h4>
              <p class="text-muted small mb-4">Fill out the inquiry form and our bench jeweler will get back to you.</p>

              <form id="contactForm" action="{{ route('contact.store') }}" method="POST" class="needs-validation" novalidate onsubmit="handleContactSubmit(event)">
                @csrf
                <div class="row g-3">
                  <div class="col-md-6">
                    <label for="contactName" class="form-label">Your Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="contactName" name="name" placeholder="e.g. Radhika Kapoor" required>
                    <div class="invalid-feedback">Please enter your name.</div>
                  </div>

                  <div class="col-md-6">
                    <label for="contactEmail" class="form-label">Email Address <span
                        class="text-danger">*</span></label>
                    <input type="email" class="form-control" id="contactEmail" name="email" placeholder="radhika@example.com"
                      required>
                    <div class="invalid-feedback">Please enter a valid email.</div>
                  </div>

                  <div class="col-md-6">
                    <label for="contactPhone" class="form-label">Phone / WhatsApp</label>
                    <input type="tel" class="form-control" id="contactPhone" name="phone" placeholder="9876543210">
                  </div>

                  <div class="col-md-6">
                    <label for="contactSubject" class="form-label">Inquiry Purpose <span
                        class="text-danger">*</span></label>
                    <select class="form-select" id="contactSubject" name="subject" required>
                      <option value="">Select Topic</option>
                      <option value="Custom Sizing">Custom Ring / Bangle Sizing</option>
                      <option value="Bridal Stacks">Bridal Bangles & Sets</option>
                      <option value="Order Tracking">Existing Order Status</option>
                      <option value="Metal Care">Jewelry Cleaning & Care</option>
                      <option value="General">General Inquiry</option>
                    </select>
                    <div class="invalid-feedback">Please select a topic.</div>
                  </div>

                  <div class="col-12">
                    <label for="contactMessage" class="form-label">Your Message <span
                        class="text-danger">*</span></label>
                    <textarea class="form-control" id="contactMessage" name="message" rows="4"
                      placeholder="Tell us about the piece you are considering or any customization..."
                      required></textarea>
                    <div class="invalid-feedback">Please write your message.</div>
                  </div>

                  <div class="col-12 mt-3">
                    <button type="submit" class="btn btn-gold px-4 py-2 fw-semibold">
                      <i class="bi bi-send me-1"></i> Send Inquiry
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </section>

      <!-- Studio FAQ Accordion -->
      <section id="faq-section">
        <div class="text-center mb-5">
          <span class="text-gold-accent letter-spacing-wide small fw-semibold">Frequently Asked Questions</span>
          <h2 class="display-6 font-serif mt-1">Everything You Need to Know</h2>
          <p class="text-muted mx-auto" style="max-width: 520px;">Clear answers about our metals, craftsmanship, and
            delivery.</p>
        </div>

        <div class="accordion accordion-flush mx-auto" id="accordionFaq" style="max-width: 780px;">
          <div class="accordion-item border-warm bg-card mb-3 rounded border">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed font-serif" type="button" data-bs-toggle="collapse"
                data-bs-target="#faq1">
                Are your handcrafted pieces hypoallergenic and skin-safe?
              </button>
            </h2>
            <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#accordionFaq">
              <div class="accordion-body small text-muted">
                Yes, absolutely. We use 100% nickel-free and lead-free alloys. Our 925 sterling silver is 92.5% pure
                elemental silver with copper, and our 18K gold vermeil consists of thick layers of real gold over
                silver. They are thoroughly safe for everyday, sensitive skin wear.
              </div>
            </div>
          </div>

          <div class="accordion-item border-warm bg-card mb-3 rounded border">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed font-serif" type="button" data-bs-toggle="collapse"
                data-bs-target="#faq2">
                How should I care for and clean my hammered jewelry?
              </button>
            </h2>
            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#accordionFaq">
              <div class="accordion-body small text-muted">
                Every order arrives with a complimentary jewelry polishing cloth. For raw brass and silver, a gentle
                wipe with warm soapy water and the cloth keeps them gleaming. Avoid wearing your jewelry in chlorinated
                swimming pools or spraying heavy perfume directly on the metal.
              </div>
            </div>
          </div>

          <div class="accordion-item border-warm bg-card mb-3 rounded border">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed font-serif" type="button" data-bs-toggle="collapse"
                data-bs-target="#faq3">
                How does Cash on Delivery (COD) work on your website?
              </button>
            </h2>
            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#accordionFaq">
              <div class="accordion-body small text-muted">
                As detailed in our product requirements, this site demonstrates a simulated front-end ordering process!
                When you select Cash on Delivery, your order confirmation is generated instantly with an order ID, and
                no advance payment or real credit card is required.
              </div>
            </div>
          </div>

          <div class="accordion-item border-warm bg-card mb-3 rounded border">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed font-serif" type="button" data-bs-toggle="collapse"
                data-bs-target="#faq4">
                Can I request a custom size or customized bangle set?
              </button>
            </h2>
            <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#accordionFaq">
              <div class="accordion-body small text-muted">
                Yes! Because every single ring and bangle is hand-forged in our home studio, our jeweler can adapt the
                ring mandrel or bangle sizing block to your exact circumference. Simply mention your requirements in the
                delivery notes during checkout or WhatsApp us directly.
              </div>
            </div>
          </div>
        </div>
      </section>

    </div>
  </main>
@endsection

@section('js')
  <script>
    function handleContactSubmit(event) {
      const form = document.getElementById("contactForm");
      if (!form.checkValidity()) {
        event.preventDefault();
        event.stopPropagation();
        form.classList.add("was-validated");
        return;
      }
      // Form will submit naturally to {{ route('contact.store') }} with CSRF
    }
  </script>
@endsection