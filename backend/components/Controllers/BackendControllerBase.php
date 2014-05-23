<?php
namespace Ekv\B\components\Controllers;

class BackendControllerBase extends \EController
{
    /**
     * Default layout for all backend controllers
     * @var string
     */
    public $layout = "//layouts/lMain";

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

}