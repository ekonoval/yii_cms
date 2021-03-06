<?php

/**
 * SiteController example
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @link http://www.ramirezcobos.com/
 * @link http://www.2amigos.us/
 * @copyright 2013 2amigOS! Consultation Group LLC
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
class SiteController extends EApiController
{
	public $defaultAction = 'error';

	public function actionError()
	{
        //pa("api error action");
		if($error=Yii::app()->errorHandler->error)
		{
			// just render it for the sake of the example
			$this->renderJson($error);
		}
	}

    function actionIndex()
    {
        $o = new \Ekv\Frontend\ProductFormatter();
        $o1 = new \Ekv\Product\Helpers\ProductDetailedHelper();
//        \Ekv\Product\Helpers\ProductDetailedHelper::staticTest();
//
//        \Ekv\Frontend\ProductFormatter::main();
//        pa("api index");exit;
    }
}