<?php
namespace Ekv\B\modules\test\controllers\Ar;

use BTestOrderBase;
use BTestOrderExtra;

class ArOrderCreateAction extends ArOrderSaveAction
{
    static function getClassNameFQ()
    {
        return getClassNameFullyQualified(__CLASS__);
    }

    protected function initModels($orderID = null)
    {
        $this->modelBase = new BTestOrderBase();
        $this->modelExtra = new BTestOrderExtra();
    }

    protected function beforeValidation()
    {
        $this->modelExtra->baseOrderID = -1; // set fake id to avoid required validator
    }

    protected function afterBaseModelSave()
    {
        $this->modelExtra->baseOrderID = $this->modelBase->idOrder;
    }


}
 