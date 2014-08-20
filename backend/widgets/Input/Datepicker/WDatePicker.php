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

        //$this->defaultOptions["changeMonth"] = true;
        //$this->defaultOptions["changeYear"] = true;
        //$this->defaultOptions["dateFormat"] = self::JS_DATE_FORMAT;
        //$this->options["dateFormat"] = self::JS_DATE_FORMAT;

        if(empty($this->language)){
            $this->language = 'en';
        }
        //$this->language = 'uk';
        //$this->language = 'ru';

        /*
         * This whole mess up is used for ajax filter grid (resetting settings after grid ajax request)
         */
        $this->i18nScriptFile = null;// !!!!
        if(!$this->_isLangDefault()){
            $assets = Yii::app()->getAssetManager()->publish(__DIR__.DIRECTORY_SEPARATOR.'assets');
            $cs = yClientScript();
            $cs->registerScriptFile($assets."/i18n/datepicker-{$this->language}.js");
        }

    }

}
 