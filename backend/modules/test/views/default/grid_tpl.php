<style type="text/css">
    .grid-view .filters input, .grid-view .filters select {
        margin: 0;
        padding: 0;
    }
</style>
<h4>grid with AR</h4>
<?php
/**
 * @var $model BTransEpisode
 */

$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'testEpGrid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    //5543'afterAjaxUpdate' => 'reinstallDatePicker',
    'selectableRows' => 2,
    'ajaxUpdate'    => true,

    'columns' => array(
        array(
            'class' => 'CCheckBoxColumn',
            'id' => 'pkID',
        ),

        'episodeID',
        'movieID',
        'episodeNum',
        //'seasonNum',
        array(
            'name' => 'seasonNum',
            'filter' => $model->getSeasonNumFilter($model),
            //'filter' => function($model){return array(7 => 's7', 3 => 's3');},
            //'filter' => array(7 => 's7', 3 => 's3'),
            'value' => function($data){
                return $data["seasonNum"];
            }
        ),

//        array(
//            'type' => "raw",
//            'value' => function ($data, $row) {
//                return CHtml::link("[words]",
//                    yApp()->createUrl("translate/words/index", array("episodeID" => $data->episodeID)),
//                    array('title' => 'View episode words')
//                );
//            }
//            //'CHtml::link(CHtml::encode($data->email), "mailto:".CHtml::encode($data->email))',
//        ),

    ),
));