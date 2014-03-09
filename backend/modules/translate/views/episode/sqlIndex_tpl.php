<style type="text/css">
    .grid-view .filters input, .grid-view .filters select {
        margin: 0;
        padding: 0;
    }
</style>

<h4>grid with SQL</h4>
<?php
/**
 * @var $model BTransEpisodeSql
 */


$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'episodeGridSql',
    //'dataProvider' => $provider,
    'filter'=>$model,
    'dataProvider'=>$model->getSqlDataProvider(),
    //'filter' => $model,
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

        array(
            'name' => 'seasonNum',
            //'filter' => $model->getSeasonNumFilter($model),
            //'filter' => function($model){return array(7 => 's7', 3 => 's3');},
            //'filter' => array(7 => 's7', 3 => 's3'),
            'value' => function($data){
                return $data["seasonNum"];
            }
        ),

        array(
            'name' => "movieName", // dbField
            'value' => function($data){
                return $data["movieName"];
            }
        ),

        array(
            'type' => "raw",
            'value' => function ($data, $row) {
                return CHtml::link("[words]",
                    yApp()->createUrl("translate/words/index", array("episodeID" => $data["episodeID"])),
                    array('title' => 'View episode words')
                );
            }
        ),
    ),
));