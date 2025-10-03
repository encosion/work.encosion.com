<?php
header('Content-Type: text/html; charset=utf-8');

// System commands
$commands = [
    'render' => 'appear',
    'nextAction' => 'proceed-after-render'
];

// Output the content
?>
<h3 style="margin-bottom:8px;margin-top:-1rem;">📏 Close</h3>
<ul>
<li>As above plus:</li>
<li><strong>Close job role variations in the same domain:</strong> Case Manager Nurse, Care Coordinator RN, Medical Reviewer, Utilization Management Nurse, Quality Improvement Nurse, Clinical Documentation Specialist.</li>
<button load-="centene-close.php">Load roles</button>
</ul>
<script type="application/json" id="system-commands">
<?php echo json_encode($commands); ?>
</script>
