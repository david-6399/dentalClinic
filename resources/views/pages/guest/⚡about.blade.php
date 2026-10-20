<?php

use App\Services\PageContent;
use Livewire\Component;

new class extends Component {
    //
};
?>

@php($pageContent = PageContent::forPage('about'))

<div>

    <!-- PAGE HERO -->
    @if ($pageContent['hero']['enabled'])
    <section class="page-hero" aria-labelledby="page-heading">
        <div class="page-hero-content">
            <nav class="breadcrumb" aria-label="Breadcrumb">
                <a href="index.html">Home</a>
                <span class="breadcrumb-sep" aria-hidden="true">/</span>
                <span>About</span>
            </nav>
            <h1 id="page-heading">{{ $pageContent['hero']['title'] }}</h1>
            <p>{{ $pageContent['hero']['description'] }}</p>
        </div>
    </section>
    @endif

    <!-- OUR STORY -->
    @if ($pageContent['story']['enabled'])
    <section class="section" aria-labelledby="story-heading">
        <div class="container">
            <div class="story-grid">
                <div class="story-img reveal-left">
                    <img src="https://images.pexels.com/photos/3845810/pexels-photo-3845810.jpeg?auto=compress&cs=tinysrgb&w=900"
                        alt="Nova Dental Clinic interior" loading="lazy" />
                </div>
                <div class="story-text reveal-right">
                    <div class="section-tag">Our Story</div>
                    <h2 class="section-title" id="story-heading">{!! nl2br(e($pageContent['story']['title'])) !!}</h2>
                    @if ($pageContent['story']['description'] !== '')
                        <p>{{ $pageContent['story']['description'] }}</p>
                    @endif
                    <p>Nova Dental Clinic was founded in 2009 by <strong>Dr. Ahmed Benali</strong> with a clear vision:
                        to bring international standards of dental care to Algerian families. Starting as a single-chair
                        practice in Alger Centre, Nova Dental has grown into a full-service multi-specialty clinic.</p>
                    <p>Over 15 years, we've treated more than <strong>5,000 patients</strong>, built a team of four
                        board-certified specialists, and invested continuously in the latest dental technology — from
                        digital X-rays to 3D implant planning software.</p>
                    <p>Today, we remain guided by the same principle that drove us from day one: <strong>every patient
                            deserves expert care, delivered with compassion and complete transparency.</strong></p>

                    <div class="mission-grid" style="margin-top:28px;">
                        <div class="mission-card mission">
                            <h4>Our Mission</h4>
                            <p>To provide accessible, high-quality dental care that improves oral health and enhances
                                the lives of every patient we serve.</p>
                        </div>
                        <div class="mission-card vision">
                            <h4>Our Vision</h4>
                            <p>To be Algeria's most trusted dental clinic — where cutting-edge technology meets
                                compassionate, personalized care.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- STATS -->
    <section class="stats-bar" aria-label="Clinic statistics">
        <div class="stats-grid">
            <div class="stat-item reveal">
                <div class="stat-num" data-count="2009">0</div>
                <div class="stat-label">Founded</div>
            </div>
            <div class="stat-item reveal reveal-delay-1">
                <div class="stat-num" data-count="5000" data-suffix="+">0</div>
                <div class="stat-label">Patients Treated</div>
            </div>
            <div class="stat-item reveal reveal-delay-2">
                <div class="stat-num" data-count="4">0</div>
                <div class="stat-label">Specialists</div>
            </div>
            <div class="stat-item reveal reveal-delay-3">
                <div class="stat-num" data-count="98" data-suffix="%">0</div>
                <div class="stat-label">Patient Satisfaction</div>
            </div>
        </div>
    </section>

    <!-- CORE VALUES -->
    @if ($pageContent['values']['enabled'])
    <section class="section" style="background:var(--bg);" aria-labelledby="values-heading">
        <div class="container">
            <div class="section-header center">
                <div class="section-tag reveal">Core Values</div>
                <h2 class="section-title reveal" id="values-heading">{{ $pageContent['values']['title'] }}</h2>
                <p class="section-subtitle reveal">{{ $pageContent['values']['description'] }}</p>
            </div>
            <div class="values-grid">
                @foreach ($pageContent['values']['items'] as $item)
                    <div class="value-card reveal">
                        <div class="value-icon" aria-hidden="true">
                            <x-heroicon :name="$item['icon'] ?? 'sparkles'" class="h-6 w-6" />
                        </div>
                        <h3>{{ $item['title'] }}</h3>
                        <p>{{ $item['description'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- MILESTONES -->
    @if ($pageContent['milestones']['enabled'])
    <section class="section" aria-labelledby="milestones-heading">
        <div class="container">
            <div class="section-header center">
                <div class="section-tag reveal">Our Journey</div>
                <h2 class="section-title reveal" id="milestones-heading">{{ $pageContent['milestones']['title'] }}</h2>
                @if ($pageContent['milestones']['description'] !== '')
                    <p class="section-subtitle reveal">{{ $pageContent['milestones']['description'] }}</p>
                @endif
            </div>
            <div style="max-width:640px;margin:0 auto;display:flex;flex-direction:column;gap:0;">
                <div style="display:flex;gap:24px;padding-bottom:32px;position:relative;">
                    <div style="display:flex;flex-direction:column;align-items:center;flex-shrink:0;">
                        <div style="width:40px;height:40px;background:var(--primary);border-radius:50%;display:flex;align-items:center;justify-content:center;color:var(--white);font-weight:700;font-size:0.75rem;z-index:1;"
                            aria-hidden="true">2009</div>
                        <div style="flex:1;width:2px;background:var(--border);margin-top:8px;" aria-hidden="true">
                        </div>
                    </div>
                    <div class="timeline-content reveal-right">
                        <h4>Clinic Founded</h4>
                        <p>Dr. Benali opens Nova Dental Clinic with a single treatment room and a commitment to
                            world-class care.</p>
                    </div>
                </div>
                <div style="display:flex;gap:24px;padding-bottom:32px;position:relative;">
                    <div style="display:flex;flex-direction:column;align-items:center;flex-shrink:0;">
                        <div style="width:40px;height:40px;background:var(--primary);border-radius:50%;display:flex;align-items:center;justify-content:center;color:var(--white);font-weight:700;font-size:0.75rem;z-index:1;"
                            aria-hidden="true">2013</div>
                        <div style="flex:1;width:2px;background:var(--border);margin-top:8px;" aria-hidden="true">
                        </div>
                    </div>
                    <div class="timeline-content reveal-right">
                        <h4>Expansion &amp; New Specialists</h4>
                        <p>The clinic expands to 4 treatment rooms and welcomes Dr. Meziani (Orthodontics) and Dr. Hadj
                            (Pediatrics) to the team.</p>
                    </div>
                </div>
                <div style="display:flex;gap:24px;padding-bottom:32px;position:relative;">
                    <div style="display:flex;flex-direction:column;align-items:center;flex-shrink:0;">
                        <div style="width:40px;height:40px;background:var(--primary);border-radius:50%;display:flex;align-items:center;justify-content:center;color:var(--white);font-weight:700;font-size:0.75rem;z-index:1;"
                            aria-hidden="true">2017</div>
                        <div style="flex:1;width:2px;background:var(--border);margin-top:8px;" aria-hidden="true">
                        </div>
                    </div>
                    <div class="timeline-content reveal-right">
                        <h4>Digital Dentistry Upgrade</h4>
                        <p>Investment in 3D digital X-ray systems, CAD/CAM crown milling, and intraoral scanners —
                            bringing Nova Dental to international standards.</p>
                    </div>
                </div>
                <div style="display:flex;gap:24px;padding-bottom:32px;position:relative;">
                    <div style="display:flex;flex-direction:column;align-items:center;flex-shrink:0;">
                        <div style="width:40px;height:40px;background:var(--primary);border-radius:50%;display:flex;align-items:center;justify-content:center;color:var(--white);font-weight:700;font-size:0.75rem;z-index:1;"
                            aria-hidden="true">2020</div>
                        <div style="flex:1;width:2px;background:var(--border);margin-top:8px;" aria-hidden="true">
                        </div>
                    </div>
                    <div class="timeline-content reveal-right">
                        <h4>ISO Certification</h4>
                        <p>Nova Dental achieves ISO 13485 certification for medical device sterilization and infection
                            control procedures.</p>
                    </div>
                </div>
                <div style="display:flex;gap:24px;">
                    <div style="display:flex;flex-direction:column;align-items:center;flex-shrink:0;">
                        <div style="width:40px;height:40px;background:var(--accent);border-radius:50%;display:flex;align-items:center;justify-content:center;color:var(--white);font-weight:700;font-size:0.75rem;"
                            aria-hidden="true">2024</div>
                    </div>
                    <div class="timeline-content reveal-right">
                        <h4>5,000 Patients Milestone</h4>
                        <p>We celebrate treating our 5,000th patient and continue expanding our services with cosmetic
                            dentistry under Dr. Lina Cherif.</p>
                    </div>
                </div>
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
                <a href="contact.html" class="btn-white"><svg width="16" height="16" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true">
                        <rect x="3" y="4" width="18" height="18" rx="2" />
                        <path d="M16 2v4M8 2v4M3 10h18" />
                    </svg> Book a Consultation</a>
                <a href="doctors.html" class="btn-outline-white">Meet Our Team</a>
            </div>
        </div>
    </section>
    @endif

</div>
