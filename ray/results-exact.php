<?php
// results-exact.php
// Dynamic candidate table HTML for recruitment search results

// Load JSON data to get search criteria
$jsonFile = 'results-exact.json';
$jsonData = json_decode(file_get_contents($jsonFile), true);
$searchCriteria = $jsonData['searchCriteria'] ?? [];

// Include loading spinner
include 'includes/loading-spinner.php';

// Include filter panel with search criteria
include 'includes/filters.php';

// Set up page-specific variables
$pageName = 'results-exact';

// Include the common layout
include 'includes/results-layout.php';
?>