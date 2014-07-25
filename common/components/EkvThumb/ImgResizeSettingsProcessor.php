<?php
namespace Ekv\components\EkvThumb;

class ImgResizeSettingsProcessor
{
    private $settings;
    private $fileName;

    function __construct($resizeSettingsItem, $fileName)
    {
        $this->fileName = $fileName;
        $this->settings = $resizeSettingsItem;
    }

    function mainPerformResize()
    {
        ThumbException::ensure(isset($this->settings["sizes"]), "Setting sizes incorrect");
        $basePathAbsolute = $this->settings["basePathAbsolute"];

        $originalAbsolutePathFull = ImgResizeSettings::getPathAbsoluteFull(
            $basePathAbsolute,
            ImgResizeSettings::ORIGINAL_FOLDER,
            $this->fileName
        );

        foreach ($this->settings["sizes"] as $sizeVal) {
            $sizeAbsolutePathFull = ImgResizeSettings::getPathAbsoluteFull(
                $basePathAbsolute,
                $sizeVal["dir"],
                $this->fileName
            );

            //--- create subdir if not exists ---//
            if(!file_exists($basePathAbsolute)){
                @mkdir($basePathAbsolute, 0775, true);
            }

            //pa($sizeAbsolutePathFull);

            $method = $sizeVal["method"];

            $resizerObj = new ImgResizerSingle($originalAbsolutePathFull, $sizeAbsolutePathFull);
            ThumbException::ensure(method_exists($resizerObj, $method), "Resize method '{$method}' doesn't exist!");

            if($method == "resizeBiggestSide"){
                $resizerObj->resizeBiggestSide($sizeVal["sizeSingle"]);
            }

        }
    }

//    private function performResize1($pathOriginal, $pathSize, $sizeVal)
//    {
//
//    }
}
 