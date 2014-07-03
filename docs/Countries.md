PHP Country Helper
==================

[![Build Status](https://travis-ci.org/STLD/php-country-helper.svg?branch=master)](https://travis-ci.org/STLD/php-country-helper) 
[![Coverage Status](https://coveralls.io/repos/STLD/php-country-helper/badge.png?branch=master)](https://coveralls.io/r/STLD/php-country-helper?branch=master)

Class to help you work with countries. Convert and find countries by their full name (United States), alpha codes (US or USA), or numeric cdes (840).

## Quick Usage

```php
<?php
require 'vendor/autoload.php';
$c = new STLD\PHP_Helpers\Countries;

echo $c::name('US'); // United States
echo $c::alpha('United States'); // USA
echo $c::alpha('United States',2); // US
echo $c::numeric('United States'); // 840
```

## Full Usage
```php
<?php

// full names - all return United States
echo $c::name('840');
echo $c::name('US');
echo $c::name('USA');
echo $c::name('United States');

// alpha 3 (default) - all return USA
echo $c::alpha('840');
echo $c::alpha('US');
echo $c::alpha('USA');
echo $c::alpha('United States');

// alpha 2  - all return US
echo $c::alpha('840',2);
echo $c::alpha('US',2);
echo $c::alpha('USA',2);
echo $c::alpha('United States',2);

// numeric  - all return 840
echo $c::numberic('840');
echo $c::numberic('US');
echo $c::numberic('USA');
echo $c::numberic('United States');
```

## Create Country HTML Dropdown Menu
```php
<?php
require 'class.countries.php';
$c = new countries;

$options = '<option>(choose a country)</option>';
foreach($c::countriesArray() as $country)
{
	$options .= '<option value="'.$country[2].'">'.$country[0].'</option>'.PHP_EOL;
}

echo '<select>'.$options.'</select>';
```

## Credits
- Country data http://en.wikipedia.org/wiki/ISO_3166-1
