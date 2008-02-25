<?php

# Less is more
function __autoload($class_name) {
	require_once("classes/" . strtolower($class_name) . ".php");
}

# Include the sorry bastards
require_once(BASE."includes/geshi/geshi.php");
// require_once(BASE."includes/geshi-src/class.geshi.php");
// require_once(BASE."includes/flickr/flickr_api.php");

?>