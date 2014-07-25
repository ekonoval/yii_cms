<?php
namespace Ekv\components\EkvThumb;

use Imagine\Gd\Imagine;
use Imagine\Image\Box;
use Imagine\Image\ImageInterface;

class ImgResizerSingle
{
    /**
     * @var Imagine
     */
    private $imagineObj;

    private $originalPath;

    private $sizePath;

    function __construct($originalPath, $sizePath)
    {
        $this->imagineObj = new Imagine();

        $this->originalPath = $originalPath;
        $this->sizePath = $sizePath;
    }


    function resizeBiggestSide($width)
    {
        $size = new Box($width, $width);
        $mode = ImageInterface::THUMBNAIL_INSET;

        $img = $this->imagineObj->open($this->originalPath);
        $thumb = $img->thumbnail($size, $mode);
        $thumb->save($this->sizePath);
    }
}
 