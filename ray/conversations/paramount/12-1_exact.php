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
<li><strong>Same job role with title variations:</strong> SVP Corporate Development, Senior Vice President Corporate Development, VP Corporate Development, Director of Corporate Development, Head of Corporate Development, Chief Corporate Development Officer</li>
<li><strong>Core skills:</strong> M&A Transaction Leadership, Strategic Partnerships, Due Diligence Management, Valuation Analysis, Deal Negotiation, Big Tech Experience</li>
<li><strong>Location:</strong> California, Washington, Oregon, Nevada, Arizona, Utah</li>
<li><strong>Ideal companies to start sourcing from:</strong> Google, Apple, Microsoft, Amazon, Meta, Netflix, Salesforce, Oracle, Adobe, Tesla.</li>
<button load-="exact.php">Load results 👉</button>
</ul>
<script type="application/json" id="system-commands">
<?php echo json_encode($commands); ?>
</script>
