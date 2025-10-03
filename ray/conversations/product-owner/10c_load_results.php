<?php
header('Content-Type: text/html; charset=utf-8');

// System commands
$commands = [
    'load' => 'results-exact.php',
    'nextAction' => 'proceed-after-render'
];

// Output the content
?>

<script type="application/json" id="system-commands">
<?php echo json_encode($commands); ?>
</script>
