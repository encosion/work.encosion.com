<?php
header('Content-Type: text/html; charset=utf-8');

// System commands
$commands = [
    'render' => 'stream',
    'nextAction' => 'wait',
    'suggestedResponse' => 'Clinical Review Nurse'
];

// Output the content
?>
<p>If none, let me know so we can figure out the best starting point.</p>

<script type="application/json" id="system-commands">
<?php echo json_encode($commands); ?>
</script>
