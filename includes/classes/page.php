<?php

class Page
{
	private $page_name;
	
	function __construct($pageName)
	{
		# Todo: Rip this line out somehow
		$this->C = new Capitalise;
		
		$this->page_name = $pageName;
		
		# Setup Geshi for us
		$this->geshi = new Geshi2;
		$this->geshi->set_footer_content_style("caption");
	} // __construct
	
	function Render()
	{
		include(CONTENT.THEME."/layout.php");
		return true;
	} // Render
	
	function FilePath($name)
	{
		$file = CONTENT . $name . ".php";
		if (!file_exists($file)) {
			$file = CONTENT . Convert::URL_to_File($name) . ".php";
		}
		return $file;
	} // FilePath
	

// = Page Tags =
	
	function Title()
	{
		# Some stuff to setup
		$site_name = "Hentan Software";
		$seperator = " « ";
		
		$name = $this->page_name;
		$array = explode("/", $name);
		
		$array = array_reverse($array);
		
		array_push($array, $site_name);
		
		$title = implode($seperator, $array);
		
		$title = $this->C->C($title);
		
		echo $title;
	} // Title
	
	function Header()
	{
		# Include header.php if it exists
		$file = $this->FilePath(THEME."/header");
		if (file_exists($file)) {
			include($file);
		}
	} // Header
	
	function Content()
	{
		$file = $this->FilePath($this->page_name);
		
		# Write out page, else write out error.php
		if (!file_exists($file)) {
			$log = new logging; $log->Error("404 - {$file}");
			$file = $this->FilePath(THEME."/error");
		}
		
		include($file);
	} // Content
	
	function Sidebar()
	{
		# Include sidebar.php if it exists
		$file = $this->FilePath(THEME."/sidebar");
		if (file_exists($file)) {
			include($file);
		}
	} // Sidebar
	
	function Footer()
	{
		# Include footer.php if it exists
		$file = $this->FilePath(THEME."/footer");
		if (file_exists($file)) {
			include($file);
		}
	} // Footer
	
	function Base_plus_dir($dir=null)
	{
		echo BASE_URL.$dir;
	} // Stylesheet
	
}


?>