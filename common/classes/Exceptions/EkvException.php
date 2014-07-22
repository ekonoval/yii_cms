<?php
namespace Ekv\classes\Exceptions;

class EkvException extends \Exception
{
    static function ensure($expr, $failMsg = "")
    {
        if(!$expr){
            throw new static($failMsg);
        }
    }
}
 