<?php
namespace Ekv\B\modules\translate\forms;

use Ekv\B\components\System\FormBuilder;

class WordEditForm extends FormBuilder
{
    protected static function _getConfig()
    {
        $config = array(
            'id' => 'wordEditForm',

            'elements' => array(
                'tab1' => array(
                    'type' => 'form',
                    'title' => 'Subform title',
                    'elements' => array(
                        'wordEN' => array(
                            'type' => 'text',
                        ),
                        "<h2>xxxx</h2>",
                        'wordRU' => array(
                            'type' => 'text',
                        ),
                    ),
                ),
            ),
        );

        return $config;
    }

}
 