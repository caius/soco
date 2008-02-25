<h2>Welcome</h2>

<p>
	Welcome to Hentan Software.  This is my little software company, but its mainly just a place I can put all my code so its all organised.
</p>

<p>Thanks to the magic of Geshi, I can include colour coded code on this site!</p>

<?php
	
$source = <<<EOF
# Quick Test
5.times { |x| p x*200 }
EOF;
	
$language = "ruby";
$cap = "Quick little testing script";

$this->geshi->render($source, $language, $cap);

?>

<p>It even does applescript highlighting.  Although with RubyOSA I shouldn't be using pure applescript that much anymore!</p>

<?php

$source = <<<EOF
tell application "Finder"
	quit
end tell
EOF;
$lang = "applescript";
$this->geshi->Render($source, $lang);

?>