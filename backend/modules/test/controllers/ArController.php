<?php
namespace Ekv\B\modules\test\controllers;

use BTestOrderBase;
use BTestOrderEditForm;
use Ekv\B\components\Controllers\BackendControllerBase;
use Ekv\B\modules\test\forms\OrderForm;
use Ekv\models\MOrderBase;
use Ekv\models\MOrderExtra;

class ArController extends BackendControllerBase
{
    public function init()
    {
        parent::init();
        $this->setEximLayout();
    }

    function actionTest()
    {
        $orderBase = new MOrderBase();
        $orderBase->uid = 222;
        $orderBase->baseTxtField = "xxx yyy";

        $baseSaveRes = $orderBase->save();
        if($baseSaveRes){
            $orderExtra = new MOrderExtra();
            $orderExtra->extraTxtField = "txt ext";
            $orderExtra->baseOrderID = $orderBase->primaryKey;

            $orderExtra->save();
            pa($orderExtra->primaryKey);
        }

    }

    function actionFetch()
    {
        $orderBase = MOrderBase::model();

        //$res = $orderBase->with('orderExtras')->findByPk(10);
        //$res = $orderBase->with('orderExtras')->findAll();

        $res = $orderBase->with(array(
            $orderBase::REL_ORDER_EXTRAS => array(
                //'select' => 'orderExtras.baseOrderID'
                //'select' => 'oe.baseOrderID'
                'alias' => 'oe'
            )
        ))->findByPk(10, "t.status = :status AND oe.idOrderExtra > 0", array(':status' => 0));

        //pa($res->debugRes());

        pa($res);
    }

    function getIndexUrl()
    {
        return $this->createUrl("/test/ar/index");
    }

    function actionIndex()
    {
        $model = new BTestOrderBase("search");
        $model->unsetAttributes();
        $this->assignFormGetAttributes($model);

        $this->renderAuto(array('model' => $model));
    }

    function actionUpdate()
    {
        $rowID = yR()->getQuery('idOrder');

        $edit_mode = true;

        /**
         * @var $model BTestOrderEditForm
         */
        $model = null;

        if (!$edit_mode) {
//            $model = new \BTransWord();
//            $model->unsetAttributes();
        } else {
            $model = BTestOrderEditForm::getModelByPk($rowID);
        }

        if (!$model) {
            throw new \CHttpException(404, \Yii::t('StoreModule.admin', 'Incorrect ID'));
        }

        $form = OrderForm::create($model);
//pa($model);exit;
        //--- check was form posted ---//
        if($this->isEditFormPosted($model)){

            if ($model->validate()) {
                $model->save();
                $this->setFlashMessage(\Yii::t('StoreModule.admin', 'Изменения успешно сохранены'));

                $this->redirect($this->getIndexUrl());
            }
        }else{

        }

        //pa($form->getElements());

        $this->render("update_tpl", array(
            'model'=>$model,
            'form'=>$form,
        ));
    }
}
 