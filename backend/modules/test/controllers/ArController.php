<?php
namespace Ekv\B\modules\test\controllers;

use BTestOrderBase;
use BTestOrderBaseBrowse;
use BTestOrderExtra;
use Ekv\B\components\Controllers\BackendControllerBase;
use Ekv\B\modules\test\controllers\Ar\ArOrderCreateAction;
use Ekv\B\modules\test\controllers\Ar\ArOrderEditAction;
use Ekv\B\modules\test\forms\OrderEditForm;
use Ekv\models\MOrderBase;
use Ekv\models\MOrderExtra;

class ArController extends BackendControllerBase
{
    public function init()
    {
        parent::init();
        $this->setEximLayout();
    }

    public function actions()
    {
        return array(
            'update' => array('class' => ArOrderEditAction::getClassNameFQ()),
            'create' => array('class' => ArOrderCreateAction::getClassNameFQ()),
        );
    }

    protected function _breadcrumps()
    {
        parent::_breadcrumps();
        $this->_addBreadCrumpItem("AR test", $this->createUrlBackend("index"));
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

    function actionGridJoin()
    {
        $model = new BTestOrderBaseBrowse("search");

        $model->unsetAttributes();

        $this->assignFormGetAttributes($model);

        $this->renderAuto(array('model' => $model));
    }

//    function actionUpdate1()
//    {
//        $rowID = yR()->getQuery('idOrder');
//
//        $edit_mode = true;
//
//        /**
//         * @var $modelBase BTestOrderBase
//         */
//        $modelBase = null;
//        $modelExtra = null;
//
//        if (!$edit_mode) {
////            $model = new \BTransWord();
////            $model->unsetAttributes();
//        } else {
//            $modelBase = BTestOrderBase::getModelByPk($rowID);
//            $modelExtra = $modelBase->orderExtras;
//
//            //$modelExtra = BTestOrderExtra::model()->findByAttributes(array('baseOrderID' => $rowID));
//        }
//
//        if (!$modelBase) {
//            throw new \CHttpException(404, \Yii::t('StoreModule.admin', 'Incorrect ID'));
//        }
//
//
//        //$form = OrderEditForm::create($modelBase);
//        $form = OrderEditForm::create(null);
//        $form["base"]->model = $modelBase;
//        $form["extra"]->model = $modelExtra;
//
//        //--- check was form posted ---//
//        if($this->isEditFormPostedMulti(array($modelBase, $modelExtra))){
//            if (
//                $modelBase->validate()
//                && $modelExtra->validate()
//            ) {
//                $baseSaveRes = $modelBase->save(false);
//                if($baseSaveRes){
//
//                    $modelExtra->save(false);
//                }
//                $this->setFlashMessage(\Yii::t('StoreModule.admin', 'Изменения успешно сохранены'));
//
//                $this->redirect($this->getIndexUrl());
//            }
//        }else{
//
//        }
//
//        //pa($form->getElements());
//
//        $this->render("update_tpl", array(
//            'model'=>$modelBase,
//            'form'=>$form,
//        ));
//    }

}
 