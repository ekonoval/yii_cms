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
    'modules' => array(
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => 'risking',
            'ipFilters' => array('127.0.0.1', '::1'),
        ),
    ),
    'components' => array(
//		configure to suit your needs
        'db' => array(
//            'connectionString' => 'mysql:host=localhost;dbname=yii',
//            'username' => 'root',
//            'password' => '',

//            'class' => '\Ekv\Yii\Db\EkvDbConnection',
//            'pdoClass' => '\Ekv\Yii\Db\Pdo\EkvPdo',
//            'enableProfiling' => true,
//            'enableParamLogging' => true,
//            'charset' => 'utf8',
//            'emulatePrepare' => true,
        ),

        'debug' => array(
            'enabled' => true
        ),

        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CWebLogRoute',
                    'enabled' => false,
                    //'categories' => 'system.db.*',
                    'categories' => 'system.db.CDbCommand',

                ),
            )
        )
    ),

    'import' => array(
        'common.models.sakila.*',
    ),

    'params' => array(
        'yii.handleErrors' => true,
        'yii.debug' => false,
        'yii.traceLevel' => 3,
    )
);