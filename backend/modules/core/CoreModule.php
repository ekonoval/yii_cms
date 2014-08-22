<?php
namespace Ekv\B\modules\core;

use Ekv\components\Yii\Main\WebModule;

class CoreModule extends WebModule
{
    protected function init()
    {
        $this->_setNamespace(__NAMESPACE__);
        parent::init();

    }


}
