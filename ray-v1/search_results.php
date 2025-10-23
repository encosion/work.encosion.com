<?php
// search_results.php
// Extracted candidate table HTML for recruitment search results
?>

<div class="candidate-table-container">
    <div class="table-header">
        <div class="header-top">
            <h2>Results</h2>
            <div class="header-controls">
                <div class="segmented-control">
                    <button class="segment-button active" data-segment="best-match">Best match</button>
                    <button class="segment-button" data-segment="broader">Broader</button>
                </div>
            </div>
            <div class="header-controls">
                <div class="action-buttons">
                    <button class="action-btn delete-btn" title="Delete">
                        <img src="images/delete.svg" alt="Delete" width="17" height="17">
                    </button>
                    <button class="action-btn edit-btn" title="Edit">
                        <img src="images/edit.svg" alt="Edit" width="17" height="17">
                        <span>Edit</span>
                    </button>
                </div>
            </div>
        </div>
        <p><b>Senior Product Owner</b> and <b>Lead Product Owner</b> roles at target companies (Microsoft, Google, Amazon, Salesforce) with Agile methodologies, Product roadmap development, Stakeholder management, User story creation within commutable distance of Wilmington, NC, USA</p>
    </div>
    <div class="candidate-cards">
        <!-- Match Score: 95 - Perfect match: Senior PO at Microsoft, local to Wilmington -->
        <div class="candidate-card" data-candidate-id="1">
            <input type="checkbox" class="candidate-checkbox" id="candidate-1">
            <div class="candidate-name">
                Michael Rodriguez
                <img src="images/attachment.svg" alt="CV/Resume" class="attachment-icon" width="16" height="16">
            </div>
            <div class="job-history">
                <div class="job-item">
                    <span class="experience">Senior Product Owner, Microsoft <span class="duration">(3y 2m) • </span>Wilmington, North Carolina, USA</span>
                </div>
                <div class="job-item">
                    <span class="experience">Product Manager, Amazon <span class="duration">(2y 8m)</span></span>
                </div>
                <div class="job-item">
                    <span class="experience">Product Analyst, Google <span class="duration">(2y 1m)</span></span>
                </div>
            </div>
            <div class="rating">★★★★★ 4.9</div>
            <div class="skills">
                <span class="skill-tag">Product Roadmap</span>
                <span class="skill-tag">Agile Methodologies</span>
                <span class="skill-tag">Stakeholder Management</span>
            </div>
        </div>
        
        <!-- Match Score: 92 - Senior PO at Google, Raleigh (commutable to Wilmington) -->
        <div class="candidate-card" data-candidate-id="2">
            <input type="checkbox" class="candidate-checkbox" id="candidate-2">
            <div class="candidate-name">
                Sarah Chen
                <img src="images/attachment.svg" alt="CV/Resume" class="attachment-icon" width="16" height="16">
            </div>
            <div class="job-history">
                <div class="job-item">
                    <span class="experience">Senior Product Owner, Google <span class="duration">(2y 6m) • </span>Raleigh, North Carolina, USA</span>
                </div>
                <div class="job-item">
                    <span class="experience">Product Manager, Microsoft <span class="duration">(3y 1m)</span></span>
                </div>
                <div class="job-item">
                    <span class="experience">Product Specialist, Salesforce <span class="duration">(2y 3m)</span></span>
                </div>
            </div>
            <div class="rating">★★★★★ 4.8</div>
            <div class="skills">
                <span class="skill-tag">User Story Creation</span>
                <span class="skill-tag">Product Strategy</span>
                <span class="skill-tag">Cross-functional Leadership</span>
            </div>
        </div>
        
        <!-- Match Score: 90 - Lead PO at Amazon, Charlotte (commutable to Wilmington) -->
        <div class="candidate-card" data-candidate-id="3">
            <input type="checkbox" class="candidate-checkbox" id="candidate-3">
            <div class="candidate-name">
                Jennifer Martinez
                <img src="images/attachment.svg" alt="CV/Resume" class="attachment-icon" width="16" height="16">
            </div>
            <div class="job-history">
                <div class="job-item">
                    <span class="experience">Lead Product Owner, Amazon <span class="duration">(2y 4m) • </span>Charlotte, North Carolina, USA</span>
                </div>
                <div class="job-item">
                    <span class="experience">Senior Product Owner, Google <span class="duration">(3y 2m)</span></span>
                </div>
                <div class="job-item">
                    <span class="experience">Product Manager, Microsoft <span class="duration">(2y 7m)</span></span>
                </div>
            </div>
            <div class="rating">★★★★★ 4.9</div>
            <div class="skills">
                <span class="skill-tag">Product Leadership</span>
                <span class="skill-tag">Team Management</span>
                <span class="skill-tag">Strategic Planning</span>
            </div>
        </div>
        
        <!-- Match Score: 88 - Senior PO at Salesforce, Durham (commutable to Wilmington) -->
        <div class="candidate-card" data-candidate-id="4">
            <input type="checkbox" class="candidate-checkbox" id="candidate-4">
            <div class="candidate-name">
                David Thompson
                <img src="images/attachment.svg" alt="CV/Resume" class="attachment-icon" width="16" height="16">
            </div>
            <div class="job-history">
                <div class="job-item">
                    <span class="experience">Senior Product Owner, Salesforce <span class="duration">(2y 8m) • </span>Durham, North Carolina, USA</span>
                </div>
                <div class="job-item">
                    <span class="experience">Product Manager, Amazon <span class="duration">(3y 4m)</span></span>
                </div>
                <div class="job-item">
                    <span class="experience">Product Analyst, Google <span class="duration">(2y 2m)</span></span>
                </div>
            </div>
            <div class="rating">★★★★★ 4.7</div>
            <div class="skills">
                <span class="skill-tag">Data Analysis</span>
                <span class="skill-tag">Product Metrics</span>
                <span class="skill-tag">User Research</span>
            </div>
        </div>
        
        <!-- Match Score: 85 - Senior PO at Microsoft, Richmond (commutable to Wilmington) -->
        <div class="candidate-card" data-candidate-id="5">
            <input type="checkbox" class="candidate-checkbox" id="candidate-5">
            <div class="candidate-name">
                Amanda Foster
                <img src="images/attachment.svg" alt="CV/Resume" class="attachment-icon" width="16" height="16">
            </div>
            <div class="job-history">
                <div class="job-item">
                    <span class="experience">Senior Product Owner, Microsoft <span class="duration">(2y 1m) • </span>Richmond, Virginia, USA</span>
                </div>
                <div class="job-item">
                    <span class="experience">Product Manager, Salesforce <span class="duration">(3y 6m)</span></span>
                </div>
                <div class="job-item">
                    <span class="experience">Product Coordinator, Google <span class="duration">(2y 4m)</span></span>
                </div>
            </div>
            <div class="rating">★★★★★ 4.8</div>
            <div class="skills">
                <span class="skill-tag">Project Coordination</span>
                <span class="skill-tag">Process Improvement</span>
                <span class="skill-tag">Team Collaboration</span>
            </div>
        </div>
        
        <!-- Match Score: 82 - Lead PO at Google, Atlanta (commutable to Wilmington) -->
        <div class="candidate-card" data-candidate-id="6">
            <input type="checkbox" class="candidate-checkbox" id="candidate-6">
            <div class="candidate-name">
                Robert Kim
                <img src="images/attachment.svg" alt="CV/Resume" class="attachment-icon" width="16" height="16">
            </div>
            <div class="job-history">
                <div class="job-item">
                    <span class="experience">Lead Product Owner, Google <span class="duration">(1 year 11m) • </span>Atlanta, Georgia, USA</span>
                </div>
                <div class="job-item">
                    <span class="experience">Senior Product Owner, Amazon <span class="duration">(3y 3m)</span></span>
                </div>
                <div class="job-item">
                    <span class="experience">Product Manager, Microsoft <span class="duration">(2y 8m)</span></span>
                </div>
            </div>
            <div class="rating">★★★★★ 4.6</div>
            <div class="skills">
                <span class="skill-tag">Technical Leadership</span>
                <span class="skill-tag">Innovation</span>
                <span class="skill-tag">Product Vision</span>
            </div>
        </div>
        
        <!-- Match Score: 80 - Senior PO at Amazon, Columbia (commutable to Wilmington) -->
        <div class="candidate-card" data-candidate-id="7">
            <input type="checkbox" class="candidate-checkbox" id="candidate-7">
            <div class="candidate-name">
                Lisa Johnson
                <img src="images/attachment.svg" alt="CV/Resume" class="attachment-icon" width="16" height="16">
            </div>
            <div class="job-history">
                <div class="job-item">
                    <span class="experience">Senior Product Owner, Amazon <span class="duration">(2y 3m) • </span>Columbia, South Carolina, USA</span>
                </div>
                <div class="job-item">
                    <span class="experience">Product Manager, Salesforce <span class="duration">(3y 1m)</span></span>
                </div>
                <div class="job-item">
                    <span class="experience">Product Specialist, Google <span class="duration">(2y 5m)</span></span>
                </div>
            </div>
            <div class="rating">★★★★★ 4.7</div>
            <div class="skills">
                <span class="skill-tag">Product Specialization</span>
                <span class="skill-tag">Market Analysis</span>
                <span class="skill-tag">Customer Focus</span>
            </div>
        </div>
        
        <!-- Match Score: 78 - Senior PO at Salesforce, Norfolk (commutable to Wilmington) -->
        <div class="candidate-card" data-candidate-id="8">
            <input type="checkbox" class="candidate-checkbox" id="candidate-8">
            <div class="candidate-name">
                Christopher Lee
                <img src="images/attachment.svg" alt="CV/Resume" class="attachment-icon" width="16" height="16">
            </div>
            <div class="job-history">
                <div class="job-item">
                    <span class="experience">Senior Product Owner, Salesforce <span class="duration">(1 year 10m) • </span>Norfolk, Virginia, USA</span>
                </div>
                <div class="job-item">
                    <span class="experience">Product Manager, Microsoft <span class="duration">(3y 2m)</span></span>
                </div>
                <div class="job-item">
                    <span class="experience">Product Analyst, Amazon <span class="duration">(2y 6m)</span></span>
                </div>
            </div>
            <div class="rating">★★★★★ 4.5</div>
            <div class="skills">
                <span class="skill-tag">Analytics</span>
                <span class="skill-tag">Problem Solving</span>
                <span class="skill-tag">Process Optimization</span>
            </div>
        </div>
        
        <!-- Match Score: 75 - Lead PO at Microsoft, Charleston (commutable to Wilmington) -->
        <div class="candidate-card" data-candidate-id="9">
            <input type="checkbox" class="candidate-checkbox" id="candidate-9">
            <div class="candidate-name">
                Michelle Davis
                <img src="images/attachment.svg" alt="CV/Resume" class="attachment-icon" width="16" height="16">
            </div>
            <div class="job-history">
                <div class="job-item">
                    <span class="experience">Lead Product Owner, Microsoft <span class="duration">(1 year 8m) • </span>Charleston, South Carolina, USA</span>
                </div>
                <div class="job-item">
                    <span class="experience">Senior Product Owner, Google <span class="duration">(3y 4m)</span></span>
                </div>
                <div class="job-item">
                    <span class="experience">Product Manager, Amazon <span class="duration">(2y 9m)</span></span>
                </div>
            </div>
            <div class="rating">★★★★★ 4.8</div>
            <div class="skills">
                <span class="skill-tag">Leadership</span>
                <span class="skill-tag">Strategic Thinking</span>
                <span class="skill-tag">Innovation</span>
            </div>
        </div>
        
        <!-- Match Score: 72 - Senior PO at Google, Jacksonville (commutable to Wilmington) -->
        <div class="candidate-card" data-candidate-id="10">
            <input type="checkbox" class="candidate-checkbox" id="candidate-10">
            <div class="candidate-name">
                Kevin Wilson
                <img src="images/attachment.svg" alt="CV/Resume" class="attachment-icon" width="16" height="16">
            </div>
            <div class="job-history">
                <div class="job-item">
                    <span class="experience">Senior Product Owner, Google <span class="duration">(2y 5m) • </span>Jacksonville, Florida, USA</span>
                </div>
                <div class="job-item">
                    <span class="experience">Product Manager, Salesforce <span class="duration">(3y 7m)</span></span>
                </div>
            </div>
            <div class="rating">★★★★★ 4.6</div>
            <div class="skills">
                <span class="skill-tag">Product Management</span>
                <span class="skill-tag">Customer Success</span>
                <span class="skill-tag">Growth Strategy</span>
            </div>
        </div>
        
        <!-- Match Score: 70 - Senior PO at Amazon, Savannah (commutable to Wilmington) -->
        <div class="candidate-card" data-candidate-id="11">
            <input type="checkbox" class="candidate-checkbox" id="candidate-11">
            <div class="candidate-name">
                Rachel Brown
                <img src="images/attachment.svg" alt="CV/Resume" class="attachment-icon" width="16" height="16">
            </div>
            <div class="job-history">
                <div class="job-item">
                    <span class="experience">Senior Product Owner, Amazon <span class="duration">(1 year 7m) • </span>Savannah, Georgia, USA</span>
                </div>
                <div class="job-item">
                    <span class="experience">Product Manager, Google <span class="duration">(3y 8m)</span></span>
                </div>
                <div class="job-item">
                    <span class="experience">Product Specialist, Salesforce <span class="duration">(2y 4m)</span></span>
                </div>
            </div>
            <div class="rating">★★★★★ 4.4</div>
            <div class="skills">
                <span class="skill-tag">Specialization</span>
                <span class="skill-tag">Quality Assurance</span>
                <span class="skill-tag">Process Design</span>
            </div>
        </div>
        
        <!-- Match Score: 68 - Lead PO at Salesforce, Greenville (commutable to Wilmington) -->
        <div class="candidate-card" data-candidate-id="12">
            <input type="checkbox" class="candidate-checkbox" id="candidate-12">
            <div class="candidate-name">
                Thomas Anderson
                <img src="images/attachment.svg" alt="CV/Resume" class="attachment-icon" width="16" height="16">
            </div>
            <div class="job-history">
                <div class="job-item">
                    <span class="experience">Lead Product Owner, Salesforce <span class="duration">(2y 2m) • </span>Greenville, South Carolina, USA</span>
                </div>
                <div class="job-item">
                    <span class="experience">Senior Product Owner, Microsoft <span class="duration">(3y 5m)</span></span>
                </div>
                <div class="job-item">
                    <span class="experience">Product Manager, Amazon <span class="duration">(2y 7m)</span></span>
                </div>
            </div>
            <div class="rating">★★★★★ 4.7</div>
            <div class="skills">
                <span class="skill-tag">Lead Management</span>
                <span class="skill-tag">Team Building</span>
                <span class="skill-tag">Strategic Execution</span>
            </div>
        </div>
        
        <!-- Match Score: 65 - Senior PO at Microsoft, Asheville (commutable to Wilmington) -->
        <div class="candidate-card" data-candidate-id="13">
            <input type="checkbox" class="candidate-checkbox" id="candidate-13">
            <div class="candidate-name">
                Nicole Taylor
                <img src="images/attachment.svg" alt="CV/Resume" class="attachment-icon" width="16" height="16">
            </div>
            <div class="job-history">
                <div class="job-item">
                    <span class="experience">Senior Product Owner, Microsoft <span class="duration">(1 year 9m) • </span>Asheville, North Carolina, USA</span>
                </div>
                <div class="job-item">
                    <span class="experience">Product Manager, Google <span class="duration">(3y 3m)</span></span>
                </div>
                <div class="job-item">
                    <span class="experience">Product Analyst, Amazon <span class="duration">(2y 8m)</span></span>
                </div>
            </div>
            <div class="rating">★★★★★ 4.5</div>
            <div class="skills">
                <span class="skill-tag">Analytical Thinking</span>
                <span class="skill-tag">Data-Driven Decisions</span>
                <span class="skill-tag">Performance Metrics</span>
            </div>
        </div>
        
        <!-- Match Score: 62 - Senior PO at Google, Knoxville (commutable to Wilmington) -->
        <div class="candidate-card" data-candidate-id="14">
            <input type="checkbox" class="candidate-checkbox" id="candidate-14">
            <div class="candidate-name">
                Daniel Garcia
                <img src="images/attachment.svg" alt="CV/Resume" class="attachment-icon" width="16" height="16">
            </div>
            <div class="job-history">
                <div class="job-item">
                    <span class="experience">Senior Product Owner, Google <span class="duration">(2y 4m) • </span>Knoxville, Tennessee, USA</span>
                </div>
                <div class="job-item">
                    <span class="experience">Product Manager, Salesforce <span class="duration">(3y 6m)</span></span>
                </div>
            </div>
            <div class="rating">★★★★★ 4.3</div>
            <div class="skills">
                <span class="skill-tag">Product Strategy</span>
                <span class="skill-tag">Market Research</span>
                <span class="skill-tag">Competitive Analysis</span>
            </div>
        </div>
    </div>
</div>

<script src="candidate-selection.js"></script>

<!-- Floating Selection Bar -->
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
        <button class="action-button secondary" id="viewInPeopleBtn">View in People</button>
        <div class="dropdown-container">
            <button class="action-button primary" id="addToBtn">Add to...</button>
            <div class="dropdown-menu" id="addToDropdown">
                <div class="dropdown-item" data-action="pool">
                    <img src="images/pool.svg" alt="Pool" class="dropdown-icon">
                    <span>Add to pool...</span>
                </div>
                <div class="dropdown-item" data-action="vacancy">
                    <img src="images/vacancy.svg" alt="Vacancy" class="dropdown-icon">
                    <span>Add to vacancy...</span>
                </div>
                <div class="dropdown-item" data-action="campaign">
                    <img src="images/campaign.svg" alt="Campaign" class="dropdown-icon">
                    <span>Add to campaign...</span>
                </div>
                <div class="dropdown-item" data-action="message">
                    <img src="images/paperplane.svg" alt="Message" class="dropdown-icon">
                    <span>Send message...</span>
                </div>
            </div>
        </div>
    </div>
</div>
