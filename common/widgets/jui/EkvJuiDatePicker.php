<?php
namespace Ekv\widgets\Jui;

use CClientScript;
use CHtml;
use CJavaScript;
use CJuiDatePicker;
use Ekv\components\System\IFullyQualified;
use Yii;

Yii::import('zii.widgets.jui.CJuiDatePicker');

/**
 * CJuiDatepicker fix a bug when defaultOptions are set but 'language' param is not passed
 * (Chinese default locale for english lang)
 * https://github.com/ekonoval/yii/commit/b05e994ee39845db805f64a0767c1d0b05d8e9f6
 */
class EkvJuiDatePicker extends CJuiDatePicker implements IFullyQualified
{
    static function getClassNameFQ()
    {
        return getClassNameFullyQualified(__CLASS__);
    }

    public function run()
    {
        list($name, $id) = $this->resolveNameID();

        if (isset($this->htmlOptions['id'])) {
            $id = $this->htmlOptions['id'];
        } else {
            $this->htmlOptions['id'] = $id;
        }
        if (isset($this->htmlOptions['name'])) {
            $name = $this->htmlOptions['name'];
        }

        if ($this->flat === false) {
            if ($this->hasModel()) {
                echo CHtml::activeTextField($this->model, $this->attribute, $this->htmlOptions);
            } else {
                echo CHtml::textField($name, $this->value, $this->htmlOptions);
            }
        } else {
            if ($this->hasModel()) {
                echo CHtml::activeHiddenField($this->model, $this->attribute, $this->htmlOptions);
                $attribute = $this->attribute;
                $this->options['defaultDate'] = $this->model->$attribute;
            } else {
                echo CHtml::hiddenField($name, $this->value, $this->htmlOptions);
                $this->options['defaultDate'] = $this->value;
            }

            $this->options['altField'] = '#' . $id;

            $id = $this->htmlOptions['id'] = $id . '_container';
            $this->htmlOptions['name'] = $name . '_container';

            echo CHtml::tag('div', $this->htmlOptions, '');
        }

        $options = CJavaScript::encode($this->options);
        $js = "jQuery('#{$id}').datepicker($options);";

        if (!$this->_isLangDefault()) {
            $this->registerScriptFile($this->i18nScriptFile);
            $js = "jQuery('#{$id}').datepicker(jQuery.extend({showMonthAfterYear:false},jQuery.datepicker.regional['{$this->language}'],{$options}));";
        }

        $cs = Yii::app()->getClientScript();

        if (isset($this->defaultOptions)) {
            if (!$this->_isLangDefault()) {
                $this->registerScriptFile($this->i18nScriptFile);
            }

            $cs->registerScript(__CLASS__, $this->defaultOptions !== null ? 'jQuery.datepicker.setDefaults(' . CJavaScript::encode($this->defaultOptions) . ');' : '');
        }
        $cs->registerScript(__CLASS__ . '#' . $id, $js);
    }

    protected function _isLangDefault()
    {
        return $this->language == '' || $this->language == 'en';
    }

    /**
     * Overrided for manual i18nScriptFile usage, set $this->i18nScriptFile = null and manualy register custom
     * i18nScriptFile file from custom assets. As this file is being tried to re-register in some other places
     * see if $fileName as null is comming and ignore re-register (custom file has to be already included at this point)
     * @param string $fileName
     * @param int $position
     */
    protected function registerScriptFile($fileName, $position = CClientScript::POS_END)
    {
        if(!is_null($fileName)){
            parent::registerScriptFile($fileName, $position);
        }
    }


}