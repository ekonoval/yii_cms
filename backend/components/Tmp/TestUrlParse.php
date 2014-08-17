<?php
namespace Ekv\B\components\Tmp;

use Ekv\components\System\IFullyQualified;

/**
 * @url http://www.yiiframework.ru/doc/guide/ru/topics.url
 */
class TestUrlParse extends \CBaseUrlRule implements IFullyQualified
{
    public $connectionID = 'db';

    static function getClassNameFQ()
    {
        return getClassNameFullyQualified(__CLASS__);
    }

    /*
     * Is called when using controller->createUrl
     */
    public function createUrl($manager,$route,$params,$ampersand)
    {
        pa("cr url", $route);
        return false;
        //pa("createUrl"); exit;
//        if ($route==='car/index')
//        {
//            if (isset($params['manufacturer'], $params['model']))
//                return $params['manufacturer'] . '/' . $params['model'];
//            else if (isset($params['manufacturer']))
//                return $params['manufacturer'];
//        }
//        return false;  // не применяем данное правило
    }

    /*
     * Is called from urlManager
     */
    public function parseUrl($manager,$request,$pathInfo,$rawPathInfo)
    {
        pa("parseUrl");
        if (preg_match('%^(\w+)(/(\w+))?$%', $pathInfo, $matches))
        {
            // Проверяем $matches[1] и $matches[3] на предмет
            // соответствия производителю и модели в БД.
            // Если соответствуют, выставляем $_GET['manufacturer'] и/или $_GET['model']
            // и возвращаем строку с маршрутом 'car/index'.
        }
        return false;  // не применяем данное правило
    }
}
 