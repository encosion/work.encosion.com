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
<li><strong>Core skills:</strong> M&A Experience, Strategic Partnerships, Due Diligence, Valuation Analysis, Deal Negotiation, Tech Industry Experience</li>
<li><strong>Location:</strong> California, Washington, Oregon, Nevada, Arizona, Utah</li>
<li><strong>Ideal companies:</strong> N/A</li>
<button load-="broad.php">Load results 👉</button>
</ul>
<script type="application/json" id="system-commands">
<?php echo json_encode($commands); ?>
</script>
