<?php
header('Content-Type: text/html; charset=utf-8');

// System commands
$commands = [
    'render' => 'appear',
    'nextAction' => 'proceed-after-render'
];

// Output the content
?>
<div class="role-selection-component" data-component="role-selection">
    <div class="role-option" data-role="svp-corporate-development">
        <span class="role-title">SVP Corporate Development</span>
    </div>
    <div class="role-option" data-role="vp-corporate-development">
        <span class="role-title">VP Corporate Development</span>
    </div>
    <div class="role-option" data-role="head-corporate-development">
        <span class="role-title">Head of Corporate Development</span>
    </div>
</div>

<script type="application/json" id="system-commands">
<?php echo json_encode($commands); ?>
</script>
