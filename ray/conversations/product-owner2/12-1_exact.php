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
<li><strong>Same job role with title variations:</strong> Sr/Senior Product Owner, Lead Product Owner</li>
<li><strong>Core skills:</strong> Agile methodologies, Product roadmap development, Stakeholder management, User story creation</li>
<li><strong>Location:</strong> Commutable distance from Wilmington, NC (50 miles)</li>
<li><strong>Ideal companies to start sourcing from:</strong> Microsoft, Google, Amazon or Salesforce.</li>
<button load-="exact.php">Load results 👉</button>
</ul>
<script type="application/json" id="system-commands">
<?php echo json_encode($commands); ?>
</script>
