<?php
// loading-spinner.php
// Reusable loading animation component
?>
<div class="loading-overlay" id="loadingOverlay">
    <div class="loading-content">
        <div class="loading-spinner-large">
            <img src="images/icon-ray.svg" alt="Loading" class="spinning-ray-icon-large" width="64" height="64">
        </div>
        <p class="loading-text">Finding prospects...</p>
    </div>
</div>

<script>
// Each spinner instance manages itself with minimal logging
(function() {
    // Get this specific overlay
    const specificOverlay = document.querySelector('.loading-overlay');
    
    if (specificOverlay) {
        // Hide results content immediately
        const candidateContainer = document.querySelector('.candidate-table-container');
        if (candidateContainer) {
            candidateContainer.style.opacity = '0';
        }
        
        // Start the fade-out timer
        setTimeout(() => {
            if (specificOverlay && document.contains(specificOverlay)) {
                // Reduce console noise - only log once per page load
                if (!window.spinnerLogged) {
                    console.log('Starting spinner fade out...');
                    window.spinnerLogged = true;
                }
                
                // Start fade out
                specificOverlay.style.opacity = '0';
                specificOverlay.style.transition = 'opacity 0.1s ease-out';
                
                // After fade completes, remove overlay and show results
                setTimeout(() => {
                    if (!window.spinnerRemovedLogged) {
                        console.log('Removing spinner and showing results...');
                        window.spinnerRemovedLogged = true;
                    }
                    
                    specificOverlay.remove();
                    
                    // Show the results content
                    if (candidateContainer) {
                        candidateContainer.style.opacity = '1';
                        candidateContainer.style.transition = 'opacity 0.1s ease-in';
                    }
                }, 300);
            }
        }, 1000);
    }
})();
</script>
