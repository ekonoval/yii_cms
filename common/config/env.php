<?php
/**
 *
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @link http://www.ramirezcobos.com/
 * @link http://www.2amigos.us/
 * @copyright 2013 2amigOS! Consultation Group LLC
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
$env_conf =  array(
	'modules' => array(
		'gii' => array(
			'class' => 'system.gii.GiiModule',
			'password' => 'yii',
			'ipFilters' => array('127.0.0.1','::1'),
		),
	),
	'components' => array(
		// configure to suit your needs
        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=yii',
            'username' => 'root',
            'password' => '',

            'class' => '\Ekv\components\Yii\Db\EkvDbConnection', //!!!!
            'pdoClass' => '\Ekv\components\Yii\Db\EkvPdo', //!!!!
            'enableProfiling' => true,
            'enableParamLogging' => true,
            'charset' => 'utf8',
            'emulatePrepare' => true,
        ),
	),
	'params' => array(
		'yii.handleErrors'   => true,
		'yii.debug' => true,
		'yii.traceLevel' => 3,
	)
);

$env_conf["components"]["db_sakila"] = $env_conf["components"]["db"];
$env_conf["components"]["db_sakila"]["connectionString"] =
    str_replace(
        "dbname=yii",
        //"dbname=bilet",
        "dbname=sakila",
        $env_conf["components"]["db_sakila"]["connectionString"]
    );

return $env_conf;