<?php

namespace RoyallTheFourth\SmoothPdo;

use PDO;

final class DataObject extends \PDO
{
    public function except()
    {
        throw new \Exception($this->errorCode() . implode('. ', $this->errorInfo()));
    }

    /**
     * @return DataObject
     * @throws \Exception
     */
    public function beginTransaction(): DataObject
    {
        if (!parent::beginTransaction()) {
            $this->except();
        }

        return $this;
    }

    /**
     * @return DataObject
     * @throws \Exception
     */
    public function commit(): DataObject
    {
        if (!parent::commit()) {
            $this->except();
        }

        return $this;
    }

    /**
     * @return DataObject
     * @throws \Exception
     */
    public function rollBack(): DataObject
    {
        if (!parent::rollBack()) {
            $this->except();
        }

        return $this;
    }

    /**
     * @param int $attribute
     * @param mixed $value
     * @return DataObject
     * @throws \Exception
     */
    public function setAttribute($attribute, $value): DataObject
    {
        if (!parent::setAttribute($attribute, $value)) {
            $this->except();
        }

        return $this;
    }

    public function prepare($statement, array $driver_options = array()): Statement
    {
        return new Statement(parent::prepare($statement, $driver_options));
    }

    public function query($statement, $mode = PDO::ATTR_DEFAULT_FETCH_MODE, $arg3 = null, array $ctorargs = array())
    {
        return new Statement(parent::query($statement, $mode, $arg3, $ctorargs));
    }
}
