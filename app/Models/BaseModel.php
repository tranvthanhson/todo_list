<?php

namespace App\Models;

use Core\App;

class BaseModel
{
    public static $driver;
    public static $table;

    /**
     * Construct
     *
     * @return void
     */
    public function __construct()
    {
        static::$driver = App::get('database');
    }


    /**
     * All
     *
     * @return mixed
     */
    public static function all()
    {
        new static();

        return static::$driver->all(static::$table);
    }


    /**
     * Insert
     *
     * @param array $data data
     *
     * @return mixed
     */
    public static function insert($data = [])
    {
        new static();

        return static::$driver->insert(
            static::$table,
            array_merge($data, [
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ])
        );
    }


    /**
     * Delete
     *
     * @param int $id id
     *
     * @return mixed
     */
    public static function delete($id)
    {
        new static();

        return static::$driver->delete(
            static::$table,
            $id
        );
    }

    /**
     * Get by Id
     *
     * @param int $id id
     *
     * @return mixed
     */
    public static function getById($id)
    {
        new static();

        return static::$driver->getById(
            static::$table,
            $id
        );
    }

    /**
     * Update by id
     *
     * @param array $data data
     * @param int   $id   id
     *
     * @return mixed
     */
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

    /**
     * Delete all
     *
     * @return mixed
     */
    public static function deleteAll()
    {
        new static();

        return static::$driver->deleteAll(static::$table);
    }
}
