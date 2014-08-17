<?php
namespace Ekv\components\System\UrlManager\Rules;

use CHttpRequest;
use CUrlManager;
use Ekv\components\System\IFullyQualified;
use Ekv\components\System\UrlManager\Rules\Parse\ParseNonModuleUrls;

class RuleNonModules extends \CBaseUrlRule implements IFullyQualified
{
    static function getClassNameFQ()
    {
        return getClassNameFullyQualified(__CLASS__);
    }

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
        $obj = new ParseNonModuleUrls($manager, $pathInfo);
        $res = $obj->mainParseUrl();
        //pa($res);exit;
        return $res;
    }

}
 