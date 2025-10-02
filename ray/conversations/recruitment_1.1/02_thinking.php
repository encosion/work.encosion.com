<?php
header('Content-Type: text/html; charset=utf-8');

// System commands
$commands = [
    'render' => 'appear',
    'nextAction' => 'proceed',
    'autoAdvance' => 2000
];

// Output the content
?>
<div class="thinking-steps" id="thinking-steps">
    <div class="thinking-step" data-step="0">
        <div class="thinking-spinner"></div>
        <span class="thinking-text">Thinking</span>
    </div>
</div>

<script type="application/json" id="system-commands">
<?php echo json_encode($commands); ?>
</script>
