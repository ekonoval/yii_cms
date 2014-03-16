<?php
namespace Ekv\B\components\System;

class GlobalHelper
{
    static function getPath($full_class_path = __CLASS__)
    {
        return '\\'.$full_class_path;
    }
}
 