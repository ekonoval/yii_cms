<?php
namespace Ekv\B\widgets\Input\Datepicker;

use CWidget;
use Ekv\B\classes\Misc\DateHelper;
use Ekv\widgets\Jui\EkvJuiDatePicker;

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
    static function getClassNameFQ()
    {
        return getClassNameFullyQualified(__CLASS__);
    }

    public function init()
    {
        parent::init();

        $this->defaultOptions["changeMonth"] = true;
        $this->defaultOptions["changeYear"] = true;

        $this->options["dateFormat"] = DateHelper::FORMAT_JQ_DATE_PICKER_NO_TIME;

        $this->language = 'uk';
    }

}
 