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
    <div class="role-option" data-role="rn-critical-care-icu">
        <span class="role-title">RN – Critical Care (ICU)</span>
    </div>
    <div class="role-option" data-role="rn-critical-care-float-pool">
        <span class="role-title">RN – Critical Care (Float Pool)</span>
    </div>
    <div class="role-option" data-role="rn-critical-care-step-down-progressive-care">
        <span class="role-title">RN – Critical Care (Step-Down/Progressive Care)</span>
    </div>
    <div class="role-option" data-role="rn-critical-care-ccu-cvicu">
        <span class="role-title">RN – Critical Care (CCU/CVICU)</span>
    </div>
    <div class="role-option" data-role="rn-critical-care-neuro-icu-micu-sicu">
        <span class="role-title">RN – Critical Care (Neuro ICU, MICU, SICU)</span>
    </div>
</div>

<script type="application/json" id="system-commands">
<?php echo json_encode($commands); ?>
</script>
