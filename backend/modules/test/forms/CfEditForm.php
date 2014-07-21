<?php
namespace Ekv\B\modules\test\forms;

use Ekv\B\components\System\FormBuilder;
use Ekv\B\modules\test\widgets\PriceMarkup\WPriceMarkup;
use Ekv\B\widgets\Input\CKEditor\WCKEditor;
use Ekv\B\widgets\Input\Datepicker\WDatePicker;
use Ekv\B\widgets\Input\Datepicker\WDateTimePicker;
use Ekv\widgets\Jui\EkvJuiDatePicker;

class CfEditForm extends FormBuilder
{
    protected static function _getConfig()
    {
        $config = array(
            'attributes' => array(
                'enctype' => 'multipart/form-data',
            ),

            'id' => 'cfEditFormID',


            'elements' => array(
                'tab1' => array(
                    'type' => 'form',
                    //'title' => 'Subform title',
                    'elements' => array(
                        'fName' => array('type' => 'text',),

                        'markupCalc' => array(
                            'type' => WPriceMarkup::getClassNameFQ(),
                            //'risking' => 3
                        ),

                        'dt' => array(
                            //'type' => WDatePicker::getClassNameFQ(),
//                            'defaultOptions' => array(
//                                'changeMonth' => true,
//                                'changeYear' => true,
//                            ),
//                            'options' => array(
//                                'dateFormat' => 'dd.mm.yy',
//                            ),
//                            'language' => 'uk'
                        ),

                        'dtFull' => array(
                            'type' => WDateTimePicker::getClassNameFQ(),
                            //'lang' => 'ru'
                        ),

                        'txtFile' => array(
                            'type' => 'file'
                        ),

//                        'txtBig' => array(
//                            'type' => WCKEditor::getClassNameFQ(),
//                        ),
//                        'txtShort' => array('type' => WCKEditor::getClassNameFQ())
                    ),
                ),
            ),
        );

        return $config;
    }

//    public function renderBody()
//    {
//        $output = '';
//        if ($this->title !== null) {
//            if ($this->getParent() instanceof self) {
//                $attributes = $this->attributes;
//                unset($attributes['name'], $attributes['type']);
//                $output = \CHtml::openTag('fieldset', $attributes) . "<legend>" . $this->title . "</legend>\n";
//            } else {
//                $output = "<fieldset>\n<legend>" . $this->title . "</legend>\n";
//            }
//        }
//
//        if ($this->description !== null) {
//            $output .= "<div class=\"description\">\n" . $this->description . "</div>\n";
//        }
//
//        if ($this->showErrorSummary && ($model = $this->getModel(false)) !== null) {
//            $output .= $this->getActiveFormWidget()->errorSummary($model) . "\n";
//        }
//
//        $output .= $this->renderElements() . "\n" . $this->renderButtons() . "\n";
//
//        if ($this->title !== null) {
//            $output .= "</fieldset>\n";
//        }
//
//        return $output;
//    }
//
//    public function renderElements()
//    {
//        $output = '';
//        foreach ($this->getElements() as $element) {
//            $output .= $this->renderElement($element);
//        }
//        return $output;
//    }

//    public function renderElement1($element)
//    {
//        //pa(get_class($element));
////        if (is_string($element)) {
////            if (($e = $this[$element]) === null && ($e = $this->getButtons()->itemAt($element)) === null) {
////                pa("exit"); exit;
////                return $element;
////            } else {
////                $element = $e;
////            }
////        }
//
//        /**
//         * @var $element \CFormInputElement
//         * @var $model BTestFieldsCustom
//         */
//
//        $model = $this->getParent()->getModel();
////        pa(
////            $model->scenario,
////            $model->getSafeAttributeNames(),
////            $model->attributes
////        );//exit;
//
//        if ($element->getVisible()) {
//            if ($element instanceof \CFormInputElement) {
//                if ($element->type === 'hidden') {
//                    return "<div style=\"visibility:hidden\">\n" . $element->render() . "</div>\n";
//                } else {
//                    return "<div class=\"row field_{$element->name}\">\n" . $element->render() . "</div>\n";
//                }
//            } elseif ($element instanceof \CFormButtonElement) {
//                return $element->render() . "\n";
//            } else {
//                echo "<h2>Vasya   </h2>\n";
//                return $element->render();
//            }
//        }else{
//            pa($element);
//        }
//        return '';
//    }
}
 