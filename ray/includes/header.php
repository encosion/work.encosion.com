<!-- Top Header -->
<header class="top-header">
    <div class="header-left">
        <div class="beamery-logo">
            <img src="images/logo-beamery.svg" alt="Beamery" height="24" />
        </div>
    </div>
    <div class="header-right">
        <button class="icon-button" title="Search">
            <img src="images/icon-search.svg" alt="Search" width="16" height="16" />
        </button>
        <button class="icon-button" title="Notifications">
            <img src="images/icon-notifications.svg" alt="Notifications" width="16" height="16" />
        </button>
        <button class="icon-button" title="Help">
            <img src="images/icon-help.svg" alt="Help" width="16" height="16" />
        </button>
        <div class="user-menu">
            <img src="images/icon-avatar.svg" alt="Profile" width="16" height="16" />
            <span class="user-name"><?php echo htmlspecialchars($header_user_name); ?></span>
            <img src="images/icon-chevron-down.svg" alt="Menu" width="16" height="16" />
        </div>
    </div>
</header>
