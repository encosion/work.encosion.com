<?php
// loading-spinner.php
// Reusable loading animation component
?>
<div class="loading-overlay" id="loadingOverlay">
    <div class="loading-content">
        <div class="loading-spinner-large">
            <img src="images/icon-ray.svg" alt="Loading" class="spinning-ray-icon-large" width="64" height="64">
        </div>
        <p class="loading-text">Finding candidates...</p>
    </div>
</div>

<script>
// Immediately hide the results content and start the spinner timer
(function() {
    // Hide results content immediately
    const candidateContainer = document.querySelector('.candidate-table-container');
    if (candidateContainer) {
        candidateContainer.style.opacity = '0';
    }
    
    // Start the fade-out timer
    setTimeout(() => {
        const loadingOverlay = document.getElementById('loadingOverlay');
        if (loadingOverlay) {
            console.log('Starting spinner fade out...');
            
            // Start fade out
            loadingOverlay.style.opacity = '0';
            loadingOverlay.style.transition = 'opacity 0.1s ease-out';
            
            // After fade completes, remove overlay and show results
            setTimeout(() => {
                console.log('Removing spinner and showing results...');
                loadingOverlay.remove();
                
                // Show the results content
                if (candidateContainer) {
                    candidateContainer.style.opacity = '1';
                    candidateContainer.style.transition = 'opacity 0.1s ease-in';
                }
            }, 300);
        }
    }, 1000);
})();
</script>
