<?php
// homepage-default.php
// Common layout for a default user dashboard

?>

<div class="homepage-container">
    <div class="homepage-layout">
        <!-- Left Column -->
        <div class="homepage-left">
            <!-- Tasks Section -->
            <div class="tasks-section">
                <h2>Tasks</h2>
                <div class="tasks-status">
                    <div class="status-box">
                        <p class="status-title">You're all caught up. Nice!</p>
                        <p class="status-description">You have no tasks to complete right now. Please check back later</p>
                    </div>
                </div>
            </div>

            <!-- Get Started Section -->
            <div class="get-started-section">
                <h2>Get started</h2>
                <div class="cards-grid">
                    <div class="card">
                        <h3 class="card-title">Beamery Learn</h3>
                        <p class="card-description">Discover Beamery new user training, role based certifications and on-demand virtual events</p>
                        <button class="card-btn">View Beamery Learn</button>
                    </div>
                    <div class="card">
                        <h3 class="card-title">Customer Portal</h3>
                        <p class="card-description">Access training resources, customer stories and product materials</p>
                        <button class="card-btn">View Customer Portal</button>
                    </div>
                    <div class="card">
                        <h3 class="card-title">Our Roadmap</h3>
                        <p class="card-description">Check out what we're working on and have your say to help us shape our roadmap</p>
                        <button class="card-btn">View Our Roadmap</button>
                    </div>
                    <div class="card">
                        <h3 class="card-title">Support</h3>
                        <p class="card-description">Search our knowledge center for answers to common questions</p>
                        <button class="card-btn">View Knowledge Center</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column -->
        <div class="homepage-right">
            <!-- Assigned to You Section -->
            <div class="assigned-section">
                <h2 class="card-title">Assigned to you</h2>
                <div class="assigned-list">
                    <div class="assigned-item">
                        <div class="item-icon">
                            <img src="images/icon-contact.svg" alt="Contact" width="16" height="16">
                        </div>
                        <span class="item-text">0 Contacts</span>
                    </div>
                    <div class="assigned-item">
                        <div class="item-icon">
                            <img src="images/icon-pools.svg" alt="Pools" width="16" height="16">
                        </div>
                        <span class="item-text">0 Pools</span>
                    </div>
                    <div class="assigned-item">
                        <div class="item-icon">
                            <img src="images/icon-vacancies.svg" alt="Vacancies" width="16" height="16">
                        </div>
                        <span class="item-text">3 Vacancies</span>
                    </div>
                </div>
            </div>

            <!-- Recently Worked On Section -->
            <div class="recent-section">
                <h2 class="card-title">Recently worked on</h2>
                <div class="recent-card">
                    <div class="recent-item">
                        <div class="item-icon">
                            <img src="images/icon-contact.svg" alt="Contact" width="16" height="16">
                        </div>
                        <div class="item-details">
                            <span class="item-name">Jun Wang</span>
                            <span class="item-privacy">Privacy: Public</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>