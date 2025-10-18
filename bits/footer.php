<link rel="stylesheet" href="/bits/footer.css">

<footer class="site-footer">
    <div class="footer-container">
        <div class="footer-buttons">
            <button class="footer-back-to-top" id="footerBackToTop" title="Back to top">👆</button>
        </div>
        <div class="copyright-link">© 2025 Tim Ferguson ♥</div>
        <div class="footer-buttons">
            <a href="/" class="footer-random-link" title="Random thought">🎲</a>
        </div>
    </div>
</footer>

<script>
    // Footer back-to-top button functionality
    (function() {
        const button = document.getElementById('footerBackToTop');
        const scrollThreshold = 300;
        
        if (!button) return;
        
        function updateButtonVisibility() {
            const scrollY = window.pageYOffset || document.documentElement.scrollTop;
            const shouldShow = scrollY > scrollThreshold;
            
            if (shouldShow) {
                button.classList.add('is-visible');
            } else {
                button.classList.remove('is-visible');
            }
        }
        
        function scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }
        
        // Event listeners
        button.addEventListener('click', scrollToTop);
        window.addEventListener('scroll', updateButtonVisibility);
        
        // Initial check
        updateButtonVisibility();
    })();
</script> 