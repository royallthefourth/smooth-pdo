<?php

namespace RoyallTheFourth\SmoothPdo;

use PDO;

final class Statement extends \PDOStatement
{
    private $stmt;

    public function __construct(\PDOStatement $statement)
    {
        $this->stmt = $statement;
        $this->queryString = $statement->queryString;
    }

    private function except()
    {
        throw new \Exception($this->stmt->errorCode() . implode('. ', $this->stmt->errorInfo()));
    }

    /**
     * @param mixed $column
     * @param mixed $param
     * @param null $type
     * @param null $maxlen
     * @param null $driverdata
     * @return Statement
     * @throws \Exception
     */
    public function bindColumn($column, &$param, $type = null, $maxlen = null, $driverdata = null): Statement
    {
        if (!$this->stmt->bindColumn($column, $param, $type, $maxlen, $driverdata)) {
            $this->except();
        }

        return $this;
    }

    /**
     * @param mixed $parameter
     * @param mixed $variable
     * @param int $data_type
     * @param null $length
     * @param null $driver_options
     * @return Statement
     * @throws \Exception
     */
    public function bindParam(
        $parameter,
        &$variable,
        $data_type = PDO::PARAM_STR,
        $length = null,
        $driver_options = null
    ): Statement {
        if (!$this->stmt->bindParam(
            $parameter,
            $variable,
            $data_type,
            $length,
            $driver_options
        )
        ) {
            $this->except();
        }

        return $this;
    }

    public function bindValue($parameter, $value, $data_type = PDO::PARAM_STR): Statement
    {
        if (!$this->stmt->bindValue($parameter, $value, $data_type)) {
            $this->except();
        }

        return $this;
    }

    public function closeCursor(): Statement
    {
        if (!$this->stmt->closeCursor()) {
            $this->except();
        }

        return $this;
    }

    public function execute(array $input_parameters = null): Statement
    {
        if (!$this->stmt->execute($input_parameters)) {
            $this->except();
        }

        return $this;
    }

    public function getAttribute($attribute)
    {
        return $this->stmt->getAttribute($attribute);
    }

    public function columnCount(): int
    {
        return $this->stmt->columnCount();
    }

    public function debugDumpParams()
    {
        $this->stmt->debugDumpParams();
    }

    public function errorCode(): string
    {
        return $this->stmt->errorCode();
    }

    public function errorInfo(): array
    {
        return $this->stmt->errorInfo();
    }

    public function fetch($fetch_style = null, $cursor_orientation = PDO::FETCH_ORI_NEXT, $cursor_offset = 0)
    {
        return $this->stmt->fetch($fetch_style, $cursor_orientation, $cursor_offset);
    }

    public function fetchAll($fetch_style = null, $fetch_argument = null, array $ctor_args = array())
    {
        return $this->stmt->fetchAll($fetch_style, $fetch_argument, $ctor_args);
    }

    public function fetchColumn($column_number = 0)
    {
        return $this->stmt->fetchColumn($column_number);
    }

    public function fetchObject($class_name = "stdClass", array $ctor_args = array())
    {
        return $this->stmt->fetchObject($class_name, $ctor_args);
    }

    public function nextRowset()
    {
        return $this->stmt->nextRowset();
    }

    public function setAttribute($attribute, $value): Statement
    {
        if (!$this->stmt->setAttribute($attribute, $value)) {
            $this->except();
        }

        return $this;
    }

    public function setFetchMode($mode): Statement
    {
        if (!$this->stmt->setFetchMode($mode)) {
            $this->except();
        }

        return $this;
    }

    public function rowCount()
    {
        return $this->stmt->rowCount();
    }

    public function getColumnMeta($column)
    {
        $this->stmt->getColumnMeta($column);
    }
}