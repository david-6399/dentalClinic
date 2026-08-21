<?php

use Livewire\Component;

new class extends Component {
    public function render()
    {
        return $this->view()->layout('layouts::app');
    }
};
?>

<div>
    <div class="reveal-right">
        <div class="contact-form-card mt-32 max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-md">
            <h3>Register</h3>
            <p>Please fill in the form below to create an account.</p>

            <form id="consultation-form" novalidate aria-label="Consultation request form">
                <div class="form-grid">
                    <div class="form-group">
                        <label for="full-name">Full Name <span aria-hidden="true"
                                style="color:var(--primary);">*</span></label>
                        <input type="text" id="full-name" name="full_name" placeholder="e.g. Ahmed Benali" required
                            autocomplete="name" />
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number <span aria-hidden="true"
                                style="color:var(--primary);">*</span></label>
                        <input type="tel" id="phone" name="phone" placeholder="+213 XX XX XX XX" required
                            autocomplete="tel" />
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" placeholder="you@example.com"
                            autocomplete="email" />
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
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2.5" aria-hidden="true">
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
