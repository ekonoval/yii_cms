<?php
/**
 * @var $model BTestFieldsCustom
 */
?>

<script type="text/javascript">

</script>

<div style="float: left;">
    <?php
    //echo CHtml::checkBox("hasMarkup", $hasMarkup);
    //CHtml::activeCheckBox($this->model, "hasMarkup");

    echo CHtml::activeCheckBox($model, "hasMarkup");

    echo CHtml::activeLabel($model, "hasMarkup");

    echo CHtml::activeLabel($model, "markupPercent");
    echo CHtml::activeTextField($model, "markupPercent");

    echo CHtml::activeLabel($model, "markupNumeric");
    echo CHtml::activeTextField($model, "markupNumeric");

    ?>
</div>

 