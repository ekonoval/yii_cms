<?php
namespace Ekv\B\widgets\Input\Datepicker;

use CHtml;
use Ekv\B\widgets\Input\BaseInputWidget;
use Yii;

class WDateTimePicker extends BaseInputWidget
{
    public $lang = 'uk';//en
    static function getClassNameFQ()
    {
        return getClassNameFullyQualified(__CLASS__);
    }

    protected function registerAssets()
    {
        $assets = Yii::app()->getAssetManager()->publish(__DIR__.DIRECTORY_SEPARATOR.'assets');
        $cs = yClientScript();

        $cs->registerScriptFile($assets.'/jquery-ui-sliderAccess.js');
        $cs->registerScriptFile($assets.'/jquery-ui-timepicker-addon.min.js');
        $cs->registerScriptFile($assets.'/jquery-ui-timepicker-uk.js');
        $cs->registerCssFile($assets.'/jquery-ui-timepicker-addon.css');
    }

    public function run()
    {
        $this->registerAssets();

        list($name, $id) = $this->resolveNameID();

        $this->drawInputText($name);

        $dtOptions = array(
            'dateFormat' => WDatePicker::JS_DATE_FORMAT
        );
        $dtOptionsJs = json_encode($dtOptions);

        $js = "$.datepicker.setDefaults($.datepicker.regional['{$this->lang}']);";
        $js .= "$('#{$id}').datetimepicker({$dtOptionsJs});";
        yClientScript()->registerScript(__CLASS__ . '#' . $id, $js);
    }


}
 