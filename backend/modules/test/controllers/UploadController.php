<?php
namespace Ekv\B\modules\test\controllers;

use Ekv\B\components\Controllers\BackendControllerBase;
use Ekv\classes\Misc\PathHelper;

class UploadController extends  BackendControllerBase
{
    function actionSimple()
    {
        $dir = PathHelper::getFrontFiles();

        $uploaded = false;
        $model = new \BTestUpload();

        if(isset($_POST["BTestUpload"])){
            $model->attributes = $_POST["BTestUpload"];

            $fileObj = \CUploadedFile::getInstance($model, 'fileUp');
            //pa($fileObj);exit;

            if($model->validate()){
                $fileNameFull = $dir . $fileObj->getName();

                $uploaded = $fileObj->saveAs($fileNameFull);
            }
        }

        $this->renderAuto(array(
            'model' => $model,
            'uploaded' => $uploaded,
            'dir' => $dir
        ));
    }
}
 