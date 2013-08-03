<?php
namespace Ekv\Yii\Db;

class EkvDbCommand extends \CDbCommand
{
    function debugSql($values = array())
    {
        return $this->pdoStatement->getSql($values);
    }
}
