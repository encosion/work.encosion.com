<!-- Filter Panel -->
<div class="filter-panel" id="filterPanel">
    <div class="filter-panel-header">
        <div class="filter-header-left">
            <img src="images/icon-filters.svg" alt="Filters" class="filter-icon" width="16" height="16">
            <h2 class="filter-title">Filters</h2>
        </div>
        <button class="filter-close-btn" id="filterCloseBtn" title="Close filters">
            <span class="close-arrow">>></span>
        </button>
    </div>
    
    <div class="filter-content">
        <!-- Job Role Section -->
        <div class="filter-section">
            <h3 class="filter-section-title">Job role</h3>
            <div class="filter-items">
                <div class="filter-pill">
                    <span class="pill-text">Senior Product Owner</span>
                    <span class="pill-logic">OR</span>
                </div>
                <div class="filter-pill">
                    <span class="pill-text">Sr. Product Owner</span>
                    <span class="pill-logic">OR</span>
                </div>
                <div class="filter-pill">
                    <span class="pill-text">Lead Product Owner</span>
                    <span class="pill-logic">OR</span>
                </div>
            </div>
            <button class="add-filter-btn">
                <span class="add-icon">+</span>
                <span class="add-text">Add</span>
            </button>
        </div>

        <!-- Core Skills Section -->
        <div class="filter-section">
            <h3 class="filter-section-title">Core skills</h3>
            <div class="filter-items">
                <div class="filter-pill">
                    <span class="pill-text">DevSecOps Practices</span>
                    <span class="pill-logic">AND</span>
                </div>
                <div class="filter-pill">
                    <span class="pill-text">Application Security</span>
                    <span class="pill-logic">AND</span>
                </div>
                <div class="filter-pill">
                    <span class="pill-text">Security Automation</span>
                    <span class="pill-logic">AND</span>
                </div>
            </div>
            <button class="add-filter-btn">
                <span class="add-icon">+</span>
                <span class="add-text">Add</span>
            </button>
        </div>

        <!-- Locations Section -->
        <div class="filter-section">
            <h3 class="filter-section-title">Locations</h3>
            <div class="filter-items">
                <div class="filter-pill">
                    <span class="pill-text">Wealden, England, United Kingdom <span class="pill-distance">50 mi</span></span>
                    <span class="pill-logic">OR</span>
                </div>
                <div class="filter-pill">
                    <span class="pill-text">Berlin, Germany <span class="pill-distance">30 mi</span></span>
                    <span class="pill-logic">OR</span>
                </div>
            </div>
            <button class="add-filter-btn">
                <span class="add-icon">+</span>
                <span class="add-text">Add</span>
            </button>
        </div>

        <!-- Ideal Companies Section -->
        <div class="filter-section">
            <h3 class="filter-section-title">Ideal companies</h3>
            <div class="filter-items">
                <div class="filter-pill">
                    <span class="pill-text">Bioserenity</span>
                    <span class="pill-logic">OR</span>
                </div>
                <div class="filter-pill">
                    <span class="pill-text">Doctolib</span>
                    <span class="pill-logic">OR</span>
                </div>
                <div class="filter-pill">
                    <span class="pill-text">Withings</span>
                    <span class="pill-logic">OR</span>
                </div>
                <div class="filter-pill">
                    <span class="pill-text">Owkin</span>
                    <span class="pill-logic">OR</span>
                </div>
                <div class="filter-pill">
                    <span class="pill-text">Therapixel</span>
                    <span class="pill-logic">OR</span>
                </div>
                <div class="filter-pill">
                    <span class="pill-text">Beamery</span>
                    <span class="pill-logic">OR</span>
                </div>
                <div class="filter-pill">
                    <span class="pill-text">Phenom</span>
                    <span class="pill-logic">OR</span>
                </div>
            </div>
            <button class="add-filter-btn">
                <span class="add-icon">+</span>
                <span class="add-text">Add</span>
            </button>
        </div>
    </div>
</div>

<!-- Filter Panel Overlay -->
<div class="filter-overlay" id="filterOverlay"></div>

