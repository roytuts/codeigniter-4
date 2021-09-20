<?php

if (!function_exists("my_each")) {
	function my_each(&$arr) {
		$key = key($arr);
		$result = ($key === null) ? false : [$key, current($arr), 'key' => $key, 'value' => current($arr)];
		next($arr);
		return $result;
	}
}

if (!function_exists('mysql_to_php_date')) {

    function mysql_to_php_date($mysql_date) {
        $datetime = strtotime($mysql_date);
        $format = date("F j, Y, g:i a", $datetime);
        return $format;
    }

}