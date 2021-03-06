<?php
namespace Ekv\F\modules\core\controllers;

use Ekv\F\components\System\FrontendControllerBase;
use Ekv\models\MPage;

class MainController extends FrontendControllerBase
{
    function actionIndex()
    {
        pa('index'); exit;
    }

    function actionStaticPage()
    {
        $statPageUrl = yR()->pathInfo;

        $pageInfo = MPage::model()->findPageByUrl($statPageUrl, false);
        //pa($pageInfo);exit;

        $this->ensureWith404(!empty($pageInfo));

        $this->pageTitle = $pageInfo->pageTitle;
        $this->renderAuto(array('pageInfo' => $pageInfo));
    }
}
 