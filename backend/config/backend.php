<?php
/**
 * backend.php configuration file
 *
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @link http://www.ramirezcobos.com/
 * @link http://www.2amigos.us/
 * @copyright 2013 2amigOS! Consultation Group LLC
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */

defined('APP_CONFIG_NAME') or define('APP_CONFIG_NAME', 'backend');

// web application configuration
return array(
	'basePath' => realPath(__DIR__ . '/..'),
	// path aliases
	'aliases' => array(
		// assumed the use of yiistrap and yiiwheels extensions
		'bootstrap' => 'vendor.yii-twbs.yiistrap',
		'yiiwheels' => 'vendor.2amigos.yiiwheels'
	),

    'import' => array(
   		'backend.components.*',
    ),

	// application behaviors
	'behaviors' => array(),

	// controllers mappings
	'controllerMap' => array(),

	// application modules
	'modules' => array(),

	// application components
	'components' => array(
        'authManager' => array(
            'class' => 'BAuthManager', // override standart authManager class!!!
            'defaultRoles' => array('guest'),
        ),

		'user' => array(
			'allowAutoLogin' => true,
			'class' => "BWebUser", // override standart User class
		),

		'bootstrap' => array(
			'class' => 'bootstrap.components.TbApi',
		),

		'clientScript' => array(
			'scriptMap' => array(
				'bootstrap.min.css' => false,
				'bootstrap.min.js' => false,
				'bootstrap-yii.css' => false
			)
		),
		'urlManager' => array(
			// uncomment the following if you have enabled Apache's Rewrite module.
			'urlFormat' => 'path',
			'showScriptName' => false,
			'rules' => array(
				// default rules
				'<controller:\w+>/<id:\d+>' 				=> '<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>' 	=> '<controller>/<action>',
				'<controller:\w+>/<action:\w+>'				=> '<controller>/<action>',
			),
		),

		'errorHandler' => array(
			'errorAction' => 'site/error',
		)
	),
);