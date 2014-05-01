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
 * @var $this TranslateController
 */

use Ekv\B\components\Controllers\BackendControllerBase;
use Ekv\B\extensions\sgridview\SGridView;
use Ekv\B\modules\translate\controllers\TranslateController;
use Ekv\B\widgets\TopButtons;

$this->topButtons = $this->widget(TopButtons::getFullName(), array(
    'template' => array('create'),
    'elements' => array(
        'create' => array(
            'link' => $this->getEpisodeWordsCreateUrl($episodeID),
            'title' => Yii::t('StoreModule.admin', 'Создать'),
            'options' => array(
                'icons' => array('primary' => 'ui-icon-plus')
            )
        ),
    ),
));

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
            'template' => '{update}{delete}{updateExt}',
            'buttons' => array(
                'updateExt' => array(
                    'label' => 'New update',
                    'imageUrl' => SGridView::getExtAssetsUrl('update.png'),
                    'url' => function($row)use($episodeID){
                        return $this->createUrl('/translate/word/updateExt/', array(
                            'episodeID' => $episodeID,
                            'id' => $row->wordID
                        ));
                    }
                )
            )
        ),
    ),
));