<?php
/** @var $this WFileUpload  */
use Ekv\B\widgets\Input\Upload\File\WFileUpload;
?>
<div class="cell-right">
    <div style="display: inline-block;">
        <?php
        echo CHtml::activeFileField($this->model, $this->attribute, $this->htmlOptions);
        ?>
    </div>

    <div style="display: inline-block; margin-left: 20px;">
    <?if(!empty($currentFilename)){
        echo CHtml::link($currentFilename, $currentUrl, array('target' => '_blank'));
    } ?>
    </div>
<!--    <a href="#">[filename]</a>-->
</div>
<div class="spacer"></div>