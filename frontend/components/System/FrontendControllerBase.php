<?php
namespace Ekv\F\components\System;

class FrontendControllerBase extends \EController
{
    public function init()
    {
        parent::init();
        $this->layout = '//layouts/lMain';
    }

}
 