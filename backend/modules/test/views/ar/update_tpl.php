<?php
use Ekv\B\widgets\TopButtons;

$this->topButtons = $this->widget(TopButtons::getClassNameFQ(), array(
    'form' => $form,
    //'langSwitcher' => !$model->isNewRecord,
    //'deleteAction' => $this->createUrl('/store/admin/delivery/delete', array('id' => $model->id))
));
?>

<div class="form wide padding-all">
    <?php
    //echo $form["tab1"];
    echo $form;

    ?>
</div>
 