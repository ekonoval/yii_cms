<?php
namespace Ekv\B\components\System\UrlManager\Rules\Parse;

use EController;

class ParseNonModuleUrls extends ParseUrlCustomBase
{
    protected $moduleName;

    protected function parseUrlParts($pathInfo)
    {
        /*
         * Must begin form controller, then possible action, then possible params
         */
        $pattern = '#^([^\/]+)(/([^\/]+))?(.*)#';

        if(preg_match($pattern, $pathInfo, $matches)){
            $this->controllerName = isset($matches[1]) ? $matches[1] : null;
            $this->actionName = isset($matches[3]) ? $matches[3] : '';

            $this->queryParamsRaw = isset($matches[4]) ? $matches[4] : '';
            //pa($this->moduleName, $this->controllerName, $this->actionName);
            return true;
        }

        $this->ensure(false, 'pregmatch failed');
    }

    protected function getControllerBaseRoute()
    {
        $route = "{$this->controllerName}";
        return $route;
    }

    protected function createRightRoute($action)
    {
        $route = "{$this->controllerName}/{$action}";
        //pa($route); exit;
        return $route;
    }

}
 