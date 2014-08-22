<?php
/**
 * @var BStatPage $model
 * @var $this BackendControllerBase
 */
use Ekv\B\components\Controllers\BackendControllerBase;
use Ekv\B\extensions\sgridview\SGridView;

$controller = $this;

$this->addTopButtonsCreate();

//$filterDateJsID = "idSpDate";

$this->widget(SGridView::getClassNameFQ(), array(
    'id' => 'fieldsStatPage',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'selectableRows' => 2,
    //'afterAjaxUpdate' => 'reinstallDatePicker',
    //'ajaxUrl' => $this->createUrlBackend('index'),

    'columns' => array(
        array(
            'class' => 'CCheckBoxColumn',
            'id' => 'pkID',
        ),
        'idPage',

        array(
            'name' => "pageTitle",
            'type' => "raw",
            'value' => function ($data, $row) use ($controller) {
                return CHtml::link(
                    CHtml::encode($data->pageTitle),
                    $controller->createUrlBackend('update', array('pageID' => $data->idPage)),
                    array('title' => 'Edit')
                );
            }
        ),

        'url',
        'pageEnabled'


    ),
));

//#------------------- reset after ajax !! -------------------#//
//yClientScript()->registerScript(
//    're-install-date-picker',
//    "function reinstallDatePicker(id, data) {
//        //console.log('reinstall');
//        $('#{$filterDateJsID}').datepicker();
//    }
//    "
//);