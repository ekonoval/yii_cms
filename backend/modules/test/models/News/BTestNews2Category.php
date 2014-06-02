<?php

use Ekv\components\Yii\Db\ActiveRecordBase;
use Ekv\models\MNews2CategoryConn;

class BTestNews2Category extends MNews2CategoryConn
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

}
 