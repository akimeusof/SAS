<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <style type="text/css">
        body {margin:0;border:0;padding:0;font:11pt sans-serif}
        body > h1 {margin:0 0 0.5em 0;font:2em sans-serif;background-color:#def}
        body > div {padding:2px}
        p {margin-top:0}
        ins {color:green;background:#dfd;text-decoration:none}
        del {color:red;background:#fdd;text-decoration:none}
        #params {margin:1em 0;font: 14px sans-serif}
        .panecontainer > p {margin:0;border:1px solid #bcd;border-bottom:none;padding:1px 3px;background:#def;font:14px sans-serif}
        .panecontainer > p + div {margin:0;padding:2px 0 2px 2px;border:1px solid #bcd;border-top:none}
        .pane {margin:0;padding:0;border:0;width:100%;min-height:20em;overflow:auto;font:12px monospace}
        #htmldiff {color:gray}
        #htmldiff.onlyDeletions ins {display:none}
        #htmldiff.onlyInsertions del {display:none}
    </style>
    <title>PHP Fine Diff: Online Diff Viewer</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<a href="https://github.com/gorhill/PHP-FineDiff"><img style="position: absolute; top: 0; right: 0; border: 0;" src="https://camo.githubusercontent.com/38ef81f8aca64bb9a64448d0d70f1308ef5341ab/68747470733a2f2f73332e616d617a6f6e6177732e636f6d2f6769746875622f726962626f6e732f666f726b6d655f72696768745f6461726b626c75655f3132313632312e706e67" alt="Fork me on GitHub" data-canonical-src="https://s3.amazonaws.com/github/ribbons/forkme_right_darkblue_121621.png"></a>
<h1>PHP Fine Diff: Online Diff Viewer</h1>
<div>
    @if(isset($rendered_diff))
    <div class="panecontainer" style="width:99%"><p>Diff <span style="color:gray">(diff: <?php printf('%.3f', $exec_time); ?> seconds, diff len: <?php echo $diff_opcodes_len; ?> chars)</span>&emsp;/&emsp;Show <input type="radio" name="htmldiffshow" onclick="setHTMLDiffVisibility('deletions');">Deletions only&ensp;<input type="radio" name="htmldiffshow" checked="checked" onclick="setHTMLDiffVisibility();">All&ensp;<input type="radio" name="htmldiffshow" onclick="setHTMLDiffVisibility('insertions');">Insertions only</p><div><div id="htmldiff" class="pane" style="white-space:pre-wrap"><?php
                echo $rendered_diff; ?></div></div>
    </div>
    @endif
    <form action="{{route('l_fineDiff')}}" method="post">
        <p style="margin:1em 0 0.5em 0">Enter text to diff below:</p>
        <div class="panecontainer" style="display:inline-block;width:49.5%"><p>From</p><div><textarea name="from" class="pane"><?php echo isset($from_text)?htmlentities($from_text, ENT_QUOTES, 'UTF-8'):""; ?></textarea></div></div>
        <div class="panecontainer" style="display:inline-block;width:49.5%"><p>To</p><div><textarea name="to" class="pane"><?php echo isset($to_text)?htmlentities($to_text, ENT_QUOTES, 'UTF-8'):""; ?></textarea></div></div>
        <p id="params">Granularity:<input name="granularity" type="radio" value="0"<?php if ( $granularity === 0 ) { echo ' checked="checked"'; } ?>>&thinsp;Paragraph/lines&ensp;<input name="granularity" type="radio" value="1"<?php if ( $granularity === 1 ) { echo ' checked="checked"'; } ?>>&thinsp;Sentence&ensp;<input name="granularity" type="radio" value="2"<?php if ( $granularity === 2 ) { echo ' checked="checked"'; } ?>>&thinsp;Word&ensp;<input name="granularity" type="radio" value="3"<?php if ( $granularity === 3 ) { echo ' checked="checked"'; } ?>>&thinsp;Character&emsp;
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="submit" value="View diff">&emsp;<a href="viewdiff.php"><button>Clear all</button></a></p>
    </form>
    <p style="margin-top:1em"><a href="viewdiff-ex.php">Go to main page</a></p>
    <script type="text/javascript">
        <!--
        function setHTMLDiffVisibility(what) {
            var htmldiffEl = document.getElementById('htmldiff'),
                    className = htmldiffEl.className;
            className = className.replace(/\bonly(Insertions|Deletions)\b/g, '').replace(/\s{2,}/g, ' ').replace(/\s+$/, '').replace(/^\s+/, '');
            if ( what === 'deletions' ) {
                htmldiffEl.className = className + ' onlyDeletions';
            }
            else if ( what === 'insertions' ) {
                htmldiffEl.className = className + ' onlyInsertions';
            }
            else {
                htmldiffEl.className = className;
            }
        }
        // -->
    </script>
</body>
</html>
