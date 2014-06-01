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
        echo $form;
    ?>
</div>


<div>
    <h2>zzzz</h2> <br/>
    <?php
        //echo CHtml::activeCheckBoxList($model, 'categoriesRelated', array(22 => 'xxx'));
        //echo CHtml::activeCheckBoxList($model, 'categoriesRelated', $model->categoriesRelated);
    ?>

    <br/><br/>
    <?php
        //echo CHtml::activeTextField($model, 'headerPhoto');
    ?>

<!--    <h1>not active</h1>-->

<?php
//echo CHtml::checkBoxList(
//        'fakeName',
//        array(44),
//        array(33 => '33x', 44 => '44z'),
//        array(
//            'checkAll' => "choos"
//        )
//    ); ?>
</div>
 