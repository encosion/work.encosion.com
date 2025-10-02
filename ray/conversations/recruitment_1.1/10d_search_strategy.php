<?php
header('Content-Type: text/html; charset=utf-8');

// System commands
$commands = [
    'render' => 'stream',
    'nextAction' => 'wait',
    'suggestedResponse' => 'Can you remove Amazon?'
];

// Output the content
?>
<p>Great, I've extracted the key criteria and created a comprehensive search starting with the most focused:</p>

<h3>Exact</h3>
<ul>
<li><strong>Same job role with title variations:</strong> Sr/Senior Product Owner, Lead Product Owner</li>
<li><strong>Core skills:</strong> Agile methodologies, Product roadmap development, Stakeholder management, User story creation</li>
<li><strong>Location:</strong> Commutable distance from Wilmington, NC (50 miles)</li>
<li><strong>Ideal companies to start sourcing from:</strong> Microsoft, Google, Amazon or Salesforce.</li>
<button load-="results-exact.php">Load roles</button>
</ul>

<h3>Close</h3>
<ul>
<li>As above plus:</li>
<li><strong>Close job role variations in the same domain:</strong> Senior Product Manager, Scrum Master, Agile Project Lead, Senior Project Manager, Senior Programme Manager.</li>
<button load-="results-close.php">Load roles</button>
</ul>

<h3>Broad</h3>
<ul>
<li><strong>Any related roles</strong></li>
<li><strong>Core skills:</strong> Agile methodologies, Product roadmap development, Stakeholder management and User story creation</li>
<li><strong>Location:</strong> Commutable distance from Wilmington, NC (50 miles)</li>
<li><strong>Ideal companies:</strong> N/A</li>
<button load-="results-broad.php">Load roles</button>
</ul>

<p>After reviewing, let me know if you would like to make any changes, or how you would like me to broaden the search for you.</p>

<script type="application/json" id="system-commands">
<?php echo json_encode($commands); ?>
</script>
