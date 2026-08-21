<?php

use Livewire\Component;

new class extends Component
{
    //
};
?>

<div>
    <!-- HERO -->
<section class="hero" aria-labelledby="hero-heading">
  <div class="hero-bg" aria-hidden="true"></div>
  <div class="hero-overlay" aria-hidden="true"></div>
  <div class="hero-content">
    <div class="hero-left">
      <div class="hero-badge">
        <span class="hero-badge-dot" aria-hidden="true"></span>
        Now Accepting New Patients
      </div>
      <h1 id="hero-heading">Healthy Smiles<br /><span>Start Here</span></h1>
      <p>Advanced dental care for adults and children in a comfortable, modern environment. Experience dentistry that puts you first.</p>
      <div class="hero-buttons">
        <a href="contact.html" class="btn-primary">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
          Book Consultation
        </a>
        <a href="services.html" class="btn-secondary">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><circle cx="12" cy="12" r="10"/><path d="M12 8v4l3 3"/></svg>
          Our Services
        </a>
      </div>
    </div>
    <div class="hero-right">
      <div class="hero-right-card">
        <h3>Our Results at a Glance</h3>
        <div class="hero-stat-grid">
          <div class="hero-stat"><div class="num">15+</div><div class="label">Years of Excellence</div></div>
          <div class="hero-stat"><div class="num">5,000+</div><div class="label">Happy Patients</div></div>
          <div class="hero-stat"><div class="num">4.9★</div><div class="label">Average Rating</div></div>
          <div class="hero-stat"><div class="num">6</div><div class="label">Specializations</div></div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- STATS BAR -->
<section class="stats-bar" aria-label="Key statistics">
  <div class="stats-grid">
    <div class="stat-item reveal"><div class="stat-num" data-count="15" data-suffix="+">0</div><div class="stat-label">Years Experience</div></div>
    <div class="stat-item reveal reveal-delay-1"><div class="stat-num" data-count="5000" data-suffix="+">0</div><div class="stat-label">Patients Treated</div></div>
    <div class="stat-item reveal reveal-delay-2"><div class="stat-num" data-count="4.9" data-suffix="/5" data-decimals="1">0</div><div class="stat-label">Patient Rating</div></div>
    <div class="stat-item reveal reveal-delay-3"><div class="stat-num" data-count="6">0</div><div class="stat-label">Specialized Services</div></div>
  </div>
</section>

<!-- SERVICES OVERVIEW -->
<section class="section" style="background: #F8FAFC;" aria-labelledby="services-heading">
  <div class="container">
    <div class="section-header center">
      <div class="section-tag reveal">Our Services</div>
      <h2 class="section-title reveal" id="services-heading">Comprehensive Dental Care</h2>
      <p class="section-subtitle reveal">From routine checkups to advanced cosmetic procedures, we offer a full range of dental services designed for every need and budget.</p>
    </div>
    <div class="services-grid">
      <div class="service-card reveal">
        <div class="service-icon" aria-hidden="true">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2C8 2 5 5 5 8c0 4 3 6 3 10a2 2 0 0 0 4 0c0-1-.5-2-.5-4s.5-2 .5-2 .5 1 .5 2-.5 3-.5 4a2 2 0 0 0 4 0c0-4 3-6 3-10 0-3-3-6-7-6z"/></svg>
        </div>
        <h3>Dental Checkup</h3>
        <p>Comprehensive oral examination including X-rays, gum assessment, and early detection of potential issues.</p>
        <div class="service-price">
          <span>2,000 DZD</span>
          <a href="services.html" class="service-price-link">Learn more <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a>
        </div>
      </div>
      <div class="service-card reveal reveal-delay-1">
        <div class="service-icon" aria-hidden="true">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14 2 14 8 20 8"/><path d="M8 13h8M8 17h5"/></svg>
        </div>
        <h3>Teeth Cleaning</h3>
        <p>Professional scaling and polishing to remove tartar, plaque, and stains for optimal oral hygiene.</p>
        <div class="service-price">
          <span>3,500 DZD</span>
          <a href="services.html" class="service-price-link">Learn more <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a>
        </div>
      </div>
      <div class="service-card reveal reveal-delay-2">
        <div class="service-icon" aria-hidden="true">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="5"/><path d="M12 1v2M12 21v2M4.22 4.22l1.42 1.42M18.36 18.36l1.42 1.42M1 12h2M21 12h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42"/></svg>
        </div>
        <h3>Teeth Whitening</h3>
        <p>Professional-grade whitening treatments that deliver dramatically brighter results safely and effectively.</p>
        <div class="service-price">
          <span>12,000 DZD</span>
          <a href="services.html" class="service-price-link">Learn more <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a>
        </div>
      </div>
      <div class="service-card reveal">
        <div class="service-icon" aria-hidden="true">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
        </div>
        <h3>Orthodontics Consultation</h3>
        <p>Expert evaluation for braces and aligners to correct misalignment and achieve your ideal smile.</p>
        <div class="service-price">
          <span>5,000 DZD</span>
          <a href="services.html" class="service-price-link">Learn more <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a>
        </div>
      </div>
      <div class="service-card reveal reveal-delay-1">
        <div class="service-icon" aria-hidden="true">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
        </div>
        <h3>Dental Implants</h3>
        <p>Permanent, natural-looking tooth replacements using titanium implants for lasting function and aesthetics.</p>
        <div class="service-price">
          <span>From 50,000 DZD</span>
          <a href="services.html" class="service-price-link">Learn more <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a>
        </div>
      </div>
      <div class="service-card reveal reveal-delay-2">
        <div class="service-icon" aria-hidden="true">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/></svg>
        </div>
        <h3>Pediatric Dentistry</h3>
        <p>Gentle, child-friendly dental care designed to build healthy habits and reduce dental anxiety from an early age.</p>
        <div class="service-price">
          <span>3,000 DZD</span>
          <a href="services.html" class="service-price-link">Learn more <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- WHY CHOOSE US -->
