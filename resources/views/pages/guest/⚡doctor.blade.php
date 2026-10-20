<?php

use App\Services\PageContent;
use Livewire\Component;

new class extends Component
{
    //
};
?>

@php($pageContent = PageContent::forPage('doctors'))

<div>
    
<!-- PAGE HERO -->
@if ($pageContent['hero']['enabled'])
<section class="page-hero" aria-labelledby="page-heading">
  <div class="page-hero-content">
    <nav class="breadcrumb" aria-label="Breadcrumb">
      <a href="index.html">Home</a>
      <span class="breadcrumb-sep" aria-hidden="true">/</span>
      <span>Doctors</span>
    </nav>
    <h1 id="page-heading">{{ $pageContent['hero']['title'] }}</h1>
    <p>{{ $pageContent['hero']['description'] }}</p>
  </div>
</section>
@endif

<!-- DOCTORS GRID -->
@if ($pageContent['team']['enabled'])
<section class="section" aria-labelledby="team-heading">
  <div class="container">
    <div class="section-header center">
      <div class="section-tag reveal">Our Medical Team</div>
      <h2 class="section-title reveal" id="team-heading">{{ $pageContent['team']['title'] }}</h2>
      <p class="section-subtitle reveal">{{ $pageContent['team']['description'] }}</p>
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
@endif

<!-- TEAM VALUES -->
@if ($pageContent['values']['enabled'])
<section class="section" style="background:var(--bg);" aria-labelledby="values-heading">
  <div class="container">
    <div class="section-header center">
      <div class="section-tag reveal">Our Commitment</div>
      <h2 class="section-title reveal" id="values-heading">{{ $pageContent['values']['title'] }}</h2>
      @if ($pageContent['values']['description'] !== '')
        <p class="section-subtitle reveal">{{ $pageContent['values']['description'] }}</p>
      @endif
    </div>
    @php($commitmentStyles = [
      ['background' => 'var(--soft-primary)', 'color' => 'var(--primary)'],
      ['background' => 'var(--soft-accent)', 'color' => 'var(--accent)'],
      ['background' => 'var(--success-bg)', 'color' => 'var(--success)'],
      ['background' => 'var(--soft-rose)', 'color' => 'var(--rose)'],
    ])
    <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:24px;" class="reveal">
      @foreach ($pageContent['values']['items'] as $index => $item)
        @php($cardStyle = $commitmentStyles[$index % count($commitmentStyles)])
        <div style="text-align:center;padding:28px 20px;background:var(--white);border-radius:16px;border:1px solid var(--border);">
          <div  style="width:48px;height:48px;background: color-mix(in srgb, {{ $item['icon_color'] ?? '#3B82F6' }} 10%, transparent);border-radius:12px;display:flex;align-items:center;color:{{ $item['icon_color'] ?? '#' }};justify-content:center;margin:0 auto 14px;" aria-hidden="true">
            <x-heroicon :name="$item['icon'] ?? 'sparkles'" class="h-6 w-6 " />
          </div>
          <h4 style="font-size:0.9rem;font-weight:700;color:var(--heading);margin-bottom:6px;">{{ $item['title'] }}</h4>
          <p style="font-size:0.8rem;color:var(--text-light);line-height:1.6;">{{ $item['description'] }}</p>
        </div>
      @endforeach
    </div>
  </div>
</section>
@endif

<!-- CTA -->
@if ($pageContent['cta']['enabled'])
<section class="cta-section" aria-labelledby="cta-heading">
  <div class="reveal">
    <h2 id="cta-heading">{{ $pageContent['cta']['title'] }}</h2>
    <p>{{ $pageContent['cta']['description'] }}</p>
    <div class="cta-buttons">
      <a href="contact.html" class="btn-white"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg> Book Appointment</a>
      <a href="services.html" class="btn-outline-white">Our Services</a>
    </div>
  </div>
</section>
@endif
</div>