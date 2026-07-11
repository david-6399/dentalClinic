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
      <span>Doctors</span>
    </nav>
    <h1 id="page-heading">Meet Our Specialists</h1>
    <p>A team of passionate, board-certified dental professionals dedicated to providing exceptional care and beautiful results.</p>
  </div>
</section>

<!-- DOCTORS GRID -->
<section class="section" aria-labelledby="team-heading">
  <div class="container">
    <div class="section-header center">
      <div class="section-tag reveal">Our Medical Team</div>
      <h2 class="section-title reveal" id="team-heading">Expertise You Can Trust</h2>
      <p class="section-subtitle reveal">Every doctor at Nova Dental holds an advanced degree, ongoing training, and a genuine commitment to patient well-being.</p>
    </div>
    <div class="doctors-full-grid">

      <div class="doctor-full-card reveal">
        <div class="doctor-full-img">
          <img src="https://images.pexels.com/photos/5215024/pexels-photo-5215024.jpeg?auto=compress&cs=tinysrgb&w=500" alt="Dr. Ahmed Benali" loading="lazy" />
        </div>
        <div class="doctor-full-info">
          <span class="specialty-badge">Implant Specialist</span>
          <h3>Dr. Ahmed Benali</h3>
          <div class="exp">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="12" cy="12" r="10"/><path d="M12 8v4l3 3"/></svg>
            15+ Years Experience &nbsp;·&nbsp; Lead Dentist &amp; Director
          </div>
          <p>Dr. Benali is the founder and lead dentist at Nova Dental Clinic. A graduate of the University of Algiers Faculty of Dentistry with a specialization in implantology from Paris Descartes University, he has performed over 2,000 successful implant procedures.</p>
          <div class="doctor-skills">
            <span class="skill-tag">Dental Implants</span>
            <span class="skill-tag">Oral Surgery</span>
            <span class="skill-tag">Bone Grafting</span>
            <span class="skill-tag">Full-Mouth Rehab</span>
          </div>
        </div>
      </div>

      <div class="doctor-full-card reveal reveal-delay-1">
        <div class="doctor-full-img">
          <img src="https://images.pexels.com/photos/5215002/pexels-photo-5215002.jpeg?auto=compress&cs=tinysrgb&w=500" alt="Dr. Sarah Meziani" loading="lazy" />
        </div>
        <div class="doctor-full-info">
          <span class="specialty-badge">Orthodontics</span>
          <h3>Dr. Sarah Meziani</h3>
          <div class="exp">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="12" cy="12" r="10"/><path d="M12 8v4l3 3"/></svg>
            10 Years Experience &nbsp;·&nbsp; Orthodontics Specialist
          </div>
          <p>Dr. Meziani completed her orthodontic specialty training in Lyon, France and returned to Algeria to bring cutting-edge aligner technology to local patients. She is certified in both traditional braces and clear aligner systems, and is known for her meticulous attention to detail.</p>
          <div class="doctor-skills">
            <span class="skill-tag">Braces</span>
            <span class="skill-tag">Clear Aligners</span>
            <span class="skill-tag">Bite Correction</span>
            <span class="skill-tag">Jaw Alignment</span>
          </div>
        </div>
      </div>

      <div class="doctor-full-card reveal">
        <div class="doctor-full-img">
          <img src="https://images.pexels.com/photos/6749773/pexels-photo-6749773.jpeg?auto=compress&cs=tinysrgb&w=500" alt="Dr. Karim Hadj" loading="lazy" />
        </div>
        <div class="doctor-full-info">
          <span class="specialty-badge">Pediatric Dentistry</span>
          <h3>Dr. Karim Hadj</h3>
          <div class="exp">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="12" cy="12" r="10"/><path d="M12 8v4l3 3"/></svg>
            8 Years Experience &nbsp;·&nbsp; Pediatric Dentist
          </div>
          <p>Dr. Hadj specializes in making dentistry a positive experience for children. His gentle approach, child-friendly communication style, and comprehensive preventive care programs help establish lifelong oral health habits from an early age.</p>
          <div class="doctor-skills">
            <span class="skill-tag">Child Dentistry</span>
            <span class="skill-tag">Preventive Care</span>
            <span class="skill-tag">Sealants</span>
            <span class="skill-tag">Fluoride Therapy</span>
          </div>
        </div>
      </div>

      <div class="doctor-full-card reveal reveal-delay-1">
        <div class="doctor-full-img">
          <img src="https://images.pexels.com/photos/5452293/pexels-photo-5452293.jpeg?auto=compress&cs=tinysrgb&w=500" alt="Dr. Lina Cherif" loading="lazy" />
        </div>
        <div class="doctor-full-info">
          <span class="specialty-badge">Cosmetic Dentistry</span>
          <h3>Dr. Lina Cherif</h3>
          <div class="exp">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="12" cy="12" r="10"/><path d="M12 8v4l3 3"/></svg>
            12 Years Experience &nbsp;·&nbsp; Cosmetic Dentist
          </div>
          <p>Dr. Cherif is Nova Dental's cosmetic dentistry expert. She combines artistry with precision to create smile transformations through veneers, whitening, bonding, and full cosmetic rehabilitations. Her work has been featured in local health publications.</p>
          <div class="doctor-skills">
            <span class="skill-tag">Veneers</span>
            <span class="skill-tag">Teeth Whitening</span>
            <span class="skill-tag">Bonding</span>
            <span class="skill-tag">Smile Design</span>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- TEAM VALUES -->
