<?php


	class Geshi2 extends Geshi
	{
		
		var $user_set_overall_class;
		var $caption;
		var $example_number = 0;
		
		function __construct($source=null, $language=null, $caption=null)
		{
			# Always use CSS
			$this->enable_classes();
			$this->set_overall_class('geshi');
			
			# Set the variables
			if ($source) 		$this->set_source($source);
      if ($language) 	$this->set_language($language);
			if ($caption) 	$this->set_caption($caption);
		} // __construct
		
		function set_caption($caption)
		{
			$this->caption = ($caption);
		} // set_caption
		
		function set_overall_class($overall_class)
		{
			$this->overall_class = $overall_class;
			$this->user_set_overall_class = true;
		} // set_overall_class
		
		private function Caption()
		{
			return "<span class=\"caption\"><strong>Example {$this->example_number}</strong> -- {$this->caption} -- <a href=\"#\" onclick=\"fnSelect('code_snippet_".$this->example_number."');\" class=\"select_code\">Select Code</a></span>";
		} // Caption
	
		public function Render($source=null, $language=null, $caption=null)
		{
			$this->example_number += 1;
			# Set the variables
			if ($source) 		$this->set_source($source);
      if ($language) 	$this->set_language($language);
			if ($caption) 	$this->set_caption($caption);

			if (!$this->caption) {
				// $this->set_caption(mb_convert_case($this->language, MB_CASE_TITLE)." snippet");
				$this->set_caption("{$this->language} snippet");
			}
			
			$this->set_overall_id("code_snippet_".$this->example_number);
			
			echo "<div class=\"code\">";
			echo $this->Parse_code();
			echo $this->Caption();
			echo "</div><!-- end .code -->";
			
			$this->Reset();
		} // Render
		
		function Reset()
		{
			$this->set_source("");
			$this->set_caption("");
		} // Reset
		
		function Footer()
		{
			$footer_content = $this->format_footer_content();

      if (GESHI_HEADER_NONE == $this->header_type) {
          return ($this->line_numbers != GESHI_NO_LINE_NUMBERS) ? '</ol>' . $footer_content
              : $footer_content;
      }

      if ($this->header_type == GESHI_HEADER_DIV) {
          if ($this->line_numbers != GESHI_NO_LINE_NUMBERS) {
              return "</ol>$footer_content</div>";
          }
          return ($this->force_code_block ? '</div>' : '') .
              "$footer_content</div>";
      }
      else {
          if ($this->line_numbers != GESHI_NO_LINE_NUMBERS) {
              return "</ol>$footer_content</pre>";
          }
          return ($this->force_code_block ? '</div>' : '') .
              "$footer_content</pre>";
      }
		} // Footer
		
		function load_language($file_name)
		{
			$this->enable_highlighting();
      $language_data = array();
      require $file_name;
      // Perhaps some checking might be added here later to check that
      // $language data is a valid thing but maybe not
      $this->language_data = $language_data;
      // Set strict mode if should be set
      if ($this->language_data['STRICT_MODE_APPLIES'] == GESHI_ALWAYS) {
          $this->strict_mode = true;
      }
      // Set permissions for all lexics to true
      // so they'll be highlighted by default
      foreach ($this->language_data['KEYWORDS'] as $key => $words) {
          $this->lexic_permissions['KEYWORDS'][$key] = true;
      }
      foreach ($this->language_data['COMMENT_SINGLE'] as $key => $comment) {
          $this->lexic_permissions['COMMENTS'][$key] = true;
      }
      foreach ($this->language_data['REGEXPS'] as $key => $regexp) {
          $this->lexic_permissions['REGEXPS'][$key] = true;
      }

      if (!$this->user_set_overall_class) {
      	// Set default class for CSS
	      $this->overall_class = $this->language;
      }
		} // load_language
		
	} // Geshi2
	


?>