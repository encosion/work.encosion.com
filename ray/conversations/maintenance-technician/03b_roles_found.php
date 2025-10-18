<?php
// This page should display a selection of roles, from the hiring organization (Caterpillar), that are related to the user's search query.
header('Content-Type: text/html; charset=utf-8');

// System commands
$commands = [
    'render' => 'appear',
    'nextAction' => 'proceed-after-render'
];

// Output the content
?>
<div class="role-selection-component" data-component="role-selection">
    <div class="role-option" data-role="maintenance-technician-i">
        <span class="role-title">Maintenance Technician I</span>
    </div>
    <div class="role-option" data-role="maintenance-technician-ii">
        <span class="role-title">Maintenance Technician II</span>
    </div>
    <div class="role-option" data-role="senior-maintenance-technician">
        <span class="role-title">Senior Maintenance Technician</span>
    </div>
</div>

<script type="application/json" id="system-commands">
<?php echo json_encode($commands); ?>
</script>
