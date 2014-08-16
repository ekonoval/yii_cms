<?php
namespace Ekv\B\components\System\UrlManager\Rules\Parse;

use CUrlManager;
use EController;

abstract class ParseUrlCustomBase
{
    //protected $moduleName;
    protected $controllerName;
    protected $actionName;

    protected $queryParamsRaw;

    protected $directActionFails = false;

    protected $defaultAction = 'index';

    protected $urlManager;
    protected $pathInfo;

    function __construct(CUrlManager $urlManager, $pathInfo)
    {
        $this->urlManager = $urlManager;
        $this->pathInfo = $pathInfo;
    }

    abstract protected function parseUrlParts($pathInfo);
    abstract protected function getControllerBaseRoute();
    abstract protected function createRightRoute($action);

    protected function customPreValidation()
    {
        return true;
    }

    function mainParseUrl()
    {
        $this->parseUrlParts($this->pathInfo);

        if(!$this->customPreValidation()){
            return false;
        }

        if(empty($this->controllerName)){
            return false;
        }

        $controllerObj = $this->tryLoadController();
        if(empty($controllerObj)){
            return false;
        }

        $finalRoute = $this->checkController($controllerObj);
        if(!empty($finalRoute)){
            return $finalRoute;
        }

        return false;
    }

    protected function parseAndSetRequestPrams()
    {
        $src = $this->queryParamsRaw;

        /**
         * This is workaround for module urls without actions but having params.
         * translate/episode/movieID/5 - movieID is considered as 'actionName' here
         * back it as part of param again!
         * Instead of translate/episode/index/movieID/5 where direct action is presented
         */
        if($this->directActionFails){
            $src = $this->actionName . $this->queryParamsRaw;
        }

        $src = ltrim($src, '/');

        $this->urlManager->parsePathInfo($src);
        //pa($_GET);
    }

    protected function checkController($ctrlObj)
    {
        $actionNameCalc = $this->actionName;
        if(empty($actionNameCalc)){
            $actionNameCalc = $this->defaultAction;
        }

        $controllerActionsAll = $ctrlObj->getAllActionsList();

        /**
         * First try directly parsed action which may be first param name
         * Check translate/episode/movieID/5 where movieID is not really an action.
         * Check possible actions in real controller actions
         */
        if(in_array($actionNameCalc, $controllerActionsAll)){
            $this->parseAndSetRequestPrams();
            return $this->createRightRoute($actionNameCalc);
        }
        /**
         * Directlty passed action doesn't exist -
         * check whether controller has DEFAULT action
         * translate/episode/movieID/5 equalas translate/episode/INDEX/movieID/5
         */
        elseif(in_array($this->defaultAction, $controllerActionsAll)){

            $this->directActionFails = true; //used for corect params parsing
            $this->parseAndSetRequestPrams();
            return $this->createRightRoute($this->defaultAction);
        }

        return false;
    }

    /**
     * @return EController | null
     */
    protected function tryLoadController()
    {
        //--- try load controller ---//
        $route = $this->getControllerBaseRoute();

        //--- append action to route ---//
        if (!empty($this->actionName)) {
            $route .= "/{$this->actionName}";
        }

        //--- try creating controller ---//
        $ctrlRes = yApp()->createController($route);
        if(!empty($ctrlRes)){
            return $ctrlRes[0];
        }
        return null;
    }
}
 