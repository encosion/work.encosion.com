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
        
        // Update selection count
        selectionCount.textContent = count === 1 ? '1 selected' : `${count} selected`;
        
        // Show/hide selection bar
        if (count > 0) {
            selectionBar.style.display = 'flex';
        } else {
            selectionBar.style.display = 'none';
        }
        
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
    document.getElementById('viewInPeopleBtn').addEventListener('click', function() {
        const selectedIds = Array.from(document.querySelectorAll('.candidate-checkbox:checked'))
            .map(checkbox => checkbox.id);
        console.log('View in People:', selectedIds);
        alert(`View in People: ${selectedIds.join(', ')}`);
    });
    
    // Dropdown functionality
    const addToBtn = document.getElementById('addToBtn');
    const dropdown = document.getElementById('addToDropdown');
    
    addToBtn.addEventListener('click', function(e) {
        e.stopPropagation();
        dropdown.classList.toggle('show');
    });
    
    // Close dropdown when clicking outside
    document.addEventListener('click', function(e) {
        if (!dropdown.contains(e.target) && !addToBtn.contains(e.target)) {
            dropdown.classList.remove('show');
        }
    });
    
    // Handle dropdown item clicks
    document.querySelectorAll('.dropdown-item').forEach(item => {
        item.addEventListener('click', function() {
            const action = this.getAttribute('data-action');
            const selectedIds = Array.from(document.querySelectorAll('.candidate-checkbox:checked'))
                .map(checkbox => checkbox.id);
            
            console.log(`Add to ${action}:`, selectedIds);
            
            // Hide dropdown after selection
            dropdown.classList.remove('show');
            
            // Show alert for demo purposes
            alert(`Add to ${action}: ${selectedIds.join(', ')}`);
        });
    });
}

// Always define the function, even if script loads multiple times
console.log('Candidate selection script executing...');

// Try to initialize immediately (for when script loads after HTML)
window.initializeCandidateSelection();

// Also try on DOMContentLoaded (for standalone pages)
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOMContentLoaded fired, initializing candidate selection...');
    window.initializeCandidateSelection();
    initializeSegmentedControl();
    initializeActionButtons();
});

// Initialize segmented control functionality
function initializeSegmentedControl() {
    const segmentButtons = document.querySelectorAll('.segment-button');
    
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
    }
    
    if (editBtn) {
        editBtn.addEventListener('click', function() {
            console.log('Edit button clicked');
            // Add edit functionality here
            // For example: open edit modal, modify search criteria, etc.
        });
    }
}
