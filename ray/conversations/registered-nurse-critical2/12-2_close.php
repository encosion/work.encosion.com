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
<li><strong>Close job role variations in the same domain:</strong> Emergency Department Nurse, ER Nurse, Step-Down Unit Nurse, Progressive Care Nurse, Cardiac Care Unit Nurse, CCU Nurse, Trauma Nurse, Flight Nurse, PACU Nurse, Telemetry Nurse, Acute Care Nurse, Med-Surg Nurse, CVICU Nurse, Neuro ICU Nurse, NICU Nurse, PICU Nurse, Critical Care Transport Nurse, Air Medical Nurse</li>
<button load-="close.php">Show prospects 👉</button>
</ul>
<script type="application/json" id="system-commands">
<?php echo json_encode($commands); ?>
</script>
