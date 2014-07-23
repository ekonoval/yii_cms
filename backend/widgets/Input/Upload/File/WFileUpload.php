<?php
namespace Ekv\B\widgets\Input\Upload\File;

use CHtml;
use Ekv\B\widgets\Input\BaseInputWidget;

class WFileUpload extends BaseInputWidget
{
    public $webRelativePath;

    static function getClassNameFQ()
    {
        return getClassNameFullyQualified(__CLASS__);
    }

    public function run()
    {
        parent::run();

        $currentFilename = $this->model->getAttribute($this->attribute);
        $currentUrl = null;
        if(!empty($currentFilename)){
            $currentUrl = $this->webRelativePath . $currentFilename;
        }

        $this->render(
            'fileUpload_tpl',
            array(
                'currentFilename' => $currentFilename,
                'currentUrl' => $currentUrl
            )
        );
    }


}
 