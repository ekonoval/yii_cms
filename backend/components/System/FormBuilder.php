<?php
namespace Ekv\B\components\System;

class FormBuilder extends \CForm
{
    static function create($model)
    {
        return new static(static::_getConfig(), $model);
    }

    protected static function _getConfig()
    {
        return array();
    }
}
 