<section class="section" aria-labelledby="why-heading">
  <div class="container">
    <div class="why-grid">
      <div class="why-img reveal-left">
        <img src="https://images.pexels.com/photos/6812509/pexels-photo-6812509.jpeg?auto=compress&cs=tinysrgb&w=900" alt="Modern dental treatment room at Nova Dental Clinic" loading="lazy" />
        <div class="why-img-badge">
          <svg class="icon" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
          <div><strong>ISO Certified</strong><span>Sterilization Standards</span></div>
        </div>
      </div>
      <div class="reveal-right">
        <div class="section-tag">Why Choose Us</div>
        <h2 class="section-title" id="why-heading">Care You Can<br />Always Trust</h2>
        <p class="section-subtitle" style="margin-bottom: 36px;">We combine years of experience with the latest technology and a patient-first approach to deliver outstanding dental outcomes.</p>
        <div class="why-features">
          <div class="why-feature">
            <div class="why-feature-icon" aria-hidden="true"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg></div>
            <div><h4>Experienced Specialists</h4><p>Our team of 4 certified dentists brings 15+ years of combined expertise across all dental disciplines.</p></div>
          </div>
          <div class="why-feature">
            <div class="why-feature-icon" aria-hidden="true"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2"/><path d="M8 21h8M12 17v4"/></svg></div>
            <div><h4>Modern Equipment</h4><p>Digital X-rays, laser dentistry, and 3D imaging technology for precise, comfortable treatments.</p></div>
          </div>
          <div class="why-feature">
            <div class="why-feature-icon" aria-hidden="true"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></div>
            <div><h4>Sterilized Environment</h4><p>Hospital-grade sterilization protocols ensure a completely safe and hygienic environment at all times.</p></div>
          </div>
          <div class="why-feature">
            <div class="why-feature-icon" aria-hidden="true"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg></div>
            <div><h4>Transparent Pricing</h4><p>Clear, upfront pricing with no hidden fees. Treatment plans are discussed and agreed upon before any procedure.</p></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- BEFORE / AFTER -->
