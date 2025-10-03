<?php
header('Content-Type: text/html; charset=utf-8');

// System commands
$commands = [
    'render' => 'stream',
    'nextAction' => 'wait',
    'suggestedResponse' => 'Can you remove Amazon?'
];

// Output the content
?>
<p style="margin-top:-1rem;">After reviewing, let me know if you would like to make any changes, or how you would like me to broaden the search for you.</p>
<script type="application/json" id="system-commands">
<?php echo json_encode($commands); ?>
</script>
