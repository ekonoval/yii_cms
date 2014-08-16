<?php
namespace Ekv\B\components\System\UrlManager\Rules;

use CHttpRequest;
use CUrlManager;

class RuleModules extends \CBaseUrlRule
{
    private $moduleName;
    private $controllerName;
    private $actionName;

    private $queryParamsRaw;

    private $directActionFails = false;

    private $defaultAction = 'index';

    /**
     * Creates a URL based on this rule.
     * @param CUrlManager $manager the manager
     * @param string $route the route
     * @param array $params list of parameters (name=>value) associated with the route
     * @param string $ampersand the token separating name-value pairs in the URL.
     * @return mixed the constructed URL. False if this rule does not apply.
     */
    public function createUrl($manager, $route, $params, $ampersand)
    {
        return false;
    }

    /**
     * Parses a URL based on this rule.
     * @param CUrlManager $manager the URL manager
     * @param CHttpRequest $request the request object
     * @param string $pathInfo path info part of the URL (URL suffix is already removed based on {@link CUrlManager::urlSuffix})
     * @param string $rawPathInfo path info that contains the potential URL suffix
     * @return mixed the route that consists of the controller ID and action ID. False if this rule does not apply.
     */
    public function parseUrl($manager, $request, $pathInfo, $rawPathInfo)
    {

        $this->parseUrlParts($pathInfo);

        $appModulesRes = yApp()->getModules();
        $appModulesNames = !empty($appModulesRes) ? array_keys($appModulesRes) : array();

        if(
            !empty($this->moduleName)
            &&  in_array($this->moduleName, $appModulesNames)
        ){
            // module found
            //pa("module found"); //exit;

            if(empty($this->controllerName)){
                return false;
            }

            //--- try load controller ---//
            $route = "{$this->moduleName}/{$this->controllerName}";

            //--- append action to route ---//
            if(!empty($this->actionName)){
                $route .= "/{$this->actionName}";
            }

            //--- try creating controller ---//
            $ctrlRes = yApp()->createController($route);
            //pa($ctrlRes); exit;

            /**
             * Controller of module is found, check action and apply url params as $_GET params
             */
            if(!empty($ctrlRes)){
                /**
                 * @var \EController $ctrlObj
                 */
                $ctrlObj = $ctrlRes[0];

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
                    $this->parseAndSetRequestPrams($manager);
                    return $this->createRightRoute($actionNameCalc);
                }
                /**
                 * Directlty passed action doesn't exist -
                 * check whether controller has DEFAULT action
                 * translate/episode/movieID/5 equalas translate/episode/INDEX/movieID/5
                 */
                elseif(in_array($this->defaultAction, $controllerActionsAll)){

                    $this->directActionFails = true; //used for corect params parsing
                    $this->parseAndSetRequestPrams($manager);
                    return $this->createRightRoute($this->defaultAction);
                }
            }

        }

        /**
         * Module or controller aren't found ...
         * Skip the rule
         */
        return false;
    }

    private function parseAndSetRequestPrams(CUrlManager $manager)
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

        $manager->parsePathInfo($src);
        //pa($_GET);
    }

    private function createRightRoute($action)
    {
        $route = "{$this->moduleName}/{$this->controllerName}/{$action}";
        //pa($route); exit;
        return $route;
    }

    private function parseUrlParts($pathInfo)
    {
        /*
         * Must begin form module, then
         */
        //$pattern = '#^([^\/]+)(/([^\/]+)(/([^\/]+))?)?(.*)#';
        $pattern = '#^([^\/]+)/([^\/]+)(/([^\/]+))?(.*)#';


        if(preg_match($pattern, $pathInfo, $matches)){
            $this->moduleName = isset($matches[1]) ? $matches[1] : null;
            $this->controllerName = isset($matches[2]) ? $matches[2] : null;
            $this->actionName = isset($matches[4]) ? $matches[4] : '';

            $this->queryParamsRaw = isset($matches[5]) ? $matches[5] : '';
            //pa($this->moduleName, $this->controllerName, $this->actionName);
        }
    }


}
 