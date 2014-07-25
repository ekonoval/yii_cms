<?php

use Ekv\behaviors\BhUploadFile;
use Ekv\classes\Misc\PathHelper;

class BTestFieldsCustomWithBh extends \MFieldsCustom
{
    public $markupCalc;
    public $hasMarkup;

    public $txtBig;

    public $txtShort;

    public $dtFull;

    public $customFlag = 'untouched';

    public function behaviors()
    {
        $parentBhs = parent::behaviors();

        $parentBhs["uploadFile"] = array(
            'class' => BhUploadFile::getClassNameFQ(),
            'baseSavePathAbsolute' => PathHelper::getFrontFiles(),
            'fileAttrName' => 'txtFile',
            'fileTypes' => 'txt'
        );

        unset($parentBhs["uploadFile"]);

        return $parentBhs;
    }


    /**
     * @param string $className
     * @return BTestFieldsCustomWithBh
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function rules()
    {
        $base_rules = parent::rules();

        $base_rules[] = array('markupCalc, hasMarkup, txtBig, txtShort, dtFull', 'safe');

//        $base_rules[] = array('txtFile', 'file',
//            'types'=>'doc,docx,xls,xlsx,odt,pdf, txt',
//            'allowEmpty'=> true,
//            //'minSize' => 1024*50,
//            'skipOnError' => true,
//            'on'=>'insert,update'
//        );

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
        //pa("Before save model");exit;

        $this->customFlag = 'modelBeforeParent';

        if (!parent::beforeSave()) {
            return false;
        }

        $this->customFlag = 'modelAfterParent';

//        if(in_array($this->scenario, array('insert', 'update'))){
//            $txtFileObj = CUploadedFile::getInstance($this,'txtFile');
//            $isFileUploading = !empty($txtFileObj);
//
//            if($isFileUploading){
//                $this->txtFile = $txtFileObj->getName();
//                $txtFileObj->saveAs($this->getFilesSavePath($this->txtFile));
//            }else{
//                unset($this->txtFile);
//            }
//        }


        return true;
    }

//    private function getFilesSavePath($fileName)
//    {
//        return UploadHelper::getFrontFiles($fileName);
//    }

    protected function afterValidate()
    {
        parent::afterValidate();
        //$this->addError("markupCalc", "Can't have both");
//        if(!$this->hasErrors()){
//            $this->addError("markupCalc", "Super custom error");
//        }

    }

}
 