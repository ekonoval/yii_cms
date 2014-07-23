<?php
namespace Ekv\B\modules\test\controllers\Ar;

use BTestOrderBase;
use BTestOrderExtra;

class ArOrderEditAction extends ArOrderSaveAction
{
    static function getClassNameFQ()
    {
        return getClassNameFullyQualified(__CLASS__);
    }

    protected function initModels($orderID = null)
    {
        $this->modelBase = BTestOrderBase::getModelByPk($orderID);
        $this->modelExtra = $this->modelBase->orderExtras;
    }


}
 