<?php
/**
 * @var $model MTransMovie
 */
?>

<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'movie-form',
        'enableAjaxValidation' => false,
    )); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>


    <div class="row">
        <?php echo $form->labelEx($model, 'movieID'); ?>
        <?php echo $form->textField($model, 'movieID'); ?>
        <?php echo $form->error($model, 'movieID'); ?>
    </div>


    <div>
        ID: <?=$model->movieID; ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'movieName'); ?>
        <?php echo $form->textField($model, 'movieName', array('size' => 45, 'maxlength' => 45)); ?>
        <?php echo $form->error($model, 'movieName'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'createDate'); ?>
        <?php echo $form->textField($model, 'createDate'); ?>
        <?php echo $form->error($model, 'createDate'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->