<?php
/**
 * User: sunsey
 * Date: 12.05.13
 */
 
function pa()
{
	$backtrace = debug_backtrace();
	$args = func_get_args();
	$matches = array();
	preg_match('|.*[\/\\\](.+)$|', $backtrace[0]['file'], $matches);
	$res = array($matches[1].': '.$backtrace[0]['line'], $args);
	echo "<pre>";
	print_r($res);
	echo "</pre>";
}