<?php
use Ekv\B\classes\Misc\DateHelper;
use Ekv\B\extensions\sgridview\SGridView;
use Ekv\B\modules\test\controllers\NewsController;
use Ekv\B\widgets\Input\Datepicker\WDatePicker;


/**
 * @var $model BTestNews
 * @var $this NewsController
 */
$controller = $this;
$this->addTopButtonsCreate();

$grid_widget = SGridView::getClassNameFQ();
$filterDateJsID = "idNewsDate";


$this->widget($grid_widget, array(
    'id' => 'fieldsNews',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'selectableRows' => 2,
    'afterAjaxUpdate' => 'reinstallDatePicker',
    'ajaxUrl' => $this->createUrlBackend('index'),

    'columns' => array(
        array(
            'class' => 'CCheckBoxColumn',
            'id' => 'pkID',
        ),
        'idNews',

        array(
            'name' => "name",
            'type' => "raw",
            'value' => function ($data, $row) use ($controller) {
                return CHtml::link(
                    CHtml::encode($data->name),
                    $controller->createUrlBackend('update', array('newsID' => $data->idNews)),
                    array('title' => 'Edit')
                );
            }
        ),

        array(
            'name' => 'date',
            'type' => 'raw',
            'value' => function ($data) {
                return DateHelper::getJqDatePickerFormatedDate($data->date, false);
            },

            'filter' => $this->widget(
                WDatePicker::getClassNameFQ(),
                array(
                    'id' => $filterDateJsID, // !!!! important for reinstall
                    'model' => $model,
                    'attribute' => 'date',
                ),
                true
            ),
        )
    ),
));

//#------------------- reset after ajax !! -------------------#//
yClientScript()->registerScript(
    're-install-date-picker',
    "function reinstallDatePicker(id, data) {
        //console.log('reinstall');
        $('#{$filterDateJsID}').datepicker();
    }
    "
);