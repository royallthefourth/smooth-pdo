<?php

namespace RoyallTheFourth\SmoothPdo;

class DataObject
{
    private $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * @return DataObject
     * @throws \Exception
     */
    public function beginTransaction(): DataObject
    {
        if (!$this->pdo->beginTransaction()) {
            throw new \Exception($this->pdo->errorCode() . implode('. ', $this->pdo->errorInfo()));
        }

        return $this;
    }

    /**
     * @return DataObject
     * @throws \Exception
     */
    public function commit(): DataObject
    {
        if (!$this->pdo->commit()) {
            throw new \Exception($this->pdo->errorCode() . implode('. ', $this->pdo->errorInfo()));
        }

        return $this;
    }

    /**
     * @return DataObject
     * @throws \Exception
     */
    public function rollBack(): DataObject
    {
        if (!$this->pdo->rollBack()) {
            throw new \Exception($this->pdo->errorCode() . implode('. ', $this->pdo->errorInfo()));
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
        if (!$this->pdo->setAttribute($attribute, $value)) {
            throw new \Exception($this->pdo->errorCode() . implode('. ', $this->pdo->errorInfo()));
        }

        return $this;
    }

    /**
     * @param string $statement
     * @param array|null $driver_options
     * @return Statement
     * @throws \Exception
     */
    public function prepare($statement, $driver_options = null): Statement
    {
        if (null === $driver_options) {
            $driver_options = [];
        }

        $stmt = $this->pdo->prepare($statement, $driver_options);

        if ($stmt === false) {
            throw new \Exception($this->pdo->errorCode() . implode('. ', $this->pdo->errorInfo()));
        }

        return new Statement($stmt);
    }

    public function query($statement): Statement
    {
        return new Statement($this->pdo->query($statement));
    }
}
