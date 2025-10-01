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

// Get all markdown files in the conversation directory
$files = glob("{$conversationDir}/*.md");
$steps = [];

foreach ($files as $file) {
    $filename = basename($file);
    $steps[] = [
        'file' => $filename,
        'step' => pathinfo($filename, PATHINFO_FILENAME)
    ];
}

// Sort steps by filename
usort($steps, function($a, $b) {
    return strcmp($a['file'], $b['file']);
});

echo json_encode($steps);
?>
