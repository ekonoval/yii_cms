<?php
namespace Ekv\B\modules\test\forms;

use Ekv\B\components\System\FormBuilder;

class OrderForm extends FormBuilder
{
    protected static function _getConfig()
    {
        $config = array(
            'id' => 'orderEditForm',

            'elements' => array(
                'tab1' => array(
                    'type' => 'form',
                    //'title' => 'Subform title',
                    'elements' => array(
                        //'uid' => array('type' => 'text',),

                        'orderExtras.extraTxtField' => array('type' => 'text')
                    ),
                ),
            ),
        );
        return $config;
    }

    public function renderElements()
    {
        //foreach($this->getElements() as $element)
        $elements = $this->getElements();


        foreach ($elements as $frmVal) {
            foreach ($frmVal->getElements() as $elVal) {
                //pa(get_class($elVal));
                $this->renderElement($elVal);
            }
        }

        //return parent::renderElements();
    }

    public function renderElement($element)
    {
        if (is_string($element)) {
            if (($e = $this[$element]) === null && ($e = $this->getButtons()->itemAt($element)) === null) {
                return $element;
            } else {
                $element = $e;
            }
        }

        if ($element->getVisible()) {
            if ($element instanceof \CFormInputElement) {
                if ($element->type === 'hidden') {
                    return "<div style=\"visibility:hidden\">\n" . $element->render() . "</div>\n";
                } else {
                    return "<div class=\"row field_{$element->name}\">\n" . $element->render() . "</div>\n";
                }
            } elseif ($element instanceof \CFormButtonElement) {
                return $element->render() . "\n";
            } else {
                return $element->render();
            }
        }
        return '';
    }


}
 