<section class="section" style="background: #F8FAFC;" aria-labelledby="cases-heading">
  <div class="container">
    <div class="section-header center">
      <div class="section-tag reveal">Real Results</div>
      <h2 class="section-title reveal" id="cases-heading">Before &amp; After</h2>
      <p class="section-subtitle reveal">See the transformative difference our treatments make for our patients.</p>
    </div>
    <div class="before-after-grid">
      <div class="ba-card reveal">
        <div class="ba-images">
          <div class="ba-img"><img src="{{ asset('images/Capture.JPG') }}" alt="Before teeth whitening" loading="lazy"  /></div>
          <div class="ba-img"><img src="{{ asset('images/Capture2.JPG') }}" alt="After teeth whitening" loading="lazy" /></div>
          <span class="ba-label before">Before</span><span class="ba-label after">After</span>
        </div>
        <div class="ba-info"><h4>Teeth Whitening</h4><p>6 shades brighter in a single session</p></div>
      </div>
      <div class="ba-card reveal reveal-delay-1">
        <div class="ba-images">
          <div class="ba-img"><img src="{{ asset('images/Capture3.JPG') }}" alt="Before dental care" loading="lazy" /></div>
          <div class="ba-img"><img src="{{ asset('images/Capture4.JPG') }}" alt="After dental care" loading="lazy" /></div>
          <span class="ba-label before">Before</span><span class="ba-label after">After</span>
        </div>
        <div class="ba-info"><h4>Dental Implant</h4><p>Natural-looking permanent replacement</p></div>
      </div>
      <div class="ba-card reveal reveal-delay-2">
        <div class="ba-images">
          <div class="ba-img"><img src="https://images.pexels.com/photos/3779709/pexels-photo-3779709.jpeg?auto=compress&cs=tinysrgb&w=400" alt="Before orthodontics" loading="lazy" style="filter:brightness(0.82) saturate(0.5);" /></div>
          <div class="ba-img"><img src="https://images.pexels.com/photos/3779709/pexels-photo-3779709.jpeg?auto=compress&cs=tinysrgb&w=400" alt="After orthodontics" loading="lazy" /></div>
          <span class="ba-label before">Before</span><span class="ba-label after">After</span>
        </div>
        <div class="ba-info"><h4>Orthodontics</h4><p>Perfectly aligned smile achieved in 18 months</p></div>
      </div>
    </div>
  </div>
</section>

<!-- TEAM -->
<section class="section" aria-labelledby="team-heading">
  <div class="container">
    <div class="section-header center">
      <div class="section-tag reveal">Our Team</div>
      <h2 class="section-title reveal" id="team-heading">Meet Our Specialists</h2>
      <p class="section-subtitle reveal">A dedicated team of board-certified dentists committed to your smile and well-being.</p>
    </div>
    <div class="doctors-grid">
      <div class="doctor-card reveal">
        <div class="doctor-img">
          <img src="https://images.pexels.com/photos/5215024/pexels-photo-5215024.jpeg?auto=compress&cs=tinysrgb&w=500" alt="Dr. Ahmed Benali" loading="lazy" />
          <div class="doctor-overlay"><a href="/doctors">View More</a></div>
        </div>
        <div class="doctor-info">
          <span class="doctor-specialty">Implant Specialist</span>
          <h3>Dr. Ahmed Benali</h3>
          <p>Lead Dentist &amp; Clinic Director</p>
          <div class="doctor-years"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="12" cy="12" r="10"/><path d="M12 8v4l3 3"/></svg> 15+ Years Experience</div>
        </div>
      </div>
      <div class="doctor-card reveal reveal-delay-1">
        <div class="doctor-img">
          <img src="https://images.pexels.com/photos/5215002/pexels-photo-5215002.jpeg?auto=compress&cs=tinysrgb&w=500" alt="Dr. Sarah Meziani" loading="lazy" />
          <div class="doctor-overlay"><a href="/doctors">View More</a></div>
        </div>
        <div class="doctor-info">
          <span class="doctor-specialty">Orthodontics</span>
          <h3>Dr. Sarah Meziani</h3>
          <p>Orthodontics Specialist</p>
          <div class="doctor-years"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="12" cy="12" r="10"/><path d="M12 8v4l3 3"/></svg> 10 Years Experience</div>
        </div>
      </div>
      <div class="doctor-card reveal reveal-delay-2">
        <div class="doctor-img">
          <img src="https://images.pexels.com/photos/6749773/pexels-photo-6749773.jpeg?auto=compress&cs=tinysrgb&w=500" alt="Dr. Karim Hadj" loading="lazy" />
          <div class="doctor-overlay"><a href="/doctors">View More</a></div>
        </div>
        <div class="doctor-info">
          <span class="doctor-specialty">Pediatric Dentistry</span>
          <h3>Dr. Karim Hadj</h3>
          <p>Pediatric Dentist</p>
          <div class="doctor-years"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="12" cy="12" r="10"/><path d="M12 8v4l3 3"/></svg> 8 Years Experience</div>
        </div>
      </div>
      <div class="doctor-card reveal reveal-delay-3">
        <div class="doctor-img">
          <img src="https://images.pexels.com/photos/5452293/pexels-photo-5452293.jpeg?auto=compress&cs=tinysrgb&w=500" alt="Dr. Lina Cherif" loading="lazy" />
          <div class="doctor-overlay"><a href="/doctors">View More</a></div>
        </div>
        <div class="doctor-info">
          <span class="doctor-specialty">Cosmetic Dentistry</span>
          <h3>Dr. Lina Cherif</h3>
          <p>Cosmetic Dentist</p>
          <div class="doctor-years"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="12" cy="12" r="10"/><path d="M12 8v4l3 3"/></svg> 12 Years Experience</div>
        </div>
      </div>
    </div>
    <div style="text-align:center; margin-top:40px;">
      <a href="doctors.html" class="btn-book">Meet All Specialists <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a>
    </div>
  </div>
