<?php
// Set content type to HTML
header('Content-Type: text/html; charset=UTF-8');

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
