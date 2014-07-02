<?php
use STLD\PHP_Helpers\OrderX12;

class OrdersX12Test extends PHPUnit_Framework_TestCase
{
	
	function test_create_object()
	{
		$order = new OrderX12(array(
			'san'          => '12345',
			'backorders'   => 'Y',
			'company_name' => 'Test Company'
		));

		$this->assertEquals($order->san,'12345');
		$this->assertEquals($order->total_ordered,0);
	}

}