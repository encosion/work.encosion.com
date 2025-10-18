<?php
header('Content-Type: text/html; charset=utf-8');

// System commands
$commands = [
    'render' => 'stream',
    'nextAction' => 'wait',
    'typingDelay' => 10
];

// Output the content
?>
<p>Hi <span class="dynamic-user-name">{{USER_NAME}}</span>,</p>
<p>I'm a sourcing assistant. I want to help you find the best prospects for your maintenance technician roles.</p>
<p>What maintenance technician position are you currently sourcing for? In which locations?</p>
<script type="application/json" id="system-commands">
<?php echo json_encode($commands); ?>
</script>
