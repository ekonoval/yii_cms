<?php
namespace Ekv\classes\Misc;

use Ekv\classes\EkvGlobalHelper;
use Ekv\classes\Exceptions\EkvException;

class UrlHelper
{
    static function appendUrlWithFrontDomain($url)
    {
        return 'http://'.yApp()->params->domainFront . $url;
    }

    static function appendUrlWithBackDomain($url)
    {
        return 'http://'.yApp()->params->domainBack . $url;
    }

    static function getUrlViewDependent($view, $url)
    {
        $map = array(
            EkvGlobalHelper::VIEW_FRONT => 'appendUrlWithFrontDomain',
            EkvGlobalHelper::VIEW_BACK => 'appendUrlWithBackDomain',
        );

        EkvException::ensure(isset($map[$view]), "No view available '{$view}' for url");
        $method = $map[$view];

        return self::$method($url);
    }

    static function getFronFilesUrl($pathRelative = '')
    {
        $urlFull = self::appendUrlWithFrontDomain('/files/');

        if(!empty($pathRelative)){
            $urlFull .= $pathRelative;
        }

        return $urlFull;

    }
}
 