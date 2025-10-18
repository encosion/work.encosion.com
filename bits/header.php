<?php
// header.php - Reusable header component for the site
// Usage: include 'bits/header.php';
?>

<link rel="stylesheet" href="/bits/header.css">

<header class="header" id="header">
    <div class="header-content">
        <div class="header-wrapper">
            <h1 class="site-title">
                <a href="/">Tim Ferguson...</a>
            </h1>
            <!-- Navigation links - styled differently for desktop/mobile -->
            <nav class="header-nav" id="headerNav">
                <ul class="nav-list">
                    <li><a href="https://thoughts.encosion.com" title="Product design and development..§.">...has&nbsp;thoughts&nbsp;🤔</a></li>
                    <li><a href="https://thoughts.encosion.com/tagged/timusic" title="My own music experiments...">...makes&nbsp;🤘</a></li>
                    <li><a href="https://thoughts.encosion.com/tagged/gigphoto" title="Mainly photos taken at gigs...">...shoots&nbsp;💛</a></li>
                    <li><a href="https://issues.encosion.com" title="Tim's collection of comics..">...has&nbsp;issues&nbsp;😃</a></li>
                </ul>
            </nav>
        </div>
        
        <!-- Hamburger menu toggle -->
        <button class="mobile-menu-toggle" id="mobileMenuToggle" aria-label="Toggle menu">
            <span class="hamburger-line"></span>
            <span class="hamburger-line"></span>
            <span class="hamburger-line"></span>
        </button>
    </div>
</header>

<script>
    // Mobile menu toggle functionality
    (function() {
        const mobileMenuToggle = document.getElementById('mobileMenuToggle');
        const headerNav = document.getElementById('headerNav');
        
        if (!mobileMenuToggle || !headerNav) return;
        
        function toggleMobileMenu() {
            const isOpen = headerNav.classList.contains('is-open');
            
            if (isOpen) {
                headerNav.classList.remove('is-open');
                mobileMenuToggle.classList.remove('is-open');
                mobileMenuToggle.setAttribute('aria-expanded', 'false');
            } else {
                headerNav.classList.add('is-open');
                mobileMenuToggle.classList.add('is-open');
                mobileMenuToggle.setAttribute('aria-expanded', 'true');
            }
        }
        
        // Toggle menu on button click
        mobileMenuToggle.addEventListener('click', toggleMobileMenu);
        
        // Close menu when clicking outside
        document.addEventListener('click', function(event) {
            if (!mobileMenuToggle.contains(event.target) && !headerNav.contains(event.target)) {
                headerNav.classList.remove('is-open');
                mobileMenuToggle.classList.remove('is-open');
                mobileMenuToggle.setAttribute('aria-expanded', 'false');
            }
        });
        
        // Close menu on escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape' && headerNav.classList.contains('is-open')) {
                headerNav.classList.remove('is-open');
                mobileMenuToggle.classList.remove('is-open');
                mobileMenuToggle.setAttribute('aria-expanded', 'false');
            }
        });
    })();
</script>
