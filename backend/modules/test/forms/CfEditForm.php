<?php
namespace Ekv\B\modules\test\forms;

use Ekv\B\components\System\FormBuilder;

class CfEditForm extends FormBuilder
{
    protected static function _getConfig()
    {
        $config = array(
            'id' => 'wordEditForm',

            'elements' => array(
                'tab1' => array(
                    'type' => 'form',
                    //'title' => 'Subform title',
                    'elements' => array(
                        'fName' => array(
                            'type' => 'text',
                        ),

                        'markup' => array(
                            'type' => 'text'
                        )
                    ),
                ),
            ),
        );

        return $config;
    }
}
 