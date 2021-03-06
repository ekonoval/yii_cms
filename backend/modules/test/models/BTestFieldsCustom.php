<?php

use Ekv\classes\Misc\PathHelper;

class BTestFieldsCustom extends \MFieldsCustom
{
    public $markupCalc;
    public $hasMarkup;

    public $txtBig;

    public $txtShort;

    public $dtFull;

    /**
     * @param string $className
     * @return BTestFieldsCustom
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function rules()
    {
        $base_rules = parent::rules();

        $base_rules[] = array('markupCalc, hasMarkup, txtBig, txtShort, dtFull', 'safe');
        $base_rules[] = array('txtFile', 'file',
            'types'=>'doc,docx,xls,xlsx,odt,pdf, txt',
            'allowEmpty'=> true,
            //'minSize' => 1024*50,
            'skipOnError' => true,
            'on'=>'insert,update'
        );

        return $base_rules;
    }

    public function attributeLabels()
    {
        $base_labels = parent::attributeLabels();

        $base_labels['markupCalc'] =  "Risking";
        $base_labels['hasMarkup'] =  "Наценка";

        return $base_labels;
    }

    protected function beforeSave()
    {
        if (!parent::beforeSave()) {
            return false;
        }



        if(in_array($this->scenario, array('insert', 'update'))){
            $txtFileObj = CUploadedFile::getInstance($this,'txtFile');
            $isFileUploading = !empty($txtFileObj);

            if($isFileUploading){
                $this->txtFile = $txtFileObj->getName();
                $txtFileObj->saveAs($this->getFilesSavePath($this->txtFile));
            }else{
                unset($this->txtFile);
            }

        }

        return true;
    }

    private function getFilesSavePath($fileName)
    {
        return PathHelper::getFrontFiles($fileName);
    }


    protected function afterValidate()
    {
        //$this->addError("markupCalc", "Can't have both");
//        if(!$this->hasErrors()){
//            $this->addError("markupCalc", "Super custom error");
//        }
    }

}
 