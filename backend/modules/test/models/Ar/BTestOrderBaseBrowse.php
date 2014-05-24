<?php

use Ekv\components\Yii\Db\ActiveRecordBase;
use Ekv\models\MOrderBase;

class BTestOrderBaseBrowse extends MOrderBase
{
    public $extraTxtFieldSearch;

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

//    protected function getOrderExtraModelFq()
//    {
//        return BTestOrderExtraBrowse::getClassNameFQ();
//    }

    public function rules()
    {

        $rules = $this->mergeRules(
            array(array("extraTxtFieldSearch", 'safe', 'on' => 'search')),
            parent::rules()
        );

        return $rules;
    }

    public function search()
    {
        $criteria = new CDbCriteria;
        $criteria->with = array(self::REL_ORDER_EXTRAS);

        $extraTxtFieldFullName = $this->getExtRelateFieldName("extraTxtField");

        $criteria->compare('idOrder', $this->idOrder);
        $criteria->compare('uid', $this->uid);
        $criteria->compare('baseTxtField', $this->baseTxtField, true);


        $criteria->compare($extraTxtFieldFullName, $this->extraTxtFieldSearch, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
//            'sort' => array(
//                'attributes' => array(
//                    'extraTxtFieldSearch' => array(
//                        'asc' => "{$extraTxtFieldFullName} ASC",
//                        'desc' => "{$extraTxtFieldFullName} DESC",
//                    ),
//                    '*',
//                ),
//
//            )
        ));
    }


}
 