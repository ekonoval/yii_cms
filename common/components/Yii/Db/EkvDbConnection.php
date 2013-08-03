<?php
namespace Ekv\Yii\Db;

class EkvDbConnection extends \CDbConnection
{
    /**
     * @param null $query
     * @return EkvDbCommand
     */
    public function createCommand($query = null)
    {
        $this->setActive(true);
        return new EkvDbCommand($this, $query);
    }

}

class EkvDbCommand extends \CDbCommand
{
    function debugSql($values = array())
    {
        return $this->pdoStatement->getSql($values);
    }
}
