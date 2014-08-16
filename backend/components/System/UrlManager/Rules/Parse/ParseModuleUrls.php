<?php
namespace Ekv\B\components\System\UrlManager\Rules\Parse;

use EController;

class ParseModuleUrls extends ParseUrlCustomBase
{
    protected $moduleName;

    protected function parseUrlParts($pathInfo)
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

    function mainParseUrl()
    {
        $this->parseUrlParts($this->pathInfo);

        if(!$this->checkModule()){
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

    protected function customPreValidation()
    {
        if(!$this->checkModule()){
            return false;
        }
        return true;
    }


    protected function getControllerBaseRoute()
    {
        $route = "{$this->moduleName}/{$this->controllerName}";
        return $route;
    }

    protected function createRightRoute($action)
    {
        $route = "{$this->moduleName}/{$this->controllerName}/{$action}";
        //pa($route); exit;
        return $route;
    }


    private function checkModule()
    {
        $appModulesRes = yApp()->getModules();
        $appModulesNames = !empty($appModulesRes) ? array_keys($appModulesRes) : array();

        if(
            !empty($this->moduleName)
            &&  in_array($this->moduleName, $appModulesNames)
        ){
            return true;
        }

        return false;
    }


}
 