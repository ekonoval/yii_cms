<?php

use Ekv\components\Yii\Db\ActiveRecordBase;
use Ekv\models\MOrderExtra;


class BTestOrderExtra extends MOrderExtra
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className); // TODO: Change the autogenerated stub
    }

    static function getClassNameFQ()
    {
        return getClassNameFullyQualified(__CLASS__);
    }

}
 