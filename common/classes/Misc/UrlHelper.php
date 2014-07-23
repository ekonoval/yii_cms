<?php
namespace Ekv\classes\Misc;

class UrlHelper
{
    static function appendUrlWithFrontDomain($url)
    {
        return 'http://'.yApp()->params->domainFront . $url;
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
 