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
<li><strong>Same job role with title variations:</strong> ICU Nurse, Critical Care Nurse, Intensive Care Nurse, ICU Registered Nurse, Adult ICU Nurse, Medical ICU Nurse, Surgical ICU Nurse, MICU Nurse, SICU Nurse</li>
<li><strong>Core skills:</strong> RN License, Registered Nurse, Critical care, ICU experience, BLS, ACLS</li>
<li><strong>Location:</strong> Sioux Falls, Mitchell, Yankton (South Dakota) and Luverne, Worthington (Minnesota)</li>
<li><strong>Ideal companies to start sourcing from:</strong> Avera Health, Mayo Clinic, Sanford Health, Essentia Health, MercyOne, UnityPoint Health, CHI Health, Nebraska Medicine, Bryan Health, Nebraska Methodist Health System</li>
<button load-="exact.php">Load results 👉</button>
</ul>
<script type="application/json" id="system-commands">
<?php echo json_encode($commands); ?>
</script>
