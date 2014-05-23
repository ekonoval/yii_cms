<?php
namespace Ekv\B\modules\test\controllers\Ar;

use BTestOrderBase;
use Ekv\B\modules\test\forms\OrderEditForm;

class ArOrderEditAction extends ArOrderSaveAction
{
    static function getClassNameFQ()
    {
        return getClassNameFullyQualified(__CLASS__);
    }

    function run()
    {
        $rowID = yR()->getQuery('idOrder');

        /**
         * @var $modelBase BTestOrderBase
         */
        $modelBase = BTestOrderBase::getModelByPk($rowID);
        $modelExtra = $modelBase->orderExtras;


        if (!$modelBase) {
            throw new \CHttpException(404, \Yii::t('StoreModule.admin', 'Incorrect ID'));
        }


        //$form = OrderEditForm::create($modelBase);
        $form = OrderEditForm::create(null);
        $form["base"]->model = $modelBase;
        $form["extra"]->model = $modelExtra;

        //--- check was form posted ---//
        if($this->controller->isEditFormPostedMulti(array($modelBase, $modelExtra))){
            if (
                $modelBase->validate()
                && $modelExtra->validate()
            ) {
                $baseSaveRes = $modelBase->save(false);
                if($baseSaveRes){

                    $modelExtra->save(false);
                }
                $this->controller->setFlashMessage(\Yii::t('StoreModule.admin', 'Изменения успешно сохранены'));

                $this->controller->redirect($this->controller->getIndexUrl());
            }
        }else{

        }

        //pa($form->getElements());

        $this->controller->render("update_tpl", array(
            'model'=>$modelBase,
            'form'=>$form,
        ));
    }
}
 