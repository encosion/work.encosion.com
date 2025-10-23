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
                <h2>Sourcing Agent v2 – Conversational Prototype</h2>
                <p>An interactive chat simulation for rapid validation of realistic top-of-funnel sourcing.</p>
                <ul>
                    <li>Interactive chat interface – Realistic conversation flow with typing indicators (optional auto-cued responses)</li>
                    <li>Dynamic candidate results – Synthetic candidates for different search strategies (powered by JSON files) with loading states and multi-selection next actions</li>
                    <li>Easy to test different conversations and approaches using folders and simple URL params</li>
                    <li>Techstack – HTML5, CSS3, JavaScript (ES6+), PHP</li>
                </ul>
                <a href="ray/roles" class="nav-link">Check it out</a>
            </div>
        </div>
        
        <div class="description">
            <div class="content-left">
                <h2>Sourcing Agent v1 – Markdown-Driven Concept</h2>
                <p>The original concept exploration driven by structured markdown files and conversation flows.</p>
                <ul>
                    <li>Markdown-based conversation structure – Organized step-by-step recruitment conversations in markdown files</li>
                    <li>Simple folder-based organization – Easy to iterate on different conversation approaches and flows</li>
                    <li>Foundation for v2 development – Provided the conversational framework that evolved into the more interactive prototype</li>
                </ul>
                <a href="ray-v1/" class="nav-link">Check it out</a>
            </div>
        </div>
    </div>
    
    <!-- Footer -->
    <?php include '../bits/footer.php'; ?>
</body>
</html>
