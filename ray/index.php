<?php
// Ray Prototype - Main Interface
// This file serves as the main chat interface for Ray

// Disable caching for development
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

// Simple configuration
$site_title = "Ray Prototype";
$site_url = "https://work.encosion.com";

// Generate cache-busting version parameter
$version = time();

// Get conversation ID from URL parameter
$conversation_id = $_GET['conversation'] ?? 'recruitment_1.1';

// Load conversation configuration (fallback to defaults if no config file)
$conversation_config = [];
$config_file = "conversations/{$conversation_id}/config.json";
if (file_exists($config_file)) {
    $conversation_config = json_decode(file_get_contents($config_file), true) ?? [];
}

// Default configuration
$default_config = [
    'user_name' => 'User'
];

$config = array_merge($default_config, $conversation_config);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sourcing Agent</title>
    <link rel="stylesheet" href="style.css?v=<?php echo $version; ?>">
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon-16x16.png">
    <link rel="icon" type="image/png" sizes="32x32" href="images/favicon-32x32.png">
    <link rel="apple-touch-icon" sizes="180x180" href="images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="192x192" href="images/android-chrome-192x192.png">
    <link rel="icon" type="image/png" sizes="512x512" href="images/android-chrome-512x512.png">
    <meta name="theme-color" content="#ffffff">
</head>
<body>
    <!-- Top Header -->
    <?php
    $header_user_name = $config['user_name']; 
    include 'includes/header.php'; 
    ?>
    
    <!-- Icon Navigation -->
    <?php include 'includes/navigation.php'; ?>
    
    <div class="page-layout">
        <div class="chat-section">
            <div class="chat-container">
                <div class="chat-header">
                    <div class="logo-section">
                        <img src="images/logo-ray.svg" alt="Ray Logo" height="16">
                    </div>
                    <div class="button-group">
                        <button class="reset-button" id="resetButton" title="Reset conversation">
                            <img src="images/icon-history.svg" alt="History" width="16" height="16">
                        </button>
                    </div>
                </div>
                
                <div class="chat-messages" id="chatMessages">
                    <!-- Messages will be loaded here -->
                </div>
                
                <div class="chat-input-container">
                    <div class="chat-input">
                        <textarea id="userInput" placeholder="Ask Ray..." autocomplete="off" rows="4"></textarea>
                        <button id="sendButton">
                            <img src="images/icon-paperplane.svg" alt="Send" width="16" height="16">
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="emoji-section">
            <?php include 'includes/homepage-default.php'; ?>
        </div>
    </div>
    
    <script src="app.js?v=<?php echo $version; ?>"></script>
    <script>
        // Initialize chat with conversation ID
        const conversationId = '<?php echo htmlspecialchars($conversation_id); ?>';
        const config = <?php echo json_encode($config); ?>;
        
        // Initialize the chat system
        document.addEventListener('DOMContentLoaded', () => {
            if (window.chatSystem) {
                window.chatSystem.init(conversationId, config);
            }
        });
    </script>
</body>
</html>