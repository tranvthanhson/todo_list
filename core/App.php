<?php

namespace Core;

use Exception;

class App
{
    protected static $registry = [];

    /**
     * Bind
     *
     * @param string $key   key
     * @param string $value value
     *
     * @return void
     */
    public static function bind($key, $value)
    {
        static::$registry[$key] = $value;
    }

    /**
     * Get
     *
     * @param string $key key
     *
     * @return mixed
     */
    public static function get($key)
    {
        if (!array_key_exists($key, static::$registry)) {
            throw new Exception("No {$key} is bound in the container.");
        }
        return static::$registry[$key];
    }
}
