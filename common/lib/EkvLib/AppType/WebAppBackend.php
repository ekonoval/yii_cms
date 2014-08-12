<?php
namespace EkvLib\AppType;

use CHttpException;

class WebAppBackend extends WebApp
{
    public function processRequest()
    {
        try {
            parent::processRequest();
        } catch (CHttpException $e) {
            if($e->statusCode == 404){
                // doing something
                throw $e;
                exit;
            }
        }
    }
}
 