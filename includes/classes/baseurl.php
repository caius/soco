<?php

class BaseUrl
{
	public $URL;
	
	public function __construct($file)
	{
		# Setup some vars
		$dir = dirname($file);
		$self = $_SERVER["PHP_SELF"];
		$host = $_SERVER["HTTP_HOST"];

		# Process the vars
		$temp = $this->erase($dir, $file);
		$path = $this->erase($temp, $self);
		$path .= "/";

		# Return the base URL
		$url = "http://{$host}{$path}";
		$this->URL = $url;
		return true;
	}
	
	# I hate writing str_replace
	private function erase($take, $result)
	{
		return str_replace($take, "", $result);
	} // erase
}

?>