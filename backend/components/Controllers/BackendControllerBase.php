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

}