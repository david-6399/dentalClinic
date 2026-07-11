<?php

use Livewire\Component;

new class extends Component {
    //
};
?>

<div>
    <!-- NAVBAR -->
    <nav class="navbar" role="navigation" aria-label="Main navigation">
        <div class="nav-inner">
            <a href="index.html" class="nav-logo" aria-label="Nova Dental Clinic – Home">
                <div class="nav-logo-icon" aria-hidden="true">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fff"
                        stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path
                            d="M12 2C8 2 5 5 5 8c0 4 3 6 3 10a2 2 0 0 0 4 0c0-1-.5-2-.5-4s.5-2 .5-2 .5 1 .5 2-.5 3-.5 4a2 2 0 0 0 4 0c0-4 3-6 3-10 0-3-3-6-7-6z" />
                    </svg>
                </div>
                <span class="nav-logo-text">Nova <span>Dental</span></span>
            </a>
            <ul class="nav-links" role="list">
                <li><a href="/"
                        >Home</a></li>
                <li><a href="/services">Services</a></li>
                <li><a href="/doctors">Doctors</a></li>
                <li><a href="/about">About</a></li>
                <li><a href="/contact">Contact</a></li>
                <li><a href="/contact" class="btn-nav">Book Appointment</a></li>
            </ul>
            <button class="mobile-menu-btn" id="mobile-menu-btn" aria-label="Toggle menu" aria-expanded="false">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2">
                    <path d="M3 12h18M3 6h18M3 18h18" />
                </svg>
            </button>
        </div>
        <div class="mobile-menu" id="mobile-menu" role="menu">
            <a href="/" role="menuitem"
                class="{{ request()->is('/') || request()->is('home') ? 'active' : '' }}">Home</a>
            <a href="/services" role="menuitem">Services</a>
            <a href="/doctors" role="menuitem">Doctors</a>
            <a href="/about" role="menuitem">About</a>
            <a href="/contact" role="menuitem">Contact</a>
            <a href="/contact" class="btn-mobile" role="menuitem">Book Appointment</a>
        </div>
    </nav>
</div>
