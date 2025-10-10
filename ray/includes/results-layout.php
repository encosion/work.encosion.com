<?php
// results-layout.php
// Common layout template for all candidate results pages
// Requires: $jsonFile variable to be set before including this file

$candidateData = null;

if (file_exists($jsonFile)) {
    $jsonContent = file_get_contents($jsonFile);
    $candidateData = json_decode($jsonContent, true);
}

// For hover component, always use exact.json data
$hoverData = null;
// More robust path resolution - replace the filename with exact.json
$exactJsonPath = dirname($jsonFile) . '/exact.json';
if (file_exists($exactJsonPath)) {
    $exactJsonContent = file_get_contents($exactJsonPath);
    $hoverData = json_decode($exactJsonContent, true);
} else {
    // Debug: show what paths we're trying
    $hoverData = ['debug' => 'exactJsonPath: ' . $exactJsonPath . ' | original: ' . $jsonFile];
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
                    <img src="/ray/images/icon-attachment.svg" alt="CV/Resume" class="attachment-icon" width="16" height="16">
                    <?php endif; ?>
                    <div class="candidate-location"><?php echo htmlspecialchars($candidate['location']); ?></div>
                </div>
                <div class="rating" data-rating-hover>
                    <?php echo htmlspecialchars($candidate['rating']); ?>
                    <div class="rating-hover-tooltip">
                        <div class="tooltip-content">
                            <h3>Match score explained</h3>
                            <p>Each candidate is weighed against the following criteria defined by your organisation:</p>
                            <div class="criteria-list">
                                <div class="criteria-item">
                                    <span class="criteria-label">Role:</span>
                                    <span class="criteria-value"><?php echo isset($hoverData['searchCriteria']['jobRoles'][0]) ? htmlspecialchars($hoverData['searchCriteria']['jobRoles'][0]) : 'Not specified'; ?></span>
                                </div>
                                <div class="criteria-item">
                                    <span class="criteria-label">Seniority:</span>
                                    <span class="criteria-value"><?php echo isset($hoverData['searchCriteria']['seniority'][0]) ? htmlspecialchars($hoverData['searchCriteria']['seniority'][0]) : 'Not specified'; ?></span>
                                </div>
                                <div class="criteria-item">
                                    <span class="criteria-label">Skills:</span>
                                    <span class="criteria-value"><?php echo isset($hoverData['searchCriteria']['coreSkills']) ? implode(', ', $hoverData['searchCriteria']['coreSkills']) : 'Not specified'; ?></span>
                                </div>
                                <div class="criteria-item">
                                    <span class="criteria-label">Industry:</span>
                                    <span class="criteria-value"><?php echo isset($hoverData['searchCriteria']['industries']) ? implode(', ', $hoverData['searchCriteria']['industries']) : 'Not specified'; ?></span>
                                </div>
                                <div class="criteria-item">
                                    <span class="criteria-label">Org size:</span>
                                    <span class="criteria-value"><?php echo isset($hoverData['searchCriteria']['orgSize'][0]) ? htmlspecialchars($hoverData['searchCriteria']['orgSize'][0]) : 'Not specified'; ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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

    <!-- Profile Overlay -->
    <div class="profile-overlay" id="profileOverlay">
        <div class="profile-overlay-content">
            <!-- Profile Header -->
            <div class="profile-header">
                <div class="profile-name-section">
                    <button class="profile-action-btn" id="profileCloseBtn">
                        <img src="/ray/images/icon-close.svg" alt="Close" width="16" height="16">
                    </button>
                    <h1 class="profile-name" id="profileName">Jane Cooper</h1>
                </div>
                
                <div class="profile-actions">
                    <button class="profile-action-btn">
                        <img src="/ray/images/icon-more.svg" alt="More" width="16" height="16">
                    </button>
                    <button class="profile-action-btn">
                        <img src="/ray/images/icon-tasks.svg" alt="Tasks" width="16" height="16">
                    </button>
                    <button class="profile-action-btn">
                        <img src="/ray/images/icon-download.svg" alt="Download" width="16" height="16">
                    </button>
                    <button class="profile-share-btn">Share</button>
                </div>
            </div>
            
            <!-- Profile Details -->
            <div class="profile-details">
                <div class="profile-detail-item">
                    <span id="profileJobTitle">Backend Developer, Stripe • Berlin, Germany</span>
                </div>
                <div class="profile-detail-item">
                    <span>j.coops+findajob@gmail.com • 962 (6)555 5555 55 ext 123 (Work)</span>
                </div>
            </div>
            
            <!-- Contact Status Tags -->
            <div class="profile-tags">
                <span class="profile-tag">OK to contact</span>
                <span class="profile-tag">Consent received</span>
            </div>
            
            <!-- Navigation Tabs -->
            <div class="profile-tabs">
                <button class="profile-tab active" data-tab="overview">Overview</button>
                <button class="profile-tab" data-tab="custom-fields">Custom fields</button>
                <button class="profile-tab" data-tab="resume">Resume</button>
                <button class="profile-tab" data-tab="linkedin">LinkedIn</button>
            </div>
            
            <!-- Profile Content -->
            <div class="profile-content">
                <!-- Overview Tab Content -->
                <div class="profile-tab-content active" id="overview-content">
                    <!-- About Section -->
                    <div class="profile-section">
                        <div class="profile-section-header">
                            <h2>About</h2>
                        </div>
                        <div class="profile-subsection">
                            <div class="profile-subsection-header">
                                <h3>Summary</h3>
                                <button class="profile-edit-btn">
                                    <img src="/ray/images/icon-edit.svg" alt="Edit" width="16" height="16">
                                </button>
                            </div>
                            <p>Experienced in designing and implementing high-impact programs to advance the UN's Sustainable Development Goals. Skilled in project management, policy advisory, and building partnerships with governments, NGOs, and the private sector. Focused on poverty alleviation, economic empowerment, and crisis response, with a passion for creating sustainable change and empowering communities globally.</p>
                        </div>
                    </div>
                    
                    <!-- Skills Section -->
                    <div class="profile-section">
                        <div class="profile-section-header">
                            <h2>Skills</h2>
                            <button class="profile-add-btn">
                                <img src="/ray/images/icon-add.svg" alt="Add" width="16" height="16">
                            </button>
                        </div>
                        
                        <!-- Declared Skills -->
                        <div class="profile-subsection">
                            <div class="profile-subsection-header">
                                <h3>Declared</h3>
                                <span class="skill-count">18</span>
                            </div>
                            <p>Skills declared by the contact in their CV/resume or application.</p>
                            <div class="skill-tags">
                                <span class="skill-tag">Budget Management</span>
                                <span class="skill-tag">Capacity Building</span>
                                <span class="skill-tag">Compliance and Risk Management</span>
                                <span class="skill-tag">Crisis Management</span>
                                <span class="skill-tag">Cultural Competency</span>
                                <span class="skill-tag">Data Analysis and Reporting</span>
                                <span class="skill-tag">Geopolitical Awareness</span>
                                <span class="skill-tag">Grant Writing and Fundraising</span>
                                <span class="skill-tag">Knowledge of International Humanitarian Law</span>
                                <span class="skill-tag">Language Proficiency</span>
                                <span class="skill-tag">Monitoring and Evaluation (M&E)</span>
                                <span class="skill-tag">Needs Assessment</span>
                                <span class="skill-tag">Policy Analysis and Advocacy</span>
                                <span class="skill-tag">Program Design and Implementation</span>
                                <span class="skill-tag">Project Management</span>
                                <span class="skill-tag">Stakeholder Engagement</span>
                                <span class="skill-tag">Supply Chain and Logistics</span>
                                <span class="skill-tag">Technical Expertise</span>
                            </div>
                        </div>
                        
                        <!-- Suggested Skills -->
                        <div class="profile-subsection">
                            <div class="profile-subsection-header">
                                <h3>Suggested</h3>
                                <span class="skill-count">8</span>
                            </div>
                            <p>Skills suggested by <span class="beamery-ai">Beamery AI</span> based on the contact's primary job title.</p>
                            <div class="skill-tags suggested">
                                <span class="skill-tag suggested">Problem-solving</span>
                                <span class="skill-tag suggested">Program Evaluation</span>
                                <span class="skill-tag suggested">Project Management</span>
                                <span class="skill-tag suggested">Report Generation</span>
                                <span class="skill-tag suggested">Risk Management</span>
                                <span class="skill-tag suggested">Stakeholder Engagement</span>
                                <span class="skill-tag suggested">Strategic Planning</span>
                                <span class="skill-tag suggested">Technical Writing</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Experience Section -->
                    <div class="profile-section">
                        <div class="profile-section-header">
                            <h2>Experience</h2>
                            <button class="profile-add-btn">
                                <img src="/ray/images/icon-add.svg" alt="Add" width="16" height="16">
                            </button>
                        </div>
                        
                        <div class="experience-item">
                            <div class="experience-company">United Nations</div>
                            <div class="experience-duration">2013 - Present (11y)</div>
                            
                            <div class="experience-role">
                                <div class="experience-role-header">
                                    <h4>Senior International Humanitarian Development Specialist</h4>
                                    <button class="profile-action-btn">
                                        <img src="/ray/images/icon-more.svg" alt="More" width="16" height="16">
                                    </button>
                                </div>
                                <div class="experience-role-details">Jan 2022 - Present (1y 2m) • Full time</div>
                                <p>Experienced in designing and implementing high-impact programs to advance the UN's Sustainable Development Goals. Skilled in project management, policy advisory, and building partnerships with governments, NGOs, and the private sector.</p>
                            </div>
                            
                            <div class="experience-role">
                                <div class="experience-role-header">
                                    <h4>International Development Specialist</h4>
                                    <button class="profile-action-btn">
                                        <img src="/ray/images/icon-more.svg" alt="More" width="16" height="16">
                                    </button>
                                </div>
                                <div class="experience-role-details">Apr 2013 - Jan 2022 (9y 11m) • Full time</div>
                                <p>Focused on poverty alleviation, economic empowerment, and crisis response, with a passion for creating sustainable change and empowering communities globally.</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Education Section -->
                    <div class="profile-section">
                        <div class="profile-section-header">
                            <h2>Education</h2>
                            <button class="profile-add-btn">
                                <img src="/ray/images/icon-add.svg" alt="Add" width="16" height="16">
                            </button>
                        </div>
                        
                        <div class="education-item">
                            <div class="education-institution">Birzeit University</div>
                            <div class="education-duration">Diplomatic Relations,Master • Jan 2025 - Jan 2028</div>
                        </div>
                    </div>
                    
                    <!-- Locations Section -->
                    <div class="profile-section">
                        <div class="profile-section-header">
                            <h2>Locations</h2>
                            <button class="profile-add-btn">
                                <img src="/ray/images/icon-add.svg" alt="Add" width="16" height="16">
                            </button>
                        </div>
                        
                        <div class="location-item">
                            <span class="location-tag">Los Angeles, California, USA</span>
                        </div>
                    </div>
                    
                    <!-- Languages Section -->
                    <div class="profile-section">
                        <div class="profile-section-header">
                            <h2>Languages</h2>
                            <button class="profile-add-btn">
                                <img src="/ray/images/icon-add.svg" alt="Add" width="16" height="16">
                            </button>
                        </div>
                        
                        <div class="language-tags">
                            <span class="language-tag">American English • Fluent</span>
                            <span class="language-tag">French • Proficient</span>
                        </div>
                    </div>
                </div>
                
                <!-- Other tab contents would go here -->
                <div class="profile-tab-content" id="custom-fields-content">
                    <p>Custom fields content would go here.</p>
                </div>
                
                <div class="profile-tab-content" id="resume-content">
                    <p>Resume content would go here.</p>
                </div>
                
                <div class="profile-tab-content" id="linkedin-content">
                    <p>LinkedIn content would go here.</p>
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
        
        // Initialize Profile Overlay
        function initializeProfileOverlay() {
            const profileOverlay = document.getElementById('profileOverlay');
            const profileCloseBtn = document.getElementById('profileCloseBtn');
            const candidateCards = document.querySelectorAll('.candidate-card');
            const candidateNames = document.querySelectorAll('.candidate-name');
            const attachmentIcons = document.querySelectorAll('.attachment-icon');
            const profileTabs = document.querySelectorAll('.profile-tab');
            const profileTabContents = document.querySelectorAll('.profile-tab-content');
            
            // Close overlay function
            function closeProfileOverlay() {
                profileOverlay.classList.remove('open');
                document.body.style.overflow = '';
            }
            
            // Open overlay function
            function openProfileOverlay(candidateData) {
                // Populate overlay with candidate data
                document.getElementById('profileName').textContent = candidateData.name;
                
                // Update the consolidated job title and company info
                const jobTitleElement = document.getElementById('profileJobTitle');
                if (jobTitleElement) {
                    const jobTitle = candidateData.jobTitle || 'Backend Developer';
                    const company = candidateData.company || 'Stripe';
                    const location = candidateData.location || 'Berlin, Germany';
                    jobTitleElement.textContent = `${jobTitle}, ${company} • ${location}`;
                }
                
                // Show overlay
                profileOverlay.classList.add('open');
                document.body.style.overflow = 'hidden';
            }
            
            // Ensure overlay starts closed
            profileOverlay.classList.remove('open');
            
            // Close button event listener
            if (profileCloseBtn) {
                profileCloseBtn.addEventListener('click', closeProfileOverlay);
            }
            
            // Close overlay when clicking outside
            document.addEventListener('click', function(e) {
                // Check if overlay is open and click is outside the overlay content
                if (profileOverlay.classList.contains('open') && 
                    !profileOverlay.contains(e.target) && 
                    !e.target.closest('.candidate-name') && 
                    !e.target.closest('.attachment-icon')) {
                    closeProfileOverlay();
                }
            });
            
            // Close overlay with Escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && profileOverlay.classList.contains('open')) {
                    closeProfileOverlay();
                }
            });
            
            // Tab switching functionality
            profileTabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    const targetTab = this.getAttribute('data-tab');
                    
                    // Remove active class from all tabs and contents
                    profileTabs.forEach(t => t.classList.remove('active'));
                    profileTabContents.forEach(c => c.classList.remove('active'));
                    
                    // Add active class to clicked tab and corresponding content
                    this.classList.add('active');
                    const targetContent = document.getElementById(targetTab + '-content');
                    if (targetContent) {
                        targetContent.classList.add('active');
                    }
                });
            });
            
            // Add click handlers to candidate names and attachment icons
            candidateNames.forEach(nameElement => {
                nameElement.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const candidateCard = this.closest('.candidate-card');
                    const candidateId = candidateCard.getAttribute('data-candidate-id');
                    
                    // Find candidate data from the PHP data
                    const candidateData = <?php echo json_encode($candidateData['candidates']); ?>;
                    const candidate = candidateData.find(c => c.id == candidateId);
                    
                    if (candidate) {
                        // Extract job title from job history if available
                        const jobTitle = candidate.jobHistory && candidate.jobHistory.length > 0 
                            ? candidate.jobHistory[0].title 
                            : 'Backend Developer';
                        
                        // Extract company from job history if available
                        const company = candidate.jobHistory && candidate.jobHistory.length > 0 
                            ? candidate.jobHistory[0].company 
                            : 'Stripe';
                        
                        const candidateInfo = {
                            name: candidate.name,
                            jobTitle: jobTitle,
                            company: company,
                            location: candidate.location
                        };
                        
                        openProfileOverlay(candidateInfo);
                    }
                });
            });
            
            attachmentIcons.forEach(iconElement => {
                iconElement.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const candidateCard = this.closest('.candidate-card');
                    const candidateId = candidateCard.getAttribute('data-candidate-id');
                    
                    // Find candidate data from the PHP data
                    const candidateData = <?php echo json_encode($candidateData['candidates']); ?>;
                    const candidate = candidateData.find(c => c.id == candidateId);
                    
                    if (candidate) {
                        // Extract job title from job history if available
                        const jobTitle = candidate.jobHistory && candidate.jobHistory.length > 0 
                            ? candidate.jobHistory[0].title 
                            : 'Backend Developer';
                        
                        // Extract company from job history if available
                        const company = candidate.jobHistory && candidate.jobHistory.length > 0 
                            ? candidate.jobHistory[0].company 
                            : 'Stripe';
                        
                        const candidateInfo = {
                            name: candidate.name,
                            jobTitle: jobTitle,
                            company: company,
                            location: candidate.location
                        };
                        
                        openProfileOverlay(candidateInfo);
                    }
                });
            });
            
            console.log('Profile overlay initialized successfully');
        }
        
        // Initialize profile overlay
        initializeProfileOverlay();
        
    })();
    </script>
</div>
