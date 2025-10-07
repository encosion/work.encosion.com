<?php
// results-layout.php
// Common layout template for all candidate results pages
// Requires: $jsonFile variable to be set before including this file

$candidateData = null;

if (file_exists($jsonFile)) {
    $jsonContent = file_get_contents($jsonFile);
    $candidateData = json_decode($jsonContent, true);
}

// Fallback data if JSON file doesn't exist or is invalid
if (!$candidateData) {
    $candidateData = [
        'searchTitle' => 'Results',
        'searchDescription' => 'No candidate data available',
        'candidates' => []
    ];
}
?>

<div class="candidate-table-container">
    <div class="table-header">
        <div class="header-top">
            <h2><?php echo htmlspecialchars($candidateData['searchTitle']); ?></h2>
            <!-- <div class="header-controls">
                <div class="segmented-control">
                    <button class="segment-button active" data-segment="best-match">Best match</button>
                    <button class="segment-button" data-segment="broader">Broader</button>
                </div>
            </div> -->
            <div class="header-controls">
                <div class="action-buttons">
                    <!-- <button class="action-btn delete-btn" title="Delete">
                        <img src="images/icon-delete.svg" alt="Delete" width="17" height="17">
                    </button> -->
                    <button class="action-btn edit-btn" title="Edit">
                        <img src="images/icon-filters.svg" alt="Filter" width="16" height="16">
                        <span>Filter</span>
                    </button>
                </div>
            </div>
        </div>
        <p class="description"><?php echo $candidateData['searchDescription']; ?></p>
    </div>
    <div class="candidate-cards">
        <?php foreach ($candidateData['candidates'] as $candidate): ?>
        <div class="candidate-card" data-candidate-id="<?php echo $candidate['id']; ?>">
            <input type="checkbox" class="candidate-checkbox" id="candidate-<?php echo $candidate['id']; ?>">
            <div class="candidate-header">
                <div class="candidate-name">
                    <?php echo htmlspecialchars($candidate['name']); ?>
                    <?php if ($candidate['hasAttachment']): ?>
                    <img src="images/icon-attachment.svg" alt="CV/Resume" class="attachment-icon" width="16" height="16">
                    <?php endif; ?>
                    <div class="candidate-location"><?php echo htmlspecialchars($candidate['location']); ?></div>
                </div>
                <div class="rating"><?php echo htmlspecialchars($candidate['rating']); ?></div>
            </div>
            <div class="job-history">
                <?php foreach ($candidate['jobHistory'] as $job): ?>
                <div class="job-item">
                    <?php echo htmlspecialchars($job['title']); ?>, <?php echo htmlspecialchars($job['company']); ?> <span class="duration">(<?php echo htmlspecialchars($job['duration']); ?>)</span>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endforeach; ?>
        <!-- Selection Bar - inside candidate-cards for perfect width alignment -->
        <div class="selection-bar" id="selectionBar">
            <div class="selection-info">
                <div class="select-all-container">
                    <input type="checkbox" class="select-all-checkbox" id="selectAllCheckbox">
                    <label for="selectAllCheckbox" class="select-all-label">
                        <span class="selection-count" id="selectionCount">Select all</span>
                    </label>
                </div>
            </div>
            <div class="selection-actions">
                <button class="action-button secondary disabled" id="viewInPeopleBtn">View in People</button>
                <div class="dropdown-container">
                    <button class="action-button" id="addToBtn">Add to...</button>
                    <div class="dropdown-menu" id="addToDropdown">
                        <div class="dropdown-item" data-action="pool">
                            <img src="images/icon-pools.svg" alt="Pool" class="dropdown-icon">
                            <span>Add to pool...</span>
                        </div>
                        <div class="dropdown-item" data-action="vacancy">
                            <img src="images/icon-vacancies.svg" alt="Vacancy" class="dropdown-icon">
                            <span>Add to vacancy...</span>
                        </div>
                        <div class="dropdown-item" data-action="campaign">
                            <img src="images/icon-campaigns.svg" alt="Campaign" class="dropdown-icon">
                            <span>Add to campaign...</span>
                        </div>
                        <div class="dropdown-item" data-action="message">
                            <img src="images/icon-paperplane.svg" alt="Message" class="dropdown-icon">
                            <span>Send message...</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Panel Integration Script -->
    <script>
    // Initialize everything when content is loaded (for includes/fragments)
    (function() {
        console.log('Results layout loaded for <?php echo $pageName; ?>.php');
        
        // Initialize candidate selection with multiple attempts
        function initializeCandidateSelectionForIncludes() {
            console.log('Initializing candidate selection for includes...');
            
            const checkboxes = document.querySelectorAll('.candidate-checkbox');
            const selectionBar = document.getElementById('selectionBar');
            const selectionCount = document.getElementById('selectionCount');
            const candidateCards = document.querySelectorAll('.candidate-card');
            
            console.log('Found elements:', {
                checkboxes: checkboxes.length,
                selectionBar: !!selectionBar,
                selectionCount: !!selectionCount,
                candidateCards: candidateCards.length
            });
            
            if (checkboxes.length === 0) {
                console.log('No checkboxes found, retrying in 100ms...');
                setTimeout(initializeCandidateSelectionForIncludes, 100);
                return;
            }
            
            function updateSelection() {
                const checkedBoxes = document.querySelectorAll('.candidate-checkbox:checked');
                const count = checkedBoxes.length;
                const totalCount = checkboxes.length;
                
                // Update selection count
                if (count === 0) {
                    selectionCount.textContent = 'Select all';
                } else if (count === totalCount) {
                    selectionCount.textContent = `All selected (${totalCount})`;
                } else {
                    selectionCount.textContent = count === 1 ? '1 selected' : `${count} selected`;
                }
                
                // Update select all checkbox state
                const selectAllCheckbox = document.getElementById('selectAllCheckbox');
                if (selectAllCheckbox) {
                    if (count === 0) {
                        selectAllCheckbox.checked = false;
                        selectAllCheckbox.indeterminate = false;
                    } else if (count === totalCount) {
                        selectAllCheckbox.checked = true;
                        selectAllCheckbox.indeterminate = false;
                    } else {
                        selectAllCheckbox.checked = false;
                        selectAllCheckbox.indeterminate = true;
                    }
                }
                
                // Keep selection bar always visible
                selectionBar.style.display = 'flex';
                
                // Update card visual states
                candidateCards.forEach((card, index) => {
                    const checkbox = card.querySelector('.candidate-checkbox');
                    if (checkbox.checked) {
                        card.classList.add('selected');
                    } else {
                        card.classList.remove('selected');
                    }
                });
            }
            
            // Add event listeners to checkboxes
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', updateSelection);
            });
            
            // Add event listener to select all checkbox
            const selectAllCheckbox = document.getElementById('selectAllCheckbox');
            if (selectAllCheckbox) {
                selectAllCheckbox.addEventListener('change', function() {
                    const isChecked = this.checked;
                    
                    // Update all candidate checkboxes
                    checkboxes.forEach(checkbox => {
                        checkbox.checked = isChecked;
                    });
                    
                    // Update visual states
                    updateSelection();
                });
            }
            
            // Add click handlers to candidate cards for easier selection
            candidateCards.forEach(card => {
                card.addEventListener('click', function(e) {
                    // Don't trigger if clicking on the checkbox itself
                    if (e.target.classList.contains('candidate-checkbox')) {
                        return;
                    }
                    
                    const checkbox = card.querySelector('.candidate-checkbox');
                    checkbox.checked = !checkbox.checked;
                    updateSelection();
                });
            });
            
            // Action button handlers
            const viewInPeopleBtn = document.getElementById('viewInPeopleBtn');
            if (viewInPeopleBtn) {
                viewInPeopleBtn.addEventListener('click', function() {
                    const selectedIds = Array.from(document.querySelectorAll('.candidate-checkbox:checked'))
                        .map(checkbox => checkbox.id);
                    console.log('View in People:', selectedIds);
                    // TODO: Implement actual "View in People" functionality
                });
            }
            
            // Dropdown functionality
            const addToBtn = document.getElementById('addToBtn');
            const dropdown = document.getElementById('addToDropdown');

            if (addToBtn && dropdown) {
                addToBtn.addEventListener('click', function(e) {
                    console.log('Add to button clicked!');
                    e.stopPropagation();
                    dropdown.classList.toggle('show');
                });
                
                // Close dropdown when clicking outside
                if (!document.hasDropdownClickListener) {
                    document.addEventListener('click', function(e) {
                        if (!dropdown.contains(e.target) && !addToBtn.contains(e.target)) {
                            dropdown.classList.remove('show');
                        }
                    });
                    document.hasDropdownClickListener = true;
                }
                
                // Handle dropdown item clicks
                document.querySelectorAll('.dropdown-item').forEach(item => {
                    item.addEventListener('click', function() {
                        const action = this.getAttribute('data-action');
                        const selectedIds = Array.from(document.querySelectorAll('.candidate-checkbox:checked'))
                            .map(checkbox => checkbox.id);
                        
                        console.log(`Add to ${action}:`, selectedIds);
                        
                        // Hide dropdown after selection
                        dropdown.classList.remove('show');
                        
                        // TODO: Implement actual "Add to ${action}" functionality
                    });
                });
            }
            
            console.log('Candidate selection initialized successfully for <?php echo $pageName; ?>');
        }
        
        // Try to initialize immediately
        initializeCandidateSelectionForIncludes();
        
        // Also try on DOMContentLoaded if page is fully loaded
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', function() {
                // Wait a bit for includes to be processed
                setTimeout(initializeCandidateSelectionForIncludes, 100);
            });
        }
        
        // Initialize filter panel integration
        if (window.filterPanelManager) {
            console.log('Filter panel integrated with <?php echo $pageName; ?>.php');
        } else {
            setTimeout(() => {
                if (window.filterPanelManager) {
                    console.log('Filter panel integrated with <?php echo $pageName; ?>.php (delayed)');
                }
            }, 100);
        }
        
        // Listen for filter panel events if needed
        document.addEventListener('filterPanelOpened', function() {
            console.log('Filter panel opened on <?php echo $pageName; ?> page');
        });
        
        document.addEventListener('filterPanelClosed', function() {
            console.log('Filter panel closed on <?php echo $pageName; ?> page');
        });
    })();
    </script>
</div>
