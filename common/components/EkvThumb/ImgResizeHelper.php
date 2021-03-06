<?php
namespace Ekv\components\EkvThumb;

use Ekv\classes\Misc\UrlHelper;

class ImgResizeHelper
{
    function removeFilesOfAllSizes($resizeSettings, $fileName)
    {
        if(!isset($resizeSettings["sizes"])){
            return false;
        }

        $basePathAbsolute = $resizeSettings["basePathAbsolute"];
        foreach($resizeSettings["sizes"] as $sizeVal){
            $this->deleteFile($basePathAbsolute,  $sizeVal["dir"], $fileName);
        }

        $this->deleteFile($basePathAbsolute,  ImgResizeSettings::ORIGINAL_FOLDER, $fileName);

        return true;
    }

    private function deleteFile($basePathAbsolute, $sizeDir, $fileName)
    {
        $pathFull = $basePathAbsolute . $sizeDir . DIRECTORY_SEPARATOR . $fileName;
        @unlink($pathFull);
    }

    function getPathAbsoluteFull($pathBaseAbs, $size, $fileName = '')
    {
        $pathFullAbs = $pathBaseAbs . $size . DIRECTORY_SEPARATOR;
        if(!empty($fileName)){
            $pathFullAbs .= $fileName;
        }
        return $pathFullAbs;
    }

    function getWebUrl($resizeSettings, $size, $fileName)
    {
        $url = "{$resizeSettings["basePathRel"]}{$size}/{$fileName}";

        $url = UrlHelper::getUrlViewDependent($resizeSettings["view"], $url);

        return $url;
    }
}
 