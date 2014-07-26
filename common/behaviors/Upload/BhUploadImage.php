<?php
namespace Ekv\behaviors\Upload;

use CActiveRecordBehavior;
use CValidator;
use Ekv\classes\Exceptions\EkvException;
use Ekv\components\EkvThumb\ImgResizeHelper;
use Ekv\components\EkvThumb\ImgResizeSettings;
use Ekv\components\EkvThumb\ImgResizeSettingsProcessor;

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
        $originalRelativePath = ImgResizeSettings::ORIGINAL_FOLDER . DIRECTORY_SEPARATOR;
        $absOriginalPath = $this->composeAbsolutePath($originalRelativePath);
        @mkdir($absOriginalPath);

        $relativePath = $originalRelativePath. $relativePath;

        return $this->composeAbsolutePath($relativePath);
    }

    protected function deleteFileCustom($fileName)
    {
        $imgResizeHelper = new ImgResizeHelper();
        $imgResizeHelper->removeFilesOfAllSizes($this->resizeSettings, $fileName);
    }

    protected function afterSuccessfullUpload($newFileName)
    {
        parent::afterSuccessfullUpload($newFileName);

        $thumbResizer = new ImgResizeSettingsProcessor($this->resizeSettings, $newFileName);
        $thumbResizer->mainPerformResize();
    }


}
 