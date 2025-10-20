<?php
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

// Function to extract title from PHP file
function extractTitleFromPHP($filePath) {
    $content = file_get_contents($filePath);
    if (preg_match('/<title>(.*?)<\/title>/i', $content, $matches)) {
        return trim($matches[1]);
    }
    return basename($filePath, '.php');
}

// Function to get all PHP files in current directory
function getPHPFiles() {
    $files = [];
    $dir = __DIR__;
    $items = scandir($dir);
    
    foreach ($items as $item) {
        if ($item !== '.' && $item !== '..' && $item !== 'index.php' && pathinfo($item, PATHINFO_EXTENSION) === 'php') {
            $filePath = $dir . '/' . $item;
            $title = extractTitleFromPHP($filePath);
            $files[] = [
                'filename' => $item,
                'title' => $title
            ];
        }
    }
    
    // Sort by title
    usort($files, function($a, $b) {
        return strcmp($a['title'], $b['title']);
    });
    
    return $files;
}

$phpFiles = getPHPFiles();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Roles</title>
    <link rel="icon" href="../images/favicon.ico" sizes="32x32">
    <link rel="apple-touch-icon" href="../images/apple-touch-icon.png">
    <link rel="stylesheet" href="../style.css">
</head>

<body class="role-index-body">
    <div class="role-index-container">
        <div class="description">
            <div class="content-left">
                <h1 class="role-index-title">Which role would you like to source for?</h1>
                
                <?php if (empty($phpFiles)): ?>
                    <p class="role-index-subtitle">No role files found in this directory.</p>
                <?php else: ?>
                    <p class="role-index-subtitle">Click on any role below to view the full job description:</p>
                    
                    <ul class="role-index-list">
                        <?php foreach ($phpFiles as $file): ?>
                            <li>
                                <a href="<?php echo htmlspecialchars($file['filename']); ?>" class="role-index-item">
                                    <strong class="role-index-item-title"><?php echo htmlspecialchars($file['title']); ?></strong>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>
