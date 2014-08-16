<?php
namespace Ekv\B\components\System\UrlManager\Rules;

use CHttpRequest;
use CUrlManager;

/**
 * TMP
 * @deprecated
 */
class RuleControllerWithoutActionPlusParams extends \CBaseUrlRule
{

    /*
     * Url Creating should work fine in native way without any additional actions
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
        pa(yApp()->getModules());exit;
        pa('parse');exit;
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
    public function parseUrl1($manager, $request, $pathInfo, $rawPathInfo)
    {
        //pa(func_get_args()); exit;
        $controllerName = $this->parseControllerName($pathInfo);

        if(empty($controllerName)){
            return false;
        }

        /**
         * @var \EController $controllerObj
         */
        $controllerRes = yApp()->createController($controllerName.'/index');
        pa($controllerRes[0]->getAction(), $controllerRes);exit;



        $actions = array('other',  'fake');
        $actions[] = 'index';
        foreach($actions as &$actionVal){
            $actionVal .= '\/';
        }


        $actionsPartsStr = implode('|', $actions);
        //$pattern = '#ekvTest\/((?!other|fake).*)#';
        $pattern = '#(ekvTest)\/((?!'.$actionsPartsStr.').*)#';

        /**
         * @var CUrlManager $manager
         */
        //if (preg_match('%^(\w+)(/.*)?$%', $pathInfo, $matches)){
        if (preg_match($pattern, $pathInfo, $matches)){
            //pa($matches);//exit;

            $route = "{$matches["1"]}/index";
            //$route = "xxx/xxx";
            //pa(\Yii::getLogger()->executionTime);

            /**
             * @var \EkvTestController $controllerRes
             */
            $controllerRes = yApp()->createController($route);
            //var_dump($controllerRes);//exit;

            //pa(\Yii::getLogger()->executionTime);
            //pa(\Yii::getLogger()->executionTime);
            //pa($controllerRes->action);
         //   exit;


            $part = ltrim(substr($pathInfo, strlen($matches[1])));
            $part = $matches["2"];

            //$res = $manager->parsePathInfo(ltrim(substr($pathInfo, strlen($matches[0])), '/'));
            $res = $manager->parsePathInfo($part);
//            pa($_REQUEST, $_GET);
//            pa($matches);//exit;

            return $route;

            // Проверяем $matches[1] и $matches[3] на предмет
            // соответствия производителю и модели в БД.
            // Если соответствуют, выставляем $_GET['manufacturer'] и/или $_GET['model']
            // и возвращаем строку с маршрутом 'car/index'.
        }

        return false;  // не применяем данное правило
    }

    private function parseControllerName($pathInfo)
    {
        $controllerName = '';

        $pattern = '/([^\/]+)/';
        if(preg_match($pattern, $pathInfo, $matches)){
            $controllerName = $matches[1];
        }
        return $controllerName;
    }


}
 