<?php
namespace Ekv\B\modules\test\controllers;

use Ekv\B\classes\Misc\DateHelper;
use Ekv\B\components\Controllers\BackendControllerBase;
use Ekv\B\modules\test\forms\CfEditForm;
use \BTestFieldsCustom;
use Ekv\behaviors\BhUploadFile;
use Ekv\helpers\UploadHelper;

class CustomFieldsController extends BackendControllerBase
{
    public function init()
    {
        parent::init();
        $this->setEximLayout();
    }

    function actionIndex()
    {
        $model = new BTestFieldsCustom("search");
        $model->unsetAttributes();
        $this->assignFormGetAttributes($model);

        $this->renderAuto(array('model' => $model));
    }

    function getIndexUrl()
    {
        return $this->createUrl("/test/customFields/index");
    }

    function actionUpdate()
    {
        $rowID = yR()->getQuery('id');

        $edit_mode = true;

        /**
         * @var $model BTestFieldsCustom
         */
        $model = null;

        if (!$edit_mode) {
//            $model = new \BTransWord();
//            $model->unsetAttributes();
        } else {
            //$model = BTestFieldsCustom::model()->findByPk($rowID);
            $model = \BTestFieldsCustomWithBh::model()->findByPk($rowID);
        }

        if (!$model) {
            throw new \CHttpException(404, \Yii::t('StoreModule.admin', 'Incorrect ID'));
        }

        $model->attachBehavior('uploadFile',
            array(
                'class' => BhUploadFile::getClassNameFQ(),
                'baseSavePathAbsolute' => UploadHelper::getFrontFiles('test'),
                'fileAttrName' => 'txtFile',
                'oldFileName' => $model->txtFile,
                'fileTypes' => 'txt',
                'filePrefix' => 'tt'
            )
        );

        $form = CfEditForm::create($model);

        //--- check was form posted ---//
        if($this->isEditFormPosted($model)){

            if ($model->validate()) {
                $model->save();
                $this->setFlashMessage(\Yii::t('StoreModule.admin', 'Изменения успешно сохранены'));

                $this->redirect($this->getIndexUrl());
            }
        }else{
            //--- init has markup ---//
            $model->hasMarkup = false;
            if(
                $model->markupNumeric > 0
                || $model->markupPercent > 0
            ){
                $model->hasMarkup = true;
            }

            $model->dt = DateHelper::getJqDatePickerFormatedDate($model->dt, false);
        }

        //pa($form->getElements());

        $this->render("update_tpl", array(
            'model'=>$model,
            'form'=>$form,
        ));
    }
}
 