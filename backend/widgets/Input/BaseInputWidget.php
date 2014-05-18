<?php
namespace Ekv\B\widgets\Input;
use CHtml;
use CInputWidget;
use Ekv\B\components\System\IFullyQualified;

abstract class BaseInputWidget extends CInputWidget implements IFullyQualified
{
    protected function drawInputText($name)
    {
        if ($this->hasModel()) {
            echo CHtml::activeTextField($this->model, $this->attribute, $this->htmlOptions);
        } else {
            echo CHtml::textField($name, $this->value, $this->htmlOptions);
        }
    }
}
 