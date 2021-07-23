<?php

namespace Core\Database;

use PDO;

class Connection
{
    /**
     * Make
     *
     * @param array $config config
     *
     * @return PDO
     */
    public static function make(array $config)
    {
        try {
            return new PDO(
                $config['connection'] . ':host=' . $config['host'] . ';dbname=' . $config['name'],
                $config['username'],
                $config['password'],
                $config['options']
            );
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
}
