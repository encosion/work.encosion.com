<?php
header('Content-Type: text/html; charset=utf-8');

// System commands
$commands = [
    'render' => 'appear',
    'nextAction' => 'proceed',
    'autoAdvance' => 1000
];

// Output the content
?>
<div class="thinking-steps" id="thinking-steps">
    <div class="thinking-step" data-step="0">
        <div class="thinking-spinner"></div>
        <span class="thinking-text">Extracting core skills</span>
    </div>
    <div class="thinking-step" data-step="1">
        <div class="thinking-spinner"></div>
        <span class="thinking-text">Mapping target locations</span>
    </div>
    <div class="thinking-step" data-step="2">
        <div class="thinking-spinner"></div>
        <span class="thinking-text">Identifying ideal companies</span>
    </div>
    <div class="thinking-step" data-step="3">
        <div class="thinking-spinner"></div>
        <span class="thinking-text">Finding equivalent job titles</span>
    </div>
    <div class="thinking-step" data-step="4">
        <div class="thinking-spinner"></div>
        <span class="thinking-text">Building search</span>
    </div>
</div>

<script type="application/json" id="system-commands">
<?php echo json_encode($commands); ?>
</script>
