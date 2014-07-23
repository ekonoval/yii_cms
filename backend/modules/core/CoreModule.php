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

    public function beforeControllerAction($controller, $action)
    {
        if (parent::beforeControllerAction($controller, $action)) {
            // this method is called before any module controller action is performed
            // you may place customized code here
            return true;
        } else {
            return false;
        }
    }
}
