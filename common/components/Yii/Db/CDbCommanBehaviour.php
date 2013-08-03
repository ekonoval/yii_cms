<?php
namespace Ekv\Yii\Db;

class CDbCommanBehaviour extends \CBehavior
{
    function debugSql($values = array())
    {
        return $this->getOwner()->pdoStatement->getSql();
    }
}
