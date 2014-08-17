<?php
namespace EkvLib;

use EkvLib\AppType\WebApp;
use Exception;
use Yii;
use Yiinitializr\Helpers\Initializer;

class AppInitializer
{
    const APP_TYPE_FRONT = 'frontend';
    const APP_TYPE_BACK = 'backend';
    const APP_TYPE_API = 'api';
    const APP_TYPE_CONSOLE = 'console';

    //private $appType;
    private $appClassName;

    function __construct($appType)
    {
        $appClassMap = array(
            self::APP_TYPE_BACK => '\EkvLib\AppType\WebAppBackend',
            self::APP_TYPE_FRONT => '\EkvLib\AppType\WebAppFrontend',
        );

        EkvLibException::ensure(isset($appClassMap[$appType]), "No proper app class found");
        $this->appClassName = $appClassMap[$appType];
    }

    static function createBackend()
    {
        return new static(self::APP_TYPE_BACK);
    }

    static function createFrontend()
    {
        return new static(self::APP_TYPE_FRONT);
    }

    function createApp($root, $configName = 'main', $mergeWith = array())
    {
        require __DIR__ . "/pa.php";
        if (($root = realpath($root)) === false) {
            throw new Exception('could not initialize framework.');
        }

        $this->registerAutoloader();

        $config = Initializer::config($configName, $mergeWith);
        //pa($config);

        $this->appendDbBilet($config);

        //pa($config);exit;

        if (php_sapi_name() !== 'cli') // aren't we in console?
        {
            //$app = Yii::createWebApplication($config);
            $app  = Yii::createApplication($this->appClassName, $config);
        } // create web
        else {
            defined('STDIN') or define('STDIN', fopen('php://stdin', 'r'));
            $app = Yii::createConsoleApplication($config);
            $app->commandRunner->addCommands($root . '/cli/commands');
            $env = @getenv('YII_CONSOLE_COMMANDS');
            if (!empty($env)) {
                $app->commandRunner->addCommands($env);
            }
        }

        /**
         * @see YiiBase::registerAutoloader
         */
        Yii::$enableIncludePath = false;

        //--- importing global shortcut functions ---//
        Yii::import("common.lib.EkvLib.global_shortcuts", true);

        //  return an app
        return $app;
    }

    /**
     * @see YiiBase::registerAutoloader
     */
    private function registerAutoloader()
    {
        //self::$enableIncludePath=false;
        spl_autoload_register(array(new EkvAutoloader(), 'loadClass'));
    }

    private function appendDbBilet(&$config)
    {
        //--- add db_bilet conf ---//
        $config["components"]["db_bilet"] = $config["components"]["db"];
        $config["components"]["db_bilet"]["connectionString"] =
            str_replace(
                "dbname=yii",
                //"dbname=bilet",
                "dbname=sched_dev",
                $config["components"]["db_bilet"]["connectionString"]
            );
    }

}
 