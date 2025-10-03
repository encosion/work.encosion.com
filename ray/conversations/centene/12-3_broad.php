<?php
header('Content-Type: text/html; charset=utf-8');

// System commands
$commands = [
    'render' => 'appear',
    'nextAction' => 'proceed-after-render'
];

// Output the content
?>
<h3 style="margin-bottom:8px;margin-top:-1rem;">🤔 Broad</h3>
<ul>
<li><strong>Any related roles</strong></li>
<li><strong>Core skills:</strong> RN License, Prior authorization experience, Medical necessity review, Clinical documentation, HIPAA compliance</li>
<li><strong>Location:</strong> California, Nevada, Washington, Oregon, Arizona, Idaho</li>
<li><strong>Ideal companies:</strong> N/A</li>
<button load-="centene-broad.php">Load roles</button>
</ul>
<script type="application/json" id="system-commands">
<?php echo json_encode($commands); ?>
</script>
