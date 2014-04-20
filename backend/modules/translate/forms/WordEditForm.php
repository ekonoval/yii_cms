<?php
namespace Ekv\B\modules\translate\forms;

//use CFormElement;
//use CModel;
//use Yii;

use CFormElement;
use CModel;
use Yii;

class WordEditForm extends \CForm
{
//    public function __construct($config, $model = null, $parent = null)
//    {
//        pa($config);
//        pa(debug_backtrace(DEBUG_BACKTRACE_PROVIDE_OBJECT, 8));
//        parent::__construct($config, $model, $parent);
//    }

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
                        //                        'wordRU' => array(
                        //                            'type' => 'text',
                        //                        ),
                    ),
                ),
            ),
        );

        return $config;
    }


    public function __construct1($config, $model = null, $parent = null)
        //public function __construct($model)
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
//                        'wordRU' => array(
//                            'type' => 'text',
//                        ),
                    ),
                ),
            ),
        );
        parent::__construct($config, $model, null);
    }

    protected function init1()
    {
        parent::init();

        $config = $this->_getConfig();
        //pa($config);exit;

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
//                        'wordRU' => array(
//                            'type' => 'text',
//                        ),
                    ),
                ),
            ),
        );

        $this->configure($config);
    }


    private function _getConfig()
    {
        $config = array(
            'id' => 'wordEditForm',

            'elements' => array(
                'tab1' => array(
                    'type' => 'form',
                    'title' => 'Subform title',
                    'elements' => array(
//                        'wordEN' => array(
//                            'type' => 'text',
//                        ),
                        "<h2>xxxx</h2>",
//                        'wordRU' => array(
//                            'type' => 'text',
//                        ),
                    ),
                ),
            ),
        );

        $config1 = array(
            'id' => 'wordEditForm',

            'elements' => array(
                'wordEN' => array(
                    'type' => 'text',
                ),
                "<h2>risk</h2>",
                'wordRU' => array(
                    'type' => 'text',
                ),
            ),
        );

        return $config;
    }

}
 