<?php

# Select which theme to use
# note: just set this to the folder name in ./content
$theme = "default";
define(THEME, $theme);

# Setup some paths
$_PATHS["base"]      = dirname(dirname(__FILE__)) . "/";
$_PATHS["includes"]  = $_PATHS["base"] . "includes/";
$_PATHS["content"]   = $_PATHS["base"] . "content/";
$_PATHS["templates"] = $_PATHS["base"] . "templates/";
$_PATHS["pear"]      = $_PATHS["base"] . "pear/";
$_PATHS["logs"]      = $_PATHS["base"] . "logs/";

# Set include path
ini_set("include_path", "$_PATHS[includes]:$_PATHS[pear]:$_PATHS[templates]");

# define some basic paths
define(BASE, $_PATHS["base"]);
define(CONTENT, $_PATHS["content"]);

# Are we using pretty URLs?
$pretty_urls = true;
if ($pretty_urls) { define(QUERYSTRING, ''); } else { define(QUERYSTRING, '?p='); }

# Carry on through
include 'prepend.php';

?>