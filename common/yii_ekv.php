<?php

/**
 * Custom implementation of Yii class, substitutes orginal Yii.
 * Allows to perform required customization
 */
class Yii extends \YiiBase
{
//    function __construct()
//    {
//        pa("new Yii"); exit;
//    }

    private static function _getCustomAutoloader()
    {
        static $obj = null;
        if(is_null($obj)){
            require_once "components/ProjectCustomAutoloader.php";
            $obj = new ProjectCustomAutoloader();
        }
        return $obj;
    }

    /**
     * @override
     * Fix import to properly work with components configuration and namespaced classes.
     * Allows configure components like 'components' => 'user' => 'class' => 'Ekv\B\components\User\Auth\BWebUser'
     * Originally this method tried to load class using original way, converting alias to Ekv.B.User... but it failed
     * Use custom autoloader for Ekv namespaced classes only.
     * The same ProjectCustomAutoloader is registered as Yii::registerAutoloader()
     * @param string $alias
     * @param bool $forceInclude
     * @return string
     */
    public static function import($alias, $forceInclude = false)
    {
        if(
            $forceInclude
            && strpos($alias, 'Ekv\\') !== false
        ){
            //pa($alias);
            $customAutoloaderObj = self::_getCustomAutoloader();
            $customAutoloaderObj->loadClass($alias);
            return $alias;
        }else{
            return parent::import($alias, $forceInclude);
        }
    }


}