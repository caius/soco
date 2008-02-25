<?php

	/**
	* Quick Class to capitalise stuff
	*/
	class Capitalise
	{
		/**
		 * Stuff that shouldn't be cased anywhere in the string
		 */
		private $exclude = array(
			"PHP", "GeSHi", "MySQL", "HTML", "CSS", "xHTML"
		);
		
		/**
		 * todo: Write the function to check this against $text
		 * Stuff that shouldn't be cased unless its at the front
		 */
		private $e_start = array(
			"is", "a", "the"
		);
		
		public function __construct()
		{
			# Just to stop it complaining about Capitalise()
		} // __construct
		
		function C($text)
		{
			return $this->Capitalise($text);
		} // C
		
		function Capitalise($text)
		{
			if (!is_array($text)) {
				$text = $this->process($text);
			} else {
				# Is an array
				foreach ($text as $k => $v) {
					$text[$k] = $this->Process($v);
				}
			}
			
			return $text;
		} // Capitalise
		
		function Process($text)
		{
			$text = $this->mbcc($text);
			foreach ($this->exclude as $v) {
				$text = str_replace($this->mbcc($v), $v, $text);
			}
			return $text;
		} // Process
		
		function mbcc($text)
		{
			// return mb_convert_case($text, MB_CASE_TITLE);
			return $text;
		} // mbcc
	}
?>