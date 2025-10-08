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
    <div class="role-option" data-role="utilization-review-nurse">
        <span class="role-title">Utilization Review Nurse</span>
    </div>
    <div class="role-option" data-role="clinical-review-nurse">
        <span class="role-title">Clinical Review Nurse – Prior Authorization</span>
    </div>
    <div class="role-option" data-role="case-manager-nurse">
        <span class="role-title">Case Management Nurse</span>
    </div>
</div>

<script type="application/json" id="system-commands">
<?php echo json_encode($commands); ?>
</script>
