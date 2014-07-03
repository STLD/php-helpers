<?php namespace STLD\PHP_Helpers;

class Helper
{
	/**
	 * Recursively search through array to find string
	 * 
	 * @param  string $needle   searching string
	 * @param  int    $haystack array to search through
	 * @return mixed  boolean|int             
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

	public static function searchArray($value,$array,$return_index=0)
	{
		$index = self::recursive_array_search($value,$array);

		if($index !== false && isset($array[$index][$return_index]) && !empty($array[$index][$return_index])){
			return $array[$index][$return_index];
		}

		return false;
	}
}
