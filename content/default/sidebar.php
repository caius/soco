<h4>SiteMap</h4>
<?php

# Navigation
$dir = new ListDirectory(CONTENT);
$nav = new Navigation();
$nav->Output($dir->files, -1);

?>