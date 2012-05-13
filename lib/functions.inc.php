<?php
/**
 * @author     SilexBB
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 or higher <http://www.gnu.org/licenses/gpl-3.0.html>
 */

/**
 * global shorthand functions
 */

/**
 * recursive scandir
 * @param  string $directory
 * @param  int    $sorting_order
 * @return array
 */
function scandirr($directory, $sorting_order = 0) {
	$files = scandir($directory, $sorting_order);
	if(strpos($directory, '/', strlen($directory) - 1) === false)
		$directory .= '/';
	
	$rfiles = array();
	foreach($files as $f) {
		if(($f === '.' || $f === '..') && is_dir($directory.$f))
			continue;
		if(is_dir($directory.$f)) {
			$rf = scandirr($directory.$f, $sorting_order);
			for($i = 0; $i < sizeof($rf); $i++)
				$rfiles[] = $f.'/'.$rf[$i];
		}
		else
			$rfiles[] = $f;
	}
	return $rfiles;
}

/**
 * get the first found key of the given value
 * breaks after the first found
 * @param  array $array
 * @param  mixed $search_value
 * @return mixed
 */
function array_get_key(array $array, $search_value) {
	foreach($array as $key => $value)
		if($value === $search_value)
			return $key;
	return false;
}

/**
 * get the founded key(s) of the given value
 * @param  array $array
 * @param  mixed $search_value
 * @return array
 */
function array_get_key_all(array $array, $search_value) {
	$founds = array();
	foreach($array as $key => $value)
		if($value === $search_value)
			$founds[] = $key;
	return empty($founds) ? false : $founds;
}

/**
 * clamp the value
 * @param  numeric $value
 * @param  numeric $min_value
 * @param  numeric $max_value
 * @return numeric
 */
function clamp($value, $min, $max) {
	return max(min($value, $max), $min);
}
?>