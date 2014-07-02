<?php
use STLD\PHP_Helpers\Countries;

class CountriesTest extends PHPUnit_Framework_TestCase
{
	
	public function test_country_name()
	{
		$c = array(
			Countries::name('840'),
			Countries::name('USA'),
			Countries::name('US')
		);
		
		$this->assertEquals(implode(',',array_unique($c)),'United States');
	}

	public function test_country_name_false()
	{
		$this->assertFalse(Countries::name('XX'));
	}

	public function test_country_alpha()
	{
		$c = array(
			Countries::alpha('840'),
			Countries::alpha('United States'),
			Countries::alpha('US')
		);
		
		$this->assertEquals(implode(',',array_unique($c)),'USA');
	}

	public function test_country_alpha_false()
	{
		$this->assertFalse(Countries::alpha('XX'));
	}

	public function test_country_alpha_two()
	{
		$c = array(
			Countries::alpha('840',2),
			Countries::alpha('United States',2),
			Countries::alpha('USA',2)
		);
		
		$this->assertEquals(implode(',',array_unique($c)),'US');
	}

	public function test_country_alpha_two_false()
	{
		$this->assertFalse(Countries::alpha('XX',2));
	}

	public function test_country_numeric()
	{
		$c = array(
			Countries::numeric('United States'),
			Countries::numeric('USA'),
			Countries::numeric('US')
		);
		
		$this->assertEquals(implode(',',array_unique($c)),'840');
	}

	public function test_country_numeric_false()
	{
		$this->assertFalse(Countries::numeric('XXX'));
	}

	public function test_country_array()
	{
		$this->assertTrue(is_array(Countries::countriesArray()));
		$this->assertGreaterThan(1,count(Countries::countriesArray()));
	}

}