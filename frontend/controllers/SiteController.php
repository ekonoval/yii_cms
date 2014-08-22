<?php
use Ekv\F\components\System\FrontendControllerBase;

/**
 *
 * SiteController class
 *
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @link http://www.ramirezcobos.com/
 * @link http://www.2amigos.us/
 * @copyright 2013 2amigOS! Consultation Group LLC
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
class SiteController extends FrontendControllerBase
{
    public function actionIndex()
    {
        //echo "<h2>-- Frontend index ACTION  </h2>\n";

        $this->render('index');
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError()
    {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest) {
                echo $error['message'];
            } else {
                pa($error);
                $this->render('error', array('error' => $error));
            }
        }
    }

    function actionRisking()
    {
        //pa("risking action");
        pa("branch of frontend rbac");
        exit;
    }
}