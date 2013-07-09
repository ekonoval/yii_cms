<?php
namespace Ekv\Product\Helpers;

class ProductDetailedHelper
{
    function test()
    {
        pa(__NAMESPACE__);
    }

    static function staticTest()
    {
        pa(__NAMESPACE__, __METHOD__);
    }
}
