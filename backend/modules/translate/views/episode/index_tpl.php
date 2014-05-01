<style type="text/css">
    .grid-view .filters input, .grid-view .filters select {
        margin: 0;
        padding: 0;
    }
</style>
<h4>grid1 with AR</h4>
<?php
/**
 * @var $model BTransEpisode
 * @var $this EpisodeController
 */


use Ekv\B\extensions\sgridview\SGridView;
use Ekv\B\modules\translate\controllers\EpisodeController;

$controller = $this; // fix 5.3 in anonymous functions

$grid_widget = 'zii.widgets.grid.CGridView';
$grid_widget = SGridView::getFullName();
$this->widget($grid_widget, array(
    'id' => 'episodeGrid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    //5543'afterAjaxUpdate' => 'reinstallDatePicker',
    'selectableRows' => 2,
    //'ajaxUpdate'    => true,
    //'ajaxType' => 'POST',
    //'ajaxUrl' => '/translate/episode/index/movieID/5/',
    'ajaxUrl' => yApp()->request->url, // !!! Seems to be fixing the problem with pagination and filter reset

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
        array(
            'name' => "movieName", // dbField
            'value' => function($data){
                return $data->lMovie->movieName;
            }
        ),

        array(
            'type' => "raw",
            'value' => function ($data, $row)use($controller) {
                return CHtml::link("[words]",
                    $controller->getEpisodeWordsIndexUrl($data->episodeID),
                    //yApp()->createUrl("translate/word/index", array("episodeID" => $data->episodeID)),
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