<?php
use STLD\PHP_Helpers\Helper;

class HelperTest extends PHPUnit_Framework_TestCase
{
	function __construct()
	{
		$this->array = array(
			array('Send The Light Distribution','100 Biblica Way','TN'),
			array('Great Value Books','100 Southside Drive','TN'),
			array('Advocate','135 Main Street','GA'),
		);
	}

	public function test_recursive_array_search()
	{
		$this->assertEquals(1,Helper::recursive_array_search('Great Value Books',$this->array));
		$this->assertEquals(0,Helper::recursive_array_search('TN',$this->array));
		
		// return false for string not in array
		$this->assertFalse(Helper::recursive_array_search('String',$this->array));
	}

	public function test_search_array()
	{
		$this->assertEquals('100 Biblica Way',Helper::searchArray('TN',$this->array,1));
		$this->assertEquals('Advocate',Helper::searchArray('GA',$this->array));

		// return false for string not in array
		$this->assertFalse(Helper::searchArray('FL',$this->array));
	}

	public function test_array_range()
	{
		$start = -2;
		$end = 5;
		$exclude = array(0,4);
		
		$this->assertCount(8,Helper::arrayRange($start,$end));
		
		/// with an excluded range
		$this->assertCount(6,Helper::arrayRange($start,$end,$exclude));
		
		// start and end same
		$this->assertCount(1,Helper::arrayRange($start,$start));
	}

}