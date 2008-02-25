<?php

class Navigation
{
	public $input;
	public $output;
	
	function __construct()
	{
		# Todo: Rip this line out somehow
		$this->C = new Capitalise;
	}

	function Prepare()
	{
		$array = explode("\n", $this->output);

		foreach ($array as $key => $value) {
			if (!strpos(strtolower($value), "home") === false) {
				array_unshift($array, $value);
				array_unshift($array, $array[1]);
				unset($array[$key+2]);
				unset($array[2]);
			}
		}
		$array[0] = "<ul class=\"nav\">";
		
		$this->output = join("\n", $array);
	} // Prepare

	function Generate($array, $level=-1, $prefix=null)
	{
		$class = 1;
		# Time for walkies!
		$this->output .= "<ul>\n";
		foreach ($array as $key => $value) {
			
			if (is_array($value)) {
				
				# If its a folder, call ourselves again
				if ($level > 0 || $level == -1) {
					
					# Output the folder name as a link, then iterate through the folder itself
					$this->output .= "<li class=\"parent ".Convert::Number_to_Word($class)."\">";
					$this->output .= "<a href=\"".BASE_URL.QUERYSTRING.Convert::File_to_URL($prefix). Convert::File_to_URL($key) . "/index\" title=\"{$this->C->C($key)}/index\">{$this->C->C($key)}</a>\n";
					
					# Iterage through
					if ($level != -1) { $l = $level - 1; } else { $l = $level; }
					$this->Generate($value, $l, $prefix.$key."/");
					# End the folder list item
					$this->output .= "</li>\n";
					$class += 1;
				} else {
					# Output the foldername, but nothing more underneath it
					$this->output .= "<li><a href=\"".BASE_URL.QUERYSTRING.Convert::File_to_URL($key)."/index\" title=\"{$this->C->C($key)}/index\"";
					
					# Check if its the current file or not...
					if ($this->C->C(PAGE_NAME) == "{$this->C->C($key)}") {
						$this->output .= " class=\"active\" ";
					}
					
					$this->output .= ">{$this->C->C($key)}</a></li>\n";
				}
			} else {
				if (!$prefix) {
					$name = str_replace("index", "home", $value);
				} else {
					$name = $value;
				}
								
				# Bodged code, but it works.
				if ($prefix && $name == "index") {
						# do nothing
				} else {
					$this->output .= "<li><a href=\"".BASE_URL.QUERYSTRING.Convert::File_to_URL($prefix).Convert::File_to_URL($value)."\" title=\"{$this->C->C($name)}\"";
					
					# Check if its the current file or not...
					if ($this->C->C(PAGE_NAME) == "{$this->C->C($value)}") {
						$this->output .= " class=\"active\" ";
					}
					
					$this->output .= ">{$this->C->C($name)}</a></li>\n";
				}
			}
		} // foreach
		$this->output .= "</ul>";
	} // NavGen

	function Output($array, $nested=true, $prefix=null)
	{
		$this->input = $array;
		$this->Generate($this->input, $nested, $prefix);
		# Post editing
		$this->Prepare();
		print $this->output;
	} // Output
}


?>