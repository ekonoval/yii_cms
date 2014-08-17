<?php
namespace EkvLib\AppType;

use CHttpException;

class WebAppFrontend extends WebApp
{
    public function processRequest1()
    {
        pa(\Yii::getLogger()->getExecutionTime());
        pa($this->request->isAjaxRequest);
        pa(\Yii::getLogger()->getExecutionTime());

        try {
            parent::processRequest();
        } catch (CHttpException $e) {
            //echo sprintf('%0.5f',\Yii::getLogger()->getExecutionTime());exit;

            //yApp()->end();
            if($e->statusCode == 404){
                // doing something
                throw $e;
                exit;
            }
        }
    }
}
 