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
    static function getClassNameFQ()
    {
        return getClassNameFullyQualified(__CLASS__);
    }

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
        /**
         * @var CUrlManager $manager
         */
        if (preg_match('%^(\w+)(/.*)?$%', $pathInfo, $matches)){
pa($matches);
            $part = ltrim(substr($pathInfo, strlen($matches[1])));
            $part = $matches["2"];

            //$res = $manager->parsePathInfo(ltrim(substr($pathInfo, strlen($matches[0])), '/'));
            $res = $manager->parsePathInfo($part);
            pa($_REQUEST, $_GET);
            pa($matches);exit;


            // Проверяем $matches[1] и $matches[3] на предмет
            // соответствия производителю и модели в БД.
            // Если соответствуют, выставляем $_GET['manufacturer'] и/или $_GET['model']
            // и возвращаем строку с маршрутом 'car/index'.
        }
        return false;  // не применяем данное правило
    }


}
 