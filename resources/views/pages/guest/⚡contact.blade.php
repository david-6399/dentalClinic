<?php

use Livewire\Component;

new class extends Component {
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
                <span>Contact</span>
            </nav>
            <h1 id="page-heading">Get in Touch</h1>
            <p>Ready to start your smile journey? Book a consultation or reach out to us — we'd love to hear from you.
            </p>
        </div>
    </section>

    <!-- CONTACT SECTION -->
    <section class="section" aria-labelledby="contact-main-heading">
        <div class="container">
            <h2 class="sr-only" id="contact-main-heading">Contact Information and Consultation Form</h2>
            <div class="contact-grid">

                <!-- INFO COLUMN -->
                <div class="reveal-left">
                    <div class="contact-info-card">
                        <h3 style="font-size:1.1rem;font-weight:700;color:#1e293b;margin-bottom:4px;">Contact
                            Information</h3>
                        <p style="font-size:0.85rem;color:var(--text-light);margin-bottom:8px;">We're here to help.
                            Reach us by phone, email, or visit us in clinic.</p>

                        <div class="contact-info-item">
                            <div class="contact-info-icon" aria-hidden="true">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                                    <circle cx="12" cy="10" r="3" />
                                </svg>
                            </div>
                            <div>
                                <h4>Address</h4>
                                <p>123 Rue Didouche Mourad<br />Alger Centre, Algeria</p>
                            </div>
                        </div>

                        <div class="contact-info-item">
                            <div class="contact-info-icon" aria-hidden="true">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <path
                                        d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.61 3.4 2 2 0 0 1 3.6 1.21h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L7.91 9a16 16 0 0 0 6.08 6.08l.91-.91a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
                                </svg>
                            </div>
                            <div>
                                <h4>Phone</h4>
                                <a href="tel:+21321000000">+213 (0) 21 00 00 00</a>
                            </div>
                        </div>

                        <div class="contact-info-item">
                            <div class="contact-info-icon" aria-hidden="true">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <path
                                        d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                                    <polyline points="22,6 12,13 2,6" />
                                </svg>
                            </div>
                            <div>
                                <h4>Email</h4>
                                <a href="mailto:contact@novadental.dz">contact@novadental.dz</a>
                            </div>
                        </div>

                        <div class="contact-info-item">
                            <div class="contact-info-icon" aria-hidden="true">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10" />
                                    <path d="M12 8v4l3 3" />
                                </svg>
                            </div>
                            <div>
                                <h4>Opening Hours</h4>
                                <div class="hours-grid">
                                    <span class="hours-day">Saturday</span><span class="hours-time">08:00 – 18:00</span>
                                    <span class="hours-day">Sunday</span><span class="hours-time">08:00 – 18:00</span>
                                    <span class="hours-day">Monday</span><span class="hours-time">08:00 – 18:00</span>
                                    <span class="hours-day">Tuesday</span><span class="hours-time">08:00 – 18:00</span>
                                    <span class="hours-day">Wednesday</span><span class="hours-time">08:00 –
                                        18:00</span>
                                    <span class="hours-day">Thursday</span><span class="hours-time">08:00 – 18:00</span>
                                    <span class="hours-day">Friday</span><span class="hours-time closed">Closed</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- QUICK ACTION CARDS -->
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-top:16px;">
                        <a href="tel:+21321000000"
                            style="background:var(--primary);color:#fff;border-radius:12px;padding:16px;text-decoration:none;display:flex;align-items:center;gap:10px;transition:background 0.2s;"
                            onmouseover="this.style.background='var(--primary-dark)'"
                            onmouseout="this.style.background='var(--primary)'">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" aria-hidden="true">
                                <path
                                    d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.61 3.4 2 2 0 0 1 3.6 1.21h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L7.91 9a16 16 0 0 0 6.08 6.08l.91-.91a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
                            </svg>
                            <div>
                                <div style="font-size:0.75rem;opacity:0.85;">Call Us</div>
                                <div style="font-weight:700;font-size:0.85rem;">+213 21 00 00 00</div>
                            </div>
                        </a>
                        <a href="mailto:contact@novadental.dz"
                            style="background:#ECFEFF;color:var(--accent);border-radius:12px;padding:16px;text-decoration:none;display:flex;align-items:center;gap:10px;border:1px solid #A5F3FC;transition:background 0.2s;"
                            onmouseover="this.style.background='#CFFAFE'" onmouseout="this.style.background='#ECFEFF'">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" aria-hidden="true">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                                <polyline points="22,6 12,13 2,6" />
                            </svg>
                            <div>
                                <div style="font-size:0.75rem;opacity:0.75;color:#0891B2;">Email Us</div>
                                <div style="font-weight:700;font-size:0.82rem;color:#0E7490;">Send a Message</div>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- FORM COLUMN -->
                <div class="reveal-right">
                    <div class="contact-form-card">
                        <h3>Book a Consultation</h3>
                        <p>Fill in the form below and we'll get back to you within a few hours to confirm your
                            appointment.</p>

                        <form id="consultation-form" novalidate aria-label="Consultation request form">
                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="full-name">Full Name <span aria-hidden="true"
                                            style="color:var(--primary);">*</span></label>
                                    <input type="text" id="full-name" name="full_name"
                                        placeholder="e.g. Ahmed Benali" required autocomplete="name" />
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone Number <span aria-hidden="true"
                                            style="color:var(--primary);">*</span></label>
                                    <input type="tel" id="phone" name="phone"
                                        placeholder="+213 XX XX XX XX" required autocomplete="tel" />
                                </div>
                                <div class="form-group">
                                    <label for="email">Email Address</label>
                                    <input type="email" id="email" name="email"
                                        placeholder="you@example.com" autocomplete="email" />
                                </div>
                                <div class="form-group">
                                    <label for="service">Service Needed</label>
                                    <select id="service" name="service">
                                        <option value="" disabled selected>Select a service...</option>
                                        <option value="checkup">Dental Checkup – 2,000 DZD</option>
                                        <option value="cleaning">Teeth Cleaning – 3,500 DZD</option>
                                        <option value="whitening">Teeth Whitening – 12,000 DZD</option>
                                        <option value="orthodontics">Orthodontics Consultation – 5,000 DZD</option>
                                        <option value="implants">Dental Implants – From 50,000 DZD</option>
                                        <option value="pediatric">Pediatric Dentistry – 3,000 DZD</option>
                                        <option value="general">General / Not Sure</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="pref-date">Preferred Date</label>
                                    <input type="date" id="pref-date" name="preferred_date" />
                                </div>
                                <div class="form-group">
                                    <label for="pref-time">Preferred Time</label>
                                    <select id="pref-time" name="preferred_time">
                                        <option value="" disabled selected>Select a time...</option>
                                        <option>08:00 – 10:00</option>
                                        <option>10:00 – 12:00</option>
                                        <option>12:00 – 14:00</option>
                                        <option>14:00 – 16:00</option>
                                        <option>16:00 – 18:00</option>
                                    </select>
                                </div>
                                <div class="form-group full">
                                    <label for="message">Additional Information</label>
                                    <textarea id="message" name="message"
                                        placeholder="Tell us about your dental concern or any specific questions you have..."></textarea>
                                </div>
                            </div>
                            <button type="submit" class="btn-submit">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2.5" aria-hidden="true">
                                    <rect x="3" y="4" width="18" height="18" rx="2" />
                                    <path d="M16 2v4M8 2v4M3 10h18" />
                                </svg>
                                Send Consultation Request
                            </button>
                            <div class="form-success" aria-live="polite">
                                Your request has been sent! We'll contact you within a few hours to confirm your
                                appointment.
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- MAP PLACEHOLDER -->
    <section class="section-sm" style="background:#F8FAFC;" aria-label="Clinic location">
        <div class="container">
            <div
                style="border-radius:20px;overflow:hidden;border:1px solid var(--border);position:relative;height:320px;background:linear-gradient(135deg,#EFF6FF 0%,#DBEAFE 100%);display:flex;align-items:center;justify-content:center;flex-direction:column;gap:16px;">
                <div style="width:64px;height:64px;background:var(--primary);border-radius:50%;display:flex;align-items:center;justify-content:center;box-shadow:0 8px 24px rgba(37,99,235,0.3);"
                    aria-hidden="true">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#fff"
                        stroke-width="2">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                        <circle cx="12" cy="10" r="3" />
                    </svg>
                </div>
                <div style="text-align:center;">
                    <h4 style="font-size:1rem;font-weight:700;color:#1e293b;margin-bottom:6px;">Nova Dental Clinic</h4>
                    <p style="font-size:0.875rem;color:var(--text-light);">123 Rue Didouche Mourad, Alger Centre,
                        Algeria</p>
                </div>
                <a href="https://maps.google.com" target="_blank" rel="noopener noreferrer"
                    style="background:var(--primary);color:#fff;padding:10px 20px;border-radius:8px;text-decoration:none;font-size:0.875rem;font-weight:600;display:inline-flex;align-items:center;gap:6px;transition:background 0.2s;"
                    onmouseover="this.style.background='var(--primary-dark)'"
                    onmouseout="this.style.background='var(--primary)'">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2.5" aria-hidden="true">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                        <circle cx="12" cy="10" r="3" />
                    </svg>
                    Get Directions
                </a>
            </div>
        </div>
    </section>

    <!-- FAQ -->
    <section class="section" aria-labelledby="faq-heading">
        <div class="container">
            <div class="section-header center">
                <div class="section-tag reveal">Before You Visit</div>
                <h2 class="section-title reveal" id="faq-heading">Common Questions</h2>
            </div>
            <div class="faq-list reveal" role="list" style="max-width:700px;">
                <div class="faq-item" role="listitem">
                    <button class="faq-question" aria-expanded="false">Do I need to bring anything to my first visit?
                        <span class="faq-icon" aria-hidden="true"><svg width="12" height="12"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
                                <path d="M12 5v14M5 12h14" />
                            </svg></span></button>
                    <div class="faq-answer">
                        <div class="faq-answer-inner">For your first visit, simply bring a valid ID. If you have
                            previous dental X-rays or medical records, they can be helpful but are not required. We'll
                            perform our own comprehensive examination and digital X-rays.</div>
                    </div>
                </div>
                <div class="faq-item" role="listitem">
                    <button class="faq-question" aria-expanded="false">How early should I arrive for my appointment?
                        <span class="faq-icon" aria-hidden="true"><svg width="12" height="12"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
                                <path d="M12 5v14M5 12h14" />
                            </svg></span></button>
                    <div class="faq-answer">
                        <div class="faq-answer-inner">We recommend arriving 10 minutes before your scheduled
                            appointment to complete a brief intake form. For new patients, 15 minutes early is ideal so
                            we can review your dental history.</div>
                    </div>
                </div>
                <div class="faq-item" role="listitem">
                    <button class="faq-question" aria-expanded="false">What payment methods do you accept? <span
                            class="faq-icon" aria-hidden="true"><svg width="12" height="12"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
                                <path d="M12 5v14M5 12h14" />
                            </svg></span></button>
                    <div class="faq-answer">
                        <div class="faq-answer-inner">We accept cash, CIB card, and bank transfers (virement bancaire).
                            For larger procedures such as implants, we offer flexible payment arrangements — please ask
                            at reception about our installment plans.</div>
                    </div>
                </div>
                <div class="faq-item" role="listitem">
                    <button class="faq-question" aria-expanded="false">Can I cancel or reschedule my appointment?
                        <span class="faq-icon" aria-hidden="true"><svg width="12" height="12"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
                                <path d="M12 5v14M5 12h14" />
                            </svg></span></button>
                    <div class="faq-answer">
                        <div class="faq-answer-inner">Yes. We ask that you notify us at least 24 hours in advance if
                            you need to cancel or reschedule. You can call us directly or send an email and we will
                            accommodate you as best we can.</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="cta-section" aria-labelledby="cta-heading">
        <div class="reveal">
            <h2 id="cta-heading">We Can't Wait to Meet You</h2>
            <p>Whether you're coming in for a routine checkup or a smile transformation, Nova Dental Clinic is here for
                you every step of the way.</p>
            <div class="cta-buttons">
                <a href="tel:+21321000000" class="btn-white"><svg width="16" height="16" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true">
                        <path
                            d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.61 3.4 2 2 0 0 1 3.6 1.21h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L7.91 9a16 16 0 0 0 6.08 6.08l.91-.91a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
                    </svg> Call +213 21 00 00 00</a>
                <a href="services.html" class="btn-outline-white">View All Services</a>
            </div>
        </div>
    </section>

</div>
