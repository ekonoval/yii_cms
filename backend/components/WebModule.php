<?php
namespace Ekv\B\components;

class WebModule extends \CWebModule
{
    protected $_namespace;

    protected function init()
    {
        $this->controllerNamespace = "\\{$this->_namespace}\\controllers";
        //pa($this->controllerNamespace);exit;
    }

    protected function _setNamespace($namespace = __NAMESPACE__)
    {
        $this->_namespace = $namespace;
    }
}
