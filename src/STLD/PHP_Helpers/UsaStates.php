<?php namespace STLD\PHP_Helpers;

use STLD\PHP_Helpers\Helper;

/*
|--------------------------------------------------------------------------
| USA States Helper
|--------------------------------------------------------------------------
|
| Convert and find USA States by names, codes, numeric, or abbreviations
| Source: http://en.wikipedia.org/wiki/List_of_U.S._state_abbreviations
|
|  Usage:
|	require 'vendor/autoload.php';
|	$state = new STLD\PHP_Helpers\UsaStates;
|
|  echo $state::name('GA'); // Georiga
|  echo $state::numeric('Ga.'); // 13
|  echo $state::alpha('13'); // GA
|  echo $state::abbr('Georgia'); // Ga.
|
*/

class UsaStates
{
	static $states_array = array(
		array('Alabama','01','AL','Ala.'),
		array('Alaska','02','AK','Alaska'),
		array('American Samoa','60','AS',''),
		array('Arizona','04','AZ','Ariz.'),
		array('Arkansas','05','AR','Ark.'),
		array('California','06','CA','Calif.'),
		array('Colorado','08','CO','Colo.'),
		array('Connecticut','09','CT','Conn.'),
		array('Delaware','10','DE','Del.'),
		array('Federated States of Micronesia','64','FM',''),
		array('Florida','12','FL','Fla.'),
		array('Georgia','13','GA','Ga.'),
		array('Guam','66','GU',''),
		array('Hawaii','15','HI','Hawaii'),
		array('Idaho','16','ID','Idaho'),
		array('Illinois','17','IL','Ill.'),
		array('Indiana','18','IN','Ind.'),
		array('Iowa','19','IA','Iowa'),
		array('Kansas','20','KS','Kan.'),
		array('Kentucky','21','KY','Ky.'),
		array('Louisiana','22','LA','La.'),
		array('Maine','23','ME','Maine'),
		array('Marshall Islands','68','MH',''),
		array('Maryland','24','MD','Md.'),
		array('Massachusetts','25','MA','Mass.'),
		array('Michigan','26','MI','Mich.'),
		array('Minnesota','27','MN','Minn.'),
		array('Mississippi','28','MS','Miss.'),
		array('Missouri','29','MO','Mo.'),
		array('Montana','30','MT','Mont.'),
		array('Nebraska','31','NE','Neb.'),
		array('Nevada','32','NV','Nev.'),
		array('New Hampshire','33','NH','N.H.'),
		array('New Jersey','34','NJ','N.J.'),
		array('New Mexico','35','NM','N.M.'),
		array('New York','36','NY','N.Y.'),
		array('North Carolina','37','NC','N.C.'),
		array('North Dakota','38','ND','N.D.'),
		array('Northern Mariana Islands','69','MP',''),
		array('Ohio','39','OH','Ohio'),
		array('Oklahoma','40','OK','Okla.'),
		array('Oregon','41','OR','Ore.'),
		array('Palau','70','PW',''),
		array('Pennsylvania','42','PA','Pa.'),
		array('Puerto Rico','72','PR',''),
		array('Rhode Island','44','RI','R.I.'),
		array('South Carolina','45','SC','S.C.'),
		array('South Dakota','46','SD','S.D.'),
		array('Tennessee','47','TN','Tenn.'),
		array('Texas','48','TX','Texas'),
		array('U.S. Armed Forces - Europe','','AE',''),
		array('U.S. Armed Forces - Pacific Ocean','','AP',''),
		array('U.S. Armed Forces - Americas','','AA',''),
		array('United States Virgin Islands','78','VI',''),
		array('Utah','49','UT','Utah'),
		array('Vermont','50','VT','Vt.'),
		array('Virginia','51','VA','Va.'),
		array('Washington (state)','53','WA','Wash.'),
		array('Washington D.C.','11','DC','D.C.'),
		array('West Virginia','54','WV','W.Va.'),
		array('Wisconsin','55','WI','Wis.'),
		array('Wyoming','56','WY','Wyo.'),
	);

	/**
	 * Return state full name (Georgia, Tennessee)
	 * 
	 * @param  string $value state name, alpha or numeric code
	 * @return mixed 	boolean|string       
	 */
	public static function name($value)
	{
		return Helper::searchArray($value,self::$states_array,0);
	}

	/**
	 * Return state numeric code (13,12)
	 * 
	 * @param  string $value state name, alpha or numeric code
	 * @return mixed 	boolean|string
	 */
	public static function numeric($value)
	{
		return Helper::searchArray($value,self::$states_array,1);
	}

	/**
	 * Return state alpha code (GA, TN)
	 * 
	 * @param  string  $value state name, alpha or numeric code
	 * @return mixed 	 boolean|string
	 */
	public static function alpha($value)
	{
		return Helper::searchArray($value,self::$states_array,2);
	}
	
	/**
	 * Return state AP abbreviations (Ga.,Fla.)
	 * 
	 * @param  string $value state name, alpha or numeric code
	 * @return mixed 	boolean|string
	 */
	public static function abbr($value)
	{
		return Helper::searchArray($value,self::$states_array,3);
	}
	
	/**
	 * Return full state array
	 * 	 
	 * @return array
	 */
	public static function getArray()
	{
		return self::$states_array;
	}
}
