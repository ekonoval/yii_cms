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
