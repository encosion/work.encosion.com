<?php
// list_files.php
// Returns a list of conversation step files for the specified conversation

header('Content-Type: application/json');

$conversation = $_GET['conversation'] ?? 'recruitment_1.1';
$conversationDir = "conversations/{$conversation}";

// Check if conversation directory exists
if (!is_dir($conversationDir)) {
    http_response_code(404);
    echo json_encode(['error' => 'Conversation not found']);
    exit;
}

// Get all HTML files in the conversation directory
$files = glob("{$conversationDir}/*.html");
$steps = [];

foreach ($files as $file) {
    $filename = basename($file);
    $stepName = pathinfo($filename, PATHINFO_FILENAME);
    
    // Determine step type based on filename
    $type = 'agent'; // Default to agent message
    if (strpos($stepName, 'user_response') !== false) {
        $type = 'user';
    }
    
    $steps[] = [
        'file' => $filename,
        'step' => $stepName,
        'type' => $type
    ];
}

// Sort steps by filename
usort($steps, function($a, $b) {
    return strcmp($a['file'], $b['file']);
});

echo json_encode($steps);
?>
