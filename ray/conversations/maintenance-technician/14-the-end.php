<?php
header('Content-Type: text/html; charset=utf-8');

// System commands
$commands = [
    'render' => 'stream',
    'nextAction' => 'wait',
];

// Output the content
?>
<p>This is just a prototype, Sorry! ☺️ Let's pretend I've did what you asked, what would you do next?</p>
<script type="application/json" id="system-commands">
<?php echo json_encode($commands); ?>
</script>
