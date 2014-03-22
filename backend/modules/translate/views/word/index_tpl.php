<style type="text/css">
    .grid-view .filters input, .grid-view .filters select {
        margin: 0;
        padding: 0;
    }
</style>
<h4>word grid with AR</h4>

<?php

/**
 * @var $model BTransWord
 */

use Ekv\B\extensions\sgridview\SGridView;

$grid_name = 'zii.widgets.grid.CGridView';
$grid_name = SGridView::getFullName();
$this->widget($grid_name, array(
    'id' => 'wordGrid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'selectableRows' => 2,
    //'ajaxUpdate'    => true,
    //'ajaxType' => 'POST',
    //'ajaxUrl' => '/translate/episode/index/movieID/5/',
    'ajaxUrl' => yApp()->request->url, // !!! Seems to be fixing the problem with pagination and filter reset

    //'template'=>"{pager}\n{items}\n{pager}",

    'columns' => array(
        array(
            'class' => 'CCheckBoxColumn',
            'id' => 'pkID',
        ),

        'wordID',
        'episodeID',
        'wordEN',
        'wordRU',

        array(
            'class' => 'CButtonColumn',
            'template' => '{update}{delete}'
        ),
    ),
));