<?php

/**
	* Converts Various stuff
	*/
class Convert
{
	static $nums = array(
		1 => 'one', 2 => 'two', 3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
		7 => 'seven', 8 => 'eight', 9 => 'nine', 10 => 'ten', 11 => 'eleven',
		12 => 'twelve', 13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
		16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen', 19 => 'nineteen',
		20 => 'twenty', 30 => 'thirty', 40 => 'forty', 50 => 'fifty', 60 => 'sixty',
		70 => 'seventy', 80 => 'eighty', 90 => 'ninety', 0 => 'zero', '-' => 'minus'
		);


	function __construct()
	{
		# Do nothing by default yet
	}

	static function File_to_URL($name)
	{
		if (is_array($name)) {
			foreach ($name as $k => $v) {
				$name[$k] = $this->File_to_URL($v);
			}
		}	else {
			$name = str_replace(" ", "_", "$name");
		}
		return $name;
	} // File_to_URL

	static function URL_to_File($url)
	{
		if (is_array($url)) {
			foreach ($url as $k => $v) {
				$url[$k] = $this->File_to_URL($v);
			}
		} else {
			$url = str_replace("_", " ", "$url");
		}
		return $url;
	} // URL_to_File

	# Written by pqscvkrfet
	static function Number_to_Word($num)
	{
		$fn = array();

		if ($num == 0)
			return self::$nums[0];

		while ($num != 0) {
			if ($num < 0) {
				$fn[] = self::$nums['-'];
				$num = -$num;
			}
			elseif ($num < 20) {
				$fn[] = self::$nums[$num];
				$num = 0;
			}
			else if ($num < 100) {
				$val = floor($num / 10) * 10;
				$fn[] = self::$nums[$val];
				if (($num -= $val) > 0)
					$fn[] = '-';
			}
			else {
				if ($num < 1000) {
					$num -= ($val = floor($num / 100)) * 100;
					$fn[] = self::$nums[$val] . ' hundred';
				}
				else {
					if ($num < 1000000) {
						$fn = array_merge($fn, (array)self::Number_to_Word(floor($num / 1000)));
						$fn[] = 'thousand';
						$num = $num % 1000;
					}
					else {
						if ($num < 1000000000) {
							$fn = array_merge($fn, (array)self::Number_to_Word(floor($num / 1000000)));
							$fn[] = 'million';
							$num = $num % 1000000;
						}
						else {
							trigger_error("WriteNum::write :: number is bigger than maximum allowed.", E_USER_WARNING);
							return false;
						}
					}
				}
			}
		}

		return preg_replace('/ \- /', '-', implode(' ', $fn));
	} // Number_to_Word

}



?>