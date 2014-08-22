<?php
namespace EkvLib\AppType;

use CHttpException;
use Ekv\models\MPage;

class WebAppFrontend extends WebApp
{
    public function processRequest()
    {
        try {
            parent::processRequest();
        } catch (CHttpException $e) {
            /*
             * When 404 is occured try to load static page, cause module and controller url have been at this point.
             */
            if($e->statusCode == 404){

                $currentUrl = $this->request->pathInfo;
                $statPageModel = new MPage();

                if($statPageModel->findPageByUrl($currentUrl)){
                    //$this->runController()
                    pa("exit"); exit;
                }

                // doing something
                throw $e;
                exit;
            }
        }
    }
}
 