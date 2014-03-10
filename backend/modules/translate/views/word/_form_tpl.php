<?php
/**
 * @var $model BTransWord
 */
?>

<div class="form">

    <?php
    /**
     * @var $form CActiveForm
     */
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'word-form',
        'enableAjaxValidation' => false,
    ));

    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div>
        WordID: <?=$model->wordID; ?>
    </div>

    <div class="row">
        <?php
            $fieldKey = "wordEN";
            echo $form->labelEx($model, $fieldKey);
            echo $form->textField($model, $fieldKey, array('size' => 45, 'maxlength' => 45));
            echo $form->error($model, $fieldKey);
        ?>
    </div>

    <div class="row">
        <?php
            $fieldKey = "wordRU";
            echo $form->labelEx($model, $fieldKey);
            echo $form->textField($model, $fieldKey, array('size' => 45, 'maxlength' => 45));
            echo $form->error($model, $fieldKey);
        ?>
    </div>

    <div class="row">
        <?php
            $fieldKey = "isHard";
            echo $form->labelEx($model, $fieldKey);
            echo $form->checkBox($model, $fieldKey);
            echo $form->error($model, $fieldKey);
        ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->