<section class="section" style="background:#F8FAFC;" aria-labelledby="values-heading">
  <div class="container">
    <div class="section-header center">
      <div class="section-tag reveal">Our Commitment</div>
      <h2 class="section-title reveal" id="values-heading">The Standards We Hold Ourselves To</h2>
    </div>
    <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:24px;" class="reveal">
      <div style="text-align:center;padding:28px 20px;background:#fff;border-radius:16px;border:1px solid var(--border);">
        <div style="width:48px;height:48px;background:#EFF6FF;border-radius:12px;display:flex;align-items:center;justify-content:center;color:var(--primary);margin:0 auto 14px;" aria-hidden="true">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
        </div>
        <h4 style="font-size:0.9rem;font-weight:700;color:#1e293b;margin-bottom:6px;">Patient Safety First</h4>
        <p style="font-size:0.8rem;color:var(--text-light);line-height:1.6;">All procedures follow strict sterilization and safety protocols.</p>
      </div>
      <div style="text-align:center;padding:28px 20px;background:#fff;border-radius:16px;border:1px solid var(--border);">
        <div style="width:48px;height:48px;background:#ECFEFF;border-radius:12px;display:flex;align-items:center;justify-content:center;color:var(--accent);margin:0 auto 14px;" aria-hidden="true">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
        </div>
        <h4 style="font-size:0.9rem;font-weight:700;color:#1e293b;margin-bottom:6px;">Continuous Education</h4>
        <p style="font-size:0.8rem;color:var(--text-light);line-height:1.6;">Our team attends international conferences and training annually.</p>
      </div>
      <div style="text-align:center;padding:28px 20px;background:#fff;border-radius:16px;border:1px solid var(--border);">
        <div style="width:48px;height:48px;background:#F0FDF4;border-radius:12px;display:flex;align-items:center;justify-content:center;color:#16A34A;margin:0 auto 14px;" aria-hidden="true">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
        </div>
        <h4 style="font-size:0.9rem;font-weight:700;color:#1e293b;margin-bottom:6px;">Evidence-Based Care</h4>
        <p style="font-size:0.8rem;color:var(--text-light);line-height:1.6;">Every recommendation is grounded in the latest dental research.</p>
      </div>
      <div style="text-align:center;padding:28px 20px;background:#fff;border-radius:16px;border:1px solid var(--border);">
        <div style="width:48px;height:48px;background:#FFF0F3;border-radius:12px;display:flex;align-items:center;justify-content:center;color:#E11D48;margin:0 auto 14px;" aria-hidden="true">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
        </div>
        <h4 style="font-size:0.9rem;font-weight:700;color:#1e293b;margin-bottom:6px;">Compassionate Care</h4>
        <p style="font-size:0.8rem;color:var(--text-light);line-height:1.6;">We treat every patient with empathy, respect, and understanding.</p>
      </div>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="cta-section" aria-labelledby="cta-heading">
  <div class="reveal">
    <h2 id="cta-heading">Ready to Meet Your Specialist?</h2>
    <p>Book a consultation with any of our doctors and take the first step toward a healthier, more confident smile.</p>
    <div class="cta-buttons">
      <a href="contact.html" class="btn-white"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg> Book Appointment</a>
      <a href="services.html" class="btn-outline-white">Our Services</a>
    </div>
  </div>
</section>
</div>