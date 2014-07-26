<?php
/**
 * @var $this WUploadFile
 * @var $webUrl
 * @var $currentFilename
 */
use Ekv\B\widgets\Input\Upload\File\WUploadFile;
?>
<div class="cell-right">
    <div>
    <?if(!empty($currentFilename)){
        $img = CHtml::image($webUrl, $currentFilename);
        echo CHtml::link($img, $webUrl, array('target' => '_blank'));
    } ?>
    </div>

    <div>
        <?php
        echo CHtml::activeFileField($this->model, $this->attribute, $this->htmlOptions);
        ?>
    </div>


<!--    <a href="#">[filename]</a>-->
</div>
<div class="spacer"></div>