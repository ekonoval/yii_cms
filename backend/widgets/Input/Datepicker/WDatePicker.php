<?php
namespace Ekv\B\widgets\Input\Datepicker;

use CWidget;
use Ekv\widgets\Jui\EkvJuiDatePicker;
use Yii;

/**
    'defaultOptions' => array(
        'changeMonth' => true,
        'changeYear' => true,
    ),
    'options' => array(
        'dateFormat' => 'dd.mm.yy',
    ),
    'language' => 'uk'
 */
class WDatePicker extends EkvJuiDatePicker
{
    const JS_DATE_FORMAT = "dd.mm.yy";

    static function getClassNameFQ()
    {
        return getClassNameFullyQualified(__CLASS__);
    }

    public function init()
    {
        parent::init();

        $this->defaultOptions["changeMonth"] = true;
        $this->defaultOptions["changeYear"] = true;

        $this->options["dateFormat"] = self::JS_DATE_FORMAT;

        $this->language = 'uk';


//        $timeOptions = array(
//            'duration' => 0,
//            'showTime' => true,
//            'stepMinutes' => 5,
//            'time24h' => true
//        );
//        $this->options = array_merge($this->options, $timeOptions);
//        $this->defaultOptions = array_merge($this->defaultOptions, $timeOptions);
        //pa($this->options);


//        $assets = Yii::app()->getAssetManager()->publish(__DIR__.DIRECTORY_SEPARATOR.'assets');
//        $cs = Yii::app()->getClientScript();
//        $cs->registerScriptFile($assets.'/timepicker.js');
    }



}
 