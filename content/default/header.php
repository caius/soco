<h1>Hentan Software</h1>

<div id="topbar">
	<?php
	
	# Navigation
	$dir = new ListDirectory(CONTENT);
	$nav = new Navigation();
	$nav->Output($dir->files, 0);
	
	
	?>
</div><!-- end #topbar -->