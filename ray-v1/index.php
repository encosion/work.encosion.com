<?php
// Chat Prototype - Main Interface
// This file serves as the main chat interface for simulating conversational experiences

// Disable caching for development
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

// Set content type to HTML
header('Content-Type: text/html; charset=UTF-8');

// Lightweight PIN gate for Work area (no username)
session_start();
const WORK_PIN = 'ray'; // change for production
if (($_POST['work_pin'] ?? null) !== null) {
    if (hash_equals(WORK_PIN, (string)$_POST['work_pin'])) {
        $_SESSION['work_authed'] = true;
        header('Location: ' . strtok($_SERVER['REQUEST_URI'], '?'));
        exit;
    } else {
        $pin_error = 'Incorrect password';
    }
}
if (!(isset($_SESSION['work_authed']) && $_SESSION['work_authed'] === true)) {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Enter password</title>
        <style>
            body { display:flex; align-items:center; justify-content:center; min-height:100vh; background:#000; color:#ddd; font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Ubuntu,Cantarell,sans-serif; }
            .card { background:#111; padding:2rem; border:1px solid #333; border-radius:8px; width:min(90vw,360px); box-shadow:0 10px 30px rgba(0,0,0,0.5); }
            h1 { margin:0 0 1rem 0; font-size:1.25rem; color:#fff; }
            .error { color:#f88; margin:0 0 0.5rem 0; font-size:0.9rem; }
            input[type=password]{ width:100%; padding:0.75rem; background:#000; color:#eee; border:1px solid #444; border-radius:6px; }
            button { margin-top:0.75rem; width:100%; padding:0.75rem; background:gold; color:#000; border:none; border-radius:6px; font-weight:600; cursor:pointer; }
            button:hover { filter:brightness(1.05); }
        </style>
    </head>
    <body>
        <form method="post" class="card" autocomplete="off">
            <h1>Enter password</h1>
            <?php if (!empty($pin_error)) { echo '<p class=\"error\">' . htmlspecialchars($pin_error) . '</p>'; } ?>
            <input type="password" name="work_pin" placeholder="Password" autofocus>
            <button type="submit">Let's go!</button>
        </form>
    </body>
    </html>
    <?php
    exit;
}

// Simple configuration
$site_title = "Chat Prototype";
$site_url = "https://work.encosion.com";

// Generate cache-busting version parameter
$version = time();

// Get conversation ID from URL parameter
$conversation_id = $_GET['conversation'] ?? 'recruitment_1.0';

// Load conversation configuration
$conversation_config = [];
$config_file = "conversations/{$conversation_id}/config.json";
if (file_exists($config_file)) {
    $conversation_config = json_decode(file_get_contents($config_file), true) ?? [];
}

// Default configuration
$default_config = [
    'title' => 'Chat Simulation',
    'description' => 'Interactive chat prototype',
    'agent_name' => 'Agent',
    'user_name' => 'User',
    'theme' => 'light'
];

$config = array_merge($default_config, $conversation_config);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($config['title']); ?></title>
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>💬</text></svg>">
    <link rel="stylesheet" href="style.css?v=<?php echo $version; ?>">
</head>
<body>
    <div class="page-layout">
        <div class="chat-section">
            <div class="chat-container">
                <div class="chat-header">
                    <div class="logo-section">
                        <img src="images/logo.svg" alt="Ray Logo">
                        <!-- <h1><?php echo htmlspecialchars($config['agent_name']); ?></h1> -->
                    </div>
                    <div class="button-group">
                        <button class="reset-button" id="resetButton" title="Reset conversation"></button>
                        <!-- <button class="add-button" title="Start new chat"></button> -->
                    </div>
                </div>
                
                <div class="chat-messages" id="chatMessages">
                    <!-- Messages will be loaded here -->
                </div>
                
                <div class="chat-input-container">
                    <div class="chat-input">
                        <textarea id="userInput" placeholder="Ask Ray to help find candidates..." autocomplete="off" rows="4"></textarea>
                        <button id="sendButton">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M14.3832 1.61625C14.2261 1.45911 14.0299 1.34669 13.8149 1.29055C13.6 1.23441 13.3739 1.2366 13.16 1.29688L13.1463 1.30125L1.15191 4.9375C0.908286 5.00814 0.691915 5.15122 0.53154 5.34775C0.371165 5.54428 0.274375 5.78495 0.254029 6.03779C0.233682 6.29063 0.29074 6.54368 0.417625 6.76333C0.54451 6.98297 0.735216 7.15882 0.964412 7.2675L6.23441 9.7675L8.73441 15.0375C8.8342 15.2516 8.99314 15.4326 9.19248 15.5593C9.39181 15.686 9.62322 15.753 9.85941 15.7525C9.89504 15.7525 9.93129 15.7525 9.96754 15.7481C10.2202 15.728 10.4606 15.6308 10.6563 15.4698C10.8519 15.3087 10.9935 15.0915 11.0619 14.8475L14.6982 2.85313C14.7 2.84867 14.7015 2.84407 14.7025 2.83938C14.7628 2.62551 14.765 2.39945 14.7089 2.18447C14.6527 1.96948 14.5403 1.77334 14.3832 1.61625ZM9.81191 13.8075L7.70441 9.35813L10.5325 6.53C10.6734 6.38911 10.7526 6.19801 10.7526 5.99875C10.7526 5.79949 10.6734 5.6084 10.5325 5.4675C10.3916 5.32661 10.2005 5.24745 10.0013 5.24745C9.80203 5.24745 9.61093 5.32661 9.47004 5.4675L6.64191 8.29563L2.19191 6.1875L13.1244 2.875L9.81191 13.8075Z" fill="#EBEBFE"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="emoji-section">
            <div class="wave-emoji">👋</div>
        </div>
    </div>
    
    <script src="chat.js?v=<?php echo $version; ?>"></script>
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
