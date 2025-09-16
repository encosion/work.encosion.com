<?php
// list_files.php - Lists conversation files in order

// Disable caching for development
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

$conversation_id = $_GET['conversation'] ?? 'recruitment_example';
$conversation_dir = "conversations/{$conversation_id}/";

if (!is_dir($conversation_dir)) {
    http_response_code(404);
    echo json_encode(['error' => 'Conversation not found']);
    exit;
}

// Get all step_*.md files
$files = glob($conversation_dir . 'step_*.md');

// Sort files numerically by step number
usort($files, function($a, $b) {
    preg_match('/step_(\d+)/', basename($a), $matchesA);
    preg_match('/step_(\d+)/', basename($b), $matchesB);
    return intval($matchesA[1]) - intval($matchesB[1]);
});

// Convert to conversation steps
$steps = [];
foreach ($files as $file) {
    $filename = basename($file);
    $isUserResponse = strpos($filename, 'user_response') !== false;
    
    $steps[] = [
        'type' => $isUserResponse ? 'user' : 'agent',
        'file' => $filename,
        'delay' => $isUserResponse ? 0 : 30,
        'nextDelay' => $isUserResponse ? 0 : 1500,
        'placeholder' => $isUserResponse ? 'Type your response...' : null
    ];
}

header('Content-Type: application/json');
echo json_encode($steps);
?>
