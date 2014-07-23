<?php
namespace Ekv\helpers;

use Yii;

class UploadHelper
{
    static function getBackendDocRoot()
    {
        $path = Yii::getPathOfAlias('backend').DIRECTORY_SEPARATOR.'www'.DIRECTORY_SEPARATOR;
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
}
 