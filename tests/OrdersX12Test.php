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
				'address'  => array(
					'100 Main Street',
					'Second Address Line',
					'Third Address Line'
				),
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

	function test_format_address()
	{
		$address = array(
			'12345679 Super Long Address With Lots of Words',
			'Main Street c/o John Doe',
			'Please deliver to back door before noon'
		);
		$f = $this->order->formatAddress($address);
		$this->assertEquals($f[2],'Please deliver to back door before');

		$address = array('12345679 Super Long Address With Lots of Words','Main Street c/o John Doe');
		$f = $this->order->formatAddress($address);

		$this->assertEquals(count($f),3);
	}

}