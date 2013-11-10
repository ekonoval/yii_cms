<style type="text/css">
    .grid-view .filters input, .grid-view .filters select{
        margin: 0;
        padding: 0;
    }
</style>
<?php
/**
 * @var $model MMovies
 */

use Ekv\models\MMovies;

$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'movieGrid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    //5543'afterAjaxUpdate' => 'reinstallDatePicker',
    'selectableRows' => 2,

    'columns' => array(
        array(
             'class'=>'CCheckBoxColumn',
             'id'=>'pkID',
         ),
        'movieID',
        'movieName',

//        'last_name' => array(
//            'name' => 'last_name',
//            'type' => 'raw',
//            'value' => '$data->last_name',
//            'header' => 'ластНейм',
//        ),

//        array(
//            'class' => 'FlagColumn',
//            'name' => 'active',
//            'fake' => 'risk',
//            //'value' => '$data->getActiveOptionValue($data->active)',
//            'filter' => array(
//                1 => 'активен',
//                0 => 'НЕактивен'
//            )
//        ),

        array(
            'name' => 'createDate',
            'type' => 'raw',
            'value' => '$data->createDate',
            'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker',
                array(
                    'model' => $model,
                    'attribute' => 'createDate',
//                    'language' => 'uk',
                    'language' => '',
                    // 'i18nScriptFile' => 'jquery.ui.datepicker-ja.js', (#2)
                    'htmlOptions' => array(
                        'id' => 'dpCreateDate',
                        'size' => '10',
                    ),
                    'options' => array('dateFormat' => 'yy-mm-dd'),
                    'defaultOptions' => array( // (#3)
                        //'yearRange' => '2013:2013',
                        'showOn' => 'focus',
                        //'dateFormat' => 'yy/mm/dd',
                        'dateFormat' => 'yy-mm-dd',
                        'showOtherMonths' => true,
                        'selectOtherMonths' => true,
                        'changeMonth' => true,
                        'changeYear' => true,
                        'showButtonPanel' => true,
                    )
                ),
                true
            ), // (#4)
        ),

        array(
            'class' => 'CButtonColumn',
        ),
    ),
));