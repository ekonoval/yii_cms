<?php

class BTestFieldsCustom extends \MFieldsCustom
{
    public $markupCalc;
    public $hasMarkup;

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

        $base_rules[] = array('markupCalc, hasMarkup', 'safe');

        return $base_rules;
    }

    public function attributeLabels()
    {
        $base_labels = parent::attributeLabels();

        $base_labels['markupCalc'] =  "Risking";
        $base_labels['hasMarkup'] =  "Наценка";

        return $base_labels;
    }

    protected function afterValidate()
    {
//        $this->addError("markupCalc", "Can't have both");
//        if(!$this->hasErrors()){
//            $this->addError("markupCalc", "Super custom error");
//        }
    }

}
 