<?php

# 
#  listdirectory.php
#  Recursively read files into multi-dimensional array.
#  
#  Created by Caius Durling <dev at caius dot name> on 2007-06-18.
#  Copyright 2007 Hentan Software.
#  Licenced under the Creative Commons Attribution-NonCommercial-ShareAlike 2.0 License.
#  
#

class ListDirectory
{
	public $files;
	function __construct($path)
	{
		$this->files = $this->list_dir($path);
	}

	function list_dir($path)
	{
		# Note: To keep Meller and pqscvkrfet happy
		$files = array();
		
		if ($handle = opendir($path)) {
			while (false !== ($file = readdir($handle))) {
				if ($file != THEME && !preg_match('/^\..*$/', $file)) {
					if (is_dir($path.$file."/")) {
						$files[$file] = $this->list_dir($path.$file."/");
					} else {
						$a = explode(".php", $file);
						$files[] = $a[0];
					}
				}
			}
			closedir($handle);
		}
		return $files;
	} // list_dir
}

?>
