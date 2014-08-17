<?php
namespace EkvLib;

class EkvLibException extends \Exception
{
    static function ensure($expr, $failMasg = "")
    {
        if(!$expr){
            throw new static($failMasg);
        }
    }
}
 