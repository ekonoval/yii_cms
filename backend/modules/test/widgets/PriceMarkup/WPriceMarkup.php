<?php
namespace Ekv\B\modules\test\widgets\PriceMarkup;

use Ekv\components\System\IFullyQualified;

class WPriceMarkup extends \CInputWidget implements IFullyQualified
{

    static function getClassNameFQ()
    {
        return getClassNameFullyQualified(__CLASS__);
    }

    public function init()
    {
        //pa("exit"); exit;
    }


    public function run()
    {
        /**
         * @var $model \BTestFieldsCustom
         */
        $model = $this->model;
//        $hasMarkup = true;
//        if(
//            $model->markupNumeric > 0
//            || $model->markupPercent > 0
//        ){
//            $hasMarkup = true;
//        }

        include_once __DIR__."/markup.php";

//        $output = CHtml::textField("_tmp1", "ss");
//        $output .= "<br>" . CHtml::textField("_tmp2", "zz");;

        //echo $output;
    }

}
