<?php

namespace Core;

class Request
{
    /**
     * Uri
     *
     * @return string
     */
    public static function uri()
    {
        return trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
    }

    /**
     * Method
     *
     * @return string
     */
    public static function method()
    {
        return $_SERVER['REQUEST_METHOD'];
    }
}
