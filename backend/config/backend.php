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

use Ekv\B\components\System\UrlManager\Rules\RuleControllerWithoutActionPlusParams;

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
    'modules' => array(
        'core' => array(
            'class' => '\Ekv\B\modules\core\CoreModule'
        ),
        'user' => array(
            'class' => '\Ekv\B\modules\user\UserModule'
        ),
        'test' => array(
            'class' => '\Ekv\B\modules\test\TestModule'
        ),
        'translate' => array(
            'class' => '\Ekv\B\modules\translate\TranslateModule'
        ),
    ),

    // application components
    'components' => array(
        'authManager' => array(
            //'class' => 'BAuthManager', // override standart authManager class!!!
            'class' => 'Ekv\B\components\User\Auth\BAuthManager', // override standart authManager class!!!
            'defaultRoles' => array('guest'),
        ),

        'user' => array(
            'allowAutoLogin' => true,
            //'class' => "BWebUser", // override standart User class
            'class' => 'Ekv\B\components\User\Auth\BWebUser', // override standart User class
            'loginUrl' => array('user/auth/login'),
        ),

        'bootstrap' => array(
            'class' => 'bootstrap.components.TbApi',
        ),

        'clientScript' => array(
//            'packages' => array(
//                'jquery' => array(
//                    'baseUrl' => '//ajax.googleapis.com/ajax/libs/jquery/1.9.1/',
//                    'js' => array('jquery.min.js'),
//                    //'js' => array('/js/libs/jquery-1.9.1.min.js'),
//                ),
//            ),
            'scriptMap' => array(
                'jquery.js' => false,
                'bootstrap.min.css' => false,
                'bootstrap.min.js' => false,
                'bootstrap-yii.css' => false,

            )
        ),
        'urlManager' => array(
            // uncomment the following if you have enabled Apache's Rewrite module.
            'urlFormat' => 'path',
            'showScriptName' => false,

            'rules' => array(

//                '<controller:\w+>/<id:\d+>' => '<controller>/view',
//                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
//                '<controller:\w+>/' => '<controller>/index', // !!!!!!!
//                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
//                '<controller:\w+>/<action:\w+>/*' => '<controller>/<action>',

                //"<module:\w+>/<controller:\w+>/<action:\w+>/*" => "<module>/<controller>/<action>",
                array( 'class' => 'Ekv\B\components\System\UrlManager\Rules\RuleModules'),
                array( 'class' => 'Ekv\B\components\System\UrlManager\Rules\RuleNonModules' ),


                /**
                 * Fails $this->createUrl('/translate/episode/index/', array('movieID' =>  5, "secondPar" =>  2))
                 * it displays /translate/episode/index?movieID=5&secondPar=2
                 * instead of /translate/episode/index/movieID/5/secondPar/2
                 * @see http://www.yiiframework.com/doc/guide/1.1/en/topics.url - section CBaseUrlRule
                 */
                //"<module:\w+>/<controller:\w+>/<action:\w+>" => "<module>/<controller>/<action>",
                //"<module:\w+>/<controller:\w+>/<action:\w+>/*" => "<module>/<controller>/<action>",

                //'<statPageUrl:\w+>' => 'site/statPage/<statPageUrl>'
                //'<statPageUrl>' => 'site/statPage',
            ),

//            'rules' => array(
//                // default rules
//                '<controller:\w+>/<id:\d+>' => '<controller>/view',
//                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
//                //'<controller:\w+>/' => '<controller>/index',
//                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
//                '<controller:\w+>/<action:\w+>/*' => '<controller>/<action>',
//            ),


        ),

        'errorHandler' => array(
            'errorAction' => 'site/error',
        )
    ),
);