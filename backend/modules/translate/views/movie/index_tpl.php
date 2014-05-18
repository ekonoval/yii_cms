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

use Ekv\B\classes\Misc\DateHelper;
use Ekv\B\extensions\sgridview\SGridView;
use Ekv\B\modules\translate\controllers\MovieController;
use Ekv\B\widgets\Input\Datepicker\WDatePicker;
use Ekv\models\MMovies;

$grid_widget = SGridView::getClassNameFQ();

$filterCreateDateJsID = 'filterCreateDate';

$this->widget($grid_widget, array(
    'id' => 'movieGrid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'afterAjaxUpdate' => 'reinstallDatePicker',
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

        //<editor-fold desc="example fields">
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
        //</editor-fold>

        array(
            'name' => 'createDate',
            'type' => 'raw',
            //'value' => '$data->createDate',
            'value' => function ($data) {
                return DateHelper::getJqDatePickerFormatedDate($data->createDate, false);
            },

            'filter' => $this->widget(
                WDatePicker::getClassNameFQ(),
                array(
                    'id' => $filterCreateDateJsID, // !!!! important for reinstall
                    'model' => $model,
                    'attribute' => 'createDate',
                ),
                true
            ),
        ),

        array(
            'class' => 'CButtonColumn',
        ),
    ),
));

//#------------------- reset after ajax !! -------------------#//
yClientScript()->registerScript(
    're-install-date-picker',
    "function reinstallDatePicker(id, data) {
        $('#{$filterCreateDateJsID}').datepicker();
    }
    "
);