<?php

use Livewire\Component;

new class extends Component
{
    //
};
?>

<div>
    
<!-- PAGE HERO -->
<section class="page-hero" aria-labelledby="page-heading">
  <div class="page-hero-content">
    <nav class="breadcrumb" aria-label="Breadcrumb">
      <a href="index.html">Home</a>
      <span class="breadcrumb-sep" aria-hidden="true">/</span>
      <span>Services</span>
    </nav>
    <h1 id="page-heading">Our Dental Services</h1>
    <p>Comprehensive, transparent dental care with upfront pricing. From your first checkup to cosmetic transformations — we have you covered.</p>
  </div>
</section>

<!-- SERVICES DETAIL -->
<section class="section" aria-labelledby="services-detail-heading">
  <div class="container">
    <div class="section-header center">
      <div class="section-tag reveal">Full Range of Care</div>
      <h2 class="section-title reveal" id="services-detail-heading">What We Offer</h2>
      <p class="section-subtitle reveal">Every service is delivered by board-certified specialists using the latest technology and evidence-based techniques.</p>
    </div>
    <div class="services-detail-grid">

      <div class="service-detail-card reveal">
        <div class="service-icon" aria-hidden="true" style="background:#EFF6FF;">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--primary)" stroke-width="2"><path d="M12 2C8 2 5 5 5 8c0 4 3 6 3 10a2 2 0 0 0 4 0c0-1-.5-2-.5-4s.5-2 .5-2 .5 1 .5 2-.5 3-.5 4a2 2 0 0 0 4 0c0-4 3-6 3-10 0-3-3-6-7-6z"/></svg>
        </div>
        <h3>Dental Checkup</h3>
        <p>A thorough oral health evaluation covering teeth, gums, bite, and oral tissues. Includes digital X-rays for precise assessment and early detection of cavities, gum disease, or other conditions.</p>
        <div class="service-detail-price">2,000 DZD <small>per visit</small></div>
        <ul class="service-features">
          <li>Full oral examination</li>
          <li>Digital X-rays included</li>
          <li>Gum health assessment</li>
          <li>Oral cancer screening</li>
          <li>Personalized care recommendations</li>
        </ul>
        <a href="contact.html" class="btn-book">Book Now <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a>
      </div>

      <div class="service-detail-card reveal reveal-delay-1">
        <div class="service-icon" aria-hidden="true" style="background:#ECFEFF;">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--accent)" stroke-width="2"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14 2 14 8 20 8"/><path d="M8 13h8M8 17h5"/></svg>
        </div>
        <h3>Teeth Cleaning</h3>
        <p>Professional scaling and polishing that removes hardened tartar, plaque buildup, and surface stains that regular brushing cannot eliminate. Leaves teeth feeling fresh and looking brighter.</p>
        <div class="service-detail-price">3,500 DZD <small>per session</small></div>
        <ul class="service-features">
          <li>Ultrasonic scaling</li>
          <li>Manual debridement</li>
          <li>Polishing &amp; flossing</li>
          <li>Fluoride treatment</li>
          <li>Oral hygiene guidance</li>
        </ul>
        <a href="contact.html" class="btn-book">Book Now <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a>
      </div>

      <div class="service-detail-card reveal">
        <div class="service-icon" aria-hidden="true" style="background:#FFF7ED;">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#F97316" stroke-width="2"><circle cx="12" cy="12" r="5"/><path d="M12 1v2M12 21v2M4.22 4.22l1.42 1.42M18.36 18.36l1.42 1.42M1 12h2M21 12h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42"/></svg>
        </div>
        <h3>Teeth Whitening</h3>
        <p>In-office professional whitening using pharmaceutical-grade bleaching agents for dramatically whiter teeth — up to 8 shades in a single visit. Safe, fast, and long-lasting results.</p>
        <div class="service-detail-price">12,000 DZD <small>per session</small></div>
        <ul class="service-features">
          <li>Up to 8 shades whiter</li>
          <li>In-office 60-minute treatment</li>
          <li>Desensitizing gel included</li>
          <li>Custom whitening trays provided</li>
          <li>Results last 12–18 months</li>
        </ul>
        <a href="contact.html" class="btn-book">Book Now <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a>
      </div>

      <div class="service-detail-card reveal reveal-delay-1">
        <div class="service-icon" aria-hidden="true" style="background:#F0FDF4;">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#16A34A" stroke-width="2"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
        </div>
        <h3>Orthodontics Consultation</h3>
        <p>A comprehensive evaluation of your bite, jaw alignment, and tooth position. Dr. Meziani will recommend the most suitable orthodontic treatment — traditional braces or modern clear aligners.</p>
        <div class="service-detail-price">5,000 DZD <small>consultation fee</small></div>
        <ul class="service-features">
          <li>Digital bite analysis</li>
          <li>3D treatment planning</li>
          <li>Braces vs. aligner recommendation</li>
          <li>Treatment timeline estimate</li>
          <li>Full cost breakdown provided</li>
        </ul>
        <a href="contact.html" class="btn-book">Book Now <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a>
      </div>

      <div class="service-detail-card reveal">
        <div class="service-icon" aria-hidden="true" style="background:#EFF6FF;">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--primary)" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
        </div>
        <h3>Dental Implants</h3>
        <p>The gold standard for permanent tooth replacement. Titanium implants fuse with your jawbone to provide a stable foundation for a natural-looking crown that functions and feels like a real tooth.</p>
        <div class="service-detail-price">From 50,000 DZD <small>per implant</small></div>
        <ul class="service-features">
          <li>Titanium implant placement</li>
          <li>Custom porcelain crown</li>
          <li>3D pre-surgical planning</li>
          <li>Local anesthesia included</li>
          <li>Lifetime structural warranty</li>
        </ul>
        <a href="contact.html" class="btn-book">Book Consultation <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a>
      </div>

      <div class="service-detail-card reveal reveal-delay-1">
        <div class="service-icon" aria-hidden="true" style="background:#FFF0F3;">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#E11D48" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/></svg>
        </div>
        <h3>Pediatric Dentistry</h3>
        <p>Child-specialized dental care in a warm, friendly environment designed to eliminate fear. Dr. Hadj uses gentle techniques and child-appropriate communication to make every visit a positive experience.</p>
        <div class="service-detail-price">3,000 DZD <small>per visit</small></div>
        <ul class="service-features">
          <li>Gentle child-friendly examination</li>
          <li>Preventive fluoride treatments</li>
          <li>Sealants for cavity prevention</li>
          <li>Parent oral hygiene guidance</li>
          <li>Ages 1 and up welcome</li>
        </ul>
        <a href="contact.html" class="btn-book">Book Now <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a>
      </div>

    </div>
  </div>
