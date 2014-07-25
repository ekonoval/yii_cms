<?php
namespace Ekv\classes\Misc;

use Ekv\classes\EkvGlobalHelper;
use Ekv\classes\Exceptions\EkvException;
use Yii;

class PathHelper
{
    static function getBackendDocRoot($pathAddRelative = "")
    {
        $path = Yii::getPathOfAlias('backend').DIRECTORY_SEPARATOR.'www'.DIRECTORY_SEPARATOR;
        if(!empty($pathAddRelative)){
            $path .= $pathAddRelative;
        }
        return $path;
    }

    static function getFrontendDocRoot($pathAddRelative = "")
    {
        $path = Yii::getPathOfAlias('frontend').DIRECTORY_SEPARATOR.'www'.DIRECTORY_SEPARATOR;
        if(!empty($pathAddRelative)){
            $path .= $pathAddRelative;
        }
        return $path;
    }

    static function getAbsPathViewDependent($view, $pathAddRelative = "")
    {
        $map = array(
            EkvGlobalHelper::VIEW_FRONT => 'getFrontendDocRoot',
            EkvGlobalHelper::VIEW_BACK => 'getBackendDocRoot',
        );

        EkvException::ensure(isset($map[$view]), "No view available '{$view}'");
        $method = $map[$view];

        return self::$method($pathAddRelative);
    }

    static function getFrontFiles($pathAddRelative = "")
    {
        $path = self::getFrontendDocRoot()."files/";
        if(!empty($pathAddRelative)){
            $path .= $pathAddRelative;
        }

        return $path;
    }

    static function getFrontImages()
    {
        return self::getFrontendDocRoot()."images/";
    }

    static function  getRandomFileName($ext, $prefix = "")
    {
        $res = strtolower(md5(uniqid($prefix, true)));

        if(!empty($prefix)){
            $res = "{$prefix}_{$res}";
        }

        $res .= ".{$ext}";
        return $res;
    }

    static function normilizePath($path)
    {
        $path = str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, $path);

        $parts = array_filter(explode(DIRECTORY_SEPARATOR, $path), 'strlen');

        $absolutes = array();
        foreach ($parts as $part) {
            if ('.' == $part) continue;
            if ('..' == $part) {
                array_pop($absolutes);
            } else {
                $absolutes[] = $part;
            }
        }
        return implode(DIRECTORY_SEPARATOR, $absolutes).DIRECTORY_SEPARATOR;
    }

}
 