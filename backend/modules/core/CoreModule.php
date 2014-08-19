<?php
namespace Ekv\B\modules\core;

use Ekv\B\components\WebModule;

class CoreModule extends WebModule
{
    protected function init()
    {
        $this->_setNamespace(__NAMESPACE__);
        parent::init();

        $this->setImport(array(
            $this->name.'.models.*'
        ));
    }


}
