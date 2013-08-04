<?php
namespace Ekv\Yii\Db;
use PDO;

/*
 * A single file is used to reduce number of autoloads for trivial functionality
 */

/**
 * Used to override CDbCommand and provide debugSql method
 */
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
        /*
         * Override PDO statement class
         */
        $this->setAttribute(PDO::ATTR_STATEMENT_CLASS, array('\Ekv\Yii\Db\EkvPdoStatement', array($this))); // !!!!
    }
}

class EkvPdoStatement extends \PDOStatement
{
    const NO_MAX_LENGTH = -1;

    protected $connection;
    /**
     * Bound params are collected here
     * @var array
     */
    protected $bound_params = array();

    protected function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function bindParam($paramno, &$param, $type = PDO::PARAM_STR, $maxlen = null, $driverdata = null)
    {
        $this->bound_params[$paramno] = array(
            'value' => &$param,
            'type' => $type,
            'maxlen' => (is_null($maxlen)) ? self::NO_MAX_LENGTH : $maxlen,
            // ignore driver data
        );

        $result = parent::bindParam($paramno, $param, $type, $maxlen, $driverdata);
    }

    public function bindValue($parameter, $value, $data_type = PDO::PARAM_STR)
    {
        $this->bound_params[$parameter] = array(
            'value' => $value,
            'type' => $data_type,
            'maxlen' => self::NO_MAX_LENGTH
        );
        parent::bindValue($parameter, $value, $data_type);
    }

    /**
     * Debugging method which returns plain SQL with placeholders substituted
     * @param array $values
     * @return mixed|string
     */
    public function getSQL($values = array())
    {
        $sql = $this->queryString;

        /**
         * param values
         */
        if (sizeof($values) > 0) {
            foreach ($values as $key => $value) {
                $sql = str_replace($key, $this->connection->quote($value), $sql);
            }
        }

        /**
         * or already bounded values
         */
        if (sizeof($this->bound_params)) {
            foreach ($this->bound_params as $key => $param) {
                $value = $param['value'];
                if (!is_null($param['type'])) {
                    $value = self::cast($value, $param['type']);
                }
                if ($param['maxlen'] && $param['maxlen'] != self::NO_MAX_LENGTH) {
                    $value = self::truncate($value, $param['maxlen']);
                }
                if (!is_null($value)) {
                    $sql = str_replace($key, $this->connection->quote($value), $sql);
                } else {
                    $sql = str_replace($key, 'NULL', $sql);
                }
            }
        }
        return $sql;
    }

    static protected function cast($value, $type)
    {
        switch ($type) {
            case PDO::PARAM_BOOL:
                return (bool)$value;
                break;
            case PDO::PARAM_NULL:
                return null;
                break;
            case PDO::PARAM_INT:
                return (int)$value;
            case PDO::PARAM_STR:
            default:
                return $value;
        }
    }

    static protected function truncate($value, $length)
    {
        return substr($value, 0, $length);
    }
}

