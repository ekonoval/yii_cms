<?php
namespace Ekv\B\modules\core\forms;

use Ekv\B\components\System\FormBuilder;
use Ekv\B\widgets\Input\CKEditor\WCKEditor;

class StatPageForm extends FormBuilder
{
    protected static function _getConfig()
    {
        $config = array(
            'attributes' => array(
                'enctype' => 'multipart/form-data',
            ),

            'id' => 'cfEditFormID',


            'elements' => array(
                'pageTitle' => array('type' => 'text',),
                'url' => array('type' => 'text',),
                'metaDescr' => array('type' => 'textarea',),
                'metaKeywords' => array('type' => 'textarea',),
                'pageBody' => array('type' => WCKEditor::getClassNameFQ(), )

//                        'dt' => array(
//                            //'type' => WDatePicker::getClassNameFQ(),
//                            //                            'defaultOptions' => array(
//                            //                                'changeMonth' => true,
//                            //                                'changeYear' => true,
//                            //                            ),
//                            //                            'options' => array(
//                            //                                'dateFormat' => 'dd.mm.yy',
//                            //                            ),
//                            //                            'language' => 'uk'
//                        ),
//
//                        'dtFull' => array(
//                            'type' => WDateTimePicker::getClassNameFQ(),
//                            //'lang' => 'ru'
//                        ),


                //                        'txtBig' => array(
                //                            'type' => WCKEditor::getClassNameFQ(),
                //                        ),

            ),
        );

        return $config;
    }

}
 