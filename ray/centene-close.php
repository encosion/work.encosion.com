<?php
// search_results.php
// Dynamic candidate table HTML for recruitment search results

// Include loading spinner
include 'includes/loading-spinner.php';

// Include filter panel
include 'includes/filters.php';

// Load candidate data from JSON file
$jsonFile = 'centene-close.json';
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
            <div class="candidate-location"><?php echo htmlspecialchars($candidate['location']); ?></div>
        </div>
        <?php endforeach; ?>
    </div>
    
    <!-- Selection Bar - now inside candidate-table-container for CSS alignment -->
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
            <button class="action-button primary" id="addToBtn">Add to...</button>
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

<!-- Filter Panel Integration Script -->
<script>
// Simple wrapper to ensure filter panel works with this results page
document.addEventListener('DOMContentLoaded', function() {
    // Wait for filter panel to be initialized
    if (window.filterPanelManager) {
        console.log('Filter panel integrated with centene-close.php');
    } else {
        // Fallback: check if filter panel exists and initialize
        setTimeout(() => {
            if (window.filterPanelManager) {
                console.log('Filter panel integrated with centene-close.php (delayed)');
            }
        }, 100);
    }
    
    // Listen for filter panel events if needed
    document.addEventListener('filterPanelOpened', function() {
        console.log('Filter panel opened on centene-close page');
    });
    
    document.addEventListener('filterPanelClosed', function() {
        console.log('Filter panel closed on centene-close page');
    });
});
</script>

<!-- Script loading handled by app.js dynamically -->
