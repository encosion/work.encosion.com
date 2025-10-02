<?php
header('Content-Type: text/html; charset=utf-8');

// System commands
$commands = [
    'render' => 'stream',
    'nextAction' => 'proceed',
    'autoAdvance' => 1000
];

// Output the content
?>
<p>Which of these roles is the best match?</p>

<script type="application/json" id="system-commands">
<?php echo json_encode($commands); ?>
</script>
