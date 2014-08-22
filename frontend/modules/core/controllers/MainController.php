<?php
namespace Ekv\F\modules\core\controllers;

use Ekv\F\components\System\FrontendControllerBase;

class MainController extends FrontendControllerBase
{
    function actionIndex()
    {
        pa('index'); exit;
    }

    function actionStaticPage()
    {
        $statPageUrl = yR()->pathInfo;

        pa($statPageUrl);
        pa("stat exit"); exit;
    }
}
 