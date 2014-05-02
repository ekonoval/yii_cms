<?php
use Ekv\B\extensions\sgridview\SGridView;
use Ekv\B\modules\test\models\BTestFieldsCustom;

/**
 * @var $model BTestFieldsCustom
 */

$grid_widget = SGridView::getFullName();
//$grid_widget = 'zii.widgets.grid.CGridView';

$this->widget($grid_widget, array(
    'id' => 'fieldsCustomGrid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'selectableRows' => 2,
    //'ajaxUrl' => yApp()->request->url,
    //'ajaxUrl' => "/translate/movie/index/",

    'columns' => array(
        array(
            'class' => 'CCheckBoxColumn',
            'id' => 'pkID',
        ),
        'id',

        array(
            'name' => "fName",
            'type' => "raw",
            'value' => function ($data, $row) {
                return CHtml::link(CHtml::encode($data->fName),
                    yApp()->createUrl("/test/customFields/update/", array("id" => $data->id)),
                    array('title' => 'View movie episodes')
                );
            }
        ),


//        array(
//            'name' => 'createDate',
//            'type' => 'raw',
//            'value' => '$data->createDate',
//            //'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker',
//            'filter' => $this->widget('common.widgets.jui.EkvJuiDatePicker',
//                    array(
//                        'model' => $model,
//                        'attribute' => 'createDate',
//                        //'language' => 'uk',
//                        //'language' => '',
//                        // 'i18nScriptFile' => 'jquery.ui.datepicker-ja.js', (#2)
//                        'htmlOptions' => array(
//                            'id' => 'dpCreateDate',
//                            'size' => '10',
//                        ),
//                        'options' => array('dateFormat' => 'yy-mm-dd'),
//                        'defaultOptions' => array( // (#3)
//                            //'yearRange' => '2013:2013',
//                            'showOn' => 'focus',
//                            //'dateFormat' => 'yy/mm/dd',
//                            'dateFormat' => 'yy-mm-dd',
//                            'showOtherMonths' => true,
//                            'selectOtherMonths' => true,
//                            'changeMonth' => true,
//                            'changeYear' => true,
//                            'showButtonPanel' => true,
//                        )
//                    ),
//                    true
//                ), // (#4)
//        ),

        array(
            'class' => 'CButtonColumn',
        ),
    ),
));