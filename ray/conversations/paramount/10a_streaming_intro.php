<?php
header('Content-Type: text/html; charset=utf-8');

// System commands
$commands = [
    'render' => 'stream',
    'nextAction' => 'proceed-after-render'
];

// Output the content
?>
<p>Ok, so we're looking for an SVP of Corporate Development with big tech experince and M&A transaction leadership on the West Coast. Let me dig into this and get a search started for you.</p>
<script type="application/json" id="system-commands">
<?php echo json_encode($commands); ?>
</script>
