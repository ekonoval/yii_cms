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

    static function getFrontendDocRoot()
    {
        $path = Yii::getPathOfAlias('frontend').DIRECTORY_SEPARATOR.'www'.DIRECTORY_SEPARATOR;
        return $path;
    }

    static function getFrontFiles()
    {
        return self::getFrontendDocRoot()."files/";
    }

    static function getFrontImages()
    {
        return self::getFrontendDocRoot()."images/";
    }
}
 