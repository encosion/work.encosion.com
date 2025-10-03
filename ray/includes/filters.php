<!-- Filter Panel -->
<div class="filter-panel" id="filterPanel">
    <div class="filter-panel-header">
        <div class="filter-header-left">
            <img src="images/icon-filters.svg" alt="Filters" class="filter-icon" width="16" height="16">
            <h2 class="filter-title">Filters</h2>
        </div>
        <button class="filter-close-btn" id="filterCloseBtn" title="Close filters">
            <img src="images/icon-double-caret-right.svg" alt="Close filters" width="17" height="16">
        </button>
    </div>
    
    <div class="filter-content">
        <!-- Job Role Section -->
        <div class="filter-section">
            <h3 class="filter-section-title">Job role</h3>
            <div class="filter-items">
                <?php if (isset($searchCriteria['jobRoles']) && !empty($searchCriteria['jobRoles'])): ?>
                    <?php foreach ($searchCriteria['jobRoles'] as $index => $jobRole): ?>
                        <div class="filter-item-wrapper">
                            <div class="filter-pill">
                                <span class="pill-text"><?php echo htmlspecialchars($jobRole); ?></span>
                            </div>
                            <?php if ($index < count($searchCriteria['jobRoles']) - 1): ?>
                                <span class="pill-logic">OR</span>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                <?php elseif (!isset($searchCriteria['jobRoles'])): ?>
                    <div class="filter-item-wrapper">
                        <div class="filter-pill">
                            <span class="pill-text">Senior Product Owner</span>
                        </div>
                        <span class="pill-logic">OR</span>
                    </div>
                    <div class="filter-item-wrapper">
                        <div class="filter-pill">
                            <span class="pill-text">Sr. Product Owner</span>
                        </div>
                        <span class="pill-logic">OR</span>
                    </div>
                    <div class="filter-item-wrapper">
                        <div class="filter-pill">
                            <span class="pill-text">Lead Product Owner</span>
                        </div>
                        <span class="pill-logic">OR</span>
                    </div>
                <?php endif; ?>
            </div>
            <button class="add-filter-btn">
                <img src="images/icon-add.svg" alt="Add" class="add-icon" width="13" height="12">
                <span class="add-text">Add</span>
            </button>
            <input type="text" class="add-filter-input hidden" placeholder="Enter new job role...">
        </div>

        <!-- Core Skills Section -->
        <div class="filter-section">
            <h3 class="filter-section-title">Core skills</h3>
            <div class="filter-items">
                <?php if (isset($searchCriteria['coreSkills']) && !empty($searchCriteria['coreSkills'])): ?>
                    <?php foreach ($searchCriteria['coreSkills'] as $index => $skill): ?>
                        <div class="filter-item-wrapper">
                            <div class="filter-pill">
                                <span class="pill-text"><?php echo htmlspecialchars($skill); ?></span>
                            </div>
                            <?php if ($index < count($searchCriteria['coreSkills']) - 1): ?>
                                <span class="pill-logic">AND</span>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                <?php elseif (!isset($searchCriteria['coreSkills'])): ?>
                    <div class="filter-item-wrapper">
                        <div class="filter-pill">
                            <span class="pill-text">DevSecOps Practices</span>
                        </div>
                        <span class="pill-logic">AND</span>
                    </div>
                    <div class="filter-item-wrapper">
                        <div class="filter-pill">
                            <span class="pill-text">Application Security</span>
                        </div>
                        <span class="pill-logic">AND</span>
                    </div>
                    <div class="filter-item-wrapper">
                        <div class="filter-pill">
                            <span class="pill-text">Security Automation</span>
                        </div>
                        <span class="pill-logic">AND</span>
                    </div>
                <?php endif; ?>
            </div>
            <button class="add-filter-btn">
                <img src="images/icon-add.svg" alt="Add" class="add-icon" width="13" height="12">
                <span class="add-text">Add</span>
            </button>
            <input type="text" class="add-filter-input hidden" placeholder="Enter new core skill...">
        </div>

        <!-- Locations Section -->
        <div class="filter-section">
            <h3 class="filter-section-title">Locations</h3>
            <div class="filter-items">
                <?php if (isset($searchCriteria['locations']) && !empty($searchCriteria['locations'])): ?>
                    <?php foreach ($searchCriteria['locations'] as $index => $location): ?>
                        <div class="filter-item-wrapper">
                            <div class="filter-pill">
                                <span class="pill-text"><?php echo htmlspecialchars($location); ?></span>
                            </div>
                            <?php if ($index < count($searchCriteria['locations']) - 1): ?>
                                <span class="pill-logic">OR</span>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                <?php elseif (!isset($searchCriteria['locations'])): ?>
                    <div class="filter-item-wrapper">
                        <div class="filter-pill">
                            <span class="pill-text">Wealden, England, United Kingdom <span class="pill-distance">50 mi</span></span>
                        </div>
                        <span class="pill-logic">OR</span>
                    </div>
                    <div class="filter-item-wrapper">
                        <div class="filter-pill">
                            <span class="pill-text">Berlin, Germany <span class="pill-distance">30 mi</span></span>
                        </div>
                        <span class="pill-logic">OR</span>
                    </div>
                <?php endif; ?>
            </div>
            <button class="add-filter-btn">
                <img src="images/icon-add.svg" alt="Add" class="add-icon" width="13" height="12">
                <span class="add-text">Add</span>
            </button>
            <input type="text" class="add-filter-input hidden" placeholder="Enter new location...">
        </div>

        <!-- Ideal Companies Section -->
        <div class="filter-section">
            <h3 class="filter-section-title">Ideal companies</h3>
            <div class="filter-items">
                <?php if (isset($searchCriteria['idealCompanies']) && !empty($searchCriteria['idealCompanies'])): ?>
                    <?php foreach ($searchCriteria['idealCompanies'] as $index => $company): ?>
                        <div class="filter-item-wrapper">
                            <div class="filter-pill">
                                <span class="pill-text"><?php echo htmlspecialchars($company); ?></span>
                            </div>
                            <?php if ($index < count($searchCriteria['idealCompanies']) - 1): ?>
                                <span class="pill-logic">OR</span>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                <?php elseif (!isset($searchCriteria['idealCompanies'])): ?>
                    <div class="filter-item-wrapper">
                        <div class="filter-pill">
                            <span class="pill-text">Bioserenity</span>
                        </div>
                        <span class="pill-logic">OR</span>
                    </div>
                    <div class="filter-item-wrapper">
                        <div class="filter-pill">
                            <span class="pill-text">Doctolib</span>
                        </div>
                        <span class="pill-logic">OR</span>
                    </div>
                    <div class="filter-item-wrapper">
                        <div class="filter-pill">
                            <span class="pill-text">Withings</span>
                        </div>
                        <span class="pill-logic">OR</span>
                    </div>
                    <div class="filter-item-wrapper">
                        <div class="filter-pill">
                            <span class="pill-text">Owkin</span>
                        </div>
                        <span class="pill-logic">OR</span>
                    </div>
                    <div class="filter-item-wrapper">
                        <div class="filter-pill">
                            <span class="pill-text">Therapixel</span>
                        </div>
                        <span class="pill-logic">OR</span>
                    </div>
                    <div class="filter-item-wrapper">
                        <div class="filter-pill">
                            <span class="pill-text">Beamery</span>
                        </div>
                        <span class="pill-logic">OR</span>
                    </div>
                    <div class="filter-item-wrapper">
                        <div class="filter-pill">
                            <span class="pill-text">Phenom</span>
                        </div>
                        <span class="pill-logic">OR</span>
                    </div>
                <?php endif; ?>
            </div>
            <button class="add-filter-btn">
                <img src="images/icon-add.svg" alt="Add" class="add-icon" width="13" height="12">
                <span class="add-text">Add</span>
            </button>
            <input type="text" class="add-filter-input hidden" placeholder="Enter new company...">
        </div>
    </div>
