<?php
header('Content-Type: text/html; charset=utf-8');

// System commands
$commands = [
    'render' => 'appear',
    'nextAction' => 'proceed-after-render'
];

// Output the content
?>
<h3 style="margin-bottom:8px;margin-top:-1rem;">🎯 Exact</h3>
<ul>
<li><strong>Same job role with title variations:</strong> Clinical Review Nurse, Senior Clinical Review Nurse, Prior Authorization Nurse, Utilization Review Nurse</li>
<li><strong>Core skills:</strong> RN License, Prior authorization experience, Medical necessity review, Clinical documentation, HIPAA compliance</li>
<li><strong>Location:</strong> California, Nevada, Washington, Oregon, Arizona, Idaho</li>
<li><strong>Ideal companies to start sourcing from:</strong> Centene, UnitedHealth Group, Aetna, Cigna, or Anthem.</li>
<button load-="centene-exact.php">Load results 👉</button>
</ul>
<script type="application/json" id="system-commands">
<?php echo json_encode($commands); ?>
</script>