</section>

<!-- TESTIMONIALS -->
<section class="section testimonials-bg" aria-labelledby="testimonials-heading">
  <div class="container">
    <div class="section-header center" style="margin-bottom:48px;">
      <div class="section-tag reveal" style="color:#67e8f9;">Testimonials</div>
      <h2 class="section-title reveal" style="color:#fff;" id="testimonials-heading">What Our Patients Say</h2>
      <p class="section-subtitle reveal" style="color:rgba(255,255,255,0.75);">Don't take our word for it — hear from the patients whose smiles we've transformed.</p>
    </div>
    <div class="testimonials-grid">
      <div class="testimonial-card reveal">
        <div class="testimonial-stars" aria-label="5 out of 5 stars"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
        <p class="testimonial-text">"I was terrified of dentists, but the team at Nova made me feel completely at ease. My teeth whitening results are incredible — I can't stop smiling!"</p>
        <div class="testimonial-author">
          <div class="testimonial-avatar" aria-hidden="true">FM</div>
          <div><div class="testimonial-name">Fatima M.</div><div class="testimonial-service">Teeth Whitening</div></div>
        </div>
      </div>
      <div class="testimonial-card reveal reveal-delay-1">
        <div class="testimonial-stars" aria-label="5 out of 5 stars"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
        <p class="testimonial-text">"Dr. Benali performed my implant surgery with amazing precision. 6 months later and it looks and feels exactly like my natural tooth. Worth every dinar."</p>
        <div class="testimonial-author">
          <div class="testimonial-avatar" aria-hidden="true">YB</div>
          <div><div class="testimonial-name">Youcef B.</div><div class="testimonial-service">Dental Implants</div></div>
        </div>
      </div>
      <div class="testimonial-card reveal reveal-delay-2">
        <div class="testimonial-stars" aria-label="5 out of 5 stars"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
        <p class="testimonial-text">"Took my daughter here and Dr. Karim was so gentle and patient with her. She actually looks forward to her dental visits now. Outstanding pediatric care!"</p>
        <div class="testimonial-author">
          <div class="testimonial-avatar" aria-hidden="true">NR</div>
          <div><div class="testimonial-name">Nadia R.</div><div class="testimonial-service">Pediatric Dentistry</div></div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- PATIENT JOURNEY -->
<section class="section" style="background:#F8FAFC;" aria-labelledby="journey-heading">
  <div class="container">
    <div class="section-header center">
      <div class="section-tag reveal">The Process</div>
      <h2 class="section-title reveal" id="journey-heading">Your Journey to a Better Smile</h2>
      <p class="section-subtitle reveal">Four simple steps from your first contact to a confident, healthy smile.</p>
    </div>
    <div class="timeline">
      <div class="timeline-item">
        <div class="timeline-content timeline-content-left reveal-left"><h4>Book Online or Call</h4><p>Choose a convenient time from our available slots. We'll confirm your appointment within 30 minutes.</p></div>
        <div class="timeline-dot" aria-hidden="true">1</div>
        <div style="flex:1;" aria-hidden="true"></div>
      </div>
      <div class="timeline-item">
        <div style="flex:1;" aria-hidden="true"></div>
        <div class="timeline-dot" aria-hidden="true">2</div>
        <div class="timeline-content reveal-right"><h4>Initial Consultation</h4><p>Meet your specialist for a full examination and digital X-rays. We'll create a custom treatment plan aligned with your goals.</p></div>
      </div>
      <div class="timeline-item">
        <div class="timeline-content timeline-content-left reveal-left"><h4>Treatment</h4><p>Receive your treatment in our modern, fully sterilized environment with the latest dental technology.</p></div>
        <div class="timeline-dot" aria-hidden="true">3</div>
        <div style="flex:1;" aria-hidden="true"></div>
      </div>
      <div class="timeline-item">
        <div style="flex:1;" aria-hidden="true"></div>
        <div class="timeline-dot" aria-hidden="true">4</div>
        <div class="timeline-content reveal-right"><h4>Follow-Up Care</h4><p>We schedule a follow-up to ensure optimal healing and answer any questions. Your smile is our commitment.</p></div>
      </div>
    </div>
  </div>