</div>

<!-- Filter Panel Overlay -->
<div class="filter-overlay" id="filterOverlay"></div>

<script>
// Check if FilterPanelManager is already declared
if (typeof FilterPanelManager === 'undefined') {
    // Filter Panel Management Module
    class FilterPanelManager {
    constructor() {
        this.filterPanel = null;
        this.filterOverlay = null;
        this.filterCloseBtn = null;
        this.filterBtn = null;
        this.isInitialized = false;
        
        // Clean up any existing instance first
        if (window.filterPanelManager) {
            window.filterPanelManager.destroy();
        }
        
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
                        document.querySelector('button[title="Edit"]') ||
                        document.querySelector('.action-btn[title="Edit"]') ||
                        document.querySelector('button:has(img[alt="Filter"])');
        
        if (!this.filterPanel) {
            console.warn('Filter panel element not found');
            return;
        }
        
        if (!this.filterCloseBtn) {
            console.warn('Filter close button not found');
            return;
        }
        
        console.log('Filter panel elements found:', {
            panel: !!this.filterPanel,
            closeBtn: !!this.filterCloseBtn,
            filterBtn: !!this.filterBtn,
            overlay: !!this.filterOverlay
        });
        
        this.bindEvents();
        this.setupFilterPills();
        this.setupAddButtons();
        this.isInitialized = true;
        
        // Make instance globally available
        window.filterPanelManager = this;
        
        console.log('Filter panel initialized successfully');
    }
    
    destroy() {
        // Clean up event listeners
        this.isInitialized = false;
        window.filterPanelManager = null;
        console.log('Filter panel destroyed');
    }
    
    bindEvents() {
        // Close events
        if (this.filterCloseBtn) {
            this.filterCloseBtn.addEventListener('click', (e) => {
                e.preventDefault();
                this.close();
            });
        }
        
        // No overlay for integrated layout - clicking outside handled by escape key
        
        // Open event
        if (this.filterBtn) {
            this.filterBtn.addEventListener('click', (e) => {
                e.preventDefault();
                this.open();
            });
            console.log('Filter button event listener attached');
        } else {
            console.warn('Filter button not found - panel can only be closed via close button');
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
                this.removeFilterPillAndLogic(pill);
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
    
    setupAddButtons() {
        const addButtons = document.querySelectorAll('.add-filter-btn');
        const addInputs = document.querySelectorAll('.add-filter-input');
        
        addButtons.forEach((button, index) => {
            button.addEventListener('click', (e) => {
                e.preventDefault();
                this.showAddInput(button, addInputs[index]);
            });
        });
        
        addInputs.forEach((input, index) => {
            input.addEventListener('keydown', (e) => {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    this.addNewFilter(input, index);
                } else if (e.key === 'Escape') {
                    e.preventDefault();
                    this.hideAddInput(input, addButtons[index]);
                }
            });
            
            input.addEventListener('blur', (e) => {
                // Small delay to allow for clicking on the created pill
                setTimeout(() => {
                    this.hideAddInput(input, addButtons[index]);
                }, 150);
            });
        });
    }
    
    showAddInput(button, input) {
        button.classList.add('hidden');
        input.classList.remove('hidden');
        input.focus();
    }
    
    hideAddInput(input, button) {
        input.classList.add('hidden');
        button.classList.remove('hidden');
        input.value = '';
    }
    
    addNewFilter(input, sectionIndex) {
        const text = input.value.trim();
        if (!text) return;
        
        // Find the section this input belongs to
        const section = input.closest('.filter-section');
        if (!section) return;
        
        // Find the filter items container
        const filterItems = section.querySelector('.filter-items');
        if (!filterItems) return;
        
        // Determine the logic type based on section
        let logic = 'OR'; // default
        const existingLogic = section.querySelector('.pill-logic');
        if (existingLogic && existingLogic.textContent.trim() === 'AND') {
            logic = 'AND';
        }
        
        // Create new filter item wrapper
        const wrapper = document.createElement('div');
        wrapper.className = 'filter-item-wrapper';
        wrapper.innerHTML = `
            <div class="filter-pill">
                <span class="pill-text">${text}</span>
            </div>
            <span class="pill-logic">${logic}</span>
        `;
        
        // Add to filter items
        filterItems.appendChild(wrapper);
        
        // Bind events to new pill
        const newPill = wrapper.querySelector('.filter-pill');
        this.bindPillEvents(newPill);
        
        // Clear input and hide it
        input.value = '';
        this.hideAddInput(input, section.querySelector('.add-filter-btn'));
        
        // Add visual feedback
        wrapper.style.opacity = '0';
        wrapper.style.transform = 'scale(0.9)';
        setTimeout(() => {
            wrapper.style.transition = 'all 0.3s ease';
            wrapper.style.opacity = '1';
            wrapper.style.transform = 'scale(1)';
        }, 50);
    }
    
    removeFilterPillAndLogic(pill) {
        // Find the wrapper that contains both the pill and the logic indicator
        const wrapper = pill.closest('.filter-item-wrapper');
        
        if (wrapper) {
            // Add visual feedback for removal
            wrapper.style.opacity = '0.5';
            wrapper.style.transform = 'scale(0.95)';
            
            setTimeout(() => {
                wrapper.remove();
            }, 200);
        } else {
            // Fallback: remove just the pill if wrapper not found
            pill.style.opacity = '0.5';
            pill.style.transform = 'scale(0.95)';
            
            setTimeout(() => {
                pill.remove();
            }, 200);
        }
    }
    
    removeFilterPill(pill) {
        // Legacy method - now calls the new method
        this.removeFilterPillAndLogic(pill);
    }
    
    open() {
        if (!this.isInitialized) return false;
        
        this.filterPanel.classList.add('open');
        
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
            this.removeFilterPillAndLogic(pill);
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
    
    // Make class globally available
    window.FilterPanelManager = FilterPanelManager;
}

// Initialize when DOM is ready - only once
if (!window.filterPanelInitialized && window.FilterPanelManager) {
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', () => {
            new window.FilterPanelManager();
            window.filterPanelInitialized = true;
        });
    } else {
        new window.FilterPanelManager();
        window.filterPanelInitialized = true;
    }
} else if (window.filterPanelInitialized && window.FilterPanelManager) {
    // If already initialized, just recreate the instance
    new window.FilterPanelManager();
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
