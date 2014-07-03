<?php
use STLD\PHP_Helpers\UsaStates as States;

class UsaStatesTest extends PHPUnit_Framework_TestCase
{
	
	public function test_state_name()
	{
		$s = array(
			States::name('GA'),
			States::name('Georgia'),
			States::name('13')
		);
		
		$this->assertEquals(implode(',',array_unique($s)),'Georgia');
	}

	public function test_state_name_false()
	{
		$this->assertFalse(States::name('XX'));
	}

	public function test_state_alpha()
	{
		$s = array(
			States::alpha('GA'),
			States::alpha('Georgia'),
			States::alpha('13')
		);
		
		$this->assertEquals(implode(',',array_unique($s)),'GA');
	}

	public function test_state_alpha_false()
	{
		$this->assertFalse(States::alpha('XX'));
	}

	public function test_state_numeric()
	{
		$s = array(
			States::numeric('GA'),
			States::numeric('Georgia'),
			States::numeric('13')
		);
		
		$this->assertEquals(implode(',',array_unique($s)),'13');
	}

	public function test_state_numeric_false()
	{
		$this->assertFalse(States::numeric('XX'));
	}

	public function test_state_abbr()
	{
		$s = array(
			States::abbr('GA'),
			States::abbr('Georgia'),
			States::abbr('13')
		);
		
		$this->assertEquals(implode(',',array_unique($s)),'Ga.');
	}

	public function test_state_abbr_false()
	{
		$this->assertFalse(States::abbr('XX'));
	}

	public function test_state_array()
	{
		$this->assertTrue(is_array(States::getArray()));
		$this->assertGreaterThan(1,count(States::getArray()));
	}

}