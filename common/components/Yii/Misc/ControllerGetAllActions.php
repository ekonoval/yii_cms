<?php
namespace Ekv\components\Yii\Misc;

use CController;

class ControllerGetAllActions
{
    private $controller;

    function __construct(CController $controller)
    {
        $this->controller = $controller;
    }


    function mainGetAllActions()
    {
        $allActions = array();

        $classMethods = get_class_methods($this->controller);
        //pa($classMethods);
        //$res = preg_grep($pattern, $methodMatches);

        /**
         * Get all controller methods matching 'action method pattern'
         * actionIndex -> index
         * actionOther -> other
         *
         * Custom actions aren't mentioned here
         */
        $controllerDirectMethods = array_reduce($classMethods,
            function ($matchesGlobal, $currentStr) {
                $pattern = '#^action([A-Z]+\w+)#';

                if (preg_match($pattern, $currentStr, $matches)) {
                    if(isset($matches[1])){
                        $matchesGlobal[] = lcfirst($matches[1]);
                    }
                }

                return $matchesGlobal;
            },
            array()
        );

        $actionFilesActions = $this->controller->actions();
        $actionFilesActions = !empty($actionFilesActions) ? array_keys($actionFilesActions) : array();

        $allActions = array_merge($controllerDirectMethods, $actionFilesActions);
        $allActions = array_combine(array_values($allActions), $allActions);

        return $allActions;
    }

}
 