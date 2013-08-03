<?php
namespace Ekv\Yii\Db\Pdo;
use PDO;

/**
 * Override PDO statement class to provide ability to have READY SQL QUERY with all placeholders substituted with
 * proper parameters
 * <code>
 * SELECT * FROM ekv_user WHERE id = :id
 * --->>
 * SELECT * FROM ekv_user WHERE id = 'x\'x'
 * </code>
 */
class EkvPdo extends PDO
{
    public function __construct($dsn, $username = null, $password = null, $driver_options = array())
    {
        parent::__construct($dsn, $username, $password, $driver_options);
        $this->setAttribute(PDO::ATTR_STATEMENT_CLASS, array('\Ekv\Yii\Db\Pdo\EkvPdoStatement', array($this)));
    }

}
