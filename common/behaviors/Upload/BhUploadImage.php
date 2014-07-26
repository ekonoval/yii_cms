<?php
namespace Ekv\behaviors\Upload;

use CActiveRecordBehavior;
use CValidator;
use Ekv\classes\Exceptions\EkvException;
use Ekv\components\EkvThumb\ImgResizeSettings;

class BhUploadImage extends BhUploadFileGeneric
{
    /**
     * Resize settings array in format specified in ImgResizeSettings
     * @var array
     */
    public $resizeSettings;

    public $fileTypes = 'png, gif, jpg, jpeg';

    static function getClassNameFQ()
    {
        return getClassNameFullyQualified(__CLASS__);
    }

    protected function init()
    {
        parent::init();

        EkvException::ensure(isset($this->resizeSettings["basePathAbsolute"]), "Incorrect resize settings");

        $this->baseSavePathAbsolute = $this->resizeSettings["basePathAbsolute"];
    }

    /**
     * Being uploading image file must be uploaded to 'original' folder untouched
     * @param $relativePath
     * @return string
     */
    protected function composeAbsolutePathCustom($relativePath)
    {
        $relativePath = ImgResizeSettings::ORIGINAL_FOLDER . DIRECTORY_SEPARATOR. $relativePath;
        return $this->composeAbsolutePath($relativePath);
    }

    protected function deleteFileCustom($relativePath)
    {
        throw new EkvException('not implemented');
    }


}
 