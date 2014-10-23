PHP OrderX12 Documentation
==========================

## Example Usage
```php
require_once('vendor/autoload.php');

$x12 = new STLD\PHP_Helpers\OrderX12(array(
	'san'             => 1234,
	'order_num'       => 100005,
	'company'         => 'Good Book Company',
	'po_num'          => 'TEST-ORDER',
	'backorders'      => 'n',
	'shipping_method' => 'BR',
));

// add drop shipping information
$x12->shipto(array(
	'name'     => 'John Doe',
	'address'  => array(
		'100 Biblica Way',
		'Appartment #999',
		'c/o John Doe',
	),
	'city'     => 'Elizabethton',
	'state'    => 'TN',
	'zip'      => '37643',
	'country'  => '840',
));

// add items to order
$x12->addItem('9781591451884',5);
$x12->addItem('9781433679735',2,19.99,0.23); // with optional retail and discount

// write order file
file_put_contents($x12->order_num.'.xpo',$x12);
```

## Example Using Countries & UsaStates Helper Classes
```php
require_once('vendor/autoload.php');

$x12 = new STLD\PHP_Helpers\OrderX12(array(
	'san'        => 1234,
	'order_num'  => 100005,
	'company'    => 'Good Book Company',
	'po_num'     => 'TEST-ORDER',
	'backorders' => 'n',
	'shipping_method' => 'BR',
));

// add drop shipping information
$x12->shipto(array(
	'name'     => 'John Doe',
	'address'  => array(
		'100 Biblica Way',
		'Apartment #999',
		'c/o John Doe',
	),
	'city'     => 'Elizabethton',
	'state'    => STLD\PHP_Helpers\UsaStates::alpha('Tennessee'),
	'zip'      => '37643',
	'country'  => STLD\PHP_Helpers\Countries::numeric('United States'),
));

// add items to order
$x12->addItem('9781591451884',5);
$x12->addItem('9781433679735',2,19.99,0.23); // with optional retail and discount

// write order file
file_put_contents($x12->order_num.'.xpo',$x12);
```