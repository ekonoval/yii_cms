<?php
namespace Ekv\B\modules\test\models;

use CActiveRecord;
use MFieldsCustom;

class BTestFieldsCustom extends \MFieldsCustom
{
    public $markupCalc;

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

        $base_rules[] = array('markupCalc', 'safe');

        return $base_rules;
    }

    public function attributeLabels()
    {
        $base_labels = parent::attributeLabels();

        $base_labels[] = array('markupCalc' => "Risking");

        return $base_labels;
    }

    protected function afterValidate()
    {
        if(!$this->hasErrors()){
            $this->addError("markupCalc", "Super custom error");
        }
    }

}
 