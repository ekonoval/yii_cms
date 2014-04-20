<?php
namespace Ekv\B\modules\translate\forms;

class WordEditForm extends \CForm
{
    static function create($model)
    {
        return new self(self::_config(), $model);
    }

    private static function _config()
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
 