<?php

class Category
{
	function __construct($cat=null)
	{
		# Todo: Rip this line out somehow
		$this->C = new Capitalise;
		if ($cat) {
			$this->index($cat);
		}
	}
	
	function Index($file)
	{
		$parent = dirname($file);
		$gparent = dirname($parent)."/";
		$path = str_replace(CONTENT, "", $parent)."/";
		$name = str_replace($gparent, "", $parent);
		echo "<h2>".$this->C->C($name)."</h2>";
		$this->ListCategory($path);
	} // Index
	
	function ListCategory($cat)
	{
		$dir = new ListDirectory(CONTENT.$cat);
		$nav = new Navigation();
		$nav->Output($dir->files, true, $cat);
	} // ListCategory
}


?>