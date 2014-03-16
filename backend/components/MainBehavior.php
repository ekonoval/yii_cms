<?php
//namespace Ekv\B\components;

class MainBehavior extends \CBehavior
{
    function getFullName()
    {
        pa(get_class($this->owner));exit;
    }
}
 