<?php
namespace Ekv\B\components\Controllers;

use CAction;
use CController;
use Ekv\B\widgets\TopButtons;
use Yii;

class BackendControllerBase extends \EController
{
    /**
     * Default layout for all backend controllers
     * @var string
     */
    //public $layout = "//layouts/lMain";
    public $layout = "//layouts/lEximus";

    /**
   	 * Buttons to display
   	 * @var array
   	 */
   	public $topButtons = array();

    protected function _breadcrumps()
    {
        parent::_breadcrumps();
        $this->_addBreadCrumpItem('Index', '/');
    }


    public function filters()
    {
        return array(
            'accessControl',
        );
    }

    public function accessRules()
    {
        return array(
            array(
                'allow',
                'users' => array('*'),
                'actions' => array('logout', 'login'),
            ),
            array(
                'allow',
                'users' => array('@')
            ),
            array('deny',)
        );
    }

    function redirectIndex()
    {
        $this->redirect("/");
    }

    function setEximLayout()
    {
        $this->layout = "//layouts/LEximus";
    }

    function initIndexModel($model)
    {
        $modelClass = get_class($model);
        $model->unsetAttributes(); // clear any default values

        if (isset($_GET[$modelClass])) {
            $model->attributes = $_GET[$modelClass];
        }
    }

    /**
   	 * Set flash messages.
   	 *
   	 * @param string $message
   	 */
   	public function setFlashMessage($message)
   	{
   		$currentMessages = yUser()->getFlash('messages');

   		if (!is_array($currentMessages))
   			$currentMessages = array();

   		yUser()->setFlash('messages', \CMap::mergeArray($currentMessages, array($message)));
   	}

    function assignFormGetAttributes($model)
    {
        $get_name = get_class($model);

        if (isset($_GET[$get_name])) {
            $model->attributes = $_GET[$get_name];
        }
    }

    function isEditFormPosted($model)
    {
        $get_name = get_class($model);
        $isPosted = isset($_POST[$get_name]);

        if($isPosted){
            $model->attributes = $_POST[$get_name];
        }

        return $isPosted;
    }

    function isEditFormPostedMulti($modelsArray)
    {
        $isPosted = false;

        foreach($modelsArray as $model){
            $get_name = get_class($model);
            $isPosted = isset($_POST[$get_name]);

            if($isPosted){
                $model->attributes = $_POST[$get_name];
            }
        }


        return $isPosted;
    }

    function createUrlBackend($action, $params = array())
    {
        return $this->createUrl("/{$this->module->id}/{$this->id}/{$action}", $params);
    }

    function addTopButtonsCreate($createUrl = "create")
    {
        $this->topButtons = $this->widget(TopButtons::getClassNameFQ(), array(
            'template' => array('create'),
            'elements' => array(
                'create' => array(
                    'link' => $this->createUrlBackend($createUrl),
                    'title' => Yii::t('StoreModule.admin', 'Создать'),
                    'options' => array(
                        'icons' => array('primary' => 'ui-icon-plus')
                    )
                ),
            ),
        ));
    }

    /**
     * Used for composing page title in specific algorythm
     * @param string $view
     * @return bool
     */
    protected function beforeRender($view)
    {
        $parentRes = parent::beforeRender($view);

        if($parentRes){
            $this->composePageTitleFull();
        }

        return $parentRes;
    }

    private function composePageTitleFull()
    {
        $bigPartsSeparator = " :: ";
        $commonTitle = "Cms. Backend";

        /**
         * When pageTitleFull is defined directly in controller then apply it without any further hesitations
         * or compose page title automatically
         */
        if(empty($this->pageTitleFull)){
            $leftTitle = "";
            if(!empty($this->pageTitle)){
                $leftTitle = $this->pageTitle;
            }else{
                $moduleName = !empty($this->module->id) ? $this->module->id : "";

                $localSeparator = "/";
                $leftTitle = "";

                if(!empty($moduleName)){
                    $leftTitle .= $moduleName . $localSeparator;
                }

                $leftTitle .= "{$this->id}{$localSeparator}{$this->action->id}";
            }

            $this->pageTitleFull = "{$leftTitle}{$bigPartsSeparator}{$commonTitle}";
        }

    }


    function actionDelete()
    {
        $ids = isset($_POST["id"]) ? $_POST["id"] : array();
        return $ids;
    }

}