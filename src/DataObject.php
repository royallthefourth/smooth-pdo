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

    /**
     * @param string $statement
     * @param array|null $driver_options
     * @return Statement
     */
    public function prepare($statement, $driver_options = null): Statement
    {
        if (null === $driver_options) {
            $driver_options = [];
        }
        return new Statement(parent::prepare($statement, $driver_options));
    }

    public function query($statement): Statement {
        return new Statement(parent::query($statement));
    }
}
