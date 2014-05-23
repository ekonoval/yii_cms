<?php

use Ekv\models\MOrderBase;

class BTestOrderEditForm extends BTestOrderBase
{
    static function getModelByPk($idOrder)
    {
        return static::model()->with(self::REL_ORDER_EXTRAS)->findByPk($idOrder);
    }

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }


}
 