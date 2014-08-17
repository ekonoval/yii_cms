<?php
/**
 *
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @link http://www.ramirezcobos.com/
 * @link http://www.2amigos.us/
 * @copyright 2013 2amigOS! Consultation Group LLC
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */

return array(
	'name' => '{APPLICATION NAME}',
    //'language' => 'en',
    'sourceLanguage' => 'en',
	'preload' => array(
        'log',
        'debug'
    ),
	'aliases' => array(
		'frontend' => dirname(__FILE__) . '/../..' . '/frontend',
		'common' => dirname(__FILE__) . '/../..' . '/common',
		'backend' => dirname(__FILE__) . '/../..' . '/backend',
		'vendor' => 'common.lib.vendor'
	),
	'import' => array(
		'common.extensions.components.*',
		'common.components.*',
		'common.helpers.*',
		'common.models.*',
		'application.controllers.*',
		'application.extensions.*',
		'application.helpers.*',
		'application.models.*'
	),
	'components' => array(
        'debug' => array(
            //'class' => 'ext.yii2-debug.Yii2Debug',
            'class' => 'vendor.zhuravljov.yii2-debug.Yii2Debug',
            'enabled' => false
        ),
		'db_sqlite'=>array(
            'class'=>'CDbConnection',
			//'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
			'connectionString' => 'sqlite:'.__DIR__.'/../data/DBmovies.db3',
		),
		'errorHandler' => array(
			'errorAction' => 'site/error',
		),
		'log' => array(
			'class'  => 'CLogRouter',
			'routes' => array(
				array(
					'class'        => 'CDbLogRoute',
					'connectionID' => 'db_sqlite',
					'levels'       => 'error, warning',
				),
			),
		),
	),
	// application parameters
	'params' => array(
		// php configuration
		'php.defaultCharset' => 'utf-8',
		'php.timezone'       => 'UTC',
	),
);