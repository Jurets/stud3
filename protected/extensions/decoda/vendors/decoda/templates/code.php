<?php
// TODO: edited
if (Yii::app()->decoda->useTextHighlighterForCode == true) {
    $content = html_entity_decode($content);
    $thl = new CTextHighlighter();
    if (!empty($default)) {
        $thl->language = $default;
    }
    echo $thl->highlight($content);
} else {
    // Place $content directly within the tags to not leave any whitespace for <pre>
?>
<pre class="decoda-code <?php if (!empty($default)) { echo 'code-'. $default; } ?>"<?php if (isset($hl)) { ?> data-highlight="<?php echo $hl; ?>"<?php } ?>><?php echo $content; ?></pre>
<?php } ?>