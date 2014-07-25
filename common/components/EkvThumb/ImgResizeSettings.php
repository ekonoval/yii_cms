<?php
namespace Ekv\components\EkvThumb;

use Ekv\B\components\System\GlobalHelper;
use Ekv\classes\EkvGlobalHelper;
use Ekv\classes\Misc\PathHelper;

class ImgResizeSettings
{
    static private $galleryHeaderPhoto =
        array(
            'view' => EkvGlobalHelper::VIEW_FRONT,
            "basePathRel" => "/images/galleries/header_photos/",
            "sizes" => array(
                array(
                    "dir" => "size1",
                    "method" => "resize_biggest_side",
                    "sizeSingle" => 150,
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
//        PathHelper::normilizePath($basePathAbsolute)

        $settingsItem["basePathAbsolute"] = $basePathAbsolute;

        return $settingsItem;


//   		//--- path root prefix definition ---//
//   		$path_root_prefix = PATH_IMAGE;
//           $path_root_prefix_relative = "/images";
//   		if($path_root_prefix_param == "PATH_FILES"){
//   			$path_root_prefix = PATH_FILES;
//               $path_root_prefix_relative = "/files";
//   		}
//
//   		$res = self::$$key;
//           $res["base_photo_path_relative"] = $path_root_prefix_relative.$res["base_photo_path"];
//   		$res["base_photo_path"] = $path_root_prefix.$res["base_photo_path"];
//   		return $res;
   	}

    static function itemGalleryPhotos()
    {
        return self::getSettingsItem('galleryHeaderPhoto');
    }

}
 