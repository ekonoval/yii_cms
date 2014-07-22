<?php
namespace Ekv\classes\Misc;

class UrlHelper
{
    static function appendUrlWithFrontDomain($url)
    {
        return 'http://'.yApp()->params->domainFront . $url;
    }

    static function getFronFilesUrl()
    {
        return self::appendUrlWithFrontDomain('/files/');
    }
}
 