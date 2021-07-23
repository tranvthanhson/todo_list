<?php

class QueryBuilder
{
    protected $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function all(string $tableName)
    {
        try {
            $statement = $this->pdo->prepare("select * from {$tableName}");

            $statement->execute();

            return $statement->fetchAll(PDO::FETCH_CLASS);
        } catch (Exception $e) {
            var_dump($e->getMessage());
        }
    }

    public function getById($table, $id)
    {
        try {
            $statement = $this->pdo->prepare("select * from {$table} where id = {$id}");

            $statement->execute();

            return $statement->fetchAll(PDO::FETCH_CLASS);
        } catch (Exception $e) {
            var_dump($e->getMessage());
        }
    }

    public function insert($table, $parameters)
    {
        try {
            $sql = sprintf(
                'insert into %s (%s) values (%s)',
                $table,
                implode(', ', array_keys($parameters)),
                ':' . implode(', :', array_keys($parameters))
            );
            $statement = $this->pdo->prepare($sql);
            $statement->execute($parameters);
        } catch (Exception $e) {
            var_dump($e->getMessage());
        }
    }

    public function delete($table, $id)
    {
        try {
            $sql = sprintf(
                "delete from %s where id = %s",
                $table,
                $id
            );
            $statement = $this->pdo->prepare($sql);
            $statement->execute();
        } catch (Exception $e) {
            var_dump($e->getMessage());
        }
    }

    public function update($table, $parameters, $condition)
    {
        try {
            $result = [];
            $keys = array_keys($parameters);
            $values = array_values($parameters);
            for ($i = 0; $i < count($parameters); $i++) {
                if (gettype($values[$i]) === "string")
                    $temp = $keys[$i] . "='" . $values[$i] . "'";
                else
                    $temp = $keys[$i] . "=" . $values[$i];
                array_push($result, $temp);
            }
            $sql = sprintf(
                'update %s set %s where id=%s',
                $table,
                implode(',', $result),
    
                $condition
            );
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
        } catch (\PDOException $e) {
            die($e->getMessage());
        }
    }
}
