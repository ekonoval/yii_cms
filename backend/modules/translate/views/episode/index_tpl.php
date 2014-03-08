<style type="text/css">
    .grid-view .filters input, .grid-view .filters select {
        margin: 0;
        padding: 0;
    }
</style>
<?php
/**
 * @var $model BTransEpisode
 */


$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'episodeGrid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    //5543'afterAjaxUpdate' => 'reinstallDatePicker',
    'selectableRows' => 2,

    'columns' => array(
        array(
            'class' => 'CCheckBoxColumn',
            'id' => 'pkID',
        ),

        'episodeID',
        'movieID',
        'episodeNum',
        'seasonNum',

//        'movieName' => array(
//            'name' => "movieName",
//            'type' => "raw",
//            'value' => function ($data, $row) {
//                return CHtml::link(CHtml::encode($data->movieName),
//                    yApp()->createUrl("translate/episode/index", array("movieID" => $data->movieID)),
//                    array('title' => 'View movie episodes')
//                );
//            }
//            //'CHtml::link(CHtml::encode($data->email), "mailto:".CHtml::encode($data->email))',
//        ),

//        array(
//            'class' => 'CButtonColumn',
//        ),
    ),
));