<?php
namespace Ekv\B\components\System;

class FormBuilder extends \CForm
{
    static function create($model)
    {
        return new static(static::_getConfig(), $model);
    }

    protected function init()
    {
        parent::init();

        $this->showErrorSummary = true;
        $this->showErrors = false;
    }


    protected static function _getConfig()
    {
        return array();
    }
}
 