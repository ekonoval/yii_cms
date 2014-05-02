<?php
namespace Ekv\B\modules\translate\forms;

use Ekv\B\components\System\FormBuilder;

class WordEditForm extends FormBuilder
{
    protected function init()
    {
        parent::init();
//        $this->showErrorSummary = true;
//        $this->showErrors = false;
    }

    protected static function _getConfig()
    {
        $config = array(
            'id' => 'wordEditForm',

            'elements' => array(
                'tab1' => array(
                    'type' => 'form',
                    //'title' => 'Subform title',
                    'elements' => array(
                        'wordEN' => array(
                            'type' => 'text',
                        ),
                        //"<h2>xxxx</h2>",
                        'wordRU' => array(
                            'type' => 'text',
                        ),
                        'isHard' => array(
                            'type' => 'checkbox'
                        ),
                        'superHard' => array(
                            'type' => 'checkbox'
                        ),
                    ),
                ),
            ),
        );

        return $config;
    }

//    public function render()
//    {
//        $output = $this->renderBegin();
//
//        foreach ($this->getElements() as $element) {
//            //$output .= $element->render();
//            $output .= $this->renderElement($element);
//        }
//
//        $output .= $this->renderEnd();
//
//        return $output;
//    }


}
 