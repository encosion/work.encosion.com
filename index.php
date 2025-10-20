<?php
// Set content type to HTML
header('Content-Type: text/html; charset=UTF-8');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tim Ferguson works...</title>
    <link rel="icon" href="favicon.ico" sizes="32x32">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include '../bits/header.php'; ?>

    <div class="container">
        <div class="description">
            <div class="content-left">
                <h2>Sourcing Agent – Conversational Prototype</h2>
                <p>An interactive chat simulation for rapid validation of realistic top-of-funnel sourcing.</p>
                <ul>
                    <li>Interactive chat interface – Realistic conversation flow with typing indicators and auto-cued responses</li>
                    <li>Dynamic candidate results – Shows synthetic candidates for different searches (powered by JSON files) with loading spinner, smooth scrolling and multi-selection next actions</li>
                    <li>Easy to test multiple different conversations and approaches using folders and simple URL parameters</li>
                    <li>Responsive – Fluid adaptation to variable desktop viewport sizes for corporate SaaS users</li>            
                    <li>Techstack – HTML5, CSS3, JavaScript (ES6+), PHP</li>
                </ul>
                <a href="ray/roles" class="nav-link">Check it out</a>
            </div>
        </div>
    </div>
    
    <!-- Footer -->
    <?php include '../bits/footer.php'; ?>
</body>
</html>
