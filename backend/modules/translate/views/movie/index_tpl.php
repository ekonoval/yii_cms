<style type="text/css">
    .grid-view .filters input, .grid-view .filters select {
        margin: 0;
        padding: 0;
    }
</style>
<?php
/**
 * @var $this MovieController
 * @var $model MMovies
 */

use Ekv\B\extensions\sgridview\SGridView;
use Ekv\B\modules\translate\controllers\MovieController;
use Ekv\models\MMovies;
use Ekv\widgets\Jui\EkvJuiDatePicker;

//$this->widget('zii.widgets.grid.CGridView', array(
//$this->widget('backend.extensions.sgridview.SGridView', array(

$grid_widget = SGridView::getFullName();
//$grid_widget = 'zii.widgets.grid.CGridView';

$this->widget($grid_widget, array(
    'id' => 'movieGrid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    //5543'afterAjaxUpdate' => 'reinstallDatePicker',
    'selectableRows' => 2,
    //'ajaxUrl' => yApp()->request->url,
    'ajaxUrl' => "/translate/movie/index/",

    'columns' => array(
        array(
            'class' => 'CCheckBoxColumn',
            'id' => 'pkID',
        ),
        'movieID',

        'movieName' => array(
            'name' => "movieName",
            'type' => "raw",
            'value' => function ($data, $row) {
                return CHtml::link(CHtml::encode($data->movieName),
                    yApp()->createUrl("translate/episode/index", array("movieID" => $data->movieID)),
                    array('title' => 'View movie episodes')
                );
            }
            //'CHtml::link(CHtml::encode($data->email), "mailto:".CHtml::encode($data->email))',
        ),

//        'movieNameLnk' => array(
//            //'name' => "movieName",
//            'class' => 'CLinkColumn',
//            'header' => 'movieNameHeader',
//            'labelExpression' => function($data){return $data->movieName;},
//            'urlExpression' => function($data){
//                return yApp()->createUrl("translate/episode/index", array("movieID" => $data->movieID));
//            },
//            'linkHtmlOptions' => array('title' => 'View movie episodes')
//        ),

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
            //'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker',
            //'filter' => $this->widget('common.widgets.jui.EkvJuiDatePicker',
            'filter' => $this->widget(EkvJuiDatePicker::getClassNameFQ(),
                    array(
                        'model' => $model,
                        'attribute' => 'createDate',
                        //'language' => 'uk',
                        //'language' => '',
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