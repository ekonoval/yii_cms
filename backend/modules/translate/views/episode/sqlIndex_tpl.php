<style type="text/css">
    .grid-view .filters input, .grid-view .filters select {
        margin: 0;
        padding: 0;
    }
</style>
<?php
/**
 * @var $model BTransEpisodeSql
 */


$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'episodeGrid',
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
            'filter' => $model->getSeasonNumFilter(),

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