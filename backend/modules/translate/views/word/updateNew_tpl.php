<?php
use Ekv\B\widgets\TopButtons;

$this->topButtons = $this->widget(TopButtons::getFullName(), array(
    'form' => $form,
    //'langSwitcher' => !$model->isNewRecord,
    //'deleteAction' => $this->createUrl('/store/admin/delivery/delete', array('id' => $model->id))
));
?>

<div class="form wide padding-all">
    <?php
    //echo $form;
    //$form->elements["tab1"]->elements["wordEN"]->render();
    echo $form->renderBegin();

    //        pa($form["tab1"]["wordEN"]);

    echo $form["tab1"]["wordEN"]->render();

    echo $form->renderEnd();
    ?>
</div>