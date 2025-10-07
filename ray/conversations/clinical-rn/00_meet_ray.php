<?php
header('Content-Type: text/html; charset=utf-8');

// System commands
$commands = [
    'render' => 'appear',
    'nextAction' => 'wait'
];

// Output the content
?>
<div class="meet-ray-container">
    <div class="meet-ray-logo-large">
        <img src="/ray/images/icon-ray.svg" alt="Ray Logo" width="80" height="80">
    </div>
    
    <h2 class="meet-ray-title">Meet Ray, your AI sidekick.</h2>
    
    <p class="meet-ray-description">I'm your sourcing assistant. I can help you find the best prospects for your roles.</p>
    
    <div class="role-selection-component" data-component="role-selection">
        <div class="role-option meet-ray-button" data-role="start-search">
            <img src="/ray/images/icon-return.svg" alt="Return" width="16" height="16" class="meet-ray-button-icon">
            <span class="role-title meet-ray-button-title">Start a prospect search</span>
        </div>
    </div>
</div>

<script type="application/json" id="system-commands">
<?php echo json_encode($commands); ?>
</script>