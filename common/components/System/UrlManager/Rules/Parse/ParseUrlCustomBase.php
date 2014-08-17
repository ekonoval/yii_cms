<?php
namespace Ekv\components\System\UrlManager\Rules\Parse;

use CUrlManager;
use EController;

class ParseUrlCustomBaseException extends \Exception{}

/**
 * Parses module and non module urls.
 * First checks module urls and fixes urls where it's impossible to define only by preg parsing is action ommited or not.
 * Like translate/episode/movieID/5/p2/xx
 * Index action is ommited here and standart parsing tries to find movieID as action in episode controller.
 * We check whether module, controller and action exists and set correctly passed params.
 *
 * The same situation is for non-module urls:
 * test/movieID/5/p2/xx - index action is ommited
 */
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

    protected function ensure($expr, $failMsg)
    {
        if (!$expr) {
            throw new ParseUrlCustomBaseException($failMsg);
        }
    }

    function mainParseUrl()
    {
        try {
            $this->parseUrlParts($this->pathInfo);

            $this->customPreValidation();

            $this->ensure(!empty($this->controllerName), "empty ctrl name");

            $controllerObj = $this->tryLoadController();
            $this->ensure($controllerObj, 'controller not found');

            $finalRoute = $this->checkController($controllerObj);
            return $finalRoute;

        } catch (ParseUrlCustomBaseException $ex) {

            return false;
        }

//        if(!$this->customPreValidation()){
//            return false;
//        }
//
//        if(empty($this->controllerName)){
//            return false;
//        }
//
//        $controllerObj = $this->tryLoadController();
//        if(empty($controllerObj)){
//            return false;
//        }
//
//        $finalRoute = $this->checkController($controllerObj);
//        if(!empty($finalRoute)){
//            return $finalRoute;
//        }
//
//        return false;
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
        if ($this->directActionFails) {
            $src = $this->actionName . $this->queryParamsRaw;
        }

        $src = ltrim($src, '/');

        $this->urlManager->parsePathInfo($src);
        //pa($_GET);
    }

    protected function checkController($ctrlObj)
    {
        $actionNameCalc = $this->actionName;
        if (empty($actionNameCalc)) {
            $actionNameCalc = $this->defaultAction;
        }

        $controllerActionsAll = $ctrlObj->getAllActionsList();

        /**
         * First try directly parsed action which may be first param name
         * Check translate/episode/movieID/5 where movieID is not really an action.
         * Check possible actions in real controller actions
         */
        if (in_array($actionNameCalc, $controllerActionsAll)) {
            $this->parseAndSetRequestPrams();
            return $this->createRightRoute($actionNameCalc);
        } /**
         * Directlty passed action doesn't exist -
         * check whether controller has DEFAULT action
         * translate/episode/movieID/5 equalas translate/episode/INDEX/movieID/5
         */
        elseif (in_array($this->defaultAction, $controllerActionsAll)) {

            $this->directActionFails = true; //used for corect params parsing
            $this->parseAndSetRequestPrams();
            return $this->createRightRoute($this->defaultAction);
        }

        $this->ensure(false, 'action not found');
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
        if (!empty($ctrlRes)) {
            return $ctrlRes[0];
        }
        return null;
    }
}