</section>

<!-- PROCESS TIMELINE -->
<section class="section" style="background:#F8FAFC;" aria-labelledby="process-heading">
  <div class="container">
    <div class="section-header center">
      <div class="section-tag reveal">How It Works</div>
      <h2 class="section-title reveal" id="process-heading">Your Patient Journey</h2>
      <p class="section-subtitle reveal">A seamless experience from booking to follow-up care.</p>
    </div>
    <div style="display:grid; grid-template-columns: repeat(4,1fr); gap:24px; margin-top:8px;" class="reveal">
      <div style="text-align:center; padding:24px;">
        <div style="width:56px;height:56px;background:var(--primary);border-radius:50%;display:flex;align-items:center;justify-content:center;color:#fff;font-size:1.2rem;font-weight:800;margin:0 auto 16px;" aria-hidden="true">1</div>
        <h4 style="font-size:0.95rem;font-weight:700;color:#1e293b;margin-bottom:8px;">Book</h4>
        <p style="font-size:0.82rem;color:var(--text-light);line-height:1.6;">Call, visit, or book online. We confirm within 30 minutes.</p>
      </div>
      <div style="text-align:center; padding:24px;">
        <div style="width:56px;height:56px;background:var(--primary);border-radius:50%;display:flex;align-items:center;justify-content:center;color:#fff;font-size:1.2rem;font-weight:800;margin:0 auto 16px;" aria-hidden="true">2</div>
        <h4 style="font-size:0.95rem;font-weight:700;color:#1e293b;margin-bottom:8px;">Consult</h4>
        <p style="font-size:0.82rem;color:var(--text-light);line-height:1.6;">Meet your specialist, get examined, and receive a custom plan.</p>
      </div>
      <div style="text-align:center; padding:24px;">
        <div style="width:56px;height:56px;background:var(--primary);border-radius:50%;display:flex;align-items:center;justify-content:center;color:#fff;font-size:1.2rem;font-weight:800;margin:0 auto 16px;" aria-hidden="true">3</div>
        <h4 style="font-size:0.95rem;font-weight:700;color:#1e293b;margin-bottom:8px;">Treatment</h4>
        <p style="font-size:0.82rem;color:var(--text-light);line-height:1.6;">Receive world-class care in our modern, safe environment.</p>
      </div>
      <div style="text-align:center; padding:24px;">
        <div style="width:56px;height:56px;background:var(--primary);border-radius:50%;display:flex;align-items:center;justify-content:center;color:#fff;font-size:1.2rem;font-weight:800;margin:0 auto 16px;" aria-hidden="true">4</div>
        <h4 style="font-size:0.95rem;font-weight:700;color:#1e293b;margin-bottom:8px;">Follow Up</h4>
        <p style="font-size:0.82rem;color:var(--text-light);line-height:1.6;">We monitor your progress and are here whenever you need us.</p>
      </div>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="cta-section" aria-labelledby="cta-heading">
  <div class="reveal">
    <h2 id="cta-heading">Not Sure Which Service You Need?</h2>
    <p>Start with a consultation. Our specialists will assess your oral health and recommend the best treatment plan for your specific needs and budget.</p>
    <div class="cta-buttons">
      <a href="contact.html" class="btn-white"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg> Book a Consultation</a>
      <a href="doctors.html" class="btn-outline-white">Meet Our Doctors</a>
    </div>
  </div>
</section>

</div>