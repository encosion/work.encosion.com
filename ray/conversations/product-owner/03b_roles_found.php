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
    <div class="role-option" data-role="associate-product-owner">
        <span class="role-title">Associate Product Owner</span>
    </div>
    <div class="role-option" data-role="product-owner">
        <span class="role-title">Product Owner</span>
    </div>
    <div class="role-option" data-role="senior-product-owner">
        <span class="role-title">Senior Product Owner</span>
    </div>
    <div class="role-option" data-role="lead-product-owner">
        <span class="role-title">Lead Product Owner</span>
    </div>
    <div class="role-option" data-role="principal-product-owner">
        <span class="role-title">Principal Product Owner</span>
    </div>
</div>

<script type="application/json" id="system-commands">
<?php echo json_encode($commands); ?>
</script>
