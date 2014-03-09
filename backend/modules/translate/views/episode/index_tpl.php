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
        array(
            'name' => "movieName", // dbField
            'value' => function($data){
//                /**
//                 * @var BTransEpisode $data
//                 */
//                pa($data->getRelated('lMovie')->attributes);exit;
//                pa($data);
//                //pa($data->relations());exit;
//                exit;
                return $data->lMovie->movieName;
            }
        ),

        array(
            'type' => "raw",
            'value' => function ($data, $row) {
                return CHtml::link("[words]",
                    yApp()->createUrl("translate/words/index", array("episodeID" => $data->episodeID)),
                    array('title' => 'View episode words')
                );
            }
            //'CHtml::link(CHtml::encode($data->email), "mailto:".CHtml::encode($data->email))',
        ),

//        array(
//            'class' => 'CButtonColumn',
//        ),
    ),
));