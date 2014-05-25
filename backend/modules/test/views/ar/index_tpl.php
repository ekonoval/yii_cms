<?php
use Ekv\B\extensions\sgridview\SGridView;
use Ekv\B\modules\test\controllers\ArController;
use Ekv\B\widgets\TopButtons;

/**
 * @var $model BTestOrderBase
 * @var $this ArController
 */

$this->addTopButtonsCreate();


$grid_widget = SGridView::getClassNameFQ();


$this->widget($grid_widget, array(
    'id' => 'fieldsOrders',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'selectableRows' => 2,
    //'ajaxUrl' => yApp()->request->url,
    //'ajaxUrl' => "/translate/movie/index/",

    'columns' => array(
        array(
            'class' => 'CCheckBoxColumn',
            'id' => 'pkID',
        ),
        'idOrder',

        array(
            'name' => "uid",
            'type' => "raw",
            'value' => function ($data, $row) {
                return CHtml::link(
                    CHtml::encode($data->uid),
                    yApp()->createUrl("/test/ar/update/", array("idOrder" => $data->idOrder)),
                    array('title' => 'Edit')
                );
            }
        ),

        array(
            'name' => 'baseTxtField'
        ),

        array(
            'name' => $model->getExtRelateFieldName('idOrderExtra')
        ),

        array(
            'name' => $model->getExtRelateFieldName('extraTxtField')
        ),

        array(
            'class' => 'CButtonColumn',
        ),
    ),
));