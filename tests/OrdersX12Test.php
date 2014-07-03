<?php
use STLD\PHP_Helpers\OrderX12;

class OrdersX12Test extends PHPUnit_Framework_TestCase
{
	
	protected function setUp()
	{
		$this->order = new OrderX12(array(
			'san'          => '12345',
			'backorders'   => 'Y',
			'company_name' => 'Test Company'
		));
	}

	function test_create_object()
	{
		
		$this->assertEquals($this->order->san,'12345');
		$this->assertEquals($this->order->total_ordered,0);
	}

	function test_add_shipping()
	{
		$this->order->shipping('BW');
		$this->assertEquals($this->order->shipping_method,'BW');
	}

	function test_add_shipto()
	{
		$this->order->shipto(
			array(
				'name'     => 'John Doe',
				'address1' => '100 Main Street',
				'address2' => 'Second Address Line',
				'address3' => 'Third Address Line',
				'city'     => 'Waynesboro',
				'state'    => 'GA',
				'zip'      => '30830',
				'country'  => '840',
			)
		);
	}

	function test_add_item()
	{
		$items = array(
			'9781433679735'=>10,
			'9781591451884'=>5
		);

		foreach($items as $item => $qty){
			$this->order->addItem($item,$qty);
		}

		$this->assertEquals($this->order->total_ordered,15);
	}

	function test_string_output()
	{
		$o = $this->order->__toString();
		
		$this->assertTrue(is_string($o));
		$this->assertTrue(!empty($o));
	}

}