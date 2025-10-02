<?php
header('Content-Type: text/html; charset=utf-8');

// System commands
$commands = [
    'render' => 'stream',
    'nextAction' => 'wait',
    'suggestedResponse' => 'I\'m looking for Product Owners near Wilmington, NC'
];

// Output the content
?>
<p>Hi Andrew,</p>
<p>I'm a sourcing assistant. I want to help you find the best prospects for your roles.</p>
<p>What job role are you currently sourcing for? In which locations?</p>
<script type="application/json" id="system-commands">
<?php echo json_encode($commands); ?>
</script>
