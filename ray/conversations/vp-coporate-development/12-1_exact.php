<?php
header('Content-Type: text/html; charset=utf-8');

// System commands
$commands = [
    'render' => 'appear',
    'nextAction' => 'proceed-after-render'
];

// Content for the expandable section
$content = '<ul>
<li><strong>Same job role with title variations:</strong> SVP Corporate Development, Senior Vice President Corporate Development, VP Corporate Development, Director of Corporate Development, Head of Corporate Development, Chief Corporate Development Officer</li>
<li><strong>Core skills:</strong> M&A Transaction Leadership, Strategic Partnerships, Due Diligence Management, Valuation Analysis, Deal Negotiation, Big Tech Experience</li>
<li><strong>Location:</strong> California, Washington, Oregon, Nevada, Arizona, Utah</li>
<li><strong>Ideal companies to start sourcing from:</strong> Google, Apple, Microsoft, Amazon, Meta, Netflix, Salesforce, Oracle, Adobe, Tesla.</li>
</ul>';

// Output the content
?>
<div class="expandable-search-section">
    <h3 class="expandable-title" onclick="(function(element) { const content = element.nextElementSibling; const caret = element.querySelector('.caret'); if (content.classList.contains('expanded')) { content.classList.remove('expanded'); caret.classList.remove('expanded'); } else { content.classList.add('expanded'); caret.classList.add('expanded'); } })(this)">
        <span class="caret"><svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" style="transform: rotate(-90deg);"><path d="M13.5306 6.53063L8.5306 11.5306C8.46092 11.6005 8.37813 11.656 8.28696 11.6939C8.1958 11.7317 8.09806 11.7512 7.99935 11.7512C7.90064 11.7512 7.8029 11.7317 7.71173 11.6939C7.62057 11.656 7.53778 11.6005 7.4681 11.5306L2.4681 6.53063C2.3272 6.38973 2.24805 6.19864 2.24805 5.99938C2.24805 5.80012 2.3272 5.60902 2.4681 5.46813C2.60899 5.32723 2.80009 5.24808 2.99935 5.24808C3.19861 5.24808 3.3897 5.32723 3.5306 5.46813L7.99997 9.9375L12.4693 5.4675C12.6102 5.32661 12.8013 5.24745 13.0006 5.24745C13.1999 5.24745 13.391 5.32661 13.5318 5.4675C13.6727 5.6084 13.7519 5.7995 13.7519 5.99875C13.7519 6.19801 13.6727 6.38911 13.5318 6.53L13.5306 6.53063Z" fill="#1F1F23"/></svg></span>
        🎯 Exact
    </h3>
    <div class="expandable-content">
        <?php echo $content; ?>
        <button load-="exact.php">Show prospects 👉</button>
    </div>
</div>


<script type="application/json" id="system-commands">
<?php echo json_encode($commands); ?>
</script>
