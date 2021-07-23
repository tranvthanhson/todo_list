<?php

namespace App\Models;

use Core\App;

class BaseModel
{
    public static $driver;
    public static $table;

    public function __construct()
    {
        static::$driver = App::get('database');
    }

    public static function all()
    {
        new static();

        return static::$driver->all(static::$table);
    }

    public static function insert($data = [])
    {
        new static();

        return static::$driver->insert(
            static::$table,
            array_merge($data, [
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]));
    }

    public static function delete($id)
    {
        new static();

        return static::$driver->delete(
            static::$table, $id
        );
    }

    public static function getById($id)
    {
        new static();

        return static::$driver->getById(
            static::$table, $id
        );
    }

    public static function updateById($data, $id)
    {
        new static();

        return static::$driver->update(
            static::$table,
            array_merge($data, [
                'updated_at' => date('Y-m-d H:i:s')
            ]),
            $id
        );
    }

    public static function deleteAll()
    {
        new static();

        return static::$driver->deleteAll(static::$table);
    }
}
