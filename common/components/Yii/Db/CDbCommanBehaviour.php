<?php
namespace Ekv\Yii\Db;

/**
 * NOT used. Don't know how to apply it automatically without overriding CDbConnection
 */
class CDbCommanBehaviour extends \CBehavior
{
    function debugSql($values = array())
    {
        return $this->getOwner()->pdoStatement->getSql();
    }
}
