<?php
namespace Ekv\B\widgets\Input\CKEditor;

use CHtml;
use Ekv\B\widgets\Input\BaseInputWidget;
use Yii, CClientScript;

class WCKEditor extends BaseInputWidget
{
    static function getClassNameFQ()
    {
        return getClassNameFullyQualified(__CLASS__);
    }

    public function run()
    {
        parent::run();

        list($name, $inputID) = $this->resolveNameID();

        /**
         * @var $cs CClientScript
         */
        $cs = Yii::app()->getClientScript();

        $assets = "/ckeditor";

        $cs->registerScriptFile($assets . '/ckeditor.js');
        $cs->registerScriptFile($assets . '/_ckfinder/ckfinder.js');
        $cs->registerCssFile($assets . "/contents.css");

        echo CHtml::openTag("div", array('class' => 'cell-right'));
        echo CHtml::activeTextArea($this->model, $this->attribute, array('rows' => 10, 'cols' => 70, 'style' => 'width: 100%;'));

        //$cs->registerScript("cke_{$jsID}", "CKEDITOR.replace('{$jsID}');");
        $script = "CKFinder.setupCKEditor(CKEDITOR.replace('{$inputID}'), '/ckeditor/_ckfinder/');";
        $cs->registerScript("cke_{$inputID}", $script);


        echo CHtml::closeTag("div");

        echo CHtml::openTag("div", array('class' => 'clear')) . CHtml::closeTag("div");
    }


}
 