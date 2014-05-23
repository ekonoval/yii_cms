<?php
namespace Ekv\B\modules\test\forms;

use Ekv\B\components\System\FormBuilder;

class OrderEditForm extends FormBuilder
{
    protected static function _getConfig()
    {
        $config = array(
            'id' => 'orderEditForm',

            'elements' => array(
                'base' => array(
                    'type' => 'form',
                    //'title' => 'Subform title',
                    'elements' => array(
                        'uid' => array('type' => 'text',),
                        'status' => array('type' => 'text',),
                        'baseTxtField' => array('type' => 'text',),
                    ),
                ),

                'extra' => array(
                    'type' => 'form',
                    'elements' => array(
                        'extraTxtField' => array('type' => 'text',),
                    ),
                ),

            ),
        );
        return $config;
    }

}
 