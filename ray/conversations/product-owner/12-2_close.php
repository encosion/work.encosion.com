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
<li><strong>Close job role variations in the same domain:</strong> Senior Product Manager, Scrum Master, Agile Project Lead, Senior Project Manager, Senior Programme Manager.</li>
<button load-="results-close.php">Load results 👉</button>
</ul>
<script type="application/json" id="system-commands">
<?php echo json_encode($commands); ?>
</script>
