<?php namespace STLD\PHP_Helpers;

class Helper
{
	/**
	 * Recursively search through array to find first instance of string
	 * @param  string $needle   searching string
	 * @param  int    $haystack array to search through
	 * @return mixed  int|boolean             
	 */
	public static function recursive_array_search($needle,$haystack)
	{
		foreach($haystack as $key => $value) {
			$current_key = $key;
			if($needle === $value OR (is_array($value) && self::recursive_array_search($needle,$value) !== false)) {
				return $current_key;
			}
		}
		return false;
	}

	/**
	 * Recursively finds first instance of a value in array
	 * @param  string  $value        value to find
	 * @param  array   $array        array to search
	 * @param  integer $return_index specific index to return
	 * @return string|boolean
	 */
	public static function searchArray($value,$array,$return_index=0)
	{
		$index = self::recursive_array_search($value,$array);

		if($index !== false && isset($array[$index][$return_index]) && !empty($array[$index][$return_index])){
			return $array[$index][$return_index];
		}

		return false;
	}

	/**
	 * Find numeric range within an array
	 * with the option to exclude certain ranges
	 * Example: $start = 1; $end = 7; would return array(1,2,3,4,5,6,7);
	 * @param  int   $start
	 * @param  int   $end
	 * @param  array $exclude ranges to exclude
	 * @return array
	 */
	public static function arrayRange($start,$end,$exclude=array())
	{
		$range = array();
		for($x=$start; $x<=$end; $x++)
		{
			if(!in_array($x, $exclude)) $range[] = $x;
		}
		
		return $range;
	}
}
