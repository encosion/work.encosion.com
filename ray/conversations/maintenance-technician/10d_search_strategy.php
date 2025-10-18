<?php
header('Content-Type: text/html; charset=utf-8');

// System commands
$commands = [
    'render' => 'stream',
    'nextAction' => 'proceed-after-render'
];

// Output the content
?>
<p>Ok, I've created a three searches for you to review:</p>
<script type="application/json" id="system-commands">
<?php echo json_encode($commands); ?>
</script>
