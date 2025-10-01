/**
 * Candidate Selection JavaScript
 * Handles the interactive candidate selection functionality
 * Extracted from working search_results.html
 */

window.initializeCandidateSelection = function initializeCandidateSelection() {
    console.log('Initializing candidate selection...');
    
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
        setTimeout(initializeCandidateSelection, 100);
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
    } else {
        console.log('View in People button not found');
    }
    
    // Dropdown functionality
    const addToBtn = document.getElementById('addToBtn');
    const dropdown = document.getElementById('addToDropdown');

    console.log('Dropdown elements found:', {
        addToBtn: !!addToBtn,
        dropdown: !!dropdown,
        addToBtnElement: addToBtn,
        dropdownElement: dropdown
    });

    if (addToBtn && dropdown) {
        addToBtn.addEventListener('click', function(e) {
            console.log('Add to button clicked!');
            e.stopPropagation();
            dropdown.classList.toggle('show');
            console.log('Dropdown show class toggled. Current classes:', dropdown.className);
        });
        
        // Close dropdown when clicking outside (only add once)
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
    } else {
        console.log('Dropdown elements not found:', {
            addToBtn: !!addToBtn,
            dropdown: !!dropdown
        });
    }
}

// Prevent multiple initializations
let isInitialized = false;

// Always define the function, even if script loads multiple times
console.log('Candidate selection script executing...');

// Try to initialize immediately (for when script loads after HTML)
if (!isInitialized) {
    window.initializeCandidateSelection();
    isInitialized = true;
}

// Also try on DOMContentLoaded (for standalone pages)
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOMContentLoaded fired, initializing candidate selection...');
    if (!isInitialized) {
        window.initializeCandidateSelection();
        initializeSegmentedControl();
        initializeActionButtons();
        isInitialized = true;
    }
});

// Initialize segmented control functionality
function initializeSegmentedControl() {
    const segmentButtons = document.querySelectorAll('.segment-button');
    
    if (segmentButtons.length === 0) {
        console.log('No segmented control buttons found, skipping initialization');
        return;
    }
    
    segmentButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Remove active class from all buttons
            segmentButtons.forEach(btn => btn.classList.remove('active'));
            
            // Add active class to clicked button
            this.classList.add('active');
            
            // Get the segment type
            const segmentType = this.getAttribute('data-segment');
            console.log('Selected segment:', segmentType);
            
            // Here you can add logic to filter results based on segment type
            // For now, we'll just log the selection
        });
    });
}

// Initialize action buttons functionality
function initializeActionButtons() {
    const deleteBtn = document.querySelector('.delete-btn');
    const editBtn = document.querySelector('.edit-btn');
    
    if (deleteBtn) {
        deleteBtn.addEventListener('click', function() {
            console.log('Delete button clicked');
            // Add delete functionality here
            // For example: confirm deletion, remove results, etc.
        });
    } else {
        console.log('Delete button not found, skipping initialization');
    }
    
    if (editBtn) {
        editBtn.addEventListener('click', function() {
            console.log('Edit button clicked');
            // Add edit functionality here
            // For example: open edit modal, modify search criteria, etc.
        });
    } else {
        console.log('Edit button not found, skipping initialization');
    }
}
