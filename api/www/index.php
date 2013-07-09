<?php
/**
 * Bootstrap index file
 *
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @link http://www.ramirezcobos.com/
 * @link http://www.2amigos.us/
 * @copyright 2013 2amigOS! Consultation Group LLC
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */

error_reporting(E_ALL);
ini_set("display_errors", 1);

require('./../../common/lib/vendor/autoload.php');


$conf_for_merge = array(
	__DIR__ .'/../../common/config/main.php',
	__DIR__ .'/../../common/config/env.php',
	__DIR__ .'/../../common/config/local.php'
);
//$conf_for_merge = array();

Yiinitializr\Helpers\Initializer::create('./../', 'api', $conf_for_merge)->run();