<style>
/* Filter Panel Styles */
.filter-panel {
    position: fixed;
    top: 0;
    right: -400px;
    width: 400px;
    height: 100vh;
    background: #ffffff;
    border-left: 1px solid #e5e7eb;
    box-shadow: -4px 0 12px rgba(0, 0, 0, 0.15);
    z-index: 1000;
    transition: right 0.3s ease-in-out;
    border-top-left-radius: 12px;
}

.filter-panel.open {
    right: 0;
}

.filter-panel-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 24px 24px 16px 24px;
    border-bottom: 1px solid #f3f4f6;
}

.filter-header-left {
    display: flex;
    align-items: center;
    gap: 12px;
}

.filter-icon {
    opacity: 0.7;
}

.filter-title {
    font-size: 18px;
    font-weight: 600;
    color: #374151;
    margin: 0;
}

.filter-close-btn {
    background: none:
    border: none;
    cursor: pointer;
    padding: 8px;
    border-radius: 6px;
    color: #6b7280;
    font-size: 14px;
    font-weight: 500;
    transition: background-color 0.2s ease;
}

.filter-close-btn:hover {
    background-color: #f9fafb;
}

.close-arrow {
    font-size: 12px;
    font-weight: bold;
}

.filter-content {
    padding: 24px;
    height: calc(100vh - 80px);
    overflow-y: auto;
}

.filter-section {
    margin-bottom: 32px;
}

.filter-section:last-child {
    margin-bottom: 0;
}

.filter-section-title {
    font-size: 14px;
    font-weight: 600;
    color: #374151;
    margin: 0 0 16px 0;
}

.filter-items {
    margin-bottom: 16px;
}

.filter-pill {
    display: inline-flex;
    align-items: center;
    background: #f9fafb;
    border: 1px solid #e5e7eb;
    border-radius: 20px;
    padding: 8px 12px 8px 16px;
    margin-right: 8px;
    margin-bottom: 8px;
    font-size: 13px;
    transition: all 0.2s ease;
    cursor: pointer;
}

.filter-pill:hover {
    background: #f3f4f6;
    border-color: #d1d5db;
}

.pill-text {
    color: #374151;
    font-weight: 400;
}

.pill-distance {
    color: #9ca3af;
    font-weight: 400;
    margin-left: 4px;
}

.pill-logic {
    color: #9ca3af;
    font-size: 12px;
    margin-left: 8px;
    font-weight: 400;
}

.add-filter-btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: none;
    border: none;
    color: #6b7280;
    font-size: 13px;
    cursor: pointer;
    padding: 4px 0;
    transition: color 0.2s ease;
}

.add-filter-btn:hover {
    color: #374151;
}

.add-icon {
    font-size: 12px;
    font-weight: bold;
}

.add-text {
    font-weight: 400;
}

/* Filter Overlay */
.filter-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.5);
    z-index: 999;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease-in-out;
}

.filter-overlay.active {
    opacity: 1;
    visibility: visible;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .filter-panel {
        width: 320px;
        right: -320px;
    }
}
</style>

<script>
// Filter Panel Management Module
class FilterPanelManager {
    constructor() {
        this.filterPanel = null;
        this.filterOverlay = null;
        this.filterCloseBtn = null;
        this.filterBtn = null;
        this.isInitialized = false;
        this.init();
    }
    
