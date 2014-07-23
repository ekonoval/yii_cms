<?php
class CkFinderConfig
{
    static function getBaseUrl()
    {
        $baseUrl = 'http://appyii.dev/images/ckeditor/';
        return $baseUrl;
    }

    static function getBaseDir()
    {
        $baseDir = 'd:\denwer3\home\appyii.dev\www\images\ckeditor\\';
        return $baseDir;
    }

    static function isBackendUserSignedIn()
    {
        if(session_id() == '') {
            session_start();
        }

        return isset($_SESSION["backend_user__id"]);
    }
}
 