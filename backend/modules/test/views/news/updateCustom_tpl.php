<?php
use Ekv\B\widgets\TopButtons;


$this->topButtons = $this->widget(TopButtons::getClassNameFQ(), array(
    //'form' => $form,
    //'langSwitcher' => !$model->isNewRecord,
    //'deleteAction' => $this->createUrl('/store/admin/delivery/delete', array('id' => $model->id))
));

?>

<div class="form wide padding-all">
    <?php echo CHtml::beginForm(); ?>
    <?php echo CHtml::errorSummary($model); ?>

    <div class="row">
        <?php echo CHtml::activeLabel($model, 'name'); ?>
        <?php echo CHtml::activeTextField($model, 'name'); ?>
    </div>

    <div>
        <?php echo CHtml::activeLabel($model, 'enabled'); ?>
        <?php echo CHtml::activeCheckBox($model, 'enabled'); ?>
    </div>

    <div>
        <?php echo CHtml::activeLabel($model, 'categoriesRelated'); ?>

        <?php
        /*
        $res = BTestNews::model()->findAllByAttributes(array('newsID' => 569));
        $data = CHtml::listData($res, 'categoryID', 'categoryID');
        */

        $res = BTestNewsCategory::model()->findAll();
        $data = CHtml::listData($res, 'idCat', 'catName');

        echo CHtml::activeCheckBoxList($model,
            'categoryIdsRelated',
            //$model->categoriesRelated,
            $data,
            array(
                'separator' => ''
            )
        ); ?>
    </div>

    <div class="row">
        <?php echo CHtml::submitButton("submit", array("style" => 'display:block;')) ?>
    </div>

    <?php echo CHtml::endForm(); ?>
</div>