    init() {
        // Wait for DOM to be ready
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', () => this.setupElements());
        } else {
            this.setupElements();
        }
    }
    
    setupElements() {
        this.filterPanel = document.getElementById('filterPanel');
        this.filterOverlay = document.getElementById('filterOverlay');
        this.filterCloseBtn = document.getElementById('filterCloseBtn');
        
        // Try different selectors for filter button to be more flexible
        this.filterBtn = document.querySelector('.action-btn.edit-btn') || 
                        document.querySelector('[title="Filter"]') ||
                        document.querySelector('button[title="Edit"]');
        
        if (!this.filterPanel || !this.filterOverlay || !this.filterCloseBtn) {
            console.warn('Filter panel elements not found');
            return;
        }
        
        this.bindEvents();
        this.setupFilterPills();
        this.isInitialized = true;
        
        // Make instance globally available
        window.filterPanelManager = this;
        
        console.log('Filter panel initialized successfully');
    }
    
    bindEvents() {
        // Close events
        if (this.filterCloseBtn) {
            this.filterCloseBtn.addEventListener('click', (e) => {
                e.preventDefault();
                this.close();
            });
        }
        
        if (this.filterOverlay) {
            this.filterOverlay.addEventListener('click', (e) => {
                e.preventDefault();
                this.close();
            });
        }
        
        // Open event
        if (this.filterBtn) {
            this.filterBtn.addEventListener('click', (e) => {
                e.preventDefault();
                this.open();
            });
        }
        
        // Keyboard escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && this.isOpen()) {
                this.close();
            }
        });
    }
    
    setupFilterPills() {
        const filterPills = document.querySelectorAll('.filter-pill');
        
        filterPills.forEach(pill => {
            // Remove pill on click
            pill.addEventListener('click', (e) => {
                e.preventDefault();
                this.removeFilterPill(pill);
            });
            
            // Hover effects
            pill.addEventListener('mouseenter', () => {
                pill.style.transform = 'translateY(-1px)';
                pill.style.boxShadow = '0 2px 4px rgba(0, 0, 0, 0.1)';
            });
            
            pill.addEventListener('mouseleave', () => {
                pill.style.transform = 'translateY(0)';
                pill.style.boxShadow = 'none';
            });
        });
    }
    
    removeFilterPill(pill) {
        // Add visual feedback for removal
        pill.style.opacity = '0.5';
        pill.style.transform = 'scale(0.95)';
        
        setTimeout(() => {
            pill.remove();
        }, 200);
    }
    
    open() {
        if (!this.isInitialized) return false;
        
        this.filterPanel.classList.add('open');
        this.filterOverlay.classList.add('active');
        document.body.style.overflow = 'hidden';
        
        // Hide the filter button when panel is open
        if (this.filterBtn) {
            this.filterBtn.style.display = 'none';
        }
        
        // Trigger custom event
        document.dispatchEvent(new CustomEvent('filterPanelOpened'));
        
        return true;
    }
    
    close() {
        if (!this.isInitialized) return false;
        
        this.filterPanel.classList.remove('open');
        this.filterOverlay.classList.remove('active');
        document.body.style.overflow = '';
        
        // Show the filter button when panel is closed
        if (this.filterBtn) {
            this.filterBtn.style.display = 'flex';
        }
        
        // Trigger custom event
        document.dispatchEvent(new CustomEvent('filterPanelClosed'));
        
        return true;
    }
    
    toggle() {
        return this.isOpen() ? this.close() : this.open();
    }
    
    isOpen() {
        return this.filterPanel && this.filterPanel.classList.contains('open');
    }
    
    // Method to programmatically add filters
    addFilter(sectionType, filterValue, logic = 'OR') {
        const section = document.querySelector(`[data-section="${sectionType}"]`);
        if (!section) return false;
        
        const filterItems = section.querySelector('.filter-items') || section.querySelector('.filter-section .filter-items');
        if (!filterItems) return false;
        
        const newPill = document.createElement('div');
        newPill.className = 'filter-pill';
        newPill.innerHTML = `
            <span class="pill-text">${filterValue}</span>
            <span class="pill-logic">${logic}</span>
        `;
        
        // Bind events to new pill
        this.bindPillEvents(newPill);
        
        filterItems.appendChild(newPill);
        return true;
    }
    
    bindPillEvents(pill) {
        pill.addEventListener('click', (e) => {
            e.preventDefault();
            this.removeFilterPill(pill);
        });
        
        pill.addEventListener('mouseenter', () => {
            pill.style.transform = 'translateY(-1px)';
            pill.style.boxShadow = '0 2px 4px rgba(0, 0, 0, 0.1)';
        });
        
        pill.addEventListener('mouseleave', () => {
            pill.style.transform = 'translateY(0)';
            pill.style.boxShadow = 'none';
        });
    }
}

// Initialize when DOM is ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => {
        new FilterPanelManager();
    });
} else {
    new FilterPanelManager();
}

// Global helper functions for easy reuse
window.openFilterPanel = function() {
    return window.filterPanelManager ? window.filterPanelManager.open() : false;
};

window.closeFilterPanel = function() {
    return window.filterPanelManager ? window.filterPanelManager.close() : false;
};

window.toggleFilterPanel = function() {
    return window.filterPanelManager ? window.filterPanelManager.toggle() : false;
};
</script>
