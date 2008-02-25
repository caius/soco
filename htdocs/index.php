<?php

# Kick the whole thing off
include 'config.php';

# Define our BaseURL for us to work off
# done: moved to BaseURL.php class
# We can't do this in config.php because it 
# returns the wrong __FILE__ to the function.
$baseURL = new BaseURL(__FILE__);
define('BASE_URL', $baseURL->URL);

# Print the damned page!
if ($_GET['p']) {
	$pageName = $_GET['p'];
} elseif ($_GET['page']) {
	$pageName = $_GET['page'];
} else {
	$pageName = "index";
}

if (stristr($pageName, "/")) {
	$a = explode("/", $pageName);
	$pn = $a[0];
} else {
	$pn = $pageName;
}
# Quick hack to check which page we're on
define('PAGE_NAME', $pn);

$page = new Page($pageName);
# Write the page to the browser
$page->Render();

?>