</section>

<!-- FAQ -->
<section class="section" aria-labelledby="faq-heading">
  <div class="container">
    <div class="section-header center">
      <div class="section-tag reveal">FAQ</div>
      <h2 class="section-title reveal" id="faq-heading">Frequently Asked Questions</h2>
      <p class="section-subtitle reveal">Have a question? We've got answers to the most common queries from our patients.</p>
    </div>
    <div class="faq-list reveal" role="list">
      <div class="faq-item" role="listitem">
        <button class="faq-question" aria-expanded="false">Is teeth whitening painful? <span class="faq-icon" aria-hidden="true"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M12 5v14M5 12h14"/></svg></span></button>
        <div class="faq-answer"><div class="faq-answer-inner">Professional teeth whitening at Nova Dental is designed to be comfortable. Some patients experience mild sensitivity during or after treatment, which typically subsides within 24-48 hours. We use professional-grade gels with desensitizing agents to minimize any discomfort.</div></div>
      </div>
      <div class="faq-item" role="listitem">
        <button class="faq-question" aria-expanded="false">How long does a dental implant procedure take? <span class="faq-icon" aria-hidden="true"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M12 5v14M5 12h14"/></svg></span></button>
        <div class="faq-answer"><div class="faq-answer-inner">The implant placement surgery itself takes 1-2 hours per implant. The complete process — from placement to final crown — typically spans 3-6 months, as the implant needs to osseointegrate (fuse with the jawbone) before the crown is placed. We'll outline a detailed timeline during the consultation.</div></div>
      </div>
      <div class="faq-item" role="listitem">
        <button class="faq-question" aria-expanded="false">Are braces suitable for adults? <span class="faq-icon" aria-hidden="true"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M12 5v14M5 12h14"/></svg></span></button>
        <div class="faq-answer"><div class="faq-answer-inner">Absolutely. Orthodontic treatment is effective at any age as long as your teeth and gums are healthy. Many adults choose clear aligners for a more discreet option. Dr. Meziani will assess your specific bite and alignment needs and recommend the most suitable treatment.</div></div>
      </div>
      <div class="faq-item" role="listitem">
        <button class="faq-question" aria-expanded="false">How often should I visit the dentist? <span class="faq-icon" aria-hidden="true"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M12 5v14M5 12h14"/></svg></span></button>
        <div class="faq-answer"><div class="faq-answer-inner">We recommend a routine checkup and professional cleaning every 6 months for most patients. Some individuals with higher risk may benefit from visits every 3-4 months. Regular visits allow us to catch and address small problems before they become costly complications.</div></div>
      </div>
      <div class="faq-item" role="listitem">
        <button class="faq-question" aria-expanded="false">What age should children have their first dental visit? <span class="faq-icon" aria-hidden="true"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M12 5v14M5 12h14"/></svg></span></button>
        <div class="faq-answer"><div class="faq-answer-inner">We recommend a child's first dental visit around their first birthday, or within 6 months after their first tooth appears. Early visits help establish a positive relationship with dental care and allow us to monitor development and provide parents with guidance on brushing and diet.</div></div>
      </div>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="cta-section" aria-labelledby="cta-heading">
  <div class="reveal">
    <h2 id="cta-heading">Ready for a Healthier Smile?</h2>
    <p>Join over 5,000 patients who trust Nova Dental Clinic for their oral health. Book your consultation today.</p>
    <div class="cta-buttons">
      <a href="contact.html" class="btn-white"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg> Book Your Consultation</a>
      <a href="tel:+21321000000" class="btn-outline-white"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.61 3.4 2 2 0 0 1 3.6 1.21h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L7.91 9a16 16 0 0 0 6.08 6.08l.91-.91a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg> Call Us Now</a>
    </div>
  </div>
</section>

</div>