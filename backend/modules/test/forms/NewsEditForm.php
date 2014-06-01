<?php
namespace Ekv\B\modules\test\forms;

use Ekv\B\components\System\FormBuilder;

class NewsEditForm extends FormBuilder
{
    static function getClassNameFQ()
    {
        return getClassNameFullyQualified(__CLASS__);
    }

    protected static function _getConfig()
    {
        $config = array(
            'id' => 'newsEditForm',

            'elements' => array(
                'base' => array(
                    'type' => 'form',
                    //'title' => 'Subform title',
                    'elements' => array(
                        'name' => array('type' => 'text',),
                        'enabled' => array('type' => 'checkbox',),
// /*
                        'categoriesRelated' => array(
                            'type' => "checkboxlist",
                            //'items' => array(22 => 'sss2' , 55 => 'zz5'),
                            //'options' => array(22 => array('label' => 'xxx'))

                            //'type' => "text"
                        )
// */
                    ),
                ),

            ),
        );

        return $config;
    }

}
 