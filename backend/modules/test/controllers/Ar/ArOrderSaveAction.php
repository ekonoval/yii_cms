<?php
namespace Ekv\B\modules\test\controllers\Ar;

use BTestOrderBase;
use BTestOrderExtra;
use Ekv\components\Yii\ActionBase;
use Ekv\B\modules\test\forms\OrderEditForm;

abstract class ArOrderSaveAction extends ActionBase
{
    /**
     * @var $modelBase BTestOrderBase
     */
    protected $modelBase;

    /**
     * @var $modelExtra BTestOrderExtra
     */
    protected $modelExtra;

    function run()
    {
        $orderID = yR()->getQuery('idOrder');

        $this->initModels($orderID);

        $modelBase = $this->modelBase;
        $modelExtra = $this->modelExtra;

        if (!$modelBase) {
            throw new \CHttpException(404, \Yii::t('StoreModule.admin', 'Incorrect ID'));
        }


        //$form = OrderEditForm::create($modelBase);
        $form = OrderEditForm::create(null);
        $form["base"]->model = $modelBase;
        $form["extra"]->model = $modelExtra;

        //--- check was form posted ---//
        if($this->controller->isEditFormPostedMulti(array($modelBase, $modelExtra))){

            $this->beforeValidation($modelBase, $modelExtra); //!!!

            if (
                $modelBase->validate()
                && $modelExtra->validate()
            ) {
                $baseSaveRes = $modelBase->save(false);
                if($baseSaveRes){

                    $this->afterBaseModelSave(); //!!!

                    $modelExtra->save();
                }
                $this->controller->setFlashMessage(\Yii::t('StoreModule.admin', 'Изменения успешно сохранены'));

                $this->controller->redirect($this->controller->getIndexUrl());
            }
        }else{

        }

        $this->controller->render("update_tpl", array(
            'model'=>$modelBase,
            'form'=>$form,
        ));
    }

    abstract protected function initModels($orderID = null);

    protected function afterBaseModelSave(){}

    protected function beforeValidation(){}


}
 