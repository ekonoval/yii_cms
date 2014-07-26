<?php
namespace Ekv\components\EkvThumb;

use Ekv\B\components\System\GlobalHelper;
use Ekv\classes\EkvGlobalHelper;
use Ekv\classes\Misc\PathHelper;

class ImgResizeSettings
{
    /**
     * For original images(unresized, as is)
     */
    const ORIGINAL_FOLDER = 'original';

    static private $galleryHeaderPhoto =
        array(
            'view' => EkvGlobalHelper::VIEW_FRONT,
            "basePathRel" => "/images/galleries/header_photos/",
            "sizes" => array(
                array(
                    "dir" => "size1",
                    "method" => "resizeBiggestSide",
                    "sizeSingle" => 150,
                    "sizeW" => 0,
                    "sizeH" => 0,
                ),

                array(
                    "dir" => "size2",
                    "method" => "resizeBiggestSide",
                    "sizeSingle" => 500,
                    "sizeW" => 0,
                    "sizeH" => 0,
                ),
            ),
    );

    public static function getSettingsItem($key)
   	{
        ThumbException::ensure(isset(self::$$key), "imgResize setting not found - '{$key}'");

        $settingsItem = self::$$key;

        $siView = isset($settingsItem["view"]) ? $settingsItem["view"] : EkvGlobalHelper::VIEW_FRONT;

        $basePathAbsolute = PathHelper::getAbsPathViewDependent($siView, $settingsItem["basePathRel"]);
        //PathHelper::normilizePath($basePathAbsolute)

        $settingsItem["basePathAbsolute"] = $basePathAbsolute;

        return $settingsItem;
   	}

    static function itemGalleryPhotos()
    {
        return self::getSettingsItem('galleryHeaderPhoto');
    }



}
 