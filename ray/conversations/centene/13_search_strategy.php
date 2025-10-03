<?php
header('Content-Type: text/html; charset=utf-8');

// System commands
$commands = [
    'render' => 'stream',
    'nextAction' => 'wait',
    'suggestedResponse' => 'I want to focus on candidates in California. Remove other states'
];

// Output the content
?>
<p>After reviewing, let me know if you would like to make any changes, or how you would like me to broaden the search for you.</p>
<script type="application/json" id="system-commands">
<?php echo json_encode($commands); ?>
</script>
