<?php
namespace Ekv\B\widgets\Input\Upload\File;

use Ekv\B\widgets\Input\BaseInputWidget;
use Ekv\components\EkvThumb\ImgResizeHelper;

class WUploadImage extends BaseInputWidget
{
    public $resizeSettings;

    public $size;

    static function getClassNameFQ()
    {
        return getClassNameFullyQualified(__CLASS__);
    }

    public function run()
    {
        parent::run();

        $currentFilename = $this->model->getAttribute($this->attribute);

        $resizeHelper = new ImgResizeHelper();
        $webUrl = $resizeHelper->getWebUrl($this->resizeSettings, $this->size, $currentFilename);

        $this->render(
            'uploadImage_tpl',
            array(
                'currentFilename' => $currentFilename,
                'webUrl' => $webUrl,
            )
        );

    }


}
 