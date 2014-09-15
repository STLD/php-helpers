PHP State Helper
================

Class to help you work with USA states. Convert and find states by their full name (Georgia), alpha codes (GA), numeric codes (13), or AP abbreviation (Ga.).

## Quick Usage

```php
require 'vendor/autoload.php';
$s = new STLD\PHP_Helpers\UsaStates;

echo $s::name('GA'); // Georgia
echo $s::numeric('Georgia'); // 13
echo $s::alpha('Georgia'); // GA
echo $s::abbr('Georgia'); // Ga.
```

## Full Usage
```php
require 'vendor/autoload.php';
$s = new STLD\PHP_Helpers\UsaStates;

// full names - all return Georgia
echo $s::name('GA');
echo $s::name('13');
echo $s::name('Georgia');
echo $s::name('Ga.');

// numeric - all return 13
echo $s::numeric('GA');
echo $s::numeric('13');
echo $s::numeric('Georgia');
echo $s::numeric('Ga.');

// alpha - all return GA
echo $s::alpha('GA');
echo $s::alpha('13');
echo $s::alpha('Georgia');
echo $s::alpha('Ga.');

// abbreviations  - all return Ga.
echo $s::abbr('GA');
echo $s::abbr('13');
echo $s::abbr('Georgia');
echo $s::abbr('Ga.');
```

## Create State HTML Dropdown Menu
```php
require 'vendor/autoload.php';
$s = new STLD\PHP_Helpers\UsaStates;

$options = '<option>(choose a state)</option>';
foreach($s::getArray() as $state)
{
	$options .= '<option value="'.$state[2].'">'.$state[0].'</option>'.PHP_EOL;
}

echo '<select>'.$options.'</select>';
```