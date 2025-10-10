<?php
header('Content-Type: text/html; charset=utf-8');

// System commands
$commands = [
    'render' => 'stream',
    'nextAction' => 'wait',
];

// Output the content
?>
<p style="margin-top:-1rem;">Would you like to make any changes?</p>
<script type="application/json" id="system-commands">
<?php echo json_encode($commands); ?>
</script>
