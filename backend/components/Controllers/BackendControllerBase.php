<?php
namespace Ekv\B\components\Controllers;

class BackendControllerBase extends \EController
{
    /**
     * Default layout for all backend controllers
     * @var string
     */
    public $layout = "//layouts/lMain";

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

    public function render($view = null, $data = null, $return = false)
    {
        if(is_null($view)){
           $view = "{$this->action->id}_tpl";
        }

        return parent::render($view, $data, $return);
    }

    /**
     * Tpl name is generated automatically
     * @param $data
     */
    function renderAuto($data)
    {
        $this->render(null, $data, false);
    }

}